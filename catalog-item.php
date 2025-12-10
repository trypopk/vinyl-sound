<?php
    include "config.php"; // подключение к БД

    $id = $_GET['id']; // получаем id товара из URL

    $result = mysqli_query($connect, "SELECT * FROM catalog WHERE id = $id");
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Товар не найден";
    exit;
    }
    ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/catalog.css">
    <title><?= $product['title'] ?></title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <?php require "block/header.php" ?>

    <!-- Основной контент -->
    <main>
        <div class="container">
            <div class="catalog-item">
                <div class="product-page">
                <div class="product-image">
                    <img src="image/<?php echo $product['image']; ?>" alt="">
                </div>

                <div class="product-info">
                    <h1><?php echo $product['title']; ?></h1>
                    <p class="description"><?php echo $product['description']; ?></p>
                    <p class="price"><?php echo $product['price']; ?> ₽</p>

                    <form class="add-to-cart-form" method="POST">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <button class="btn-main" type="submit">Добавить в корзину</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </main>

    <?php require "block/footer.php" ?>

     <script>
        document.querySelectorAll(".add-to-cart-form").forEach(form => {
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                fetch("add_to_cart.php", { method: "POST", body: formData })
                    .then(res => res.text())
                    .then(data => { if(data.trim() === "ok") showToast("Товар добавлен в корзину!"); });
            });
        });

        function showToast(msg) {
            let toast = document.createElement("div");
            toast.className = "toast";
            toast.innerText = msg;
            document.body.appendChild(toast);
            setTimeout(() => toast.classList.add("show"), 10);
            setTimeout(() => toast.classList.remove("show"), 2500);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>
</body>