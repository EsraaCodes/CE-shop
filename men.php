<?php
session_start();

include('config.php');

function fetchProductsBySubcategory($subcategory, $categoryId = null) {
    global $conn;
    
    $sql = "SELECT * FROM products WHERE subcategory = '$subcategory'";
    
    if ($categoryId !== null) {
        $sql .= " AND category_id = $categoryId";
    }
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

$shirts = fetchProductsBySubcategory("Shirt");
$bottoms = fetchProductsBySubcategory("Pants", 2);
$sportswear = fetchProductsBySubcategory("Sportswear");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Men's Collection</title>
  <link rel="stylesheet" href="menn.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
  <script src="menwomen.js"></script>
  <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<head>
  <style>
#back-to-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color:rgb(44, 150, 221);
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
      background-color:rgb(44, 150, 221);
      transform: translateY(-3px);
    }

    #back-to-home:focus {
      outline: 3px solidrgb(196, 191, 236);
    }</style>
</head>
<body>
  
  <div id="mySidebar" class="sidebar">
    <div class="logo-container">
      <h1>C&E</h1>
      <p>Your luxury awaits</p>
    </div>
    <ul class="category-list">
      <li><a href="#shirts-section">Shirts</a></li>
      <li><a href="#bottoms-section">Bottoms</a></li>
      <li><a href="#sportswear-section">Sportswear</a></li>
    </ul>
    <div id="cart">
      <a href="cart.php"><button id="view-cart-btn">View Cart</button></a>
    </div>
  </div>

  <!-- for mobile -->
  <button class="openbtn" onclick="toggleSidebar()">&#9776;</button>

  <div class="main-content">
    
    <div class="slideshow">
      <div class="slide fade">
        <img src="slide4.jpg" alt="Slide 1">
      </div>  
      <div class="slide fade">
        <img src="slide5.jpg" alt="Slide 2">
      </div>
      <div class="slide fade">
        <img src="slide6.jpg" alt="Slide 6">
      </div>
    </div>

    <button id="back-to-home" onclick="window.location.href='index.php';"> Home
</button>

    
    <?php
    $categories = [
        "shirts" => $shirts,
        "bottoms" => $bottoms,
        "sportswear" => $sportswear
    ];
    foreach ($categories as $key => $products): 
    ?>
    <div id="<?= $key ?>-section" class="category-title">
      <h2><?= ucfirst($key) ?></h2>
    </div>
    <div class="product-grid">
      <?php foreach ($products as $product): ?>
      <div class="product-item">
        <img src="images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <p class="price">$<?= number_format($product['price'], 2) ?></p>
        <select class="size-select">
          <option value="" disabled selected>Select Size</option>
          <?php 
          $sizes = explode(",", $product['SizesAvailable']); 
          foreach ($sizes as $size):
          ?>
          <option value="<?= $size ?>"><?= $size ?></option>
          <?php endforeach; ?>
        </select>
        <button class="add-to-cart" 
                data-product-id="<?= $product['product_id'] ?>" 
                data-product-name="<?= htmlspecialchars($product['name']) ?>" 
                data-product-price="<?= $product['price'] ?>">
          Add to Cart
        </button>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
  </div>

  <script>
 document.addEventListener('DOMContentLoaded', function () {
  const openBtn = document.querySelector('.openbtn');
  const sidebar = document.querySelector('.sidebar');

  openBtn.addEventListener('click', function () {
      sidebar.classList.toggle('open');
  });
});


let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function showSlide(index) {
  slides.forEach(slide => slide.classList.remove('fade'));
  slides[index].classList.add('fade');
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % totalSlides;
  showSlide(currentSlide);
}

setInterval(nextSlide, 3000);

showSlide(currentSlide);

document.addEventListener("DOMContentLoaded", function() {
  const slides = document.querySelectorAll('.slide');
  if (slides.length > 0) {
    slides[0].classList.add('fade');
  }
});

  </script>
  <script>
  $(document).ready(function() {
    $('.add-to-cart').click(function() {
      var selectedSize = $(this).siblings('.size-select').val(); 
      var productId = $(this).data('product-id');
      var productName = $(this).data('product-name');
      var productPrice = $(this).data('product-price');
      var userId = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>"; 
      var quantity = 1; 

      if (!userId) {
        window.location.href = 'login.php?redirect=' + encodeURIComponent(window.location.href); 
      }

      if (!selectedSize) {
        alert('Please select a size!');
        return;
      }

      $.ajax({
        url: 'add_to_cart.php',
        method: 'POST',
        data: {
          user_id: userId,
          product_id: productId,
          quantity: quantity,
          size: selectedSize 
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
