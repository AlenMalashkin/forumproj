<?php
	if (isset($_POST['report_send']))
	{
		$reports = R::dispense('reportbook');
		$reports->report = $_POST['report_text'].$i;	
		$reports->user = $_SESSION['logged_user'];	
		R::store($reports);
		echo("<meta http-equiv='refresh'>");
	}
	
	$report_query = R::getAll('SELECT * FROM reportbook ORDER BY id DESC LIMIT 25');
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
	<?php
		nav();
	?>
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
							<strong>Автор жалобы:</strong> <a href="/profile?id=<?=$user->id?>"><?=$user->login?></a>
							<p><strong>Текст жалобы:</strong> <?=$report_view['report']?></p>	
						</li>
					</ul>
				<?php 
				}
			?>
			
		</main>

		<footer>
		<?php
			footer();
		?>
		</footer>
			

</body>
</html>