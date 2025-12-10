<?php
require __DIR__ . '/../config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}
$id = (int)$_GET['id'];
mysqli_query($connect, "DELETE FROM catalog WHERE id=$id");
header('Location: catalog.php');
exit;
