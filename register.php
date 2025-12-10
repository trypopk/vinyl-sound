<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/catalog.css">
    <title>Регистрация</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
<?php
include "config.php";

$defaultAvatar = 'image/avatar.png'; // путь к дефолтной аватарке

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Хэшируем пароль

    // Подготовленный запрос для безопасности
    $stmt = $connect->prepare("INSERT INTO users (login, password, avatar) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $login, $pass, $defaultAvatar);

    if ($stmt->execute()) {
        // Успешная регистрация — редирект на страницу входа
        header("Location: login.php");
        exit();
    } else {
        echo "Ошибка регистрации: " . $stmt->error;
    }
}
?>


    <?php require "block/header.php" ?>

    <!-- Основной контент -->
    <main>
        <div class="container">
            <div class="admin-form">
                <h1>Регистрация</h1>
                <form method="POST">
                    <input type="text" name="login" placeholder="Логин" required>
                    <input type="password" name="password" placeholder="Пароль" required>
                    <button type="submit">Зарегистрироваться</button>
                    <span>Нажмите</span><a href="login.php"> Войти</a>, если уже есть аккаунт</span>
                </form>
            </div>
        </div>
    </main>

    <?php require "block/footer.php" ?>
</body>