<?php
	$offers = R::getAll('SELECT * FROM offers ORDER BY id DESC LIMIT 5');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style.css">
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
			<h2>Вакансии</h2>
		<?php
		foreach ($offers as $offer) {
		?>
			<div class="offer">
				<p>Название вакансии: <?=$offer['title']?></p>
				<p>Описание: <?=$offer['desc']?></p>
				<p>Оплата: <?=$offer['cost']?></p> <br>
				<a class="link" href="offers/answer?offer_id=<?=$offer['id']?>">Ответить на вакансию</a>
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
