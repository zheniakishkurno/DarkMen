<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password_hash, is_admin FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $password_hash, $is_admin);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $password_hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = $is_admin;
            $stmt->close(); // Close the prepared statement

            // Redirect to appropriate page based on user role
            if ($is_admin) {
                header('Location: cat1.php');
            } else {
                header('Location: add_cat.php');
            }
            exit;
            
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that username";
    }

    $stmt->close(); // Close the prepared statement
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <h2>Login</h2>
    
    <form action="login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <footer>
        <div class="footer-content">
            <p>мяу мяу мяу мяу мяу мяу мяу</p>
        </div>
        <p>&copy; 2024 Your Website</p>
    </footer>
</body>
</html>
