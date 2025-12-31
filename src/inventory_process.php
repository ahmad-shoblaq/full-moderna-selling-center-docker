<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// ADD product (optional fallback)
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $barcode = $_POST['barcode'];

    if ($name && $price && $quantity) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, quantity, barcode) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdis", $name, $price, $quantity, $barcode);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'] = "Product added successfully!";
    } else {
        $_SESSION['error'] = "Please fill in all required fields.";
    }

    header("Location: inventory.php");
    exit();
}

// UPDATE product
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?");
    $stmt->bind_param("sdii", $name, $price, $quantity, $id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success'] = "Product updated successfully!";
    header("Location: inventory.php");
    exit();
}

// DELETE product
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['success'] = "Product deleted successfully!";
    header("Location: inventory.php");
    exit();
}
?>
