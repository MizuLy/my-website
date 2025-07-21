<?php
session_start();

if (isset($_POST['login'])) {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';

    // Hardcoded credentials (change to your preferred username/password)
    $adminUser = 'admin';
    $adminPass = 'admin123';

    if ($user === $adminUser && $pass === $adminPass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: report.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<link rel="icon" href="img/logo.png" />
<title>Admin Login</title>
<style>
  body { background: #181a1b; color: white; font-family: 'Josefin Sans', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
  form { background: #232526; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.7); }
  input { margin: 10px 0; padding: 10px; border-radius: 6px; border: none; width: 100%; }
  button { background: gold; border: none; padding: 10px; border-radius: 6px; cursor: pointer; width: 100%; font-weight: bold; }
  .error { color: red; margin-bottom: 10px; }
  a { color: gold; text-decoration: none; display: block; margin-top: 15px; text-align: center; }
</style>
</head>
<body>
  <form method="POST" action="">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <input type="text" name="username" placeholder="Username" required autofocus />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" name="login">Login</button>
    <a href="index.php">Back to Main Page</a>
  </form>
</body>
</html>
