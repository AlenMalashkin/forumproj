<?php
	$news_view = R::getAll('SELECT * FROM news ORDER BY id DESC LIMIT 5');
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
			<?php
				sidebar_news();
			?>
			</ul>
			
		</div>
	<main>
		
		<div class="content">
			<h2>Новости нашего сайта</h2>
			<?php
			foreach ($news_view as $news)
			{
			?>
				<hr>
				<a class="link" href="/article?id=<?=$news['id']?>"><?=$news['title']?></a>
				<p><strong>Текст новости:</strong> <?=$news['text']?></p>
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
