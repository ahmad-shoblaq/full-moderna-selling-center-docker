<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require_once 'db.php';

$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventory Management</title>
  <link rel="stylesheet" href="css/inventory.css">
</head>
<body>
<div class="container">
  <div class="form-card">
    <div class="left">
      <h2>Current Inventory</h2>
      <a href="add_product.php" class="button">➕ Add New Product</a>
      <br><br>
      <table border="1" cellpadding="8">
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Qty</th>
          <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <form action="inventory_process.php" method="POST">
            <td><input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required></td>
            <td><input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required></td>
            <td><input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required></td>
            <td>
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <button type="submit" name="update">Update</button>
              <button type="submit" name="delete" onclick="return confirm('Are you sure?')">Delete</button>
            </td>
          </form>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
    <div class="right">
      <h2>Actions</h2>
      <p>Edit existing products using the fields. Click Update or Delete accordingly.</p>
      <a href="dashboard.php" class="button">&larr; Back to Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>
