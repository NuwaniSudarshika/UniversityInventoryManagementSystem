<?php include 'db_connect.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    
  <meta charset="UTF-8">
  <title>University Inventory Management System</title>
  <link rel="stylesheet" href="table.css">
  <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
</head>
<body>
   

  <!-- Header -->    
  <header>
     <?php include 'header.php'; ?>
    
    <!--<h1>University Inventory Management</h1>
    <input type="text" placeholder="Search..." id="searchBar" /> -->
  </header>
  

  <!--Quick insert-->
  <?php include 'quick_insert.php'; ?>


  <!-- Inventory Charts -->
  <section id="charts">
    <div class="chartBox">
      <h3>Applied Science Inventory Chart</h3>
      
      <!-- Replace with chart canvas or image -->
      <div class="chartPlaceholder">
            <a href="applied.php">Click Here</a>
    </div>

      
    </div>
    <div class="chartBox">
      <h3>Business Management Inventory Chart</h3>
      <div class="chartPlaceholder">
        <a href="business.php">Click Here</a>
      </div>
    </div>

    
    <div class="chartBox">
      <h3>Technology Studies Inventory Chart</h3>
      <div class="chartPlaceholder">
        <a href="technology.php">Click Here</a>
      </div>
    </div>
  </section>

  <!-- Notifications -->
  <?php include 'notification.php'; ?>

  <!-- Navigation -->
<div class="nav-links">
    <a href="returns.php">Returns Page</a>|
    <a href="issue.php">Issues Page</a>
</div><br>

 <?php include 'footer.php'; ?>

</body>
</html>
