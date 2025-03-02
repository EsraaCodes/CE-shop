<?php
include('config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit();
    }

    $email = mysqli_real_escape_string($conn, $email);
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "Email already registered!";
        exit();
    }

    $insertQuery = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";
    if (mysqli_query($conn, $insertQuery)) {
        $_SESSION['signup_success'] = 'Thank you for signing up! You can now log in.';
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="login.css"> 
    <script src="https://accounts.google.com/gsi/client" async defer></script> <!-- Google Sign-In Script -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script> <!-- Facebook SDK -->
    <script src="email.js" defer></script> 
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    
    <div class="container">
        <header>
            <h1>Sign Up</h1>
            <p>Join us to get started!</p>
        </header>
        
        <form method="POST" action="">
    <input type="email" id="email" name="email" placeholder="Enter your email" required>
    <input type="password" id="password" name="password" placeholder="Enter your password" required>
    <button type="submit" class="submit-btn">Sign Up</button>
</form>

<div class="social-login">
    <button class="social-btn google-btn" onclick="googleSignUp()">
        <i class="fab fa-google"></i> Sign in with Google
    </button>
    <button class="social-btn facebook-btn" onclick="facebookLogin()">
        <i class="fab fa-facebook-f"></i> Sign in with Facebook
    </button>
</div>

<div class="account-option">
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>

    </div>
</body>
</html>
