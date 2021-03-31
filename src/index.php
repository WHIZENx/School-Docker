<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	session_start();
	if(isset($_SESSION["permission"])) {
		header('Location: '.$uri.'/main.php');
	} else {
		header('Location: '.$uri.'/login.php');
	}
	exit;
?>