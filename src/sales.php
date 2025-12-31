<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], ['admin', 'cashier'])) {
    header("Location: dashboard.php");
    exit();
}


$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="css/sales.css">
<head>
    <meta charset="UTF-8">
    <title>Sales</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: lightgreen; font-weight: bold;">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </p>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: salmon; font-weight: bold;">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </p>
    <?php endif; ?>

    <div class="form-card">
        <div class="left">
            <h2>Product List</h2>
            <form action="process_sale.php" method="POST">
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Select Qty</th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>
                                <input type="number" name="products[<?php echo $row['id']; ?>]" min="0" max="<?php echo $row['quantity']; ?>">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
                <br>
                <button type="submit">Confirm Sale</button>
            </form>
        </div>
        <div class="right">
            <h2>Instructions</h2>
            <p>Select quantities and click Confirm Sale. Inventory will be updated automatically.</p>
            <a href="dashboard.php" style="color: #fff">&larr; Back to Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
