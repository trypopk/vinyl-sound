<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$id = (int)$_GET['id'];
$res = mysqli_query($connect, "SELECT * FROM blog WHERE id=$id LIMIT 1");
$article = mysqli_fetch_assoc($res);
if (!$article) die('Статья не найдена');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $desc = mysqli_real_escape_string($connect, $_POST['description']);
    $content = mysqli_real_escape_string($connect, $_POST['content']);
    $image = $article['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../image/blog/' . $image);
    }
    mysqli_query($connect, "UPDATE blog SET title='$title', description='$desc', content='$content', image='$image' WHERE id=$id");
    header('Location: blogs.php');
    exit;
}
?>
<?php require __DIR__ . '/admin-header.php'; ?>
<div class="container">
    <h1>Редактировать статью</h1>
    <form class="admin-form-wide admin-form" method="post" enctype="multipart/form-data">
        <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>" required><br>
        <input type="text" name="description" value="<?= htmlspecialchars($article['description']) ?>"><br>
        <textarea name="content" rows="8"><?= htmlspecialchars($article['content']) ?></textarea><br>
        <?php if ($article['image']): ?><img src="../image/blog/<?= htmlspecialchars($article['image']) ?>" width="200"><br><?php endif; ?>
        <input type="file" name="image"><br>
        <button type="submit">Сохранить</button>
    </form>
</div>
<?php require __DIR__ . '/admin-footer.php'; ?>
