<?php

// Get raw POST data from Razorpay webhook
$incomingData = file_get_contents("php://input");

// Decode JSON data
$data = json_decode($incomingData, true);

// Check if the webhook contains payment data
if (isset($data['payload']['payment_link']['entity']['status']) &&
    $data['payload']['payment_link']['entity']['status'] === "paid") {
    
    // Extract reference ID
    $reference_id = $data['payload']['payment_link']['entity']['reference_id'];
    $purposeParts = explode('-', $reference_id);
    $user_id = isset($purposeParts[0]) ? $purposeParts[0] : null;
    $coins_id = isset($purposeParts[1]) ? $purposeParts[1] : null;

    $apiUrl = 'https://hidude.in/api/auth/add_coins';

    $formData = [
        'user_id' => $user_id,
        'coins_id' => $coins_id
    ];

    // Initialize cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($formData));

    // Execute the request and get the response
    $apiResponse = curl_exec($ch);
    curl_close($ch);

    echo "Payment received. Reference ID: " . $reference_id;
} else {
    echo "Payment not successful.";
}

?>
