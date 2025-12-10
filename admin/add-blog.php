<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $desc = mysqli_real_escape_string($connect, $_POST['description']);
    $content = mysqli_real_escape_string($connect, $_POST['content']);
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../image/blog/' . $image);
    }
    mysqli_query($connect, "INSERT INTO blog (title, description, content, image) VALUES ('$title', '$desc', '$content', '$image')");
    header('Location: blogs.php');
    exit;
}
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Добавить статью</h1>
    <form class="admin-form-wide admin-form" method="post" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Заголовок" required><br>
        <input type="text" name="description" placeholder="Короткое описание"><br>
        <textarea name="content" placeholder="Контент" rows="8"></textarea><br>
        <input type="file" name="image" accept="image/*"><br>
        <button type="submit">Добавить</button>
    </form>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
