<?php
$servername = "localhost";
$username = "root";     // Default username for XAMPP
$password = "";         // Default password for XAMPP (leave empty)
$database = "inventory_db"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
