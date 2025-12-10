<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$res = mysqli_query($connect, "SELECT id, login, role FROM users ORDER BY id DESC");
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Пользователи</h1>
    <table class="admin-table">
        <tr><th>ID</th><th>Логин</th><th>Роль</th><th>Действия</th></tr>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['login']) ?></td>
            <td><?= htmlspecialchars($row['role']) ?></td>
            <td>
                <a href="user-edit.php?id=<?= $row['id'] ?>">Редактировать</a> |
                <a href="user-delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Удалить?')">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
