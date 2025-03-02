<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
    SELECT cart.product_id, products.name, products.price, cart.quantity, products.image, categories.name AS category_name
    FROM cart
    JOIN products ON cart.product_id = products.product_id
    JOIN categories ON products.category_id = categories.id
    WHERE cart.user_id = $user_id
";

$result = mysqli_query($conn, $query);

$cartItems = [];
$totalPrice = 0;
$itemCount = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $cartItems[] = $row;
    $totalPrice += $row['price'] * $row['quantity'];
    $itemCount += $row['quantity'];
}

mysqli_close($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    include('config.php');

    $query = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $currentQuantity = $row['quantity'];

        if ($action == 'decrease') {
            if ($currentQuantity > 1) {
                $newQuantity = $currentQuantity - 1;
                $updateQuery = "UPDATE cart SET quantity = $newQuantity WHERE user_id = $user_id AND product_id = $product_id";
                mysqli_query($conn, $updateQuery);
                echo json_encode(['success' => true, 'message' => 'Item quantity decreased.']);
            } else {
                $deleteQuery = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";
                mysqli_query($conn, $deleteQuery);
                echo json_encode(['success' => true, 'message' => 'Item removed from cart.']);
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found in cart.']);
    }

    mysqli_close($conn);

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<head> 
    <style>
       #back-to-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color:#2c3e50;
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
      z-index: 1000;
    }

    #back-to-home:hover {
      background-color: #1c2833;
      transform: translateY(-3px);
    }

    #back-to-home:focus {
      outline: 3px solid #1c2833;
    }
    </style>
</head>
<body>
<button id="back-to-home" onclick="window.location.href='index.php#shop';"> Home
</button>
    <div class="main-content">
        <h2>Your Shopping Cart</h2>

        <div id="cart-items">
            <?php if (empty($cartItems)): ?>
                <p>Your cart is empty!</p>
                <button class="start-shopping-btn" onclick="window.location.href='index.php#shop'">Start Shopping Now</button>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="cart-item-image">
                            <img src="images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="cart-item-image">
                        </div>
                        <div class="cart-item-details">
                            <span class="item-name"><?= htmlspecialchars($item['name']) ?></span>
                            <span class="item-price">$<?= number_format($item['price'], 2) ?></span>
                            <span class="item-quantity">Quantity: <?= $item['quantity'] ?></span>
                            <button class="remove-btn" onclick="removeFromCart(<?= $item['product_id'] ?>)">Remove</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="cart-summary">
        <h3>Cart Summary</h3>
        <p>Items: <span id="item-count"><?= $itemCount ?></span></p>
        <p>Total: <span class="total-price" id="total-price">$<?= number_format($totalPrice, 2) ?></span></p>
        <button class="checkout-btn" onclick="window.location.href='checkout.php'">Checkout</button>
        <button class="clear-cart-btn" onclick="clearCart()">Empty Cart</button>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
    </div>

    <script>
        function removeFromCart(productId) {
            fetch('cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'product_id=' + productId + '&action=decrease'
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        function clearCart() {
            if (confirm('Are you sure you want to clear the cart?')) {
                fetch('clear_cart.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_id: <?= $user_id ?> })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</body>
</html>
