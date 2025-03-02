<?php
session_start();
include('config.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Decor</title>
  <link rel="stylesheet" href="home1.css">
  <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<head>
  <style>
    #back-to-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color:#9e9e9e;
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
      background-color:#a6a6a6;
      transform: translateY(-3px);
    }

    #back-to-home:focus {
      outline: 3px solid #9e9e9e;
    }

@media (max-width: 768px) {
  .sidebar {
    width: 250px;
    left: -250px;
    transform: translateX(0);
  }

  .sidebar.active {
    left: 0;
  }

  .hamburger {
    display: block;
    position: fixed;
  }

  .content {
    margin-left: 0;
    padding: 20px;
    width: 100%;
  }

  .sidebar-header {
    font-size: 28px;
  }

  .sidebar-nav ul li a {
    font-size: 16px;
  }

  .category-section h2 {
    font-size: 28px;
  }

  .subcategory h3 {
    font-size: 24px;
  }

  .items {
    grid-template-columns: repeat(2, 1fr);
  }
}
html {
  scroll-behavior: smooth;
}
  </style>
</head>
<body>
<button class="hamburger" onclick="toggleSidebar()">&#9776;</button>
  <div class="sidebar">
    <div class="sidebar-header">Home Decor</div>
    <nav class="sidebar-nav">
      <ul>
        <li class="category">
          <a href="#bedroom-decor">Bedroom Decor</a>
          <ul class="dropdown-menu">
            <li><a href="#lighting-led">Lighting & LED</a></li>
            <li><a href="#accessories">Accessories</a></li>
            <li><a href="#wall-art">Wall Art</a></li>
          </ul>
        </li>

        <li class="category">
          <a href="#kitchen-decor">Kitchen Decor</a>
          <ul class="dropdown-menu">
            <li><a href="#storage-organization">Storage & Organization</a></li>
            <li><a href="#kitchen-accessories">Accessories</a></li>
          </ul>
        </li>
      </ul>
    </nav>
    <div id="cart">
      <a href="cart.php"><button id="viewcart-button">View Cart</button></a>
  </div>
  </div>
  <button id="back-to-home" onclick="window.location.href='index.php';"> Home
</button>

  <div class="content">
    <section id="bedroom-decor">
      <h2>Bedroom Decor</h2>
      <div class="subcategories">
        <div class="subcategory" id="lighting-led">
          <h3>Lighting & LED</h3>
          <div class="items">
            <?php
            foreach ($products as $product) {
              if ($product['subcategory'] == 'Lighting & LED') {
                echo '<div class="item">
                        <img src="images/'.$product['image'].'" alt="'.$product['name'].'">
                        <p class="description">'.$product['name'].'</p>
                        <p class="price">$'.$product['price'].'</p>
                        <button class="add-to-cart" data-product-id="'.$product['product_id'].'" data-quantity="1">Add to Cart</button>
                      </div>';
              }
            }
            ?>
          </div>
        </div>

        <div class="subcategory" id="accessories">
          <h3>Accessories</h3>
          <div class="items">
            <?php
            foreach ($products as $product) {
              if ($product['subcategory'] == 'Bedroom Accessories') {
                echo '<div class="item">
                        <img src="images/'.$product['image'].'" alt="'.$product['name'].'">
                        <p class="description">'.$product['name'].'</p>
                        <p class="price">$'.$product['price'].'</p>
                        <button class="add-to-cart" data-product-id="'.$product['product_id'].'" data-quantity="1">Add to Cart</button>
                      </div>';
              }
            }
            ?>
          </div>
        </div>

        <div class="subcategory" id="wall-art">
          <h3>Wall Art</h3>
          <div class="items">
            <?php
            foreach ($products as $product) {
              if ($product['subcategory'] == 'Wall Art') {
                echo '<div class="item">
                        <img src="images/'.$product['image'].'" alt="'.$product['name'].'">
                        <p class="description">'.$product['name'].'</p>
                        <p class="price">$'.$product['price'].'</p>
                        <button class="add-to-cart" data-product-id="'.$product['product_id'].'" data-quantity="1">Add to Cart</button>
                      </div>';
              }
            }
            ?>
          </div>
        </div>
      </div>
    </section>
    
    <section id="kitchen-decor">
      <h2>Kitchen Decor</h2>
      <div class="subcategories">
        <div class="subcategory" id="storage-organization">
          <h3>Storage & Organization</h3>
          <div class="items">
            <?php
            foreach ($products as $product) {
              if ($product['subcategory'] == 'Storage & Organization') {
                echo '<div class="item">
                        <img src="images/'.$product['image'].'" alt="'.$product['name'].'">
                        <p class="description">'.$product['name'].'</p>
                        <p class="price">$'.$product['price'].'</p>
                        <button class="add-to-cart" data-product-id="'.$product['product_id'].'" data-quantity="1">Add to Cart</button>
                      </div>';
              }
            }
            ?>
          </div>
        </div>
        <div class="subcategory" id="kitchen-accessories">
          <h3>Accessories</h3>
          <div class="items">
            <?php
            foreach ($products as $product) {
              if ($product['subcategory'] == 'Kitchen Accessories') {
                echo '<div class="item">
                        <img src="images/'.$product['image'].'" alt="'.$product['name'].'">
                        <p class="description">'.$product['name'].'</p>
                        <p class="price">$'.$product['price'].'</p>
                        <button class="add-to-cart" data-product-id="'.$product['product_id'].'" data-quantity="1">Add to Cart</button>
                      </div>';
              }
            }
            ?>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    const hamburger = document.querySelector('.hamburger');
const sidebar = document.querySelector('.sidebar');

hamburger.addEventListener('click', () => {
  sidebar.classList.toggle('active');
});

  document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        var productId = this.getAttribute('data-product-id');
        var quantity = this.getAttribute('data-quantity');

        if (productId && quantity > 0) {
            var userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;

            if (!userId) {
                window.location.href = 'login.php?redirect=' + encodeURIComponent(window.location.href);
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_home_to_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Product added to Cart!");
                } else {
                    alert('Error adding product to cart.');
                }
            };

            xhr.send('product_id=' + productId + '&quantity=' + quantity);
        } else {
            alert("Invalid product or quantity!");
        }
    });
});
</script>

</body>
</html>
