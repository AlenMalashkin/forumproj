<?php
if (isset($_POST['add_offer'])){
	$offers = R::dispense('offers');
	$offers->title = $_POST['title'];
	$offers->desc = $_POST['desc'];
	$offers->cost = $_POST['cost'];
	R::store($offers);
	echo "Вакансия успешно добавлена в базу данных";
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
				<form method="POST" action="/admin/add_offer">
					<p>Название вакасии</p>
					<input type="text" name="title">
					<p>Описание вакансии</p>
					<textarea name="desc"></textarea>
					<p>Оплата</p>
					<input type="text" name="cost">
					<br />
					<input type="submit" value="Добавить вакансию" name="add_offer">
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