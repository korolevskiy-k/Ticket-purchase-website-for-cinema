<?php 
$title="Авторизация"; // название формы
require "db.php"; // подключаем файл для соединения с БД
require __DIR__ . '/header.php'; // подключаем шапку проекта
// Создаем переменную для сбора данных от пользователя по методу POST
$data = $_POST;
$new_url = 'index.php';

// Пользователь нажимает на кнопку "Авторизоваться" и код начинает выполняться
if(isset($data['do_login'])) { 

 // Создаем массив для сбора ошибок
 $errors = array();

 // Проводим поиск пользователей в таблице users
 $user = R::findOne('users', 'login = ?', array($data['login']));

 if($user) {

 	// Если логин существует, тогда проверяем пароль
 	if(password_verify($data['password'], $user->password)) {

 		// Все верно, пускаем пользователя
 		$_SESSION['logged_user'] = $user;
 		
		exit("<meta http-equiv='refresh' content='0; url= /index.php'>");
 		// echo '<div style="color: green; ">Вы успешно авторизировались! Можно <a href="../index.php">перейти на главную страницу</a>.</div><hr>';
 	} 

	else {
    $errors[] = 'Пароль неверно введен!';
 	}

 } else {
 	$errors[] = 'Пользователь с таким логином не найден!';
 }

if(!empty($errors)) {
		echo '<div style="color: red; ">' . array_shift($errors). '</div><hr>';
	}
}
?>

<div class="container mt-4">
		<div class="row">
			<div class="col">
		<!-- Форма авторизации -->
		<h2>Авторизация</h2>
		<form action="login.php" method="post">
			<input type="text" class="form-control" name="login" id="login" placeholder="Введите логин" required><br>
			<input type="password" class="form-control" name="password" id="pass" placeholder="Введите пароль" required><br>
			<button class="btn btn-success" name="do_login" type="submit">Авторизоваться</button>
		</form>
		<br>
		<p>Если вы еще не зарегистрированы, тогда нажмите <a href="signup.php">здесь</a>.</p>
		<p>Вернуться на <a href="../index.php">главную</a>.</p>
			</div>
		</div>
	</div>
<?php require __DIR__ . '/footer.php'; ?> <!-- Подключаем подвал проекта -->