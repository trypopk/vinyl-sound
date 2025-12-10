<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$res = mysqli_query($connect, "SELECT * FROM blog ORDER BY id DESC");
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Блоги</h1>
    <a href="add-blog.php" class="btn-main">Добавить статью</a>
    <table class="admin-table">
        <tr><th>ID</th><th>Заголовок</th><th>Описание</th><th>Действия</th></tr>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td>
                <a href="edit-blog.php?id=<?= $row['id'] ?>">Редактировать</a> |
                <a href="delete-blog.php?id=<?= $row['id'] ?>" onclick="return confirm('Удалить?')">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
