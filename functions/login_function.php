<?php
	require "libs/db.php";

	$errors = [];

	if (isset($_POST['login_user']))
	{
		$user = R::findOne('users', 'login = ?', array($_POST['login']));
		if ($user)
		{
			if (password_verify($_POST['password'], $user->password))
			{
				$_SESSION['logged_user'] = $user;
				header('Location: index.php');
			} else
			{
				echo $errors[] = 'Пароль введён неверно';
			}
		} else
		{
			echo $errors[] = 'Пользователь не найден';
		}
	}
?>