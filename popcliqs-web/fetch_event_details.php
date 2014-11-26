<?php
session_start();

// $time = microtime(true);

require_once 'functions/db_functions.php';
require_once 'functions/user_functions.php';
require_once 'pdo/user_class.php';
require_once 'functions/pref_functions.php';
require_once 'functions/events_functions.php';
require_once 'pdo/user_event_class.php';
require_once 'functions/geo_functions.php';
require_once 'pdo/exit_code_class.php';
require_once 'pdo/exitcode_constants.php';
require_once 'functions/rsvp_functions.php';
require_once 'json/cat.list.php';

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}
date_default_timezone_set("UTC");  

$status_obj = $_SUCCESS;
$user_id 	= $_SESSION['user_id'];


if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

	$event_id = isset($_POST['event_id']) ? trim($_POST['event_id']): null;
	$tz 	  = isset($_POST["tz"]) ? $_POST["tz"] : 0;

	// echo  " 1. " . (round ( (microtime(true)) - $time , 4 ) ) . ' elapsed';
	$conn 		= connect ($config);
	
	$event_info = fetch_event($conn,$event_id , $tz);
	
	$user_zip 	= get_user_zip($conn , $user_id);
	
	//get user lat lon 
	$userlatlong = get_lat_lon_zip( $user_zip  ,  $conn );
	
	// get event lat lon
	$eventlatlong = array('lat' => $event_info->lat ,'lon' => $event_info->lon);

	// distance between lat lon 

	// error_log("Distance : " . $userlatlong['lat'] ." ," . $userlatlong['lon'] .":::" .  $eventlatlong['lat'] ." ," . $eventlatlong['lon'] );
	$distanceToEvent = round (degrees_difference($userlatlong['lat'] , $userlatlong['lon'] , 
        $eventlatlong['lat'] , $eventlatlong['lon'] ) , 2 , PHP_ROUND_HALF_UP);

	// $distanceToEvent = round( get_distance_between_zips($conn, $event_info->postal_code, $user_zip), 0, PHP_ROUND_HALF_UP); ;
	$rsvp_id = user_event_rsvp_cd($event_id , $user_id , $conn );
	
	// Dump x
	// ob_start();
	// var_dump($event_info);
	// $contents = ob_get_contents();
	// ob_end_clean();
	// error_log($contents);

	$conn = null;

}
require_once 'json/json.event.layout.php';