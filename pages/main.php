<?php
	$themes = R::getAll( 'SELECT * FROM themes ORDER BY id DESC LIMIT 5' );
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
			<h2>Главная страница форума, добро пожаловать!</h2>
			<div>
				<a class="link" href="/theme_create">Создать тему</a>
				<?php
				if ($_SESSION['logged_user']->admin == 1)
				{
				?>
				<a class="link" href="/admin/add_state">Добавить новость</a>
				<a class="link" href="admin/add_offer">Добавить вакансию</a>
				<a class="link" href="admin/offer_answers">Посмотреть ответы на вакансии</a>
				<?php
				}
				?>
				<h3>Тут расположены популярные разделы сайта.</h3>
				<ul class="topics">
				<?php
				foreach ($themes as $theme)
				{
					$user = R::load('users', $theme['creator_id']);
					
					$comment = R::findOne('answers', 'theme = ?', [$theme['id']]);
					$commentator = R::load('users', $comment->user_id);
				?>
					<hr>
					<li class="topic-list-item">
						<a class="theme-link" href="/theme?id=<?=$theme['id']?>"><strong><?=$theme['title']?></strong></a>
						<div class="answer">
							<?php
							if (!empty($comment))
							{
							?>
							<div class="user-answer">Пользователь <a  href="/profile?id=<?=$commentator->id?>"><?=$commentator->login?></a> ответил:</div>
							<div class="user-answer"><p class="topic-answer"><?=$comment->text?></p></div>
							<?php
							} else 
							{
							?>
							<div><p>В этой теме пока что никто не оставлял своих коментариев...</p></div>
							<?php
							}
							?>
						</div>
						<strong>Автор темы:</strong> <a href="/profile?id=<?=$user->id?>"><?=$user->login?></a>
					</li>
				<?php
				}
				?>
				</ul>
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
