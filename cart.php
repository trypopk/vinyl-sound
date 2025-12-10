<?php
session_start();

// Если пользователь не авторизован, перенаправляем на страницу регистрации
if (!isset($_SESSION['user'])) {
    header("Location: register.php"); // укажи здесь путь к странице регистрации
    exit();
}
?>
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
    <link rel="stylesheet" href="css/cart.css">
    <title>Корзина</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <?php require "block/header.php" ?>


    <!-- Основной контент -->
    <main>
        <div class="container">
             <h1>Корзина</h1>

            <?php if(empty($_SESSION['cart'])): ?>
                <p>Корзина пуста</p>
            <?php else: ?>
            <table>
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                    <th></th>
                </tr>

                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item):
                    $sum = $item['price'] * $item['quantity'];
                    $total += $sum;
                ?>
                <tr>
                    <td><?= $item['title'] ?></td>
                    <td><?= $item['price'] ?> ₽</td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $sum ?> ₽</td>
                    <td><a href="remove_from_cart.php?id=<?= $item['id'] ?>">Удалить</a></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h3>Итого: <?= $total ?> ₽</h3>

            <a href="checkout.php" class="btn-main">Оформить заказ</a>
        <?php endif; ?>
        </div>
    </main>

    <?php require "block/footer.php" ?>
</body>