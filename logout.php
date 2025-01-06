<?php
session_start();

// Destroy the session to log out the user
session_unset();
session_destroy();

// Redirect to the login page with a logout success message
header("Location: login.php?message=logged_out");
exit;
?>
