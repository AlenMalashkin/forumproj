<?php
	require "libs/db.php";

	$errors = [];

	if (isset($_POST['reg_user']))
	{
		

		if ($_POST['login' == ''])
		{
			$errors[] = "Введите логин";
		}

		if ($_POST['password' == ''])
		{
			$errors[] = "Введите пароль";
		}

		if ($_POST['password_2'] != $_POST['password'])
		{
			$errors[] = "Повторный пароль введён неверно";
		}

		if (R::count('users', "login = ?", array($_POST['login'])) > 0)
		{
			$errors[] = "Пользователь с таким логином уже существует";
		}

		if (empty($errors))
		{
			$user = R::dispense( 'users' );
			$user->login = $_POST['login'];
			$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			R::store($user);
			header('Location: index.php');
		} else
		{
			echo array_shift($errors);
		}
	}
?>
