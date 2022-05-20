<?php
$title="Главная страница"; // название формы
require "db.php"; // подключаем файл для соединения с БД
//require __DIR__ . '/header.php'; // подключаем шапку проекта
?>

<!-- Если авторизован выведет приветствие -->
<?php if(isset($_SESSION['logged_user'])) : ?>
	Здравствуй, <?php echo $_SESSION['logged_user']->name; ?></br>

<!-- Пользователь может нажать выйти для выхода из системы -->
<a href="../reg_auth/logout.php">Выйти</a> <!-- файл logout.php создадим ниже -->
<?php else : ?>

<!-- Если пользователь не авторизован выведет ссылки на авторизацию и регистрацию -->
<a href="reg_auth/login.php">Авторизация</a>
<a href="reg_auth/signup.php">Регистрация</a>

<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->
