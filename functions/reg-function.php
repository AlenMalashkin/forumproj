<?php
	$username = "";
	
	$db = mysqli_connect('localhost', 'root', '', 'forum-users');

	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['login']);
		$password = mysqli_real_escape_string($db, $_POST['pass']);


		// form validation: ensure that the form is correctly filled
		if (empty($username)) { echo "Введите имя пользователя"; }
		if (empty($password)) { echo "Ввелите пароль!"; }

		// register user if there are no errors in the form
		$password = md5($password_1);//encrypt the password before saving in the database
		$query = "INSERT INTO userdata (login, password) 
					VALUES('$username', '$password')";
		mysqli_query($db, $query);

		header('location: index.php');

	}
?>