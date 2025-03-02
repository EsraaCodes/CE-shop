<?php
include('config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $userId = $_POST['user_id'];
    $quantity = $_POST['quantity'];
    $priceAtOrder = $_POST['price_at_order'];

    $query = "INSERT INTO orders (user_id, quantity, price_at_order) 
              VALUES ('$userId', '$quantity', '$priceAtOrder')";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error adding order: " . mysqli_error($conn);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $orderId = $_GET['id'];

 
    mysqli_query($conn, "DELETE FROM order_items WHERE order_id = $orderId");

 
    $query = "DELETE FROM orders WHERE order_id = $orderId";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error deleting order: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="manage.css"> 
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    <div class="main-content">
        <h1>Manage Orders</h1>

    
        <button id="addButton">Add Order</button>
        <div id="addForm" style="display:none;">
            <h2>Add New Order</h2>
            <form method="POST" action="manage_orders.php">
                <label for="user_id">User ID:</label><input type="number" name="user_id" required><br>
                <label for="quantity">Quantity:</label><input type="number" name="quantity" required><br>
                <label for="price_at_order">Price at Order:</label><input type="number" name="price_at_order" required><br>
                <button type="submit" name="add">Add Order</button>
            </form>
        </div>

        
        <table border="1">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Quantity</th>
                    <th>Price at Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['price_at_order']; ?></td>
            <td>
                <a href="edit_order.php?id=<?php echo $row['order_id']; ?>">Edit</a> |
                <a href="manage_orders.php?action=delete&id=<?php echo $row['order_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="5">No orders found.</td></tr>
<?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
      
        document.getElementById('addButton').onclick = function() {
            var form = document.getElementById('addForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        };
    </script>
</body>
</html>

<?php $conn->close(); ?>
