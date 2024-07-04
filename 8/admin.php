<?php
session_start();
require 'conf.php';

// Обработка отправленной формы для добавления кота
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_cat'])) {
    $name = trim($_POST['name']);
    $breed = trim($_POST['breed']);
    $age = (int)$_POST['age'];

    // Подготовленный запрос для вставки данных о коте в базу данных
    $sql = "INSERT INTO cats (name, breed, age) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $name, $breed, $age);

    if ($stmt->execute()) {
        // Успешно добавлено, перенаправляем обратно на страницу с котами
        header('Location: admin.php');
        exit;
    } else {
        echo "Ошибка при добавлении кота: " . $conn->error;
    }

    $stmt->close();
}

// Обработка удаления кота
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_cat'])) {
    $cat_id = (int)$_POST['cat_id'];

    // Подготовленный запрос для удаления кота из базы данных
    $sql = "DELETE FROM cats WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $cat_id);

    if ($stmt->execute()) {
        // Успешно удалено, перенаправляем обратно на страницу с котами
        header('Location: admin.php');
        exit;
    } else {
        echo "Ошибка при удалении кота: " . $conn->error;
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
        <a href="admin.php">Add Cat</a>
        <a href="cat1.php">Cat</a>
    </nav>
    <div class="container">
        <h2>Введите данные кота</h2>
        <form action="admin.php" method="post">
            <input type="hidden" name="add_cat" value="1">
            <label for="name">Имя:</label><br>
            <input type="text" id="name" name="name" required><br>
            <label for="breed">Порода:</label><br>
            <input type="text" id="breed" name="breed" required><br>
            <label for="age">Возраст:</label><br>
            <input type="number" id="age" name="age" required><br><br>
            <input type="submit" value="Добавить кота">
        </form>
    </div>
    <div class="container">
        <h2>Наши коты</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Порода</th>
                    <th>Возраст</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($cats)): ?>
                    <tr>
                        <td colspan="5">Котов не найдено.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($cats as $cat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cat['id']); ?></td>
                            <td><?php echo htmlspecialchars($cat['name']); ?></td>
                            <td><?php echo htmlspecialchars($cat['breed']); ?></td>
                            <td><?php echo htmlspecialchars($cat['age']); ?></td>
                            <td>
                                <form action="admin.php" method="post" style="display:inline;">
                                    <input type="hidden" name="cat_id" value="<?php echo $cat['id']; ?>">
                                    <input type="hidden" name="delete_cat" value="1">
                                    <input type="submit" value="Удалить">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
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
