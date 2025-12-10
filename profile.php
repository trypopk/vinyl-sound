<?php
session_start();
include "config.php"; // подключение к БД

// Если пользователь не вошёл
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];

// Получаем данные пользователя из БД
$stmt = $connect->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: login.php");
    exit();
}

// Обработка формы редактирования профиля
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $success = "";
    
    // Обновляем основные данные пользователя
    $stmt = $connect->prepare("UPDATE users SET first_name=?, last_name=?, phone=?, email=? WHERE id=?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $phone, $email, $userId);
    $stmt->execute();
    
    // Изначально используем текущий аватар
    $avatarPath = $user['avatar'];
    
    // Загрузка нового аватара
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $fileName = $_FILES['avatar']['name'];
        $fileSize = $_FILES['avatar']['size'];
        $fileTmp = $_FILES['avatar']['tmp_name'];
        
        // Получаем расширение файла
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Проверяем расширение
        if (!in_array($fileExt, $allowedExtensions)) {
            $error = "Допустимые форматы: jpg, jpeg, png, gif, webp";
        }
        // Проверяем размер файла (максимум 5MB)
        elseif ($fileSize > 5 * 1024 * 1024) {
            $error = "Файл слишком большой. Максимальный размер: 5MB";
        } else {
            // Создаем папку если её нет
            $uploadDir = 'image/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Генерируем уникальное имя файла
            $newFileName = uniqid() . '.' . $fileExt;
            $avatarPath = $uploadDir . $newFileName;
            
            // Пытаемся загрузить файл
            if (move_uploaded_file($fileTmp, $avatarPath)) {
                // Удаляем старый аватар если он существует и не является дефолтным
                $oldAvatar = $user['avatar'];
                if (!empty($oldAvatar) && $oldAvatar !== 'avatar.png' && file_exists($oldAvatar)) {
                    unlink($oldAvatar);
                }
                
                // Обновление в БД
                $stmt = $connect->prepare("UPDATE users SET avatar = ? WHERE id = ?");
                $stmt->bind_param("si", $avatarPath, $userId);
                $stmt->execute();
                
                // Обновление сессии
                $_SESSION['user']['avatar'] = $avatarPath;
                $user['avatar'] = $avatarPath;
                $success .= "Аватарка успешно обновлена! ";
            } else {
                $error = "Ошибка при загрузке файла";
                $avatarPath = $user['avatar']; // Возвращаем старый путь
            }
        }
    }
    
    // Обновляем сессию
    $_SESSION['user']['first_name'] = $first_name;
    $_SESSION['user']['last_name'] = $last_name;
    $_SESSION['user']['phone'] = $phone;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['avatar'] = $avatarPath;
    
    $success .= "Данные успешно обновлены!";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<body>
<?php require "block/header.php"; ?>

<main>
<div class="profile-page">
    <div class="profile-page"> 
        <img src="<?= !empty($user['avatar']) ? htmlspecialchars($user['avatar']) : 'avatar.png' ?>" 
             alt="Аватар" 
             class="profile-avatar"
             onerror="this.src='avatar.png'"> 
        <div class="profile-info"> 
            <h2><?= htmlspecialchars($user['login']) ?></h2> 
            <p><strong>Имя:</strong> <span id="firstName"><?= htmlspecialchars($_SESSION['user']['first_name']) ?></span></p> 
            <p><strong>Фамилия:</strong> <span id="lastName"><?= htmlspecialchars($_SESSION['user']['last_name']) ?></span></p> 
            <p><strong>Телефон:</strong> <span id="phone"><?= htmlspecialchars($_SESSION['user']['phone']) ?></span></p> 
            <p><strong>Email:</strong> <span id="email"><?= htmlspecialchars($_SESSION['user']['email']) ?></span></p>

            <button class="btn-edit" id="editProfileBtn">Редактировать профиль</button>
        </div>
    </div>
    
    <?php 
    if (isset($success)) echo "<p style='color:green;'>$success</p>";
    if (isset($error)) echo "<p style='color:red;'>$error</p>";
    ?>

    <div id="profileModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <form class="profile-form" method="POST" enctype="multipart/form-data">
            <h2>Редактировать профиль</h2>
            
            <div class="form-group">
                <label>Текущая аватарка:</label>
                <img src="<?= !empty($user['avatar']) ? htmlspecialchars($user['avatar']) : 'avatar.png' ?>" 
                     alt="Текущий аватар" 
                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin: 10px 0;">
            </div>
            
            <div class="form-group">
                <label for="avatar">Выбрать новую аватарку:</label>
                <input type="file" name="avatar" id="avatar" accept="image/*">
                <small>Допустимые форматы: JPG, PNG, GIF, WEBP. Макс. размер: 5MB</small>
            </div>
            
            <div class="form-group">
                <input type="text" name="first_name" placeholder="Имя" value="<?= htmlspecialchars($user['first_name']) ?>" required>
            </div>
            
            <div class="form-group">
                <input type="text" name="last_name" placeholder="Фамилия" value="<?= htmlspecialchars($user['last_name']) ?>" required>
            </div>
            
            <div class="form-group">
                <input type="tel" name="phone" placeholder="Телефон" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>
            
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            
            <button type="submit" name="update_profile" class="btn-save">Сохранить изменения</button>
        </form>
    </div>
</div>
</div>
</main>

<?php require "block/footer.php"; ?>
<script>
// JS для открытия/закрытия модалки
const modal = document.getElementById("profileModal");
const btn = document.getElementById("editProfileBtn");
const closeBtn = modal.querySelector(".close-modal");

btn.onclick = () => modal.style.display = "block";
closeBtn.onclick = () => modal.style.display = "none";
window.onclick = e => { if(e.target == modal) modal.style.display = "none"; };

// Предпросмотр аватарки перед загрузкой
document.getElementById('avatar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.querySelector('.form-group img');
            if (img) {
                img.src = e.target.result;
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>
</body>
</html>