<?php
session_start();

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

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}
date_default_timezone_set("UTC");  


$status_obj     = $_SUCCESS;
$user_id		= $_SESSION['user_id']; 
$time_interval 	= $_POST["time_interval"];

$tz 			= isset($_POST["tz"]) ? $_POST["tz"] : 0;
$search_term    = isset($_POST["s"]) ?  urldecode ($_POST["s"]) : false;
$cat_id         = isset($_POST["cat_type"]) ? $_POST["cat_type"] : 0;

// echo " $user_id : $time_interval :  $tz : $search_term  : $cat_id ";

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

	$results 	 = getSplashEvent($conn , $start_t  , $end_t , $user_lat_log , $search_term , $age , $cat_id );
	$user_events = getUserEvent($results, $tz );

	$ranked_events  = assign_rank_to_events($user_events , 
						$user_cat_pref , $user_lat_log, $start_t, $end_t, $miles);

	foreach ($ranked_events as $event) {
		
		// to get total user attending particular event
		$total_no_of_rsvp =  user_event_rsvp_count( $event->event_id , $conn );

		// to get to no male attend 
		$total_no_of_male_rsvp = rsvp_event_male_count($event->event_id , $conn);
		
		// to get ratio of male users a,omg total users
		$event->mratio = $total_no_of_male_rsvp/$total_no_of_rsvp*2;

		// to get count of checked-in users
		$total_no_of_checked_in_users = rsvp_checked_in_users_count($event->event_id , $conn );

		//to get percentage of checked-in users
		$event->fillPCent = $total_no_of_checked_in_users/$total_no_of_rsvp*100;
	}

	// getNoOfMaybeAttendeeInfo($user_events , $conn);

	// Dump x
	// ob_start();
	// var_dump($ranked_events);
	// $contents = ob_get_contents();
	// ob_end_clean();
	// error_log($contents);
	include_once ('json/json.fetchevent.layout.php');
}

$conn = null;


