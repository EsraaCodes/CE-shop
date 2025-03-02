<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $subcategory = $_POST['subcategory'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $sizesAvailable = $_POST['SizesAvailable'];
    $stockQuantity = $_POST['stock_quantity'];
    $categoryId = $_POST['category_id'];

    $query = "INSERT INTO products (name, subcategory, price, image, SizesAvailable, stock_quantity, category_id) 
              VALUES ('$name', '$subcategory', '$price', '$image', '$sizesAvailable', '$stockQuantity', '$categoryId')";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_items.php");
        exit();
    } else {
        echo "Error adding item: " . mysqli_error($conn);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $query = "DELETE FROM products WHERE product_id = $itemId";
    mysqli_query($conn, $query);
    header("Location: manage_items.php");
    exit();
}

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Items</title>
    <link rel="stylesheet" href="manage.css"> 
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>
    <div class="main-content">
        <h1>Manage Items</h1>

        <!-- Add Item Button -->
        <button id="addButton">Add Item</button>
        <div id="addForm" style="display:none;">
            <h2>Add New Item</h2>
            <form method="POST" action="manage_items.php">
                <label for="name">Name:</label><input type="text" name="name" required><br>
                <label for="subcategory">Subcategory:</label><input type="text" name="subcategory" required><br>
                <label for="price">Price:</label><input type="number" name="price" required><br>
                <label for="image">Image URL:</label><input type="text" name="image"><br>
                <label for="SizesAvailable">Sizes Available:</label><input type="text" name="SizesAvailable" required><br>
                <label for="stock_quantity">Stock Quantity:</label><input type="number" name="stock_quantity" required><br>
                <label for="category_id">Category ID:</label><input type="number" name="category_id" required><br>
                <button type="submit" name="add">Add Item</button>
            </form>
        </div>

        <!-- Item List Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Sizes Available</th>
                    <th>Category ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['stock_quantity']; ?></td>
            <td><?php echo htmlspecialchars($row['SizesAvailable']); ?></td>
            <td><?php echo $row['category_id']; ?></td>
            <td>
                <?php if (!empty($row['image'])): ?>
                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="Product Image" style="width: 100px; height: auto;">
                <?php else: ?>
                    No Image
                <?php endif; ?>
            </td>
            <td>
                <a href="edit_item.php?id=<?php echo $row['product_id']; ?>">Edit</a> |
                <a href="manage_items.php?action=delete&id=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="8">No items found.</td></tr>
<?php endif; ?>

            </tbody>
        </table>
    </div>

    <script>
        // Toggle the Add Item form
        document.getElementById('addButton').onclick = function() {
            var form = document.getElementById('addForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        };
    </script>
</body>
</html>

<?php $conn->close(); ?>
