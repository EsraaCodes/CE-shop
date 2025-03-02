<?php
include('config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $role = $_POST['role'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, password, role) 
              VALUES ('$email', '$hashedPassword', '$role')";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_users.php"); 
        exit();
    } else {
        echo "Error adding user: " . mysqli_error($conn);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $query = "DELETE FROM users WHERE user_id = $userId";
    mysqli_query($conn, $query);
    header("Location: manage_users.php"); 
    exit();
}

$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="manage.css"> 
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    <div class="main-content">
        <h1>Manage Users</h1>

        <!-- Add User Button -->
        <button id="addButton">Add User</button>
        <div id="addForm" style="display:none;">
            <h2>Add New User</h2>
            <form method="POST" action="manage_users.php">
                <label for="email">Email:</label><input type="email" name="email" required><br>
                <label for="password">Password:</label><input type="password" name="password" required><br>
                <label for="role">Role:</label><input type="text" name="role" required><br>
                <button type="submit" name="add">Add User</button>
            </form>
        </div>

        <!-- User List Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['role']); ?></td>
            <td>
                <a href="edit_user.php?id=<?php echo $row['user_id']; ?>">Edit</a> |
                <a href="manage_users.php?action=delete&id=<?php echo $row['user_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="4">No users found.</td></tr>
<?php endif; ?>

            </tbody>
        </table>
    </div>

    <script>
        // Toggle the Add User form
        document.getElementById('addButton').onclick = function() {
            var form = document.getElementById('addForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        };
    </script>
</body>
</html>

<?php $conn->close(); ?>
