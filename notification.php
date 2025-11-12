<?php
include 'db_connect.php';

$lowStockThreshold = 2;
$alerts = [];

$faculties = [
    'applied_items' => 'Faculty of Applied Science',
    'business_items' => 'Faculty of Business',
    'technology_items' => 'Faculty of Technology'
];

// Build low stock alerts
foreach ($faculties as $table => $facultyName) {
    $query = "SELECT item_name, item_count FROM $table WHERE item_count <= $lowStockThreshold";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $alerts[] = [
                'message' => "Item: {$row['item_name']} – $facultyName (Only {$row['item_count']} left)"
            ];
        }
    }
}
?>

<!-- Low Stock Notification Section -->
<section id="notifications">
  <h2>Low Stock Alerts</h2>
  <ul>
    <?php if (!empty($alerts)): ?>
      <?php foreach ($alerts as $alert): ?>
        <li class="low-alert"><?php echo $alert['message']; ?></li>
      <?php endforeach; ?>
    <?php else: ?>
      <li>No low stock items.</li>
    <?php endif; ?>
  </ul>
</section>



<!-- Optional CSS Styling -->
<style>
#notifications {
  background-color: #ffe5e5;
  border-left: 5px solid #ff0000;
  padding: 15px;
  border-radius: 8px;
  margin: 20px auto;
  width: 90%;
  color:rgb(0, 0, 0);
 

}

.low-alert {
  color: #c10000;
  font-weight: bold;
  margin-bottom: 6px;
}

 #notifications h2 {
  color: red;
}

</style>
