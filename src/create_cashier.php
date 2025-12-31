<?php
require_once 'db.php';

$username = 'cashier1';
$password = password_hash('cashier123', PASSWORD_DEFAULT);
$role = 'cashier';

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $role);
$stmt->execute();

echo $stmt->affected_rows > 0 ? "Cashier user created ✅" : "Failed ❌";
$stmt->close();
?>
