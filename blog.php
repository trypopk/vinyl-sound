<?php include "config.php"; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Блог</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <style>
        .blog-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 40px;
        }
        .blog-card {
            border-radius: 10px;
            background: #fff;
            overflow: hidden;
            text-decoration: none;
            color: #111;
            transition: 0.3s;
        }
        .blog-card:hover { 
            transform: translateY(-5px); 
        }
        .blog-card img { 
            width: 100%; 
            height: 220px; 
            object-fit: cover;
        }
        .blog-card-body { 
            padding: 15px; 
        }
        .blog-card h3 { 
            margin: 0 0 10px; 
            font-size: 20px; 
        }
        .blog-card p { 
            color: #555; 
        }
    </style>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
<?php require "block/header.php"; ?>

<main>
<div class="container">
    <h1>Блоги о музыке и виниле</h1>

    <div class="blog-list">
        <?php
        $res = mysqli_query($connect, "SELECT * FROM blog ORDER BY id DESC");
        while($row = mysqli_fetch_assoc($res)):
        ?>
        <a href="blog-article.php?id=<?= $row['id'] ?>" class="blog-card">
            <img src="image/blog/<?= $row['image'] ?>" alt="">
            <div class="blog-card-body">
                <h3><?= $row['title'] ?></h3>
                <p><?= $row['description'] ?></p>
            </div>
        </a>
        <?php endwhile; ?>
    </div>

</div>
</main>

<?php require "block/footer.php"; ?>
</body>
</html>
