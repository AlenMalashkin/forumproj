<?php
	if (isset($_POST['report_send']))
	{
		$reports = R::dispense('reportbook');
		$reports->report = $_POST['report_text'];	
		R::store($reports);
		echo("<meta http-equiv='refresh'>");
	}
	
	$report_query = R::getAll('SELECT * FROM reportbook');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet" type="text/css"/>
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
			<h2>Жалобная книга</h2>
			<p>Тут вы можете написать нам жалобу или своё предложение, как можно развить проект.</p>
			<?php
			if (isset($_SESSION['logged_user']))
			{
			?>
			<form method="POST" action="/reportbook">
				<p>Введите вашу жаобу или предложение:</p>
				<textarea placeholder="Текст жалобы" name="report_text"></textarea>
				<br />
				<input type="submit" name="report_send" value="Отправить жалобу">
			</form>
			<?php
			} else 
			{
			?>
			<p>Извините, но жалобы могут оставлять только авторизированные пользователи! <a href="/login">Авторизируйтесь</a>, чтобы оставить жалобу.</p>
			<?php
			}
			?>
			<p>Здесь отображаются жалобы других пользователей:</p>
			<?php
				foreach ($report_query as $report_view)
				{
					$user = R::load('users', $report_view['user_id']);
				?>
					<ul class="report">
						<li class="report-item">
							<strong>Автор жалобы:</strong> <a href="/profile.php?id=<?=$user->id?>"><?=$user->login?></a>
							<p><strong>Текст жалобы:</strong> <?=$report_view['report']?></p>	
						</li>
					</ul>
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