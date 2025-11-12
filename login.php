<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $password = $_POST['password'];

    if ($role === "user" && $password === "user") {
        $_SESSION['role'] = "user";
        header("Location: user.php");
        exit();
    } elseif ($role === "admin" && $password === "admin") {
        $_SESSION['role'] = "admin";
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid role or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> <!-- External CSS -->
</head>
<body>
    <div>
        <h1 class="main-header">University Inventory Management System</h1>
        <br><br>
    </div>

    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST">
                <label for="role">Login as:</label>
                <select name="role" id="role" required onchange="togglePassword()">
                    <option value="">--Select--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <!-- Hidden field for user password -->
                <input type="hidden" id="hiddenPassword" name="password" value="user">

                <input type="submit" value="Login">
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            </form>
        </div>
    </div>

    <div class="back-link">
        <a href="index.php">⬅ Back to Welcome Page</a>
    </div>

    <script>
    function togglePassword() {
        const role = document.getElementById("role").value;
        const passwordField = document.getElementById("password");
        const hiddenPassword = document.getElementById("hiddenPassword");

        if (role === "user") {
            passwordField.style.display = "none";         // Hide visible input
            passwordField.disabled = true;
            hiddenPassword.disabled = false;              // Enable hidden input
        } else {
            passwordField.style.display = "block";        // Show input
            passwordField.disabled = false;
            hiddenPassword.disabled = true;               // Hide hidden input
        }
    }
    </script>

    <br><br><br><br><br>
    <?php include 'footer.php'; ?>
</body>
</html>
