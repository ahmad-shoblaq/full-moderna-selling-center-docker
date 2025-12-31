<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/dashboard.css">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="dashboard-container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>!</h2>
    <p>You are logged in.</p>
    <a href="inventory.php">Inventory</a>
    <a href="sales.php">Sales</a>
    <a href="sales_history.php">Sales History</a>
    <a href="report.php">Report</a>
    <a href="add_product.php">Add Product</a>
    <a href="receipt.php">Receipts</a>
    <a href="logout.php">Logout</a>
  </div>
</body>
</html>
