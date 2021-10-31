<?php
	require_once "functions/login_function.php";
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
			<a  href="/">Форум</a>
		</li>
		<li class="nav-item">
			<a href="/news">Новости сайта</a>
		</li>
		<li class="nav-item">
			<a href="/reportbook">Книга жалоб и предложений</a>
		</li>
		<li class="nav-item" style="float:right">
			<a class="active" href="/register">Реистрация</a>
		</li>
		<li class="nav-item" class="active" style="float:right">
			<a class="active" href="/login">Войти</a>
		</li>
	</ul>
	</nav>
		<div class="sidebar">
			<h3>Статьи от пользователей нашего сайта</h3>
			<ul>
				<?php
				sidebar_news();
				?>
			</ul>
		</div>
	<main>
		
		<div class="content">
			<form method="POST" action="/login">
				<h2>Авторизация</h2>
				<input placeholder="Логин" maxlength="15" pattern="[A-Za-z]\d[0-9]{5, 15}" type="text" name="login"> <br />
				<input placeholder="Пароль" maxlength="20" pattern="[A-Za-z]\d[0-9]{5, 20}" type="password" name="password"> <br />
				<input type="submit"  name="login_user" value="Войти"> <br />
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