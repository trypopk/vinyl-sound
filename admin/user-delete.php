<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$id = (int)$_GET['id'];
// защитим от удаления самого себя (если есть id в сессии)
if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $id) {
    header('Location: users.php');
    exit;
}
mysqli_query($connect, "DELETE FROM users WHERE id=$id");
header('Location: users.php');
exit;
