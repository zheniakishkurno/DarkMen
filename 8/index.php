<?php
session_start();
require 'config.php';

// Получаем список продуктов из базы данных
$sql = "SELECT id, name, description, price FROM products";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <header>
        <h1>Welcome to our site!</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="logout.php">Logout</a>
            <?php if ($_SESSION['is_admin']): ?>
                <a href="admin.php">Admin</a>
                <a href="users.php">Users</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
    <div class="container">
        <h2>Our Products</h2>
        <!-- Галерея с изображениями котиков -->
        <div class="gallery">
            <img src="1.jpg" alt="Cute Cat 1">
            <img src="2.jpg" alt="Cute Cat 2">
            <img src="3.jpg" alt="Cute Cat 1">
            <img src="4.jpg" alt="Cute Cat 2">
            <img src="5.jpg" alt="Cute Cat 1">
            <img src="6.jpg" alt="Cute Cat 2">
            <img src="7.jpg" alt="Cute Cat 1">
            <img src="8.jpg" alt="Cute Cat 2">
            <img src="9.jpg" alt="Cute Cat 1">
            <img src="10.jpg" alt="Cute Cat 2">
            <img src="11.jpg" alt="Cute Cat 1">
            <img src="12.jpg" alt="Cute Cat 2">
            <img src="13.jpg" alt="Cute Cat 2">
            <img src="14.jpg" alt="Cute Cat 2">
            <img src="15.jpg" alt="Cute Cat 2">
            <img src="16.jpg" alt="Cute Cat 2">
            <img src="17.jpg" alt="Cute Cat 2">
            <img src="18.jpg" alt="Cute Cat 2">
            <img src="19.jpg" alt="Cute Cat 2">
            <img src="20.jpg" alt="Cute Cat 2">
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <p>мяу мяу мяу мяу мяу мяу мяу</p>
        </div>
        <p>&copy; 2024 Your Website</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
