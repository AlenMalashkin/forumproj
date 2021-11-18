<?php
if (isset($_POST['send_msg'])) {
	$chat = R::dispense('chat');
	$chat->msg = $_POST['msg'].$i;
	$chat->user = $_SESSION['logged_user'];
	$chat->time = date('d-m-Y H:i:s');
	R::store($chat);
	echo("<meta http-equiv='refresh'>");
}

$msgs = R::getAll('SELECT * FROM chat ORDER BY id DESC LIMIT 50');
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
			<h2>Чат для пользователей</h2>
			<div class='chatbox'>
				<?php
				foreach ($msgs as $msg) {
					$user = R::load('users', $msg['user_id']);
				?>
				<div class="chat-msg">
					<a href="/profile?id<?=$user->id?>"><?=$user->login?></a><br>
					<span><?=$msg['time']?></span>
					<p><?=$msg['msg']?></p>
				</div>
				<?php
				}
				?>
			</div>
			<form method="POST" action="/contact">
				<p>Написать сообщение в чат</p>
				<textarea name="msg"></textarea><br>
				<input type="submit" value="Отправить сообщение" name="send_msg">
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
