<?php
session_start();
require 'config.php';

// Получаем список котов из базы данных
$sql = "SELECT id, name, breed, age FROM cats";
$result = $conn->query($sql);
$cats = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cats[] = $row;
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
                
                <a href="users.php">Users</a>
                <a href="add_cat.php">Add Cat</a>
                <a href="cat1.php"> Cat</a>
            <?php endif; ?>
            <a href="add_cat.php">Add Cat</a>
                <a href="cat1.php"> Cat</a>
        <?php else: ?>
           
                <a href="users.php">Users</a>
                <a href="add_cat.php">Add Cat</a>
                <a href="cat1.php"> Cat</a>
        <?php endif; ?>
    </nav>
    <div class="container">
        <h2>Our Cats</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cats as $cat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cat['id']); ?></td>
                        <td><?php echo htmlspecialchars($cat['name']); ?></td>
                        <td><?php echo htmlspecialchars($cat['breed']); ?></td>
                        <td><?php echo htmlspecialchars($cat['age']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
