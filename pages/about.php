<?php

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
		
		<div class="about">
			<h2>Об этом проекте</h2>
				<p>Это мой первый проект, которые не расчитан на использование широким кругом лиц. Просто пришла в голову мысль сделать проект и я его сделал для себя, чтобы проверить свои знания и понять куда мне двигаться дальше. Больще я ничего не напишу тут об этом проекте, поэтому просто оставлю ссылку на свой гитхаб с исходным кодом этого проекта: <a href="https://github.com/AlenMalashkin/forumproj">вот сюда</a> нужно нажать, чтобы попасть прямо в репозиторий с проектом :)</p>
		</div>
	</main>
	
		<footer>
			<?php
				footer();
			?>
		</footer>
			

</body>
</html>
