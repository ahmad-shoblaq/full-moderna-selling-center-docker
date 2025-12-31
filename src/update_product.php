<?php
//Update product from inventory
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);

    if ($name && $price >= 0 && $quantity >= 0) {
        $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?");
        $stmt->bind_param("sdii", $name, $price, $quantity, $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Product updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update product.";
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Invalid input.";
    }
}

header("Location: inventory.php");
exit();
?>
