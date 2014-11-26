<?php
session_start();

require_once 'functions/user_functions.php';
require_once 'functions/db_functions.php';

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
	
	$key   			=  isset($_POST['key'])? trim($_POST['key']): null;
	$new_password   =  isset($_POST['pwd'])? trim($_POST['pwd']): null;
	$new_password2  =  isset($_POST['pwd2'])? trim($_POST['pwd2']): null;
	
	
	// echo "string >>> $key <<<< $pwd $pwd2 ";

	if(empty($new_password) || strlen($new_password) < 6){
		$erro_msg = "Enter valid password, which is greater than six character.";
	}

	if( $new_password  != $new_password2 ){
		$erro_msg = "Passwords dont match.";
	}
	
	if(isset($erro_msg)){

		require_once 'web/reset.tmpl.php';
	}else{

		$conn    = connect ( $config );
		$user_id = getUserIdFromKey($conn,$key);
		update_user_password( $conn, $user_id, $new_password );

		$conn = null;
		header('Location:home.php');
	}
}else{

	$key  =  isset($_GET['key'])? trim($_GET['key']): null;
	require_once 'web/reset.tmpl.php';

}