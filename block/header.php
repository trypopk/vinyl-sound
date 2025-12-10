<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Инициализация переменных по умолчанию
$cart_count = 0;
$is_logged_in = false;

if (isset($_COOKIE['name'])) {
  require_once 'lib/db.php';
  $sql = 'SELECT COUNT(*) as count FROM cart WHERE user_id = (SELECT id FROM users WHERE name = ?)';
  $query = $pdo->prepare($sql);
  $query->execute([$_COOKIE['name']]);
  $result = $query->fetch(PDO::FETCH_OBJ);
  $cart_count = $result ? $result->count : 0;
  $is_logged_in = true;
}
?>

<!-- Хедер -->
<header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                <a href="/Vinyl&Sound/index.php">Vinyl <br/>& Sound</a>
                </div>
                <button class="menu-toggle" aria-label="Открыть меню">☰</button>
                <nav>
                    <ul>
                        <li><a href="/Vinyl&Sound/catalog.php">Каталог</a></li>
                        <li><a href="/Vinyl&Sound/about.php">О нас</a></li>
                        <li><a href="/Vinyl&Sound/blog.php">Блог</a></li>
                        <li><a href="/Vinyl&Sound/upload.php">Практические</a></li>
                        <li><a href="/Vinyl&Sound/cart.php">Корзина</a></li>

                        <?php if(isset($_SESSION['user'])): ?>
                
                        <!-- Если админ - показываем ссылку на админку -->
                        <?php if($_SESSION['user']['role'] === 'admin'): ?>
                        <li><a href="/Vinyl&Sound/admin.php">Админ-панель</a></li>
                        <?php endif; ?>

                        <!-- Ссылка на профиль для всех авторизованных -->
                        <li><a href="/Vinyl&Sound/profile.php">Профиль</a></li>
                        
                        <!-- Выход для всех авторизованных -->
                        <li><a href="/Vinyl&Sound/logout.php">Выход</a></li>
                        <?php else: ?>

                         <!-- Если гость -->
                        <li><a href="/Vinyl&Sound/login.php">Войти</a></li>
                        <li><a class="btn-main" href="/Vinyl&Sound/register.php">Регистрация</a></li>
                        <?php endif; ?> 
                        
                    </ul>
                </nav>
            </div>
        </div>
</header>