<?php
session_start();
$role = isset($_SESSION['role']) ? ucfirst($_SESSION['role']) : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>University Inventory Management System</title>
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <header class="header-container">
    <!-- Left: Title -->
    <div class="header-left">
      <h1>University Inventory Management System</h1>
    </div>

    <!-- Center: Search bar -->
    <div class="search-bar">
      <form method="GET" action="search.php">
        <input type="text" name="query" id="searchBar" placeholder="Search...">
        <button type="submit" class="search-btn">Search</button>
      </form>
    </div>

    <!-- Right: User info -->
    <div class="user-info">
      <span class="user-role"><?php echo "Welcome, ",$role,"!"; ?></span>
      <a class="logout-btn" href="logout.php">Logout</a>
    </div>
  </header>

</body>
</html>
