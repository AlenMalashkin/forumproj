<?php
	$pid = $_GET['id'];
	$profile = R::findOne('users', 'id = ?', [$pid]);
	$comment_form = R::dispense('comments');
	$comments = R::getAll("SELECT * FROM comments WHERE module = 'profile' ORDER BY id DESC LIMIT 5");
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
			<h3>Статьи от пользователей нашего сайта</h3>
			<ul>
				<?php
				sidebar_news();
				?>
			</ul>
		</div>
	<main>
		
		<div class="content">
			<h2>Профиль пользователя <?=$profile->login?></h2>
			<div>
				<?php
				if ($_GET['id'] == $_SESSION['logged_user']->id)
				{
				?>
					<p>Поставьте ваш статаус:</p>
					<p><?=$profile->status?></p>
				
				<?php
					if ($user->status == '')
					{	
				?>
						<form method="POST" action="/profile?id=<?=$_SESSION['logged_user']->id?>">
						
							<textarea placeholder="Расскажите о себе" maxlength="1000" name="status"></textarea>
							<br />
							<input type="submit" name="set_status" value="Поставить">
						</form>
				<?php
					} 
						if (isset($_POST['set_status'])) 
						{
							$user->status = $_POST['status'];
							R::store($user);
							echo("<meta http-equiv='refresh' content='1'>");
						}
				?>		
				<?php
					if (!empty($user->status) && $_GET['id'] == $_SESSION['logged_user']->id)
					{
				?>
					<form method="POST" action="/profile?id=<?=$_SESSION['logged_user']->id?>">
							<input type="submit" name="update_status" value="Обновить"> <br />
					</form>					
				<?php
					}
					if(isset($_POST['update_status']))
					{
						$user->status = '';
						R::store($user);
						echo("<meta http-equiv='refresh' content='1'>");
					}	
				} else
				{
				?>
					<p>Статус пользователя:</p>
					<p><?=$profile->status?></p>
				<?php	
				}
				?>
				<?php
				if (isset($_SESSION['logged_user']))
				{
					if (isset($_POST['send_comment']))
					{
						$comment_form->text = $_POST['comment_text'];
						$comment_form->module = 'profile';
						$comment_form->params = $_GET['id'];
						$comment_form->user = $_SESSION['logged_user'];
						R::store($comment_form);
						echo("<meta http-equiv='refresh' content='1'>");
					}

				?>
					<hr>
					<p>Здесь вы можете оставить коментарий для этого пользователя</p>
					<form method="POST" action="/profile?id=<?=$profile->id?>">
						<input placeholder="Введите ваш коментарий" maxlength="1000" type="text" name="comment_text"> <br />
						<input type="submit" name="send_comment">
					</form>
				<?php
				} else
				{
				?>
				<p>Чтобы оставлять комментарии необходимо <a href="/login">авторизироваться</a> на сайте</p>
				<?php
				}
				?>
				<h3>Коментарии пользователя</h3>
				<ul class="comments">
					<?php
					foreach ($comments as $comment)
					{
						if ($comment['params'] == $_GET['id'])
						{
							$commentator = R::findOne('users', 'id = ?', [$comment['user_id']]);
					?>	
						<hr>	
						<li class="comment">
							<strong>Автор коментария: </strong><a class="link" href="profile?id=<?=$commentator->id?>"><?=$commentator->login?></a>
							<p><?=$comment['text']?></p>
						</li>
					<?php
						}
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