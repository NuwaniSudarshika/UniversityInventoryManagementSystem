<?php
include 'db_connect.php';



$item = null;
$table = '';
$table_name_to_redirect = [
    'applied_items' => 'applied',
    'business_items' => 'business',
    'technology_items' => 'technology'
];

// Load item data
if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = intval($_GET['id']);
    $table = $_GET['table'];

    $sql = "SELECT * FROM `$table` WHERE item_id = $id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        echo "Item not found.";
        exit();
    }
}

// Update logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['item_id']);
    $table = $_POST['table'];
    $name = $_POST['item_name'];
    $count = intval($_POST['item_count']);

    $sql = "UPDATE `$table` SET item_name='$name', item_count=$count WHERE item_id=$id";

    if ($conn->query($sql) === TRUE) {
        $redirect_page = isset($table_name_to_redirect[$table]) ? $table_name_to_redirect[$table] : 'index';
        header("Location: {$redirect_page}.php?updated=1");
        exit();
    } else {
        echo "Update failed: " . $conn->error;
    }
}
?>

<?php if ($item): ?>

    <head>
  <link rel="stylesheet" type="text/css" href="edit_style.css">
</head>

<!-- Edit Form with Confirmation -->

<form method="post" onsubmit="return confirmUpdate()">
  <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
  <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">

  Item Name: <input type="text" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>"><br>
  Count: <input type="number" name="item_count" value="<?php echo $item['item_count']; ?>"><br>
  <button type="submit">Update</button>
</form>

<script>
  function confirmUpdate() {
    return confirm("Are you sure you want to update this item?");
  }
</script>
<?php endif; ?>
