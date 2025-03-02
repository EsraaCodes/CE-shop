<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('config.php');

$user_id = $_SESSION['user_id'];

$query = "SELECT products.product_id, products.name, products.price, cart.quantity 
          FROM cart 
          JOIN products ON cart.product_id = products.product_id 
          WHERE cart.user_id = $user_id";
$result = mysqli_query($conn, $query);

$totalPrice = 0;
$cartItems = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
    $totalPrice += $row['price'] * $row['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $street = $_POST['street'];
    $city = $_POST['city'];
    $payment_method = $_POST['payment_method'];
    $order_items = json_decode($_POST['order_items'], true);

    mysqli_begin_transaction($conn);

    try {
        $insertOrderQuery = "INSERT INTO orders (user_id, quantity, price_at_order) 
                             VALUES ($user_id, " . count($order_items) . ", $totalPrice)";
        $insertResult = mysqli_query($conn, $insertOrderQuery);
        if (!$insertResult) {
            throw new Exception("Error inserting order.");
        }
        
        $order_id = mysqli_insert_id($conn);

        foreach ($order_items as $item) {
            $product_id = $item['product_id'];
            $total_price = $item['total_price'];
            $ordered_quantity = $item['quantity'];

            $stockCheckQuery = "SELECT stock_quantity, name FROM products WHERE product_id = $product_id";
            $stockResult = mysqli_query($conn, $stockCheckQuery);
            $stockRow = mysqli_fetch_assoc($stockResult);

            if ($stockRow['stock_quantity'] <= 0) {
                echo "<script>
                        alert('The product " . $stockRow['name'] . " is sold out!');
                        window.location.href = 'cart.php'; 
                      </script>";
                mysqli_rollback($conn);
                exit();
            }

            $newStockQuantity = max(0, $stockRow['stock_quantity'] - $ordered_quantity);
            $updateStockQuery = "UPDATE products SET stock_quantity = $newStockQuantity WHERE product_id = $product_id";
            if (!mysqli_query($conn, $updateStockQuery)) {
                throw new Exception("Error updating stock.");
            }

            $insertOrderItemQuery = "INSERT INTO order_items (order_id, product_id, total_price) 
                                     VALUES ($order_id, $product_id, $total_price)";
            if (!mysqli_query($conn, $insertOrderItemQuery)) {
                throw new Exception("Error inserting order items.");
            }
        }

        $clearCartQuery = "DELETE FROM cart WHERE user_id = $user_id";
        mysqli_query($conn, $clearCartQuery);

        mysqli_commit($conn);

        $_SESSION['confirmation'] = [
            'order_id' => $order_id,
            'total_price' => $totalPrice,
            'street' => $street,
            'city' => $city,
            'payment_method' => $payment_method,
        ];

        header("Location: confirmation.php");
        exit();

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    <div id="checkout-container" class="checkout-container">
        <h1>Checkout</h1>
        <form action="checkout.php" method="POST">
            <div class="location-section">
                <h3>Location</h3>
                <label for="street">Street</label>
                <input type="text" id="street" name="street" placeholder="Enter street name" required>
                
                <label for="city">City</label>
                <input type="text" id="city" name="city" placeholder="Enter city name" required>
            </div>

            <div class="payment-section">
                <h3>Payment Method</h3>
                <label for="payment-method">Choose Payment Method</label>
                <select id="payment-method" name="payment_method" required>
                    <option value="USD">USD</option>
                    <option value="LBP">Lebanese Pounds</option>
                </select>
            </div>

            <div class="summary-section">
                <h3>Order Summary</h3>
                <p>Total: <span id="order-total">$<?php echo number_format($totalPrice, 2); ?></span></p>
            </div>

            <input type="hidden" name="order_items" id="order_items_input">

            <div class="place-order-section">
                <button type="submit" id="place-order-btn">Place Order</button>
            </div>
        </form>
    </div>

    <div class="background-overlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const orderItems = <?php echo json_encode($cartItems); ?>;
            const orderItemsInput = document.getElementById('order_items_input');

            const orderDetails = orderItems.map(item => ({
                product_id: item.product_id,
                quantity: item.quantity,
                total_price: item.price * item.quantity
            }));

            orderItemsInput.value = JSON.stringify(orderDetails);
        });
    </script>
</body>
</html>
