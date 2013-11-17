<?php
session_start();
require 'functions/user_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_class.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

	$email    	=  isset($_POST['email'])    ? trim($_POST['email']): null;
	$password 	=  isset($_POST['password']) ? trim($_POST['password']):null;
	$conn = connect ($config);
	if( empty($email) || empty($password)  ){

		$status = "incorrect login";
		require 'web/index.tmpl.php';
		die();
		
    }
	
	$user_id = authenticate_user($conn, $email, $password );
	if ($user_id != null) {
		$_SESSION['email'] = $email;
		$_SESSION['user_id'] = $user_id;
		header('Location:home.php');
	}else{

		$status = "incorrect login";
		// require 'index.tmpl.php';
		header('Location:index.php');
	}
	

	

}
else {

	header('Location:index.php');
}