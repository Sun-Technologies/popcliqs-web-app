<?php
session_start();

require 'functions/db_functions.php';
require 'functions/user_functions.php';
require 'pdo/user_class.php';
require 'functions/pref_functions.php';
require 'functions/events_functions.php';
require 'pdo/user_event_class.php';
require 'functions/geo_functions.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}
date_default_timezone_set("UTC");  

$status_obj     = $_SUCCESS;
$user_id		= $_SESSION['user_id']; 	
$time_interval 	= $_POST["time_interval"];
$tz 			= isset($_POST["tz"]) ? $_POST["tz"] : 0;
$search_term    = isset($_POST["s"]) ? $_POST["s"] : false;

$start_t  = time();
// $start_t  = $start_t - (60 *  $tz);
$end_t 	  = $start_t + (60 * 60 * $time_interval );

$miles = 25;
$conn = connect ($config);
$user = get_user($conn , $user_id);

if($user != null){

	$age = get_user_age($user->dob);

	$user_cat_pref  = get_user_cat_pref($conn , $user_id);
	// var_dump($user_cat_pref);

	$user_lat_log 	= get_lat_lon_zip( $user->zip ,  $conn);
	// var_dump($user_lat_log);

	$results = getSplashEvent($conn , $start_t  , $end_t , $user_lat_log , $search_term , $age );

	$user_events	= getUserEvent($results, $tz );

	$ranked_events  = assign_rank_to_events($user_events , 
						$user_cat_pref , $user_lat_log, $start_t, $end_t, $miles);

	// getNoOfMaybeAttendeeInfo($user_events , $conn);

	// Dump x
	// ob_start();
	// var_dump($ranked_events);
	// $contents = ob_get_contents();
	// ob_end_clean();
	// error_log($contents);
	include ('json/json.fetchevent.layout.php');
}



