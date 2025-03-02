<?php
session_start();  
include('config.php');

// Fetch products
function fetchProductsBySubcategory($subcategory) {
    global $conn;
 
    $sql = "SELECT * FROM products WHERE subcategory = '$subcategory' AND category_id = 1";  
    $result = $conn->query($sql);

    // Return products 
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return []; // Return empty array if no products found
    }
}


$dresses = fetchProductsBySubcategory("Dresses");
$hoodies = fetchProductsBySubcategory("Hoodies");  
$sweaters = fetchProductsBySubcategory("Sweaters");  
$pants = fetchProductsBySubcategory("Pants");  
$skirts = fetchProductsBySubcategory("Skirts");  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Women's Collection</title>
  <link rel="stylesheet" href="womenn.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
 <link rel="icon" href="favicon.ico" sizes="16x16" />
 
</head>
<head>
  <style>
    #back-to-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #ff66b2;
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
      background-color: #f06292;
      transform: translateY(-3px);
    }

    #back-to-home:focus {
      outline: 3px solid #ff66b2;
    }

  </style>
</head>

<body>
  <div class="sidebar">
    <div class="logo-container">
      <h1>C&E</h1>
      <p>Your luxury awaits</p>
    </div>
    <ul class="category-list">
  
    <li><a href="#dresses-section">Dresses</a></li>
      <li><a href="#hoodies-section">Hoodies</a></li>
      <li><a href="#sweaters-section">Sweaters</a></li>
      <li class="dropdown">
        <a href="#pants-section">Bottoms</a>
        <div class="dropdown-content">
          <a href="#pants-section">Pants</a>
          <a href="#skirts-section">Skirts</a>
        </div>
      </li>
     
    </ul>
    <div id="cart">
      <a href="cart.php"><button id="view-cart-btn">View Cart</button></a>
    </div>
  </div>
  <button class="openbtn" onclick="toggleSidebar()">&#9776;</button>
 
  <div class="main-content">
    <div class="slideshow">
      <div class="slide fade">
        <img src="slide1.jpg" alt="Slide 1">
      </div>
      <div class="slide fade">
        <img src="slide2.jpg" alt="Slide 2">
      </div>
      <div class="slide fade">
        <img src="slide3.jpg" alt="Slide 3">
      </div>
    </div>

    <button id="back-to-home" onclick="window.location.href='index.php';"> Home
