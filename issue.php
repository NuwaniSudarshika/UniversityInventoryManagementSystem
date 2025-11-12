<?php
include 'db_connect.php';

if (isset($_POST['submit'])) {
    $faculty = $_POST['faculty'];
    $item_name = $_POST['item_name'];
    $item_count = intval($_POST['item_count']);

    // Map faculty to table
    $faculty_tables = [
        'Faculty of Applied Science' => 'applied_items',
        'Faculty of Business' => 'business_items',
        'Faculty of Technology' => 'technology_items'
    ];

    // Get correct table name
    $table = $faculty_tables[$faculty];

    // Check if item exists
    $check = "SELECT item_count FROM $table WHERE item_name = '$item_name'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $available = $row['item_count'];

        if ($available >= $item_count) {
            // Deduct item count
            $update = "UPDATE $table SET item_count = item_count - $item_count WHERE item_name = '$item_name'";
            mysqli_query($conn, $update);

            // Add record to issued_items
            $insert = "INSERT INTO issued_items (faculty, item_name, item_count) 
                       VALUES ('$faculty', '$item_name', $item_count)";
            if (mysqli_query($conn, $insert)) {
                echo "<script>alert('Item Issued Successfully'); window.location.href='issue.php';</script>";
            } else {
                echo "Error saving issue: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Not enough stock available'); window.location.href='issue.php';</script>";
        }
    } else {
        echo "<script>alert('Item not found for selected faculty'); window.location.href='issue.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Issue Item</title>
    <link rel="stylesheet" href="issue.css">
</head>
<body>
    <div class="form-container">
        <h2>Issue Item</h2>
        <form method="POST" action="">
            <label>Faculty:</label>
            <select name="faculty" required>
                <option value="">Select Faculty</option>
                <option value="Faculty of Applied Science">Faculty of Applied Science</option>
                <option value="Faculty of Business">Faculty of Business</option>
                <option value="Faculty of Technology">Faculty of Technology</option>
            </select>

            <label>Item Name:</label>
            <input type="text" name="item_name" required>

            <label>Item Count:</label>
            <input type="number" name="item_count" min="1" required>

            <button type="submit" name="submit">Issue Item</button>
        </form>
         <div class="back-link">
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
    </div>
   
</body>
</html>
