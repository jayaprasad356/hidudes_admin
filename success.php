<?php
// Simulating a successful payment message
$paymentStatus = "success";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745;
        }
        p {
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($paymentStatus == "success") { ?>
            <h1>Payment Paid Successfully</h1>
            <p>Close and open the app to get your coins.</p>
        <?php } else { ?>
            <h1>Payment Failed</h1>
            <p>Please try again.</p>
        <?php } ?>
    </div>
</body>
</html>
