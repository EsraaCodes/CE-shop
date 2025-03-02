<?php
include('config.php');

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $query = "SELECT * FROM orders WHERE order_id = $orderId";
    $result = mysqli_query($conn, $query);
    $order = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
        $userId = $_POST['user_id'];
        $quantity = $_POST['quantity'];
        $priceAtOrder = $_POST['price_at_order'];

        $update_query = "UPDATE orders SET user_id='$userId', quantity='$quantity', price_at_order='$priceAtOrder' 
                         WHERE order_id = $orderId";
        mysqli_query($conn, $update_query);

        header("Location: manage_orders.php");
        exit();
    }
} else {
    header("Location: manage_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="manage.css">
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>

    <h1>Edit Order</h1>

    <form method="POST" action="edit_order.php?id=<?php echo $orderId; ?>">
        <label for="user_id">User ID:</label><input type="number" name="user_id" value="<?php echo htmlspecialchars($order['user_id']); ?>" required><br>
        <label for="quantity">Quantity:</label><input type="number" name="quantity" value="<?php echo htmlspecialchars($order['quantity']); ?>" required><br>
        <label for="price_at_order">Price at Order:</label><input type="number" name="price_at_order" value="<?php echo htmlspecialchars($order['price_at_order']); ?>" required><br>

        <button type="submit" name="edit">Update Order</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
