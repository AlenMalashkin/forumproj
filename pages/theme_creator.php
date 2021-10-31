<?php
	if (isset($_POST['theme_create']))
	{
		$theme = R::dispense('themes');
		$theme->title = $_POST['theme_title'];
		$theme->text = $_POST['theme_text'];
		$theme->creator = $_SESSION['logged_user'];
		R::store($theme);
		echo "Тема успешно создана, перейдите на <a href='/'>главную</a> страницу.";
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
			<a  href="/">Форум</a>
		</li>
		<li class="nav-item">
			<a href="/news">Новости сайта</a>
		</li>
		<li class="nav-item">
			<a href="/reportbook">Книга жалоб и предложений</a>
		</li>
		
		<?php if (isset($_SESSION['logged_user']))
		{?>
			<li class="nav-item" style="float:right">
				<a class="active" href="/register">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/login">Войти</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/profile?id=<?=$user->id?>">Профиль</a>
			</li>

			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/logout">Выйти</a>
			</li>
		<?php } else {?>
			<li class="nav-item" style="float:right">
				<a class="active" href="/register">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/login">Войти</a>
			</li>
		<?php } ?>

	</ul>
	</nav>
		<div class="sidebar">
			<h3>Новости нашего сайта</h3>
			<ul>
				<?php
				sidebar_news();
				?>
			</ul>
		</div>
	<main>
		<?php
		if (isset($_SESSION['logged_user']))
		{
		?>
		<div class="content">
			<h2>Создайте тему для форума.</h2>
			<form method="POST" action="/theme_create">
				<p>Введите название темы</p>
				<input placeholder="Название темы" maxlength="40" type="text" name="theme_title">
				<p>Введите основной текст темы</p>
				<textarea placeholder="Текст темы" name="theme_text"></textarea> <br />				
				<input value="Создать тему" type="submit" name="theme_create">
			</form>
		</div>
		<?php
		} else
		{
		?>
		<p>Для создания темы необходимо <a href="/login">авторизироваться</a> на сайте.</p>
		<?php
		}
		?>
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