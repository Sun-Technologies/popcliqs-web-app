<?php 
require_once 'pdo/user_event_class.php';
require_once 'pdo/user_class.php';
require_once 'functions/mobile.functions.php';
require_once 'functions/rsvp_functions.php';
require_once 'functions/events_functions.php';
require_once 'functions/db_functions.php';
require_once 'functions/sessions_function.php';
require_once 'functions/PushBots.class.php';
require_once 'functions/push_notifications.php';

	$_SUCCESS    				= 0;
	$_ERROR_ALL	 				= -1000;
	$_ERROR_AUTH 				= -1001;
	$_ERROR_INVALID_EVENT_ID 	= -1002;
	$_ERROR_INVALID_RSP_CD 		= -1003;
	$_ERROR_INVALID_CAT         = -1004;
	$_ERROR_INVALID_ZIP			= -1005;

	date_default_timezone_set("UTC");  

	$exit_cd 	= $_SUCCESS;
	$key  		= isset($_GET["key"]) ? $_GET["key"] : null ;
	$tz   		= isset($_GET["tz"]) ? $_GET["tz"] : 0 ;
	$event_id   = isset($_GET["evtid"]) ? $_GET["evtid"] : null ;
	$rsvp_cd    = isset($_GET["rspcd"]) ? $_GET["rspcd"] : null ;

	if($key === null  || $key === '' ){

		$exit_cd = $_ERROR_AUTH;
		include_once ('json/json.login.layout.php');
		return;
	}

	$keys = explode("$",$key);
	
	if(sizeof($keys)  < 2  ){
	
		$exit_cd = $_ERROR_AUTH;
		include_once ('json/json.login.layout.php');
		return;
	}


	if($event_id === null  || $event_id === '' ){

		$exit_cd = $_ERROR_INVALID_EVENT_ID;
		include_once ('json/json.login.layout.php');
		return;
	}


	if($rsvp_cd === null  || ($rsvp_cd  !== '2' &&  $rsvp_cd  !== '-1' ) ){

		$exit_cd = $_ERROR_INVALID_RSP_CD;
		include_once ('json/json.login.layout.php');
		return;
	}

	$user_id = $keys[0];
	$pwd 	 = $keys[1];

	$conn  = connect ($config);

	$is_authorized = is_operation_authorised($conn ,$user_id, $pwd);

	if( $is_authorized ){

		if($rsvp_cd  == '2' ){

			update_rsvp_status($conn, $event_id, $user_id,  $rsvp_cd); 
						
			$deviceToken = fetch_device($conn,$user_id);
			error_log("device token for current user $deviceToken");
			
			if($deviceToken){

				$event=fetch_event($conn, $event_id, $tz);
								
				if($event){

			 		$event_title    = $event->title;
           			$event_location = $event->location;
            		$start_dt       = $event->start_dt;
            		$address		= $event->address;

   	        		$event_alert = 'Event: '.$event_title ."\n" .'Location: '.$event_location."\n".'Address: '.$address."\n".'@ ' .$start_dt ;
            		push_notification($deviceToken, $event_alert);

            		// trigger email with the address 
            		$user_info 	= get_user($conn , $user_id );
            		if($user_info) { 
            			$email 		= $user_info->email;
            			$subject 	= "You have checked-in to a event.";
            			mail($email, $subject,$event_alert);
            		}

       			}
       		}
			
		}else{
			update_event_status($conn ,$user_id , $event_id  , $rsvp_cd); 
		}
	} else {
		$exit_cd = $_ERROR_AUTH;
	}

	$conn = null;
	include_once ('json/json.login.layout.php');
?>