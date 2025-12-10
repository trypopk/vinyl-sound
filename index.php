<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name = "description" content = "Винил" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="виниловые пластинки; купить виниловые пластинки;проигрыватель виниловых пластинок;проигрыватель виниловых пластинок купить;магазин виниловых пластинок;виниловые пластинки москва
    авито виниловые пластинки;песня виниловая пластинка;виниловые пластинки ссср;виниловые пластинки цена">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="animation/anim.css">
    <script src="animation/anim.js"></script>
    <title>Vinyl&Sound</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <?php require "block/header.php" ?>

    <!-- Основной контент -->
    <main>
        <div class="container">
        <section class="hero" id="hero">
                <div class="hero-text">
                    <h1>Настоящий звук, который можно потрогать</h1>
                    <p>Мир виниловых пластинок и безупречной аудиотехники. <br>Верните магию музыки в ваш дом.</p>
    
                    <a class="btn-main" href="catalog.php">Каталог</a>
                </div>

                <!-- <div class="hero-img">
                    <img src="image/vinyl1.png" alt="img">
                </div> -->

                <div class="hero-img">
        <!-- Контейнер для анимации с двумя изображениями -->
        <div class="vinyl-animation-container">
            <!-- Изображение коробки (статичное) -->
            <img src="image/vinyl11.png" alt="Коробка для пластинки" class="record-case-img" id="recordCase">
            
            <!-- Изображение пластинки (будет анимироваться) -->
            <img src="image/vinyl22.png" alt="Виниловая пластинка" class="vinyl-record-img" id="vinylRecord">
        </div>
    </div>
        </section>

        <section class="catalog" id="catalog">
            <h2>Категории товаров</h2>

            <div class="link-list">
                <ul>
                    <li>
                        <a class="link-item" href="catalog.php?category=vinyl">
                            <div class="cat-cart">
                                <p>Винил</p>
                                <img src="image/categories/cat1.png" alt="img">
                            </div>
                        </a>
                    </li>

                    <li>
                        <a class="link-item" href="catalog.php?category=players">
                            <div class="cat-cart">
                                <p>Проигрыватели</p>
                                <img src="image/categories/cat2.png" alt="img">
                            </div>
                        </a>
                    </li>

                    <li>
                        <a class="link-item" href="catalog.php?category=accessories">
                            <div class="cat-cart">
                                <p>Аксессуары</p>
                                <img src="image/categories/cat3.png" alt="img">
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </section>

        <section class="benefits" id="benefits">
            <h2>Почему выбирают нас?</h2>

            <div class="ben-list">
                <div class="ben-item">
                    <img src="image/lupa.png" alt="">
                    <h2>Экспертный подбор</h2>
                    <p>Наша команда - это фанаты музыки. <br>
                        Мы поможем с выбором <br>
                        и ответим на любой вопрос
                    </p>
                </div>

                <div class="ben-item">
                    <img src="image/lampochka.png" alt="">
                    <h2>Гарантия качества</h2>
                    <p>Мы тщательнго проверяем всю технику <br>
                        и работаем только с <br>
                        проверенными поставщиками
                    </p>
                </div>

                <div class="ben-item">
                    <img src="image/focus.png" alt="">
                    <h2>Экспертиза</h2>
                    <p>Наши консультанты — опытные специалисты, <br>готовые помочь с выбором и <br>ответить на все вопросы.
                    </p>
                </div>
            </div>
        </section>

        <section class="suppliers" id="suppliers">
            <h2>Наши поставщики</h2>

            <div class="suppl-list">
                <img src="image/suppliers/guitar_center.png" alt="">

                <img src="image/suppliers/sweetwater.png" alt="">

                <img src="image/suppliers/thomann.png" alt="">

                <img src="image/suppliers/rough.png" alt="">
            </div>
        </section>
    </main>      

<?php require "block/footer.php" ?>
</body>
</html>