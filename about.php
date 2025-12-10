<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
    <title>О нас</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
    <?php require "block/header.php" ?>

    <main>
        <!-- Hero секция -->
        <section class="about-hero">
            <div class="container">
                <div class="about-hero-content">
                    <h1>Vinyl&Sound — Ваш проводник в мир виниловой музыки</h1>
                    <p>С 2010 года мы помогаем меломанам находить ту самую пластинку, которая заставляет сердце биться чаще.</p>
                </div>
            </div>
        </section>

        <!-- Наша миссия -->
        <section class="our-mission">
            <div class="container">
                <div class="mission-content">
                    <div class="mission-text">
                        <h2>Наша миссия</h2>
                        <p>Мы верим, что музыка — это не просто звук, а настоящее искусство, которое заслуживает быть услышанным в самом лучшем качестве. Виниловые пластинки дарят тот самый аутентичный звук, который невозможно воспроизвести цифровыми технологиями.</p>
                        <p>Наша команда тщательно отбирает каждую пластинку, чтобы вы могли наслаждаться чистейшим звуком и неповторимой атмосферой аналоговой записи.</p>
                    </div>
                    <div class="mission-stats">
                        <div class="stat-item">
                            <span class="stat-number">5000+</span>
                            <span class="stat-label">Пластинок в каталоге</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">13+</span>
                            <span class="stat-label">Лет на рынке</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">10000+</span>
                            <span class="stat-label">Довольных клиентов</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Брендов партнеров</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Наши ценности -->
        <section class="our-values">
            <div class="container">
                <h2>Наши ценности</h2>
                <div class="values-grid">
                    <div class="value-card">
                        <h3>Качество звука</h3>
                        <p>Мы гарантируем оригинальное качество каждой пластинки и тщательно проверяем их перед продажей.</p>
                    </div>
                    <div class="value-card">
                        <h3>Любовь к музыке</h3>
                        <p>Мы сами — страстные меломаны и делимся своей любовью к винилу с каждым клиентом.</p>
                    </div>
                    <div class="value-card">
                        <h3>Честность</h3>
                        <p>Прозрачные условия покупки, честные описания состояния пластинок и открытые цены.</p>
                    </div>
                    <div class="value-card">
                        <h3>Экспертиза</h3>
                        <p>Наша команда — настоящие эксперты в мире винила с многолетним опытом.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Наш магазин -->
        <section class="store-info">
            <div class="container">
                <h2>Посетите наш магазин</h2>
                <div class="store-content">
                    <div class="store-text">
                        <p>Мы находимся в самом центре города, в историческом здании с уникальной атмосферой. В нашем магазине вы можете:</p>
                        <ul class="store-features">
                            <li>Послушать любую пластинку перед покупкой в нашем listening lounge</li>
                            <li>Получить консультацию от наших экспертов</li>
                            <li>Посетить тематические вечера и встречи коллекционеров</li>
                            <li>Осмотреть и оценить редкие экземпляры из нашей коллекции</li>
                        </ul>
                        <div class="store-contacts">
                            <p><strong>Адрес:</strong> ул. Музыкальная, 17, Москва</p>
                            <p><strong>Часы работы:</strong> Пн-Пт: 11:00-20:00, Сб-Вс: 10:00-21:00</p>
                            <p><strong>Телефон:</strong> +7 (495) 123-45-67</p>
                        </div>
                    </div>
                    <div class="store-map">
                        <div class="map-placeholder">
                            <img src="image/magazyn-s2dio-1.jpg" alt="Интерьер нашего магазина">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content">
                    <h2>Готовы начать свое виниловое путешествие?</h2>
                    <p>Приходите в наш магазин или исследуйте наш онлайн-каталог</p>
                    <div class="cta-buttons">
                        <a href="catalog.php" class="btn-main">Смотреть каталог</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require "block/footer.php" ?>
</body>
</html>