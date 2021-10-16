<?php
	$username = "";
	
	$db = mysqli_connect('localhost', 'root', '', 'forum-users');

	if (isset($_POST['reg_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['login']);
		$password = mysqli_real_escape_string($db, $_POST['pass']);

		if (empty($username)) { echo "Введите имя пользователя"; }
		if (empty($password)) { echo "Ввелите пароль!"; }

		$password = md5($password_1);
		$query = "INSERT INTO userdata (login, password) 
					VALUES('$username', '$password')";
		mysqli_query($db, $query);

		header('location: index.php');

	}
?>
