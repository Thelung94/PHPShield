<?php
require_once 'protect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to PHPShield Protected Site</title>
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        .container {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 10px;
            display: inline-block;
            padding: 40px 60px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.5);
        }
        h1 {
            color: #58a6ff;
        }
        p {
            font-size: 18px;
            color: #8b949e;
        }
        footer {
            margin-top: 50px;
            font-size: 14px;
            color: #6e7681;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome!</h1>
        <p>Your access is protected by <strong>PHPShield</strong>.</p>
        <p>Enjoy your stay 🚀</p>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> PHPShield Project
    </footer>
</body>
</html>
