<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['receipt'])) {
    header("Location: dashboard.php"); // or sales.php
    exit();
}

$receipt = $_SESSION['receipt']; // pull the dynamic receipt from session
unset($_SESSION['receipt']);     // clear after showing once

if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'cashier'])) {
    header("Location: dashboard.php");
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Receipt</title>
  <link rel="stylesheet" href="css/receipt.css">
</head>
<body>
<div class="container">
  <div class="receipt-box">
    <h2>Receipt</h2>
    <p><strong>Date:</strong> <?php echo $receipt['date']; ?></p>
    <p><strong>Cashier:</strong> <?php echo htmlspecialchars($receipt['cashier']); ?></p>
    <table>
      <thead>
        <tr><th>Item</th><th>Qty</th><th>Price</th></tr>
      </thead>
      <tbody>
        <?php foreach ($receipt['items'] as $item): ?>
        <tr>
          <td><?php echo htmlspecialchars($item['name']); ?></td>
          <td><?php echo $item['qty']; ?></td>
          <td>$<?php echo number_format($item['price'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <hr>
    <p><strong>Total:</strong> $<?php echo number_format($receipt['total'], 2); ?></p>
    <br>
    <button id="print-btn" onclick="window.print()">Print Receipt</button>
    <br>
    <a href="dashboard.php">&larr; Back to Dashboard</a>
  </div>
</div>
</body>
</html>
