<?php
	$article = R::findOne( 'news', ' id = ? ', [ $_GET['id'] ] )
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
	<ul class="navigation">
		<li class="nav-item">
			<a  href="/">Форум</a>
		</li>
		<li class="nav-item">
			<a href="/news">Новости сайта</a>
		</li>
		<li class="nav-item">
			<a href="/reportbook">Книга жалоб и предложений</a>
		</li>
		
		<?php if (isset($_SESSION['logged_user']))
		{?>
			<li class="nav-item" style="float:right">
				<a class="active" href="/register">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/login">Войти</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/profile?id=<?=$user->id?>">Профиль</a>
			</li>

			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/logout">Выйти</a>
			</li>
		<?php } else {?>
			<li class="nav-item" style="float:right">
				<a class="active" href="/register">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="/login">Войти</a>
			</li>
		<?php } ?>

	</ul>
	</nav>
		<div class="sidebar">
			<h4>Новости нашего сайта</h4>
			<?php
			sidebar_news();
			?>
		</div>
	<main>
		
		<div class="content">
			<h2><?=$article->title?></h2>
			<p><?=$article->text?></p>
			<h3>Была ли полезна эта статься?</h3>
			<?php
			if (isset($_SESSION['logged_user']))
			{
			?>
			<form method="POST" action="/article?id=<?=$article->id?>">
					<p>Заголовок</p>
					<input type="text" name="comment_title">
					<p>Комментарий</p>
					<textarea required name="comment_text"></textarea> <br />
					<input required type="submit" name="comment_send">
			</form>
			<?php
				if (isset($_POST['comment_send']))
				{
					$comments = R::dispense('comments');
					$comments->module = 'article';
					$comments->params = $_GET['id'];
					$comments->title = $_POST['comment_title'];
					$comments->text = $_POST['comment_text'];		
					$comments->user = $_SESSION['logged_user'];
					R::store($comments);
					echo("<meta http-equiv='refresh' content='1'>");
				}
			} else
			{
			?>
			<p><a href="/login">Авторизируйтесь</a> на сайте, чтобы поделиться с другими пользователями своим мнением насчёт неё!</p>
			<?php
			}
			?>
			<p>Здесь отображаются коментарии пользователей:</p>
			<?php
			
			$comments_view = R::getAll("SELECT * FROM comments WHERE module = 'article'");
				
			foreach ($comments_view as $comments)
			{
				$user = R::findOne('users', ' id = ? ', [$comments['user_id']]);
				if ($_GET['id'] == $comments['params'])
				{

				?>
					<hr>
					<strong><?=$comments['title']?></strong>
					<p><?=$comments['text']?></p>
					<a href="/profile?id=<?=$user->id?>"><?=$user->login?></a>
				<?php
				}
			}
			?>
		</div>
	</main>
	
		<footer>
			<ul class="footer-item-list">
				<li class="footer-item">
					<a href="#">Контакты</a>
				</li>
				<li class="footer-item">
					<a href="#">О нас</a>
				</li>
				<li class="footer-item">
					<a href="#">Вакансии</a>
				</li>
			</ul>
			<p>&copy; Все права защищены 2021</p>
		</footer>
			

</body>
</html>