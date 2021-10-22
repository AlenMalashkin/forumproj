<?php
	require "functions/libs/db.php";
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
			<a href="/articles.php">Статьи</a>
		</li>
		<li class="nav-item">
			<a href="/reportbook.php">Книга жалоб и предложений</a>
		</li>
		
		<?php if (isset($_SESSION['logged_user']))
		{?>
			<li class="nav-item" style="float:right">
				<a class="active" href="/reg_form.php">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/login.php">Войти</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/profile.php">Профиль</a>
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
					<a href="/articles">Статья 1</a>
				</li>
				<li class="active-list-item">
					<a href="/articles">Статья 2</a>
				</li>
				<li class="active-list-item">
					<a href="/articles">Статья 3</a>
				</li>
			</ul>
		</div>
	<main>
		
		<div>
			<h2>Жалобная книга</h2>
			<p>Тут вы можете написать нам жалобу или своё предложение, как можно развить проект.</p>
			<form>
				<textarea>
					
				</textarea>
				<br />
				<input type="submit" name="report" value="Отправить жалобу">
				<ul class='report'>
					<li class="report-item">
						<h3>Title</h3>
						<p>Paragraph</p>
						<a href="#">User</a>
					</li>
				</ul>
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