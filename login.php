<?php
session_start();  // Start the session 

include('config.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=Please fill in all fields.");
        exit();
    }

    $email = $conn->real_escape_string($email);

    try {
        // Query to fetch user by email
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user data in the session
                $_SESSION['user_id'] = $user['user_id']; 
                $_SESSION['user_email'] = $user['email']; 
                $_SESSION['user_role'] = $user['role']; // Store the role

                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: cart.php");
                }
                exit();
            } else {
                header("Location: login.php?error=Invalid password!");
                exit();
            }
        } else {
            header("Location: login.php?error=No user found with this email!");
            exit();
        }
    } catch (Exception $e) {
        // Handle database errors 
        header("Location: login.php?error=Database error: " . $e->getMessage());
        exit();
    }
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">  
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    <div class="container">
        <header>
            <h1 class="title">Log In</h1>
            <p>Enter your email and password to continue.</p>
        </header>

        <div class="form-container">
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="login-email">Email Address</label>
                    <input type="email" id="login-email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="input-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="submit-btn">Log In</button>
            </form>

            <!-- Error Message Display -->
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <p><?php echo htmlspecialchars($_GET['error']); ?></p>
                </div>
            <?php endif; ?>

           
            <?php
            
            if (isset($_SESSION['signup_success'])) {
                echo "<script>alert('" . $_SESSION['signup_success'] . "');</script>";
                
                unset($_SESSION['signup_success']);
            }
            ?>

            <div class="account-option">
                <p>Don't have an account? <a href="email.php">Sign up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
