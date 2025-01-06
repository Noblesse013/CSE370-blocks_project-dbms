<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <link rel="stylesheet" href="css/logout_styles.css">
</head>
<body>
    <div class="logout-container">
        <div class="logout-message">
            <h1>You have successfully logged out!</h1>
            <p>Thank you for visiting. Click below to log in again.</p>
            <a href="login.php" class="btn">Login</a>
        </div>
    </div>
</body>
</html>
