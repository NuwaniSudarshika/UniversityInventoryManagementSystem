<!-- welcome.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('login2.png'); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      color: white;
    }

    .signin-btn {
      position: absolute;
      top: 20px;
      right: 30px;
      background-color:rgb(140, 12, 14);
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
      transition: background-color 0.3s;
    }

    .signin-btn:hover {
      background-color:rgb(187, 33, 33);
    }

    .welcome-container {
      text-align: center;
      background: rgba(0, 0, 0, 0.6);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
      max-width: 600px;
    }
  </style>
</head>
<body>
  <a href="login.php" class="signin-btn">Sign In</a>

  <div class="welcome-container">
    <h2>Welcome to</h2>
    <h1>University Inventory Management System</h1>
    <p>This system helps you manage university inventory efficiently with features like stock tracking, issuing, returns, and low-stock alerts.</p>
    
  </div>


</body>
</html>
