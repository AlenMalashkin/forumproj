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
	<?php
		nav();
	?>
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
		<?php
			footer();
		?>
		</footer>
			

</body>
</html>