</button>

    <div id="dresses-section" class="category-title">
      <h2>Dresses</h2>
    </div>
    <div class="product-grid">
      <?php foreach ($dresses as $dress): ?>
      <div class="product-item">
        <img src="images/<?php echo $dress['image']; ?>" alt="<?php echo $dress['name']; ?>">
        <p class="price">$<?php echo number_format($dress['price'], 2); ?></p>
        
       
        <select class="size-select" id="size-<?php echo $dress['product_id']; ?>">
          <option value="">Select Size</option>
          <?php
            $sizes = explode(", ", $dress['SizesAvailable']); 
            foreach ($sizes as $size) {
              echo "<option value=\"$size\">$size</option>";
            }
          ?>
        </select>

        <button class="add-to-cart" id="add-to-cart-<?php echo $dress['product_id']; ?>" 
                data-product-id="<?php echo $dress['product_id']; ?>"
                data-product-name="<?php echo $dress['name']; ?>"
                data-product-price="<?php echo $dress['price']; ?>">Add to Cart</button>
      </div>
      <?php endforeach; ?>
    </div>

   
    <div id="hoodies-section" class="category-title">
      <h2>Hoodies</h2>
    </div>
    <div class="product-grid">
      <?php foreach ($hoodies as $hoodie): ?>
      <div class="product-item">
        <img src="images/<?php echo $hoodie['image']; ?>" alt="<?php echo $hoodie['name']; ?>">
        <p class="price">$<?php echo number_format($hoodie['price'], 2); ?></p>
        
      
        <select class="size-select" id="size-<?php echo $hoodie['product_id']; ?>">
          <option value="">Select Size</option>
          <?php
            $sizes = explode(", ", $hoodie['SizesAvailable']);
            foreach ($sizes as $size) {
              echo "<option value=\"$size\">$size</option>";
            }
          ?>
        </select>

        <button class="add-to-cart" id="add-to-cart-<?php echo $hoodie['product_id']; ?>" 
                data-product-id="<?php echo $hoodie['product_id']; ?>"
                data-product-name="<?php echo $hoodie['name']; ?>"
                data-product-price="<?php echo $hoodie['price']; ?>">Add to Cart</button>
      </div>
      <?php endforeach; ?>
    </div>

   
    <div id="sweaters-section" class="category-title">
      <h2>Sweaters</h2>
    </div>
    <div class="product-grid">
      <?php foreach ($sweaters as $sweater): ?>
      <div class="product-item">
        <img src="images/<?php echo $sweater['image']; ?>" alt="<?php echo $sweater['name']; ?>">
        <p class="price">$<?php echo number_format($sweater['price'], 2); ?></p>
        
        <select class="size-select" id="size-<?php echo $sweater['product_id']; ?>">
          <option value="">Select Size</option>
          <?php
            $sizes = explode(", ", $sweater['SizesAvailable']);
            foreach ($sizes as $size) {
              echo "<option value=\"$size\">$size</option>";
            }
          ?>
        </select>

        <button class="add-to-cart" id="add-to-cart-<?php echo $sweater['product_id']; ?>" 
                data-product-id="<?php echo $sweater['product_id']; ?>"
                data-product-name="<?php echo $sweater['name']; ?>"
                data-product-price="<?php echo $sweater['price']; ?>">Add to Cart</button>
      </div>
      <?php endforeach; ?>
    </div>

  
    <div id="pants-section" class="category-title">
      <h2>Pants</h2>
    </div>
    <div class="product-grid">
      <?php foreach ($pants as $pant): ?>
      <div class="product-item">
        <img src="images/<?php echo $pant['image']; ?>" alt="<?php echo $pant['name']; ?>">
        <p class="price">$<?php echo number_format($pant['price'], 2); ?></p>
        
        
        <select class="size-select" id="size-<?php echo $pant['product_id']; ?>">
          <option value="">Select Size</option>
          <?php
            $sizes = explode(", ", $pant['SizesAvailable']);
            foreach ($sizes as $size) {
              echo "<option value=\"$size\">$size</option>";
            }
          ?>
        </select>

        <button class="add-to-cart" id="add-to-cart-<?php echo $pant['product_id']; ?>" 
                data-product-id="<?php echo $pant['product_id']; ?>"
                data-product-name="<?php echo $pant['name']; ?>"
                data-product-price="<?php echo $pant['price']; ?>">Add to Cart</button>
      </div>
      <?php endforeach; ?>
    </div>

  
    <div id="skirts-section" class="category-title">
      <h2>Skirts</h2>
    </div>
    <div class="product-grid">
      <?php foreach ($skirts as $skirt): ?>
      <div class="product-item">
        <img src="images/<?php echo $skirt['image']; ?>" alt="<?php echo $skirt['name']; ?>">
        <p class="price">$<?php echo number_format($skirt['price'], 2); ?></p>
        
        
        <select class="size-select" id="size-<?php echo $skirt['product_id']; ?>">
          <option value="">Select Size</option>
          <?php
            $sizes = explode(", ", $skirt['SizesAvailable']);
            foreach ($sizes as $size) {
              echo "<option value=\"$size\">$size</option>";
            }
          ?>
        </select>

        <button class="add-to-cart" id="add-to-cart-<?php echo $skirt['product_id']; ?>" 
                data-product-id="<?php echo $skirt['product_id']; ?>"
                data-product-name="<?php echo $skirt['name']; ?>"
                data-product-price="<?php echo $skirt['price']; ?>">Add to Cart</button>
      </div>
      <?php endforeach; ?>
    </div>
  </div>


  <script>
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
    slides[0].classList.add('fade'); // Show the first slide 
  }
});


document.addEventListener('DOMContentLoaded', function () {
  const openBtn = document.querySelector('.openbtn');
  const sidebar = document.querySelector('.sidebar');

  openBtn.addEventListener('click', function () {
      sidebar.classList.toggle('open');
  });
});

   
    $(document).ready(function() {
      $('.add-to-cart').click(function() {
        var productId = $(this).data('product-id');
        var productName = $(this).data('product-name');
        var productPrice = $(this).data('product-price');
        var size = $('#size-' + productId).val();  
        var quantity = 1;  
        var userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>;  

        if (!userId) {
          
          window.location.href = 'login.php'; 
          return;
        }

        if (!size) {
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
            size: size 
          },
          success: function(response) {
            alert('Product added to cart!');
          },
          error: function(xhr, status, error) {
            alert('An error occurred. Please try again.');
          }
        });
      });
    });
  </script>

</body>
</html>
