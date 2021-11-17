<?php
if (isset($_POST['create_news']))
{
	$news = R::dispense('news');
	$news->title = $_POST['news_title'].$i;
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
	<?php
		nav();
	?>
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
					<textarea name="news_text"></textarea>
					<br />
					<input type="submit" name="create_news">
				</form>
			</div>
		
		</div>
	</main>
	
		<footer>
			<?php
				footer();
			?>
		</footer>
			

</body>
</html>

