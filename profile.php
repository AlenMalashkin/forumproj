<?php
	require "functions/libs/db.php";
	$uid = $_SESSION['logged_user'];
	$user = R::findOne('users', 'login = ?', [$uid->login]);
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
			<a  href="/index.php">Форум</a>
		</li>
		<li class="nav-item">
			<a href="#">Статьи</a>
		</li>
		<li class="nav-item">
			<a href="#">Книга жалоб и предложений</a>
		</li>
		
		<?php if (isset($_SESSION['logged_user']))
		{?>
			<li class="nav-item" style="float:right">
				<a class="active" href="reg_form.php">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="login.php">Войти</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="profile.php">Профиль</a>
			</li>

			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="functions/logout.php">Выйти</a>
			</li>
		<?php } else {?>
			<li class="nav-item" style="float:right">
				<a class="active" href="reg_form.php">Реистрация</a>
			</li>
			<li class="nav-item" class="active" style="float:right">
				<a class="active" href="login.php">Войти</a>
			</li>
		<?php } ?>

	</ul>
	</nav>
		<div class="sidebar">
			<h4>Статьи от пользователей нашего сайта</h4>
			<ul>
				<li class="active-list-item">
					<a href="#">Статья 1</a>
				</li>
				<li class="active-list-item">
					<a href="#">Статья 2</a>
				</li>
				<li class="active-list-item">
					<a href="#">Статья 3</a>
				</li>
			</ul>
		</div>
	<main>
		
		<div class="content">
			<h2>Профиль пользователя <?=$user->login?></h2>
			<div>
				<p>Поставьте ваш статаус:</p>
				<p><?=$user->status?></p>
				<?php
					if ($user->status == '')
					{
					
				?>

				<form method="POST" action="profile.php">
				
					<textarea name="status">
						
					</textarea>
					<br />
					<input type="submit" name="set_status" value="Поставить">
				</form>
				<?php
						if (isset($_POST['set_status']))
						{
							$user->status = $_POST['status'];
							R::store($user);
							echo("<meta http-equiv='refresh' content='1'>");
						}
					} else
					{
				?>
				<form method="POST" action="profile.php">
					<input type="submit" name="update_status" value="Обновить"> <br />
					<?php
						if (isset($_POST['update_status']))
						{
							$user->status = '';
							R::store($user);
							echo("<meta http-equiv='refresh' content='1'>");
						}
					}
					?>
				</form>
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