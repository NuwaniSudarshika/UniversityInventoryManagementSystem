<?php
include 'db_connect.php';

if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = intval($_GET['id']);
    $table = $_GET['table'];

    $sql = "DELETE FROM `$table` WHERE item_id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the correct faculty page
        if ($table == "applied_items") {
            header("Location: applied.php");
        } elseif ($table == "business_items") {
            header("Location: business.php");
        } elseif ($table == "technology_items") {
            header("Location: technology.php");
        }
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
