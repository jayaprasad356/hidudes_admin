<?php
// Get the raw POST data
$data = file_get_contents("php://input");

// Decode JSON if needed
$decodedData = json_decode($data, true);

// Prepare log entry
$logEntry = date('Y-m-d H:i:s') . " - " . json_encode($decodedData, JSON_PRETTY_PRINT) . "\n";

// Append log entry to log.txt
file_put_contents("log.txt", $logEntry, FILE_APPEND);

echo "Webhook received successfully.";
?>
