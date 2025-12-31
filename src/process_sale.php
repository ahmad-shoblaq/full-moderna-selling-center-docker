<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['products'])) {
    $userId = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $success = false;
    $receiptItems = [];
    $totalAmount = 0;

    foreach ($_POST['products'] as $productId => $quantity) {
        $productId = (int)$productId;
        $quantity = (int)$quantity;

        if ($quantity > 0) {
            // get product info
            $stmt = $conn->prepare("SELECT name, price, quantity FROM products WHERE id = ?");
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $product = $result->fetch_assoc();

                if ($product['quantity'] >= $quantity) {
                    $newQty = $product['quantity'] - $quantity;
                    $total = $quantity * $product['price'];

                    // update product inventory
                    $update = $conn->prepare("UPDATE products SET quantity = ? WHERE id = ?");
                    $update->bind_param("ii", $newQty, $productId);
                    $update->execute();

                    // log the sale in sales table
                    $log = $conn->prepare("INSERT INTO sales (product_id, quantity, total, user_id) VALUES (?, ?, ?, ?)");
                    $log->bind_param("iidi", $productId, $quantity, $total, $userId);
                    $log->execute();

                    // add to receipt items
                    $receiptItems[] = [
                        'name' => $product['name'],
                        'qty' => $quantity,
                        'price' => $total
                    ];

                    $totalAmount += $total;
                    $success = true;
                }
            }
        }
    }

    if ($success) {
        $_SESSION['receipt'] = [
            'items' => $receiptItems,
            'total' => $totalAmount,
            'date' => date("Y-m-d H:i:s"),
            'cashier' => $username
        ];
        header("Location: receipt.php");
        exit();
    } else {
        $_SESSION['error'] = "No valid sale was processed.";
    }

    header("Location: sales.php");
    exit();
}

$_SESSION['error'] = "Invalid request.";
header("Location: sales.php");
exit();
