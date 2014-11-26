<?php 
	
	require_once('functions/db_functions.php');
	require_once('pdo/user_event_class.php');
	require_once('functions/mobile.functions.php');
	require_once('functions/geo_functions.php');
	
	$_SUCCESS    				=  0;
	$_ERROR_ALL	 				= -1000;
	$_ERROR_AUTH 				= -1001;
	$_ERROR_INVALID_EVENT_ID 	= -1002;
	$_ERROR_INVALID_RSP_CD 		= -1003;
	$_ERROR_INVALID_CAT         = -1004;
	$_ERROR_INVALID_ZIP			= -1005;

	date_default_timezone_set("UTC");  

	$exit_cd 	= $_SUCCESS;
	$key  		= isset($_GET["key"]) 	? $_GET["key"] : null ;
	$tz   		= isset($_GET["tz"])  	? $_GET["tz"] : 0 ;
	$cat_cd   	= isset($_GET["cat_cd"])? $_GET["cat_cd"] : 0 ;
	$zip   		= isset($_GET["zip"])   ? $_GET["zip"] : 0 ;
	$st_hr   	= isset($_GET["st_hr"]) ? $_GET["st_hr"] : 0 ;

	$start_t  = time() - (time() % 3600);
	// $start_t  = $start_t - (60 *  $tz);

	$st_time  = $start_t + ($st_hr  * 60 * 60 );
	$end_time  = $st_time + ( 60 * 60 );

	if($key === null  || $key === '' ){
		$exit_cd = $_ERROR_AUTH;
	}

	$keys = explode("$",$key);
	
	if(sizeof($keys)  < 2  ){
		$exit_cd = $_ERROR_AUTH;
	}

	$user_id = $keys[0];
	$pwd 	 = $keys[1];

	if($user_id === null  || $pwd  === null || $user_id === ''  || $pwd === '' ){
		$exit_cd = $_ERROR_AUTH;
	}

	//Category code validation
	if($cat_cd == null || $cat_cd == '' || $cat_cd < 1 || $cat_cd > 8 ){
		$exit_cd = $_ERROR_INVALID_CAT;
	} 

	//Zip code validation
	if($zip == null ||  $zip == ''  ){
		$exit_cd = $_ERROR_INVALID_ZIP;
	}

	$conn = connect ($config);
	$is_authorized = is_operation_authorised($conn ,$user_id, $pwd );

	if( $is_authorized && $exit_cd == $_SUCCESS ){ 
			
		$event_lat_log 	= get_lat_lon_zip( $zip ,  $conn);
		add_new_event($conn , $user_id ,  $zip , $cat_cd , $st_time , $end_time  , $event_lat_log);
	}
	$conn = null;

	include ('json/json.login.layout.php');
