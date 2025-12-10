<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$id = (int)$_GET['id'];
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=$id LIMIT 1");
$user = mysqli_fetch_assoc($res);
if (!$user) die('Пользователь не найден');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = mysqli_real_escape_string($connect, $_POST['login']);
    $role = $_POST['role'] === 'admin' ? 'admin' : 'user';
    if (!empty($_POST['password'])) {
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($connect, "UPDATE users SET login='$login', role='$role', password='$pass' WHERE id=$id");
    } else {
        mysqli_query($connect, "UPDATE users SET login='$login', role='$role' WHERE id=$id");
    }
    header('Location: users.php');
    exit;
}
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Редактировать пользователя</h1>
    <form class="admin-form-wide admin-form" method="post">
        <input type="text" name="login" value="<?= htmlspecialchars($user['login']) ?>" required><br>
        <input type="password" name="password" placeholder="Новый пароль (оставьте пустым чтобы не менять)"><br>
        <select name="role">
            <option value="user" <?= $user['role']=='user' ? 'selected' : '' ?>>Пользователь</option>
            <option value="admin" <?= $user['role']=='admin' ? 'selected' : '' ?>>Админ</option>
        </select><br>
        <button type="submit">Сохранить</button>
    </form>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
