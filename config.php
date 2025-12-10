<?php
$connect = mysqli_connect("localhost", "root", "", "vinyl&sound");

if (!$connect) {
    die("Ошибка подключения к БД: " . mysqli_connect_error());
}
