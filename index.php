<?php
session_start(); 

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
$user_id = $isLoggedIn ? $_SESSION['user_id'] : null; // If logged in, store user ID


if ($isLoggedIn && !isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Initialize empty cart 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C&E - Your Key to Luxury</title>
  <link rel="stylesheet" href="index.css">
  <link rel="icon" href="favicon.ico" sizes="16x16" />
  

  
</head>
<body>
  
<?php include('header.php'); ?>
  <main id="home">
    <section id="hero">
        <div class="hero-container">
          <div class="hero-text">
            <h1>What is C&E?</h1>
           <br><br> <p>
              A clothing brand founded by two best friends to bring elegance to your wardrobe. Celine and Esraa had a 
              passion for such creativity and decided to show the world the greatness of mixing art and fashion.
            </p> <br>
            <p>
              As a result, C&E was created. All you can do is your best to benefit from it!
            </p>
          </div>
          <div class="hero-image">
            <img src="first.jpg" alt="C&E Founders" />
          </div>
        </div>
      </section>

      <section class="categories-container" id="shop">
        <h2>Explore Our Categories</h2>
        <div class="categories-grid">
        
          <div class="category-item">
            <a href="women.php"><h3>Women</h3></a>
            <img src="images/women.jpg" alt="Women Category" class="category-image">
            <p>Elegant apparel for every occasion.</p>
          </div>
      
        
          <div class="category-item">
            <a href="men.php"><h3>Men</h3></a>
            <img src="images/men.jpg" alt="Men Category" class="category-image">
            <p>Timeless fashion for men.</p>
          </div>
      
          <div class="category-item">
            <a href="bags.php"><h3>Bags</h3></a>
            <img src="images/bags.jpg" alt="Bags Category" class="category-image">
            <p>Luxury bags to match your style.</p>
          </div>
      
         
          <div class="category-item">
            <a href="beauty.php"><h3>Beauty</h3></a>
            <img src="images/beauty.jpg" alt="Beauty Category" class="category-image">
            <p>Luxurious beauty products.</p>
          </div>


         
          <div class="category-item">
            <a href="home.php"><h3>Home Decor</h3></a>
            <img src="images/home.jpg" alt="Home Decor Category" class="category-image">
            <p>Elegant touches for your home.</p>
          </div>
        </div>
      </section>
      
      
      <section class="content-section" id="bestsellers">
        <h2>Bestseller Items</h2>
        <div class="product-grid">
          <div class="product-item">
            <img src="luxuryblazer.jpg" alt="Luxury Blazer" class="product-img">
          </div>
          <div class="product-item">
            <img src="elegentdress.jpg" alt="Elegant Dress" class="product-img">
          </div>
          <div class="product-item">
            <img src="classicshirt.jpg" alt="Classic Shirt" class="product-img">
          </div>
          <div class="product-item">
            <img src="chichandbag.jpg" alt="Chic Handbag" class="product-img">
          </div>
        </div>
      </section>
       
      

      <section id="sales">
        <h2>Exclusive Sales</h2>
        <div class="sales-container">
        
          <div class="sale-item">
            <h3>50% Off</h3>
            <p>Get 50% off on select items. Limited time offer!</p>
            <div class="sale-images">
              <img src="images/top1sale.jpg" alt="50% Off Item 1">
              <img src="images/50sale3.jpg" alt="50% Off Item 2">
            </div>
            <a href="sale1.php" class="cta-button">Shop Now</a>
          </div>
      
          <div class="sale-item">
            <h3>30% Off</h3>
            <p>Enjoy 30% off on your favorites. Grab them before they're gone!</p>
            <div class="sale-images">
              <img src="images/jacket1sale.jpg" alt="30% Off Item 1">
              <img src="images/top2sale.jpg" alt="30% Off Item 2">
            </div>
            <a href="sale2.php" class="cta-button">Shop Now</a>
          </div>
      
        
          <div class="sale-item">
            <h3>Buy 1 Get 1 Free</h3>
            <p>For a limited time, buy one, get one free on selected items!</p>
            <div class="sale-images">
              <img src="images/top3sale.jpg" alt="Buy 1 Get 1 Free Item 1">
              <img src="images/dress3sale.jpg" alt="Buy 1 Get 1 Free Item 2">
            </div>
            <a href="sale3.php" class="cta-button">Shop Now</a>
          </div>
        </div>
      </section>
  </main>

  <section id="connect" class="image-placeholder">
    <div  class="cta-container">
      <h2>Stay Connected</h2>
      <p>Follow us on Facebook for exclusive updates, offers, and the latest arrivals.</p>
      <a href="https://www.facebook.com" class="cta-button">Follow Us</a>
    </div>
    <img src="facebook.jpg" alt="Facebook Follow" class="cta-image">
  </section>
  <?php include('footer.html'); ?>
</main>

</body>
</html>
