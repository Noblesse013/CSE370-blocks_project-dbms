<!-- ?php
session_start();
include 'DBconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Plaintext password

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        switch ($user['role']) {
            case 'admin':
                header("Location: admin.php");
                break;
            case 'buyer':
                header("Location: buyer.php");
                break;
            case 'employee':
                header("Location: employee.php");
                break;
        }
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Blocks inventory</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="background">
    <div class="login-container">
      <h2>Login</h2>
      < action="auth.php" method="POST">
        <div class="input-group">
        <select name="role" required>
        <option value="admin">Admin</option>
        <option value="buyer">Buyer</option>
        <option value="employee">Employee</option>
    </select></div>
        <div class="input-group">

          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="signup.php">Register</a></p>
      
    </div>
  </div>
</body>
</html> -->


<?php
session_start();
include 'DBconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Capture the role from the form

    // SQL query to check username, password, and role
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' AND role = '$role'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on the user's role
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
  <link rel="stylesheet" href="css/styles.css">
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
