<?php 
	require_once('functions/db_functions.php');
	require_once('pdo/user_event_class.php');
	require_once('functions/mobile.functions.php');
	require_once('functions/sessions_function.php');
	require_once 'pdo/exit_code_class.php';
	require_once 'pdo/exitcode_constants.php';

	

	date_default_timezone_set("UTC"); 

	$status_obj = $_SUCCESS;
	$key  		= isset($_GET["key"]) ? $_GET["key"] : null ;
	$deviceToken = isset($_GET["deviceToken"]) ? $_GET["deviceToken"] : null ;

	
	if($key === null  || $key === '' ){

		$status_obj = $_ERROR_AUTH;
	}

	$keys = explode("$",$key);
	
	if(sizeof($keys)  < 2  ){
		$status_obj = $_ERROR_AUTH;
	}

	$user_id = $keys[0];
	$pwd 	 = $keys[1];

	if($user_id === null  || $pwd  === null || $user_id === ''  || $pwd === '' ){

		$exit_cd = $_ERROR_AUTH;
	}

	$conn = connect ($config);
	$is_authorized = is_operation_authorised($conn ,$user_id, $pwd);

	if( $is_authorized ){

		//update session table. 
		$sessionType = "MOBILE";
		$status      = 0; 
		updateSession($conn,  $deviceToken , $sessionType , $status , $user_id) ;
	}else{
		$status_obj = $_ERROR_AUTH;
	}

	$conn = null;
	include_once ('json/json.service.layout.php');
?>

