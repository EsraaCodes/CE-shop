<?php
include('config.php');

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $query = "SELECT * FROM categories WHERE id = $categoryId";
    $result = mysqli_query($conn, $query);
    $category = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];

        $update_query = "UPDATE categories SET name='$name', description='$description' WHERE id = $categoryId";
        mysqli_query($conn, $update_query);

        header("Location: manage_categories.php");
        exit();
    }
} else {
    header("Location: manage_categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="manage.css">
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>

    <h1>Edit Category</h1>

    <form method="POST" action="edit_category.php?id=<?php echo $categoryId; ?>">
        <label for="name">Name:</label><input type="text" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required><br>
        <label for="description">Description:</label><textarea name="description" required><?php echo htmlspecialchars($category['description']); ?></textarea><br>

        <button type="submit" name="edit">Update Category</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
