<?php
include('config.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $query = "SELECT * FROM users WHERE user_id = $userId";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $update_query = "UPDATE users SET email='$email', password='$password', role='$role' 
                         WHERE user_id = $userId";
        mysqli_query($conn, $update_query);

        header("Location: manage_users.php");
        exit();
    }
} else {
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="manage.css">
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>

    <h1>Edit User</h1>

    <form method="POST" action="edit_user.php?id=<?php echo $userId; ?>">
        <label for="email">Email:</label><input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        <label for="password">Password:</label><input type="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required><br>
        <label for="role">Role:</label><input type="text" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" required><br>

        <button type="submit" name="edit">Update User</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
