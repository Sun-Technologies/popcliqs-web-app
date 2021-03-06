<?php
session_start();
require_once 'functions/user_functions.php';
require_once 'functions/db_functions.php';
require_once 'pdo/user_class.php';

$login_status = NULL;
if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$email    	=  isset($_POST['email'])    ? trim($_POST['email']): null;
	$password 	=  isset($_POST['password']) ? trim($_POST['password']):null;
	$conn = connect ($config);
	if( empty($email) || empty($password)  ){

		$login_status = "Invalid user name or  password login";
		require_once 'web/index.tmpl.php';
		die();	
    }
	
	$user_id = authenticate_user($conn, $email, $password );

	if ($user_id != null) {
		$_SESSION['email']   = $email; //$email;
		$_SESSION['user_id'] = $user_id;
		header('Location:home.php');
	}else{

		$login_status = "Invalid email or password, please try again.";
		// header('Location:index.php');
		require_once 'web/index.tmpl.php';
	}

	$conn = null;
}
else {
	header('Location:index.php');
}