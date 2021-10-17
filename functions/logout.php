<?php
	require "libs/db.php";

	$_SESSION = [];
	session_destroy();
	header('Location: ../index.php');
?>