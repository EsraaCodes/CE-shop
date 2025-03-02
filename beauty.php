<?php
session_start();
include('config.php');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$query = "SELECT * FROM products WHERE category_id = 4";

$result = mysqli_query($conn, $query);

if ($result) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    die("Error fetching products: " . mysqli_error($conn));
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beauty Collection</title>
  <link rel="stylesheet" href="beautyy.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="icon" href="favicon.ico" sizes="16x16" />
  <style>
    #back-to-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color:#ffb6b9;
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
      background-color:#ff6f61;
      transform: translateY(-3px);
    }

    #back-to-home:focus {
      outline: 3px solid  #ff6f61;
    }

  </style>
</head>
<body>
  <div class="sidebar">
    <div class="logo-container">
      <h1>Beauty Luxe</h1>
      <p>Your glow, our priority</p>
    </div>
    <ul class="category-list">
      <li><a href="#skincare-section">Skincare</a></li>
      <li class="dropdown">
        <a href="#">Makeup</a>
        <div class="dropdown-content">
          <a href="#makeup-face-section">Face</a>
          <a href="#makeup-eyes-section">Eyes</a>
          <a href="#makeup-lips-section">Lips</a>
        </div>
      </li>
    </ul>
    <div class="cart-container">
      <ul id="cart-items"></ul>
      <h2>Your Cart</h2>
      <a href="cart.php"><button id="viewcart-button">View Cart</button></a>
    </div>
  </div>
  <button id="back-to-home" onclick="window.location.href='index.php';"> Home</button>
  <button id="hamburger-menu">☰</button>

  <script>
  $(document).ready(function() {
    $('#hamburger-menu').click(function() {
      $('.sidebar').toggleClass('open');
    });
  });
  </script>

  <div class="main-content">
    <div id="skincare-section" class="category-title">
      <h2>Skincare</h2>
    </div>
    <div class="product-grid">
      <?php foreach ($products as $product): ?>
        <?php if ($product['subcategory'] == 'Skincare'): ?>
          <div class="product-item">
            <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            <p><?= htmlspecialchars($product['name']) ?></p>
            <p class="price">$<?= number_format($product['price'], 2) ?></p>
            <button class="add-to-cart" data-product-id="<?= $product['product_id'] ?>">Add to Cart</button>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>

    <div id="makeup-section" class="category-title">
      <h2>Makeup</h2>
    </div>

    <div id="makeup-face-section" class="subcategory-section">
      <h3>Face</h3>
      <div class="product-grid">
        <?php foreach ($products as $product): ?>
          <?php if ($product['subcategory'] == 'Makeup - Face'): ?>
            <div class="product-item">
              <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
              <p><?= htmlspecialchars($product['name']) ?></p>
              <p class="price">$<?= number_format($product['price'], 2) ?></p>
              <button class="add-to-cart" data-product-id="<?= $product['product_id'] ?>">Add to Cart</button>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="makeup-eyes-section" class="subcategory-section">
      <h3>Eyes</h3>
      <div class="product-grid">
        <?php foreach ($products as $product): ?>
          <?php if ($product['subcategory'] == 'Makeup - Eyes'): ?>
            <div class="product-item">
              <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
              <p><?= htmlspecialchars($product['name']) ?></p>
              <p class="price">$<?= number_format($product['price'], 2) ?></p>
              <button class="add-to-cart" data-product-id="<?= $product['product_id'] ?>">Add to Cart</button>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="makeup-lips-section" class="subcategory-section">
      <h3>Lips</h3>
      <div class="product-grid">
        <?php foreach ($products as $product): ?>
          <?php if ($product['subcategory'] == 'Makeup - Lips'): ?>
            <div class="product-item">
              <img src="images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
              <p><?= htmlspecialchars($product['name']) ?></p>
              <p class="price">$<?= number_format($product['price'], 2) ?></p>
              <button class="add-to-cart" data-product-id="<?= $product['product_id'] ?>">Add to Cart</button>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('.add-to-cart').click(function() {
        var productId = $(this).data('product-id');
        var userId = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";
        var quantity = 1;

        if (!userId) {
          window.location.href = 'login.php?redirect=' + encodeURIComponent(window.location.href);
          return;
        }

        $.ajax({
          url: 'add_beauty_to_cart.php',
          method: 'POST',
          data: {
            user_id: userId,
            product_id: productId,
            quantity: quantity
          },
          success: function(response) {
            alert('Product added to cart!');
          },
          error: function(xhr, status, error) {
            alert('An error occurred: ' + xhr.responseText);
          }
        });
      });
    });
  </script>
</body>
</html>
