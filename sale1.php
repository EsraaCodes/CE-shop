<?php
include('config.php');

$sql = "SELECT * FROM sale_items WHERE sale_percentage = 50";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sale_items = [];
    while ($row = $result->fetch_assoc()) {
        $sale_items[] = $row;
    }
} else {
    $sale_items = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sale Items</title>
  <link rel="stylesheet" href="sale.css">
  <link rel="icon" href="favicon.ico" sizes="16x16" />
  <script src="sale.js"></script>
</head>
<body>
  <div class="header">
    Items on Sale - Grab the Best Deals!
  </div>
  <div class="items-container">
    <?php
    foreach ($sale_items as $item) {
        echo '<div class="item-card">';
        echo '<span class="sale-badge">' . htmlspecialchars($item['sale_percentage']) . '% Off</span>';
        echo '<div class="item-image">';
        echo '<img src="' . htmlspecialchars($item['image_url']) . '" alt="' . htmlspecialchars($item['product_name']) . '">';
        echo '</div>';
        echo '<div class="item-details">';
        echo '<div class="item-name">' . htmlspecialchars($item['product_name']) . '</div>';
        echo '<div class="item-prices">';
        echo '<del>' . htmlspecialchars($item['original_price']) . '</del>';
        echo '<span class="sale-price">' . htmlspecialchars($item['sale_price']) . '</span>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
  </div>
</body>
</html>

<?php
$conn->close();
?>
