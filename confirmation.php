<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_SESSION['confirmation'])) {
    header("Location: checkout.php");
    exit();
}


$orderConfirmation = $_SESSION['confirmation'];
unset($_SESSION['confirmation']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="icon" href="favicon.ico" sizes="16x16" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .confirmation-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            width: 450px;
            text-align: center;
        }

        h1 {
            color: #2d3e50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .order-details {
            margin: 20px 0;
            text-align: left;
            font-size: 16px;
            color: #4f5b66;
        }

        .order-details h3 {
            color: #005a8d;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .order-details p {
            margin: 10px 0;
        }

        .back-home-btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #2d3e50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .back-home-btn:hover {
            background-color: #004c7d;
        }

        .order-details strong {
            color: #2d3e50;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <h1>Order Confirmation</h1>

        <div class="order-details">
            <h3>Thank you for your order!</h3>
            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($orderConfirmation['order_id']); ?></p>
            <p><strong>Total Price:</strong> $<?php echo number_format($orderConfirmation['total_price'], 2); ?></p>
            <p><strong>Street:</strong> <?php echo htmlspecialchars($orderConfirmation['street']); ?></p>
            <p><strong>City:</strong> <?php echo htmlspecialchars($orderConfirmation['city']); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($orderConfirmation['payment_method']); ?></p>
        </div>

        <a href="index.php" class="back-home-btn">Return to Home</a>
    </div>
</body>
</html>
