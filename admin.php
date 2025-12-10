<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Проверка прав администратора
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Перенаправляем админа в новую панель
header("Location: admin/catalog.php");
exit;
