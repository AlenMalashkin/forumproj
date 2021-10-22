<?php
	require 'functions/libs/db.php';
	if (isset($_POST['theme_create']))
	{
		$theme = R::dispense('themes');
		$theme->title = $_POST['theme_title'];
		$theme->text = $_POST['theme_text'];
		$theme->creator = $_SESSION['logged_user'];
		R::store($theme);
		header('Location: index.php');
	}
	
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
			<a  href="/index.php">Форум</a>
		</li>
		<li class="nav-item">
			<a href="#">Статьи</a>
		</li>
		<li class="nav-item">
			<a href="#">Книга жалоб и предложений</a>
		</li>
		
		<?php if (isset($_SESSION['logged_user']))
		{?>
			<li class="nav-item" style="float:right">
				<a class="active" href="reg_form.php">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="login.php">Войти</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="profile.php">Профиль</a>
			</li>

			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="functions/logout.php">Выйти</a>
			</li>
		<?php } else {?>
			<li class="nav-item" style="float:right">
				<a class="active" href="reg_form.php">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="login.php">Войти</a>
			</li>
		<?php } ?>

	</ul>
	</nav>
		<div class="sidebar">
			<h4>Новости нашего сайта</h4>
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
			<h2>Создайте тему для форума.</h2>
			<form method="POST" action="theme_creator.php">
				<p>Введите название темы</p>
				<input type="text" name="theme_title">
				<p>Введите основной текст темы</p>
				<textarea name="theme_text">
					
				</textarea> <br />
				<input value="Создать тему" type="submit" name="theme_create">
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