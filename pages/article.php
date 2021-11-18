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
			<h2><?=$article->title?></h2>
			<p><?=$article->text?></p>
			<h3>Была ли полезна эта статься?</h3>
			<?php
			if (isset($_SESSION['logged_user']))
			{
			?>
			<form method="POST" action="/article?id=<?=$article->id?>">
					
					<input class="custom-radio" name="q_answer" type="radio" required value="Да">
					<label for="yes">Да</label> <br />
					<input class="custom-radio" name="q_answer" type="radio" required value="Нет">
					<label for="no">Нет</label>
					<p>Пожалуйста, обоснуйте ответ, это важно для нас:</p>
					<textarea placeholder="Текст" cols="30" rows="5" required name="comment_text"></textarea> <br />
					<input type="submit" name="comment_send">
			</form>
			<?php
				if (isset($_POST['comment_send']))
				{
					$comments = R::dispense('comments');
					$comments->module = 'article';
					$comments->params = $_GET['id'];
					$comments->answer = $_POST['q_answer'];
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
			if (empty($comments_view))
			{
			?>
			<p>Здесь пока нет ответов...</p>
			<?php
			} else
			{
			?>
			<p>Здесь отображаются коментарии пользователей:</p>
			<?php
			}
			$comments_view = R::getAll("SELECT * FROM comments WHERE module = 'article'");
				
			foreach ($comments_view as $comments)
			{
				$user = R::findOne('users', ' id = ? ', [$comments['user_id']]);
				if ($_GET['id'] == $comments['params'])
				{

				?>
					<hr>
					<div class="comments">
						<strong>Ответ на вопрос: <?=$comments['answer']?></strong>
						<p>Кометарий: <?=$comments['text']?></p>
						<strong>Автор коментария:</strong> <a href="/profile?id=<?=$user->id?>"><?=$user->login?></a>
					</div>
					
				<?php
				}
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