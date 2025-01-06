<?php
session_start();


$host = '127.0.0.1';
$db_user = 'root';
$db_password = '';
$db_name = 'blocks_inventory';


$conn = new mysqli($host, $db_user, $db_password, $db_name);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Input validation
    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Prepare the SQL query to fetch user
    $stmt = $conn->prepare("SELECT Buyer_ID, Username, Password FROM buyer WHERE Username = ?");
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

    
        if ($password === $user['Password']) {
            // Set session variables
            $_SESSION['user_id'] = $user['Buyer_ID'];
            $_SESSION['username'] = $user['Username'];

        
            header("Location: product.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "No user found.";
    }

    $stmt->close();
}

$conn->close();
?>