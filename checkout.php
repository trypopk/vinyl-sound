<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$user = $_SESSION['user'];

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    die("Корзина пуста!");
}

// Обработка AJAX-запроса для обновления данных пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    $stmt = $connect->prepare("UPDATE users SET first_name=?, last_name=?, phone=?, email=? WHERE id=?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $phone, $email, $userId);
    $stmt->execute();

    // Обновляем сессию
    $_SESSION['user']['first_name'] = $first_name;
    $_SESSION['user']['last_name'] = $last_name;
    $_SESSION['user']['phone'] = $phone;
    $_SESSION['user']['email'] = $email;

    echo "success";
    exit();
}

// Обработка заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $total_price = 0;

    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    mysqli_query($connect, "INSERT INTO orders (user_id, name, phone, email, total_price)
        VALUES ('".$userId."', '$name', '$phone', '$email', $total_price)");

    $order_id = mysqli_insert_id($connect);

    foreach ($_SESSION['cart'] as $item) {
        mysqli_query($connect, "INSERT INTO order_items (order_id, product_id, title, price, quantity)
            VALUES ($order_id, ".$item['id'].", '".$item['title']."', ".$item['price'].", ".$item['quantity'].")");
    }

    unset($_SESSION['cart']); // очищаем корзину
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Оформление заказа</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script>
    // AJAX для обновления данных пользователя 
    function updateUser() {
        const formData = new FormData(document.getElementById('userForm'));
        formData.append('update_user', '1');

        fetch('checkout.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            if(data.trim() === 'success') {
                document.getElementById('status').innerText = "Данные обновлены!";
            }
        });
    }
    </script>
</head>
<body>
<?php require "block/header.php"; ?>

<main>
<div class="container-checkout">
    <h1>Оформление заказа</h1>

    <form id="userForm">
        <input type="text" name="first_name" placeholder="Имя" value="<?= htmlspecialchars($user['first_name']) ?>" required>
        <input type="text" name="last_name" placeholder="Фамилия" value="<?= htmlspecialchars($user['last_name']) ?>" required>
        <input type="tel" name="phone" placeholder="Телефон" value="<?= htmlspecialchars($user['phone']) ?>" required>
        <input type="email" name="email" placeholder="E-mail" value="<?= htmlspecialchars($user['email']) ?>" required>
        <p id="status" style="color:green;"></p>
        <button type="button" onclick="updateUser()">Обновить данные</button>
    </form>

    <hr>

    <form method="POST">
        <!-- Подставляем обновлённые данные из сессии -->
        <input type="hidden" name="name" value="<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>">
        <input type="hidden" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
        <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
        <button type="submit" name="place_order" class="btn-main">Подтвердить заказ</button>
    </form>
</div>
</main>

<?php require "block/footer.php"; ?>
</body>
</html>
