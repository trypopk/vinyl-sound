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
    <link rel="script" href="script.js">
    <title>Вход</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <?php require "block/header.php" ?>

    <?php
    include "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['login']) || empty($_POST['password'])) {
        $error = "Заполните все поля";
    } else {
        $login = $_POST['login'];
        $pass = $_POST['password'];

        $query = mysqli_query($connect, "SELECT * FROM users WHERE login='$login'");
        $user = mysqli_fetch_assoc($query);

        if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user'] = $user;

        if ($user['role'] === 'admin') {
        header("Location: admin.php"); // путь к админке
        } else {
            header("Location: index.php");
        }
        exit;
        } else {
            $error = "Неверный логин или пароль";
        }
    }
}
    ?>

    

    <!-- Основной контент -->
    <main>
        <div class="container">
            <div class="admin-form">
                <h1>Вход</h1>
                    <form method="POST">
                        <input type="text" name="login" placeholder="Логин" required>
                        <input type="password" name="password" placeholder="Пароль" required>
                        <button type="submit">Войти</button>
                    </form>
                <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            </div>
        </div>
    </main>

    <?php require "block/footer.php" ?>
</body>