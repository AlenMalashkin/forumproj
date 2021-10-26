<?php
	$_SESSION = [];
	session_destroy();
	echo "Вы успешно вышли из аккаунта, вернуться на <a href='/'>главную</a> страницу";
?>