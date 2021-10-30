<?php
	header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	require "functions/libs/db.php";
	include "functions/reg_function.php";
	include "functions/login_function.php";
	include "functions/sidebar_news_viewer.php";
	include "functions/main_content.php";
	$user = R::findOne('users', 'id = ?', [$_SESSION['logged_user']->id]);
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$segments = explode('/', trim($uri, '/'));

	if($segments[0] === 'admin')
	{
	    if($segments[1] === 'add_state')
	        $file = 'admin.php';
	    
	}
	else
	{
	    if($uri === '/')
	    {
	        $file = 'main.php';
	    }
	    elseif($uri === '/news')
	    {
	       $file = 'news.php';
	    }
	    elseif($uri === '/login')
	    {
	    	$file = 'login.php';
	    }
	    elseif ($uri === '/profile')
	    {
	    	$file = 'profile.php';
	    }
	    elseif ($uri === '/register')
	    {
	    	$file = 'reg_form.php';
	    }
	    elseif ($uri === '/reportbook')
	    {
	    	$file = 'reportbook.php';
	    }
	    elseif ($uri === '/theme_create')
	    {
	    	$file = 'theme_creator.php';
	    }
	    elseif ($uri === '/logout')
	    {
	    	$file = '../functions/logout.php';
	    } else if ($uri === '/theme')
	    {
	    	$file = 'theme.php';
	    } else if ($uri === '/article')
	    {
	    	$file = 'article.php';
	    }
	    else
	    {
	        exit('Ошибка 404, файл не найден.');
	    }
	}

	require 'pages/' . $file;
?>