<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); // login page if not authorized
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    <div class="admin-container">
       <div class="main-content">
            <div class="header">
                <h1>Welcome to the Admin Dashboard</h1>
             <a href="adminlogout.php" class="logout-btn">Logout</a>
            </div>
             
            <div class="dashboard-options">
                <div class="option">
                    <h2>Manage Users</h2>
                    <p>Manage all the users registered on your website.</p>
                    <a href="manage_users.php" class="btn">Go to Users</a>
                </div>

                <div class="option">
                    <h2>Manage Items</h2>
                    <p>Manage all the items and products available in your shop.</p>
                    <a href="manage_items.php" class="btn">Go to Items</a>
                </div>

                <div class="option">
                    <h2>Manage Orders</h2>
                    <p>View and manage customer orders and their status.</p>
                    <a href="manage_orders.php" class="btn">Go to Orders</a>
                </div>

                <div class="option">
                    <h2>Manage Categories</h2>
                    <p>Organize products by categories and subcategories.</p>
                    <a href="manage_categories.php" class="btn">Go to Categories</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
