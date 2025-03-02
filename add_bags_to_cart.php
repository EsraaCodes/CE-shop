<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $quantity = 1;

    if (!isset($userId)) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit;
    }

    $query = "SELECT quantity FROM cart WHERE user_id = $userId AND product_id = $productId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $newQuantity = $row['quantity'] + $quantity;

        $updateQuery = "UPDATE cart SET quantity = $newQuantity WHERE user_id = $userId AND product_id = $productId";
        $conn->query($updateQuery);

        echo json_encode(['status' => 'success', 'message' => 'Product quantity updated']);
    } else {
        $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
        $conn->query($insertQuery);

        echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>