<?php 
require "db.php"; // подключаем файл для соединения с БД
//require __DIR__ . '/header.php'; // подключаем шапку проекта
// Производим выход пользователя
unset($_SESSION['logged_user']);

// Редирект на главную страницу
exit("<meta http-equiv='refresh' content='0; url= /index.php'>");

require __DIR__ . '/footer.php'; // Подключаем подвал проекта
?>