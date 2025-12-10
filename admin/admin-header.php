<?php
// Включаем общий хедер сайта, если есть
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="/Vinyl&Sound/css/style.css">
<link rel="icon" type="image/x-icon" href="../favicon.ico">
<title>Админ-панель</title>
</head>
<body>
<?php if (file_exists(__DIR__.'/../block/header.php')) require __DIR__.'/../block/header.php'; ?>
<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <a href="catalog.php">Товары</a>
        <a href="blogs.php">Блоги</a>
        <a href="users.php">Пользователи</a>
        <a href="../index.php">На сайт</a>
    </aside>
    <main class="admin-content">
