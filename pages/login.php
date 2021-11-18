<?php
	require_once "functions/login_function.php";
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
			<?php
				if (isset($_SESSION['logged_user'])) {
					echo 'Вы уже авторизированы';
				} else {
			?>
					<form method="POST" action="/login">
						<h2>Авторизация</h2>
						<input placeholder="Логин" maxlength="15" pattern="[A-Za-z]\d[0-9]{5, 15}" type="text" name="login"> <br />
						<input placeholder="Пароль" maxlength="20" pattern="[A-Za-z]\d[0-9]{5, 20}" type="password" name="password"> <br />
						<input type="submit"  name="login_user" value="Войти"> <br />
					</form>
			<?php
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