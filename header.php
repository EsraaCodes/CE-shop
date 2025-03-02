<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo-container">
                <h1>C&E</h1>
                <p>Your key to luxury</p>
            </div>

            <button class="menu-toggle" onclick="toggleMenu()">
                <div class="hamburger"></div>
                <div class="hamburger"></div>
                <div class="hamburger"></div>
            </button>

            <ul class="nav-links">
                <li><a href="index.php#">Home</a></li>
                <li><a href="index.php#shop">Shop</a></li>
                <li><a href="index.php#connect">Contact</a></li>
                <li><a href="index.php">About</a></li>
                
            </ul>

            <div class="search-cart">
               <a href="cart.php">
                    <span class="cart-icon">🛒</span>
                </a>
               
            </div>
        </nav>
    </header>

    <script>
        
    function toggleMenu() {
        document.querySelector('nav').classList.toggle('open');
    }

 </script>
</body>
</html>
