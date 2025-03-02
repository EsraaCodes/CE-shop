<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_categories.php");
        exit();
    } else {
        echo "Error adding category: " . mysqli_error($conn);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $query = "DELETE FROM categories WHERE id = $categoryId";
    mysqli_query($conn, $query);
    header("Location: manage_categories.php");
    exit();
}

$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="manage.css"> 
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    <div class="main-content">
        <h1>Manage Categories</h1>

        <!-- Add Category Button -->
        <button id="addButton">Add Category</button>
        <div id="addForm" style="display:none;">
            <h2>Add New Category</h2>
            <form method="POST" action="manage_categories.php">
                <label for="name">Name:</label><input type="text" name="name" required><br>
                <label for="description">Description:</label><textarea name="description" required></textarea><br>
                <button type="submit" name="add">Add Category</button>
            </form>
        </div>

        <!-- Category List Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td>
                <a href="edit_category.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="manage_categories.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="4">No categories found.</td></tr>
<?php endif; ?>

            </tbody>
        </table>
    </div>

    <script>
        // Toggle the Add Category form
        document.getElementById('addButton').onclick = function() {
            var form = document.getElementById('addForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        };
    </script>
</body>
</html>

<?php $conn->close(); ?>
