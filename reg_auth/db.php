<?php
// Подключаем библиотеку RedBeanPHP
require "libs/rb-mysql.php";

// Подключаемся к БД
R::setup('mysql:host=localhost;dbname=cinemadb', 'root', '');

session_start();
?>