<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $price = (int)$_POST['price'];
    $category = mysqli_real_escape_string($connect, $_POST['category']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../image/' . $image);
    }
    mysqli_query($connect, "INSERT INTO catalog (title, price, image, description, category) VALUES ('$title', $price, '$image', '$description', '$category')");
    header('Location: catalog.php');
    exit;
}
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Добавить товар</h1>
    <form class="admin-form-wide admin-form" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Название" required><br>
        <input type="number" name="price" placeholder="Цена" required><br>
        <select name="category">
            <option value="vinyl">Винил</option>
            <option value="players">Проигрыватели</option>
            <option value="accessories">Аксессуары</option>
        </select><br>
        <textarea name="description" placeholder="Описание"></textarea><br>
        <input type="file" name="image" accept="image/*"><br>
        <button type="submit">Добавить</button>
    </form>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
