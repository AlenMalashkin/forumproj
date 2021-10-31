<?php
	$theme = R::findOne('themes', ' id = ? ', [$_GET['id']]);
	$creator = R::findOne('users', ' id = ? ', [$theme->creator_id]);
	$answer = R::dispense('answers');
	$answers_array = R::getAll('SELECT * FROM answers WHERE theme = :themeid ORDER BY id DESC', [':themeid' => $_GET['id']]);
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
				<?
				sidebar_news();
				?>
			</ul>
		</div>
	<main>
		
		<div class="content">
			<h2>Раздел темы <?=$theme->title?></h2>
			Текст темы:<p><?=$theme->text?></p>
			Автор темы:<a href="/profile?id=<?=$theme->creator_id?>"><?=$creator->login?></a>
			<p>Ответы пользователей в теме:</p>
			<hr>
			<?php
			foreach ($answers_array as $answers)
			{
			$user = R::findOne('users', 'id = ?', [$answers['user_id']])
			?>
				<div class="comments">
					Ответ:<p><?=$answers['text']?></p>
					Автор коментария:<a href="profile?id=<?=$user->id?>"><?=$user->login?></a>
				</div>
				<hr>
			<?php

			?>
			<?php
			}
				if(isset($_SESSION['logged_user']))
				{
				?>
					<form method="POST" action="/theme?id=<?=$_GET['id']?>">
						<p>Написать в теме:</p>
						<textarea name="theme_answer"></textarea> <br />
						<input type="submit" name="send_answer">
					</form>
				<?php
				} else
				{
			?>
					<p>Хотите отставить совой ответ в теме? <a href="/login">Авторизируйтесь</a> на сайте.</p>
			<?php
				}
			if (isset($_POST['send_answer']))
			{
				$answer->text = $_POST['theme_answer'];
				$answer->user = $_SESSION['logged_user'];
				$answer->theme = $_GET['id'];
				R::store($answer);
				echo("<meta http-equiv='refresh' content='1'>");
			}
			?>
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