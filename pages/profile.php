<?php
	$pid = $_GET['id'];
	$profile = R::findOne('users', 'id = ?', [$pid]);
	$comment_form = R::dispense('comments');
	$comments = R::getAll("SELECT * FROM comments WHERE module = 'profile'");
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
			<h4>Статьи от пользователей нашего сайта</h4>
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
						
							<textarea name="status">
								
							</textarea>
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
						<input type="text" name="comment_text"> <br />
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
						<li class="user-comment">
							<a href="profile?id=<?=$commentator->id?>"><?=$commentator->login?></a>
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