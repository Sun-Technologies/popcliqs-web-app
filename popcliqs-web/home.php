<?php
session_start();

if(!isset($_SESSION['email'])){
	$user_id= $_COOKIE['user_id'];
	if ($user_id!=null) {
		$_SESSION['user_id'] = $user_id;
         require 'web/home.tmpl.php';
	}else {
	header('Location:index.php');
	die();

	}

} 
 require 'web/home.tmpl.php';
