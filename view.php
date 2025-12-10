<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $connect->prepare("SELECT name, type, content FROM documents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $type, $content);
        $stmt->fetch();

        header("Content-Type: $type");
        header("Content-Disposition: inline; filename=\"$name\"");
        echo $content;
        exit;
    } else {
        echo "Документ не найден.";
    }
} else {
    echo "Не указан ID документа.";
}
?>
