<?php
	if (isset($_POST['theme_create']))
	{
		$theme = R::dispense('themes');
		$theme->title = $_POST['theme_title'].$i;
		$theme->text = $_POST['theme_text'].$i;
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
	<?php
		nav();
	?>
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
		<?php
			nav();
		?>
		</footer>
</body>
</html>