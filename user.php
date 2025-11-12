<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Inventory</title>
  <link rel="stylesheet" href="user.css">
</head>
<body>

<?php include 'header.php'; ?>

<h2>Faculty of Applied Science</h2>
<?php
$result = $conn->query("SELECT * FROM applied_items");
if ($result->num_rows > 0) {
    echo "<table><tr><th>Item ID</th><th>Item Name</th><th>Item Count</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['item_id']}</td><td>{$row['item_name']}</td><td>{$row['item_count']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No items found in Applied Science faculty.</p>";
}
?>

<h2>Faculty of Business Studies</h2>
<?php
$result = $conn->query("SELECT * FROM business_items");
if ($result->num_rows > 0) {
    echo "<table><tr><th>Item ID</th><th>Item Name</th><th>Item Count</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['item_id']}</td><td>{$row['item_name']}</td><td>{$row['item_count']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No items found in Business faculty.</p>";
}
?>

<h2>Faculty of Technology Studies</h2>
<?php
$result = $conn->query("SELECT * FROM technology_items");
if ($result->num_rows > 0) {
    echo "<table><tr><th>Item ID</th><th>Item Name</th><th>Item Count</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['item_id']}</td><td>{$row['item_name']}</td><td>{$row['item_count']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No items found in Technology faculty.</p>";
}
?>

</body>
</html>

 <?php include 'footer.php'; ?>
