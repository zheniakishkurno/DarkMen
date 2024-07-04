<?php
session_start();
require 'conf.php';

// Обработка отправленной формы
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];

    // Подготовленный запрос для вставки данных о коте в базу данных
    $sql = "INSERT INTO cats (name, breed, age) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $name, $breed, $age);

    if ($stmt->execute()) {
        // Успешно добавлено, перенаправляем обратно на страницу с котами
        header('Location: cat1.php');
        exit;
    } else {
        echo "Ошибка при добавлении кота: " . $conn->error;
    }

    $stmt->close();
}

// Получаем список котов из базы данных
$sql = "SELECT id, name, breed, age FROM cats";
$result = $conn->query($sql);
$cats = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cats[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Cat</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <header>
        <h1>Add Cat</h1>
    </header>
    <nav>
   
                <a href="users.php">Users</a>
                <a href="add_cat.php">Add Cat</a>
                <a href="cat1.php"> Cat</a>

    </nav>
    <div class="container">
        <h2>Enter Cat Details</h2>
        <form action="cat1.php" method="post"> <!-- Форма отправляет данные на тот же файл -->
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="breed">Breed:</label><br>
            <input type="text" id="breed" name="breed" required><br>
            <label for="age">Age:</label><br>
            <input type="number" id="age" name="age" required><br><br>
            <input type="submit" value="Add Cat">
        </form>
    </div>
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
                <?php if (empty($cats)): ?>
                    <tr>
                        <td colspan="4">No cats found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cats as $cat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cat['id']); ?></td>
                            <td><?php echo htmlspecialchars($cat['name']); ?></td>
                            <td><?php echo htmlspecialchars($cat['breed']); ?></td>
                            <td><?php echo htmlspecialchars($cat['age']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 Your Website</p>
    </footer>
</body>
</html>
