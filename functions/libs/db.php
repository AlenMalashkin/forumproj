<?php
	require "rb.php";
	R::setup( 'mysql:host=localhost;dbname=forum_users',
        'root', '' );

	session_start();
?>