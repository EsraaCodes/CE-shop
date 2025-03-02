<?php
session_start();
include('config.php'); 

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $productId = isset($_POST['product_id']) ? $_POST['product_id'] : 0; 
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1; 

    if (!is_numeric($productId) || $productId <= 0 || !is_numeric($quantity) || $quantity <= 0) {
        echo "Error: Invalid product or quantity.";
        exit();
    }

    $sql = "SELECT * FROM products WHERE product_id = $productId"; 
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "Error: Product does not exist.";
        exit();
    }

    $sql = "SELECT * FROM cart WHERE user_id = $userId AND product_id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $userId AND product_id = $productId";
    } else {
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
    }

    if ($conn->query($sql)) {
        echo "Product added to cart successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "User not logged in!";
}

$conn->close();
?>