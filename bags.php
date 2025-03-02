<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="icon" href="favicon.ico" sizes="16x16" />
  <title>Luxury Bags</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="bags.css">
  <link href="css/responsive.css" rel="stylesheet" />
  <style>
    .add-to-cart-action {
      cursor: pointer;
    }

    .view-cart-container {
      text-align: center; 
      margin-top: 30px;   
    }

    #view-cart-btn {
      padding: 12px 25px;
      background-color:rgb(233, 88, 190);
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
    }

    #view-cart-btn:hover {
      background-color:rgba(255, 0, 170, 0.35);
    }

    #back-to-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color:rgb(233, 88, 190);
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
      background-color:rgba(255, 0, 170, 0.35);
      transform: translateY(-3px);
    }

    #back-to-home:focus {
      outline: 3px solidrgb(196, 191, 236);
    }
  </style>
</head>

<body>

  <div class="slideshow-container">
    <div class="owl-carousel owl-theme">
      <div class="item">
        <img src="images/slideshow1.jpg" alt="Luxury Bag 1" style="width:100%; height:100vh; object-fit:cover;">
      </div>
      <div class="item">
        <img src="images/slidshow2.jpg" alt="Luxury Bag 2" style="width:100%; height:100vh; object-fit:cover;">
      </div>
      <div class="item">
        <img src="images/slideshow3.jpeg" alt="Luxury Bag 3" style="width:100%; height:100vh; object-fit:cover;">
      </div>
    </div>
  </div>
  <button id="back-to-home" onclick="window.location.href='index.php';"> Home
  </button>

  <div class="hero_area">
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand" href="index.html">
          <span>Bags</span>
        </a>
      </nav>
    </header>
  </div>

  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Check out our <b><i>Luxurious</i></b> Bags
        </h2>
      </div>
      <div class="row">
        <?php
        session_start();
        include('config.php');
        $sql = "SELECT product_id, name, price, image, stock_quantity FROM products WHERE category_id = 3";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $name = $row['name'];
            $price = $row['price'];
            $image = $row['image'];
            $stock = $row['stock_quantity'];
            $imagePath = "images/" . $image;
            echo "<div class='col-sm-6 col-md-4 col-lg-3'>
                    <div class='box'>
                      <a  class='add-to-cart' data-id='$product_id' data-name='$name' data-price='$price' data-image='$image'>
                        <div class='img-box'>
                          <img src='$imagePath' alt='$name'>
                        </div>
                        <div class='detail-box'>
                          <h6>$name</h6>
                          <h6>Price <span>\$$price</span></h6>
                        </div>
                        <div class='new'>
                          <span>New</span>
                        </div>
                      </a>
                      <div class='add-to-cart-btn'>
                        <a  class='add-to-cart-action'>Add to Cart</a>
                      </div>
                    </div>
                  </div>";
          }
        } else {
          echo "<p>No products available in this category.</p>";
        }
        $conn->close();
        ?>
      </div>
      <div class="view-cart-container">
        <a href="cart.php">
          <button id="view-cart-btn">View Cart</button>
        </a>
      </div>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="bags.js"></script>
  <script>
    $(document).ready(function () {
  $('.add-to-cart-action').on('click', function (event) {
    event.preventDefault();
    var userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>;
    if (!userId) {
      window.location.href = 'login.php?redirect=' + encodeURIComponent(window.location.href);
      return;
    }
    const parentBox = $(this).closest('.box');
    const productId = parentBox.find('.add-to-cart').data('id');
    $.ajax({
      url: 'add_bags_to_cart.php',
      type: 'POST',
      data: {
        product_id: productId,
      },
      success: function (response) {
        const res = JSON.parse(response);
        if (res.status === 'success') {
          alert(res.message);
        } else {
          alert('Error: ' + res.message);
        }
      },
      error: function () {
        alert('Failed to add product to cart.');
      },
    });
  });
});
  </script>
</body>

</html>
