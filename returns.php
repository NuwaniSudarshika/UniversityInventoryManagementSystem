<?php
include 'db_connect.php';

// Check for overdue items
$overdue_query = "SELECT * FROM returned_items 
                  WHERE return_date IS NULL AND taken_date < NOW() - INTERVAL 2 DAY";
$overdue_result = mysqli_query($conn, $overdue_query);
$overdue_count = mysqli_num_rows($overdue_result);

// Handle take out form (new entry)
if (isset($_POST['take_submit'])) {
    $faculty = $_POST['faculty'];
    $item_name = $_POST['item_name'];
    $item_count = intval($_POST['item_count']);

    $insert = "INSERT INTO returned_items (faculty, item_name, item_count) 
               VALUES ('$faculty', '$item_name', $item_count)";
    mysqli_query($conn, $insert);

    // Reduce item count in inventory
    $table = '';
    if ($faculty == "Applied Science") $table = "applied_items";
    elseif ($faculty == "Business") $table = "business_items";
    elseif ($faculty == "Technology") $table = "technology_items";

    $update_inventory = "UPDATE $table SET item_count = item_count - $item_count 
                         WHERE item_name = '$item_name'";
    mysqli_query($conn, $update_inventory);

    echo "<script>alert('Item taken recorded.'); window.location.href='returns.php';</script>";
}

// Handle return form
if (isset($_POST['return_submit'])) {
    $return_id = intval($_POST['return_id']);
    $faculty = $_POST['faculty'];
    $item_name = $_POST['item_name'];
    $item_count = intval($_POST['item_count']);

    $update_return = "UPDATE returned_items SET return_date = NOW() WHERE return_id = $return_id";
    mysqli_query($conn, $update_return);

    // Update stock back
    $table = '';
    if ($faculty == "Applied Science") $table = "applied_items";
    elseif ($faculty == "Business") $table = "business_items";
    elseif ($faculty == "Technology") $table = "technology_items";

    $update_stock = "UPDATE $table SET item_count = item_count + $item_count WHERE item_name = '$item_name'";
    mysqli_query($conn, $update_stock);

    echo "<script>alert('Return recorded successfully.'); window.location.href='returns.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Returns - Inventory Management</title>
    <link rel="stylesheet" href="return.css">
</head>
<body>
<div class="container">
    <h1>Inventory Return Management</h1>

    <?php if ($overdue_count > 0): ?>
        <script>alert('⚠️ Some items were not returned within 3 days!');</script>
        <div class="alert">
            <h3>Overdue Items:</h3>
            <ul>
                <?php while ($row = mysqli_fetch_assoc($overdue_result)): ?>
                    <li><?= $row['item_name'] ?> (<?= $row['faculty'] ?>) - Taken on <?= $row['taken_date'] ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php else: ?>
        <p class="no-overdue">✅ No overdue returns.</p>
    <?php endif; ?>

    <!-- Take Item Form -->
    <div class="form-section">
        <h2>Take Out Item</h2>
        <form method="post">
            <label>Faculty:</label>
            <select name="faculty" required>
                <option value="">Select</option>
                <option value="Applied Science">Applied Science</option>
                <option value="Business">Business</option>
                <option value="Technology">Technology</option>
            </select>

            <label>Item Name:</label>
            <input type="text" name="item_name" required>

            <label>Item Count:</label>
            <input type="number" name="item_count" required>

            <input type="submit" name="take_submit" value="Take Item">
        </form>
    </div>

    <!-- Return Item Form -->
    <div class="form-section">
        <h2>Mark Item as Returned</h2>
        <form method="post">
            <label>Return ID:</label>
            <input type="number" name="return_id" required>

            <label>Faculty:</label>
            <select name="faculty" required>
                <option value="">Select</option>
                <option value="Applied Science">Applied Science</option>
                <option value="Business">Business</option>
                <option value="Technology">Technology</option>
            </select>

            <label>Item Name:</label>
            <input type="text" name="item_name" required>

            <label>Item Count:</label>
            <input type="number" name="item_count" required>

            <input type="submit" name="return_submit" value="Submit Return">
        </form>
    </div>

    <!-- Display Records -->
    <div class="records-section">
        <h2>All Return Records</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Faculty</th>
                <th>Item</th>
                <th>Count</th>
                <th>Taken Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM returned_items ORDER BY taken_date DESC");
            while ($row = mysqli_fetch_assoc($result)):
                $status = "Returned";
                $bg = "#e7f7ec";
                if (is_null($row['return_date'])) {
                    $status = (strtotime($row['taken_date']) < strtotime('-2 days')) ? "Overdue" : "Not Returned";
                    $bg = ($status == "Overdue") ? "#ffe5e5" : "#fffad1";
                }
            ?>
            <tr style="background-color: <?= $bg ?>;">
                <td><?= $row['return_id'] ?></td>
                <td><?= $row['faculty'] ?></td>
                <td><?= $row['item_name'] ?></td>
                <td><?= $row['item_count'] ?></td>
                <td><?= $row['taken_date'] ?></td>
                <td><?= $row['return_date'] ?? '---' ?></td>
                <td><?= $status ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

   <div class="back-link">
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div> 
</div>
</body>
</html>
