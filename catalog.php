<?php include "config.php"; 

// Получаем категорию из GET и защитим её
$allowed_categories = ['vinyl', 'players', 'accessories'];
$category = isset($_GET['category']) ? trim($_GET['category']) : 'vinyl';
if (!in_array($category, $allowed_categories)) {
    $category = 'vinyl';
}

// Защита строки
$category_safe = mysqli_real_escape_string($connect, $category);

// Получаем товары по категории
$result = mysqli_query($connect, "SELECT * FROM catalog WHERE category = '$category_safe' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/catalog.css">
    <title>Каталог</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
    <?php require "block/header.php" ?>

    <main>
        <div class="container">

            <!-- Меню категорий -->
            <div class="catalog-menu">
                <a href="catalog.php?category=vinyl">Винил</a>
                <a href="catalog.php?category=players">Проигрыватели</a>
                <a href="catalog.php?category=accessories">Аксессуары</a>
            </div>

            <!-- Товары -->
            <div class="catalog">
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <a href="catalog-item.php?id=<?php echo $row['id']; ?>">
                        <img src="image/<?php echo $row['image']; ?>" alt="">
                        <h3><?php echo $row['title']; ?></h3>
                    </a>

                    <form class="add-to-cart-form" method="POST">
                        <p><?php echo $row['price']; ?> ₽</p>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="btn-main" type="submit">Добавить в корзину</button>
                    </form>
                </div>
                <?php endwhile; ?>
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
</html>
