<?php
if (isset($_POST['create_news']))
{
	$news = R::dispense('news');
	$news->title = $_POST['news_title'];
	$news->text = $_POST['news_text'];
	$news->comments;
	R::store($news);
	echo "Новость успешно добавлена в базу данных.";
	echo("<meta http-equiv='refresh'>");
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../style.css">
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
				<?
				sidebar_news();
				?>
			</ul>
		</div>
	<main>
		<div class="content">

			<div class="content">
				<h2>Панель администратора</h2>
				<p>Добавить новость</p>
				<form method="POST" action="/admin/add_state">
					<p>Заголовок новости</p>
					<input type="text" name="news_title">
					<p>Текст новости</p>
					<textarea name="news_text">
						
					</textarea>
					<br />
					<input type="submit" name="create_news">
				</form>
			</div>
		
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

