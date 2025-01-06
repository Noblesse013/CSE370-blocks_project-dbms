<?php
session_start();
include 'DBconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    switch ($user['role']) {
      case 'admin':
        header("Location: product.php");
        break;
      case 'buyer':
        header("Location: buy_view.php");
        break;
      case 'employee':
        header("Location: employee.php");
        break;
    }
    exit();
  } else {
    $error = "Invalid username, password, or role.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Blocks Inventory</title>
  <link rel="stylesheet" href="css/login_styles.css">
</head>
<body>
  <div class="background">
  <div class="login-container">
    <h2>Login</h2>
    <form method="POST" action="">
    <div class="input-group">
      <select name="role" required>
      <option value="admin">Admin</option>
      <option value="buyer">Buyer</option>
      <option value="employee">Employee</option>
      </select>
    </div>
    <div class="input-group">
      <input type="text" name="username" placeholder="Username" required>
    </div>
    <div class="input-group">
      <input type="password" name="password" placeholder="Password" required>
    </div>
    <button type="submit">Login</button>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    </form>
  </div>
  </div>
</body>
</html>
