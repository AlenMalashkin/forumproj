<?php
	$resume = R::getAll('SELECT * FROM resume ORDER BY id DESC LIMIT 5');
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
			<h2>Резюме кандидатов</h2>
			<?php
			foreach ($resume as $res) {
				$offer = R::load('offers', $res['offer']);
				$user = R::load('users', $res['user_id']);
			?>
			<div class="resume">
				<b>Специальность: <?=$offer->title?></b>
				<p><b>Ответ:</b> <?=$res['answer']?></p>
				<p><b>Контакты:</b> <?=$res['contact']?></p>
				<b>Прислал: </b><a href="/profile?id=<?=$user->id?>"><?=$user->login?></a>
			</div>
			
			<?php
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