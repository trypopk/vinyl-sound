<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$id = (int)$_GET['id'];
$res = mysqli_query($connect, "SELECT * FROM catalog WHERE id=$id LIMIT 1");
$product = mysqli_fetch_assoc($res);
if (!$product) die('Товар не найден');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $price = (int)$_POST['price'];
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $image = $product['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../image/' . $image);
    }
    mysqli_query($connect, "UPDATE catalog SET title='$title', price=$price, category='$category', description='$description', image='$image' WHERE id=$id");
    header('Location: catalog.php');
    exit;
}
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Редактировать товар</h1>
    <form class="admin-form-wide admin-form" method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?= htmlspecialchars($product['title']) ?>" required><br>
        <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>
        <select name="category">
            <option value="vinyl" <?= $product['category']=='vinyl' ? 'selected' : '' ?>>Винил</option>
            <option value="players" <?= $product['category']=='players' ? 'selected' : '' ?>>Проигрыватели</option>
            <option value="accessories" <?= $product['category']=='accessories' ? 'selected' : '' ?>>Аксессуары</option>
        </select><br>
        <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea><br>
        <label>Текущее изображение:</label><br>
        <?php if ($product['image']): ?><img src="../image/<?= htmlspecialchars($product['image']) ?>" width="150"><br><?php endif; ?>
        <input type="file" name="image"><br>
        <button type="submit">Сохранить</button>
    </form>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
