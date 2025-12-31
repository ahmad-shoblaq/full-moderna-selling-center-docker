<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require_once 'db.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    if ($name && $price && $quantity) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, quantity, barcode) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdis", $name, $price, $quantity, $barcode);
        if ($stmt->execute()) {
            $message = "✅ Product added successfully!";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "⚠️ All fields except barcode are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <link rel="stylesheet" href="css/add_product.css">
</head>
<body>
<div class="container">
  <div class="form-card">
    <div class="left">
      <h2>Add New Product</h2>
      <?php if ($message): ?>
          <p style="font-weight: bold;"><?php echo $message; ?></p>
      <?php endif; ?>
      <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <input type="text" name="barcode" placeholder="Barcode (Optional)">
        <button type="submit">Add Product</button>
      </form>
    </div>
    <div class="right">
      <h2>Tips</h2>
      <p>Use unique names and barcodes to avoid duplication. All fields are case-sensitive.</p>
      <a href="inventory.php" class="button">&larr; Back to Inventory</a>
    </div>
  </div>
</div>
</body>
</html>
