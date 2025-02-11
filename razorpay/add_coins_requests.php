<?php
$response = [];

// Validate required POST parameters
if (empty($_POST['reference_id'])) {
    $response['success'] = false;
    $response['message'] = "Reference id is Empty";
    echo json_encode($response);
    return;
}

if (empty($_POST['buyer_name'])) {
    $response['success'] = false;
    $response['message'] = "Buyer Name is Empty";
    echo json_encode($response);
    return;
}

if (empty($_POST['amount'])) {
    $response['success'] = false;
    $response['message'] = "Amount is Empty";
    echo json_encode($response);
    return;
}

if (empty($_POST['email'])) {
    $response['success'] = false;
    $response['message'] = "Email is Empty";
    echo json_encode($response);
    return;
}

if (empty($_POST['phone'])) {
    $response['success'] = false;
    $response['message'] = "Phone is Empty";
    echo json_encode($response);
    return;
}

// Assign POST data to variables
$reference_id = $_POST['reference_id'] .'-'. time();
$buyer_name = $_POST['buyer_name'];
$amount = $_POST['amount'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$api_key = "YOUR_API_KEY_ID";
$api_secret = "YOUR_API_KEY_SECRET";
$amount = $amount * 100; // Convert amount to paise
$url = "https://api.razorpay.com/v1/payment_links";
$expire_by = (time() + 20) * 1000;

$data = [
    "upi_link" => true,
    "amount" => $amount,  // Amount in paise (₹100.00)
    "currency" => "INR",
    "accept_partial" => false,
    "expire_by" => $expire_by,
    "reference_id" => $reference_id,
    "description" => "Payment for policy no #23456",
    "customer" => [
        "name" => $buyer_name,
        "contact" => $phone,
        "email" => $email
    ],
    "notify" => [
        "sms" => true,
        "email" => true
    ],
    "reminder_enable" => true,
    "notes" => [
        "policy_name" => "Jeevan Bima"
    ],
    "callback_url" => "https://example-callback-url.com/",
    "callback_method" => "get"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":" . $api_secret);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

echo $response;



// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/oauth2/token/');
// curl_setopt($ch, CURLOPT_HEADER, FALSE);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

// $payload = [
//     'grant_type' => 'client_credentials',
//     'client_id' => 'YwMN9BucXuOn1MdwNPM9ZI1QGNR3SK09TmypyIDk',
//     'client_secret' => 'KlcnoEAqYsc0TVjdBDo8gLL2GoEspypToXuYw1bvwe06jh9FEWNqXm82iCBaW8qyXCPDLDV96SbMkXRb8xN0veNx2YowsTAGiTL4YCNwKgr8HwohUk6Y1rtWhZKu1Fgj'
// ];

// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

// // Execute cURL request for access token
// $response = curl_exec($ch);
// curl_close($ch);

// // Decode JSON response to extract access token
// $tokenData = json_decode($response, true);
// if (isset($tokenData['access_token'])) {
//     $accessToken = $tokenData['access_token'];

//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/v2/payment_requests/');
//     curl_setopt($ch, CURLOPT_HEADER, FALSE);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, [
//         'Authorization: Bearer ' . $accessToken,
//         'Content-Type: application/x-www-form-urlencoded'
//     ]);

//     $payload = [
//         'purpose' => $purpose,
//         'amount' => $amount,
//         'buyer_name' => $buyer_name,
//         'email' => $email,
//         'phone' => $phone,
//         'redirect_url' => 'https://himaapp.in/path/to/serid',
//         'send_email' => 'True',
//         'webhook' => 'https://himaapp.in/dwpay/webhook.php',
//         'allow_repeated_payments' => 'False',
//     ];

//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

//     $paymentResponse = curl_exec($ch);
//     curl_close($ch);

//     echo $paymentResponse;
// } else {
//     $response['success'] = false;
//     $response['message'] = "Failed to obtain access token.";
//     echo json_encode($response);
// }
?>
