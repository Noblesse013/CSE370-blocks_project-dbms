<?php
session_start();

// Optionally, check if the user is logged in and redirect back to the login page if needed
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link rel="stylesheet" href="css/acess_denied.css">
</head>
<body>
    <div class="container">
        <div class="error-message">
            <h1>Access Denied</h1>
            <p>You do not have permission to view this page.</p>
            <p>Please contact the administrator if you believe this is a mistake.</p>
        </div>
    </div>
</body>
</html>
