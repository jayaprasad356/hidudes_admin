<?php
// Capture the incoming data (for application/x-www-form-urlencoded)
$incomingData = $_POST;

// Log the incoming data for debugging
$logFile = 'webhook_log.txt';
$logData = "Incoming Data: " . print_r($incomingData, true) . "\n";

// Check if the status is 'Credit'
if (isset($incomingData['status']) && $incomingData['status'] === 'Credit') {
    
    // Parse the 'purpose' field and assign to respective variables
    if (isset($incomingData['purpose'])) {
        $purposeParts = explode('-', $incomingData['purpose']);
        
        $user_id = isset($purposeParts[0]) ? $purposeParts[0] : null;
        $coins_id = isset($purposeParts[1]) ? $purposeParts[1] : null;

        // Log the parsed data
        $logData .= "Parsed Purpose Data: \n";
        $logData .= "User ID: $user_id\n";
        $logData .= "Coins ID: $coins_id\n";

        // Call the external API with form data if status is Credit
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

        // Log API response
        $logData .= "API Response: " . $apiResponse . "\n";
    }

    // Write to log file
    file_put_contents($logFile, $logData, FILE_APPEND);

    // Respond with success message
    header('Content-Type: application/json');
    $response = [
        'status' => 'success',
        'message' => 'Webhook received, status is Credit, purpose parsed, order placed, and logged',
        'parsed_data' => [
            'user_id' => $user_id,
            'coins_id' => $coins_id

            
        ]
    ];
    echo json_encode($response);

} else {
    // If status is not 'Credit', log and respond with error
    $logData .= "Error: Invalid status or status not Credit\n";
    file_put_contents($logFile, $logData, FILE_APPEND);
    
    header('Content-Type: application/json');
    $response = [
        'status' => 'error',
        'message' => 'Invalid status or status not Credit'
    ];
    echo json_encode($response);
}
