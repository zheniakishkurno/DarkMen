<?php
require 'config.php';

// Хеширование пароля "admin"
$admin_password = 'admin';
$admin_password_hash = password_hash($admin_password, PASSWORD_DEFAULT);

// Вставка администратора в базу данных
$sql = "INSERT INTO users (username, email, password_hash, is_admin) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssi', $username, $email, $password_hash, $is_admin);

$username = 'admin';
$email = 'admin@example.com';
$password_hash = $admin_password_hash;
$is_admin = 1;

if ($stmt->execute()) {
    echo "Admin user created successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
