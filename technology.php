<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Faculty of Technology Studies Inventory</title>
  <link rel="stylesheet" href="table.css">
  <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
  <style>
    .edit-button, .delete-button {
      padding: 6px 12px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      color: white;
      border-radius: 4px;
      font-size: 14px;
      display: inline-block;
    }

    .edit-button {
      background-color: #4CAF50; /* Green */
    }

    .delete-button {
      background-color: #DC143C; /* Red */
    }

    .action-buttons {
      display: flex;
      gap: 5px;
    }
  </style>
</head>
<body>
  <header><?php include 'header.php'; ?></header><br>
  <h2>Faculty of Technology Studies Inventory</h2>
  <table border="1" width="100%">
    <thead>
      <tr>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Count</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql = "SELECT * FROM technology_items";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['item_id']}</td>
                    <td>{$row['item_name']}</td>
                    <td>{$row['item_count']}</td>
                    <td class='action-buttons'>
                      <a href='edit.php?id={$row['item_id']}&table=technology_items' class='edit-button'>Edit</a>
                      <a href='delete.php?id={$row['item_id']}&table=technology_items' class='delete-button' onclick=\"return confirm('Are you sure?');\">Delete</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No items found.</td></tr>";
        }
        $conn->close();
      ?>
    </tbody>
  </table>
  <div class="back-link">
        <a href="dashboard.php">⬅ Back to Dashboard</a>
    </div>
     <?php include 'footer.php'; ?>
</body>
</html>
