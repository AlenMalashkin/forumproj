<?php
	$offer = R::findOne('offers', 'id = ?', [$_GET['offer_id']]);
	if (isset($_POST['send_answer'])) {
		for ($i=0; $i < 10; $i++) { 
			$resume = R::dispense('resume');
		$resume->answer = $_POST['answer'].$i;
		$resume->contact = $_POST['contacts'];
		$resume->offer = $_GET['offer_id'];
		$resume->user = $_SESSION['logged_user'];
		R::store($resume);
		}
		
		echo "Ваша заявка принята и будет рассмотрена администратором в ближайшее время. Перейдите на <a href='/'>главную</a> страницу сайта.";
	}
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
			<h2>Ответ на вакансию <?=$offer->title?></h2>
				<form method="POST" action="/offers/answer?offer_id=<?=$offer['id']?>">
					<textarea name="answer" placeholder="Поле для ответа"></textarea>
					<br>
					<textarea name="contacts" placeholder="Поле для контактов"></textarea>
					<br>
					<input type="submit" name="send_answer">				
				</form>
		</div>
	</main>
	
		<footer>
			<?php
				footer();
			?>
		</footer>
			

</body>
</html>