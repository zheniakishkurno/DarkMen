<?php
require 'config.php';
session_start();

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit;
}

$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Users</h1>
    </header>
    <nav>
        <a href="index.php">Home</a>
        <a href="logout.php">Logout</a>
        <?php if ($_SESSION['is_admin']): ?>
            <a href="admin.php">Admin</a>
            <a href="users.php">Users</a>
        <?php endif; ?>
    </nav>
    <div class="container">
        <h2>Registered Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                    </tr>
                <?php endwhile; ?>
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
