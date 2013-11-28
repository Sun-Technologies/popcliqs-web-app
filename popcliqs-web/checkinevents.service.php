<?php 
	
	require('functions/db_functions.php');
	require('pdo/user_event_class.php');
	require('functions/mobile.functions.php');
	require 'functions/geo_functions.php';

	$_ERROR_AUTH = -1001;
	$_ERROR_ALL	 = -1000;
	$_SUCCESS    = 0;

	date_default_timezone_set("UTC");  


	$exit_cd 	= $_SUCCESS;
	$key  		= isset($_GET["key"]) ? $_GET["key"] : null ;
	$tz   		= isset($_GET["tz"])  ? $_GET["tz"] : 0 ;
	

	$start_t  = time();
	//$start_t  = $start_t - (60 *  $tz);

	if($key === null  || $key === '' ){

		$exit_cd = $_ERROR_AUTH;
	}

	$keys = explode("$",$key);
	
	if(sizeof($keys)  < 2  ){
		$exit_cd = $_ERROR_AUTH;
	}

	$q = (abs($tz)  / 60);
	$q = round($q, 0, PHP_ROUND_HALF_DOWN);
	$q = ($q > 10 )? $q : "0$q"; 
	$r = (abs($tz) % 60 )== 0 ? "00" : "30";
	
	$sign  = "+";
	if($tz > 0 ){
		$sign = "-";
	}
	$ret_tz = "$sign$q$r";
	

	$user_id = $keys[0];
	$pwd 	 = $keys[1];

	if($user_id === null  || $pwd  === null || $user_id === ''  || $pwd === '' ){

		$exit_cd = $_ERROR_AUTH;
	}

	$conn = connect ($config);
	$is_authorized =is_operation_authorised($conn ,$user_id, $pwd);

	$event_data_list = array();

	if( $is_authorized ){
		
		error_log(" start_t  : $start_t ");
		$checkin_eventid_list = fetch_checkin_event($conn ,$user_id , $start_t);
		
		foreach( $checkin_eventid_list as $checkin_eventid){
			error_log("event " + $checkin_eventid);
			$event_data = get_event_by_id($checkin_eventid , $conn , $tz , $start_t);

			$event_data_list[] = $event_data[0];
			
		}

	}else{
		$exit_cd = $_ERROR_AUTH;
	} 
	//var_dump($event_data_list);
	include ('json/json.checkinevent.layout.php');

?>