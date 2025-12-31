<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/login.css">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="login-container">
    <h2>Login to Your Account</h2>
    <?php if (isset($_SESSION['error'])): ?>
      <p class="error-msg"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <form action="AuthController.php" method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit" name="login">Login</button>
    </form>
  </div>
</body>
</html>
