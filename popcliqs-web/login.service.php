<?php 
	require('functions/db_functions.php');
	require('pdo/user_event_class.php');
	require('functions/mobile.functions.php');

	$_ERROR_AUTH = -1001;
	$_ERROR_ALL	 = -1000;
	$_SUCCESS    = 0;

	date_default_timezone_set("UTC"); 


	$exit_cd 	= $_SUCCESS;
	$usernm  	= isset($_GET["usernm"]) ? $_GET["usernm"] : null ;
	$pwd  		= isset($_GET["pwd"]) ? $_GET["pwd"] : null ;

	if($usernm === null  || $pwd  === null || $usernm === ''  || $pwd === '' ){
		$exit_cd = $_ERROR_AUTH;
	}

	$conn 	= connect ($config);
	$key	= authenticate_user($conn, $usernm , $pwd); 

	if($key == null){
		$exit_cd = $_ERROR_AUTH;
	}
	include ('json/json.login.layout.php');
?>

