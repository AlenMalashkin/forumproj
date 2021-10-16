<?php
	require "libs/rb.php";

	R::setup( 'mysql:host=localhost;dbname=forum_users',
        'root', '' );

	$errors = [];

	if (isset($_POST['login_user']))
	{
		$user = R::findOne('users', 'login = ?', array($_POST['login']));
		if ($user)
		{
			if (password_verify($_POST['password'], $user->password))
			{
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