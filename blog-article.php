<?php
include "config.php";

$id = (int)$_GET['id'];
$res = mysqli_query($connect, "SELECT * FROM blog WHERE id = $id LIMIT 1");
$article = mysqli_fetch_assoc($res);

if (!$article) die("Статья не найдена.");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title><?= $article['title'] ?></title>

    <style>
        .blog-article {
            max-width: 800px;
            margin: 40px auto;
        }
        .blog-article img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 25px;
        }
        .blog-article p {
            line-height: 1.7;
            font-size: 18px;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>

<?php require "block/header.php"; ?>

<main>
    <div class="container blog-article">
        <h1><?= $article['title'] ?></h1>
        <img src="image/blog/<?= $article['image'] ?>" alt="">
        <p><?= nl2br($article['content']) ?></p>
        <a href="blog.php" class="btn-main" style="margin-top:20px;display:inline-block;">Назад</a>
    </div>
</main>

<?php require "block/footer.php"; ?>

</body>
</html>
