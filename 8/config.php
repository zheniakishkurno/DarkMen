<?php
// Параметры подключения к базе данных
$dbhost = 'localhost'; // Имя хоста базы данных
$dbusername = 'root'; // Имя пользователя базы данных
$dbpass = 'zhe27'; // Пароль пользователя базы данных
$dbname = 'mysitebd'; // Имя базы данных


// Подключение к базе данных
$conn = new mysqli($dbhost, $dbusername, $dbpass, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
