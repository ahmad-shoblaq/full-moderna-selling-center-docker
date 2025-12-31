<?php
// report.php - Display inventory summary
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require_once 'db.php';


// Fetch products
$result = $conn->query("SELECT * FROM products");
$totalProducts = 0;
$totalValue = 0;

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
    $totalProducts += $row['quantity'];
    $totalValue += $row['quantity'] * $row['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventory Report</title>
  <link rel="stylesheet" href="css/report.css">
</head>
<body>
<div class="container">
  <div class="form-card">
    <div class="left">
      <h2>Inventory Summary</h2>
      <p>Total Products in Stock: <strong><?php echo $totalProducts; ?></strong></p>
      <p>Total Inventory Value: <strong>$<?php echo number_format($totalValue, 2); ?></strong></p>
    </div>
    <div class="right">
      <h2>Actions</h2>
      <p>View product stats and monitor stock values.</p>
      <a href="dashboard.php">&larr; Back to Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>
