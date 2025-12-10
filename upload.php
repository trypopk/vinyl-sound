<?php
session_start();
include "config.php"; // подключение к БД

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $fileName = $_FILES['document']['name'];
    $fileType = $_FILES['document']['type'];
    $fileTmp  = $_FILES['document']['tmp_name'];

    $fileContent = file_get_contents($fileTmp);

    $stmt = $connect->prepare("INSERT INTO documents (name, type, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fileName, $fileType, $fileContent);

    // if ($stmt->execute()) {
    //     echo "Документ успешно загружен!";
    // } else {
    //     echo "Ошибка загрузки документа.";
    // }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <title>Загрузка документа</title>
    
</head>
<body>
    <?php require "block/header.php" ?>
    <main>
            <div class="container">
        <h2 style="text-align: center;">Загрузить документ</h2>
        <form class="admin-form-wide admin-form" action="" method="post" enctype="multipart/form-data">
            <input type="file" name="document" required>
            <button type="submit">Загрузить</button>
        </form>

        <hr>
        <h2>Список документов</h2>
        <?php
        $result = $connect->query("SELECT id, name FROM documents");
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li><a href='view.php?id={$row['id']}' target='_blank'>{$row['name']}</a></li>";
            }
            echo "</ul>";
        } else {
            echo "Документы не найдены.";
        }
        ?>

    </div>
    </main>
    <?php require "block/footer.php" ?>
</body>
</html>
