<?php
session_start();
include "config.php";

if (!isset($_POST['id'])) exit;

$id = intval($_POST['id']);

$query = mysqli_query($connect, "SELECT * FROM catalog WHERE id = $id");
$product = mysqli_fetch_assoc($query);

if (!$product) exit;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantity']++;
} else {
    $_SESSION['cart'][$id] = [
        'id' => $product['id'],
        'title' => $product['title'],
        'price' => $product['price'],
        'image' => $product['image'],
        'quantity' => 1
    ];
}

echo "ok";
exit;
