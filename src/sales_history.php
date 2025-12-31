<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}

$query = "SELECT s.id, s.quantity, s.total, s.sale_date, p.name AS product_name, u.username
          FROM sales s
          JOIN products p ON s.product_id = p.id
          JOIN users u ON s.user_id = u.id
          ORDER BY s.sale_date DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sales History</title>
  <link rel="stylesheet" href="css/sales_history.css">
</head>
<body>
<div class="container">
  <div class="form-card">
    <h2>Sales History</h2>
    <table border="1" cellpadding="8">
      <tr>
        <th>#</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Sold By</th>
        <th>Date</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['product_name']); ?></td>
          <td><?php echo $row['quantity']; ?></td>
          <td>$<?php echo number_format($row['total'], 2); ?></td>
          <td><?php echo htmlspecialchars($row['username']); ?></td>
          <td><?php echo $row['sale_date']; ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
    <br>
    <a href="dashboard.php" class="button">&larr; Back to Dashboard</a>
  </div>
</div>
</body>
</html>
