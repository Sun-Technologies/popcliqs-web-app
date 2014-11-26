<?php 
	require_once('functions/db_functions.php');
	require_once('pdo/user_event_class.php');
	require_once('functions/mobile.functions.php');
	require_once('functions/sessions_function.php');

	$_ERROR_AUTH = -1001;
	$_ERROR_ALL	 = -1000;
	$_SUCCESS    = 0;

	date_default_timezone_set("UTC"); 

	$exit_cd 	 = $_SUCCESS;
	$usernm  	 = isset($_GET["usernm"]) ? $_GET["usernm"] : null ;
	$pwd  		 = isset($_GET["pwd"]) ? $_GET["pwd"] : null ;
	$deviceToken = isset($_GET["deviceToken"]) ? $_GET["deviceToken"] : null ;

	if($usernm === null  || $pwd  === null || $usernm === ''  || $pwd === '' ){
		$exit_cd = $_ERROR_AUTH;
	}

	$conn 	= connect ($config);
	$key	= authenticate_user($conn, $usernm , $pwd); 

	if($key == null){
		$exit_cd = $_ERROR_AUTH;
	}else{
		if( $deviceToken !== null ) {
			//update session table. 
			$sessionType = "MOBILE";
			$status      = 1; 

			//get user id from keys.
			$keys 		= explode("$",$key);
			$user_id 	= $keys[0];

			updateSession($conn,  $deviceToken , $sessionType , $status , $user_id) ;
		}
	}

	$conn = null;
	include_once ('json/json.login.layout.php');
?>

