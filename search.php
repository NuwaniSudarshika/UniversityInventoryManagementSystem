<?php
session_start();
include 'db_connect.php';

if (isset($_GET['query'])) {
    $search = mysqli_real_escape_string($conn, $_GET['query']);

    $faculties = [
        'applied_items' => 'Faculty of Applied Science',
        'business_items' => 'Faculty of Business Management',
        'technology_items' => 'Faculty of Technology Studies'
    ];

    $message = "<h2>Search Results for: <em>" . htmlspecialchars($search) . "</em></h2>";

    foreach ($faculties as $table => $facultyName) {
        $sql = "SELECT item_count FROM $table WHERE item_name LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);

        $message .= "<p><strong style='color:blue;'>$facultyName:</strong> ";
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $message .= "<span style='color:green;'>Item Count = {$row['item_count']}</span></p>";
        } else {
            $message .= "<span style='color:red;'>Not available</span></p>";
        }
    }

    // ✅ Get the role from session
    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';

    // ✅ Output the modal with redirect logic
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Search Results</title>
        <style>
            body, html {
                height: 100%;
                margin: 0;
                font-family: Arial, sans-serif;
                background-color: #56073e;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            #modal {
                background: white;
                padding: 25px 30px;
                border-radius: 10px;
                box-shadow: 0 0 15px #56073e;
                max-width: 480px;
                width: 90%;
                text-align: center;
            }
            h2 {
                margin-top: 0;
            }
            #closeBtn {
                margin-top: 20px;
                padding: 10px 25px;
                font-size: 16px;
                border: none;
                border-radius: 6px;
                background-color: 	#8B0000;
                color: white;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            #closeBtn:hover {
                background-color:rgba(139, 0, 0, 0.67);
            }
            p {
                font-size: 18px;
                margin: 10px 0;
            }
        </style>
    </head>
    <body>
        <div id='modal'>
            $message
            <button id='closeBtn'>Close</button>
        </div>

        <script>
            const userRole = '$userRole';
            document.getElementById('closeBtn').addEventListener('click', function() {
                if (userRole === 'admin') {
                    window.location.href = 'dashboard.php';
                } else if (userRole === 'user') {
                    window.location.href = 'user.php';
                } else {
                    window.location.href = 'index.php'; // fallback if not logged in
                }
            });
        </script>
    </body>
    </html>
    ";
    exit;
}
?>

