<?php
	require_once "functions/reg_function.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<title>Основная страница сайта</title>
</head>
<body>
	<h1>Тематический сайт-форум</h1>
	<nav>
	<ul class="navigation">
		<li class="nav-item">
			<a  href="#">Форум</a>
		</li>
		<li class="nav-item">
			<a href="#">Статьи</a>
		</li>
		<li class="nav-item">
			<a href="#">Книга жалоб и предложений</a>
		</li>
		<li class="nav-item" style="float:right">
			<a class="active" href="reg_form.php">Реистрация</a>
		</li>
		<li class="nav-item" class="active" style="float:right">
			<a class="active" href="login.php">Войти</a>
		</li>
	</ul>
	</nav>
		<div class="sidebar">
			<h4>Статьи от пользователей нашего сайта</h4>
			<ul>
				<li class="active-list-item">
					<a href="#">Статья 1</a>
				</li>
				<li class="active-list-item">
					<a href="#">Статья 2</a>
				</li>
				<li class="active-list-item">
					<a href="#">Статья 3</a>
				</li>
			</ul>
		</div>
	<main>
		
		<div class="content">
			<form method="POST" action="reg_form.php">
				<h2>Регистрация</h2>
				<input type="text" name="login"> <br />
				<input type="password" name="password"> <br />
				<input type="password" name="password_2"> <br />
				<input type="submit" name="reg_user" value="Зарегистрироваться"> <br />
			</form>
		</div>
	</main>
	
		<footer>
			<ul class="footer-item-list">
				<li class="footer-item">
					<a href="#">Контакты</a>
				</li>
				<li class="footer-item">
					<a href="#">О нас</a>
				</li>
				<li class="footer-item">
					<a href="#">Вакансии</a>
				</li>
			</ul>
			<p>&copy; Все права защищены 2021</p>
		</footer>
			

</body>
</html>