<?php
	$themes = R::getAll( 'SELECT * FROM themes LIMIT 5' );
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
			<h4>Новости нашего сайта</h4>
			<ul>
				<?
				sidebar_news();
				?>
			</ul>
		</div>
	<main>
		
		<div class="content">
			<h2>Главная страница форума, добро пожаловать!</h2>
			<div>
				<a href="/theme_create">Создать тему</a>
				<br />
				<?php
				if ($_SESSION['logged_user']->id == 2)
				{
				?>
				<a href="/admin/add_state">Администрация сайта</a>
				<?php
				}
				?>
				<h3>Тут расположены популярные разделы сайта.</h3>
				<ul class="topics">
				<?php
				foreach ($themes as $theme)
				{
					$user = R::load('users', $theme['creator_id']);
				?>
					<li class="topic-list-item">
						<a href="/theme?id=<?=$theme['id']?>"><strong><?=$theme['title']?></strong></a>
						<p><?=$theme['text']?></p>
						<a href="/profile?id=<?=$user->id?>"><?=$user->login?></a>
					</li>
				<?php
				}
				?>
				</ul>
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
