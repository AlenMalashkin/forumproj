<?php
	$pid = $_GET['id'];
	$profile = R::findOne('users', 'id = ?', [$pid]);
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
			<a href="/articles">Статьи</a>
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
					if (empty(!$user->status) && $_GET['id'] == $_SESSION['logged_user']->id)
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
					
				?>

				<h3>Коментарии пользователя</h3>
				<ul class="comments">
					<li class="user-comment">
						<a href="<?=$uri?>">Пользователь 1</a>
						<p>Коментарий</p>
					</li>
					<li class="user-comment">
						<a href="#">Пользователь 2</a>
						<p>Коментарий</p>
					</li>
					<li class="user-comment">
						<a href="#">Пользователь 3</a>
						<p>Коментарий</p>
					</li>
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