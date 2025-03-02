<?php
session_start();
include('config.php');

if (isset($_SESSION['user_id'])) {
    echo "User is logged in with ID: " . $_SESSION['user_id'];
} else {
    echo "User is not logged in";
}

if (isset($_POST['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $userId = $_POST['user_id'];
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $sql = "SELECT * FROM cart WHERE user_id = $userId AND product_id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sql = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $userId AND product_id = $productId";
    } else {
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>