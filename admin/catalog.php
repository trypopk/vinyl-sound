<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$res = mysqli_query($connect, "SELECT * FROM catalog ORDER BY id DESC");
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Товары</h1>
    <a href="add-product.php" class="btn-main">Добавить товар</a>
    <table class="admin-table">
        <tr><th>ID</th><th>Фото</th><th>Название</th><th>Цена</th><th>Категория</th><th>Действия</th></tr>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?php if($row['image']): ?><img src="../image/<?= htmlspecialchars($row['image']) ?>" width="80"><?php endif; ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['price']) ?> ₽</td>
            <td><?= htmlspecialchars($row['category']) ?></td>
            <td>
                <a href="edit-product.php?id=<?= $row['id'] ?>">Редактировать</a> |
                <a href="delete-product.php?id=<?= $row['id'] ?>" onclick="return confirm('Удалить?')">Удалить</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
