<?php
include('config.php');

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $query = "SELECT * FROM products WHERE product_id = $itemId";
    $result = mysqli_query($conn, $query);
    $item = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
        $name = $_POST['name'];
        $subcategory = $_POST['subcategory'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $sizesAvailable = $_POST['SizesAvailable'];
        $stockQuantity = $_POST['stock_quantity'];
        $categoryId = $_POST['category_id'];

        $update_query = "UPDATE products SET name='$name', subcategory='$subcategory', price='$price', image='$image',
                         SizesAvailable='$sizesAvailable', stock_quantity='$stockQuantity', category_id='$categoryId' 
                         WHERE product_id = $itemId";
        mysqli_query($conn, $update_query);

        header("Location: manage_items.php");
        exit();
    }
} else {
    header("Location: manage_items.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link rel="stylesheet" href="manage.css">
    <link rel="icon" href="favicon.ico" sizes="16x16" />
</head>
<body>

    <h1>Edit Item</h1>

    <form method="POST" action="edit_item.php?id=<?php echo $itemId; ?>">
        <label for="name">Name:</label><input type="text" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required><br>
        <label for="subcategory">Subcategory:</label><input type="text" name="subcategory" value="<?php echo htmlspecialchars($item['subcategory']); ?>" required><br>
        <label for="price">Price:</label><input type="number" name="price" value="<?php echo $item['price']; ?>" required><br>
        <label for="image">Image URL:</label><input type="text" name="image" value="<?php echo htmlspecialchars($item['image']); ?>"><br>
        <label for="SizesAvailable">Sizes Available:</label><input type="text" name="SizesAvailable" value="<?php echo htmlspecialchars($item['SizesAvailable']); ?>" required><br>
        <label for="stock_quantity">Stock Quantity:</label><input type="number" name="stock_quantity" value="<?php echo $item['stock_quantity']; ?>" required><br>
        <label for="category_id">Category ID:</label><input type="number" name="category_id" value="<?php echo $item['category_id']; ?>" required><br>

        <button type="submit" name="edit">Update Item</button>
    </form>

</body>
</html>

<?php $conn->close(); ?>
