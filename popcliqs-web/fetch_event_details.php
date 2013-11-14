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
require 'functions/rsvp_functions.php';

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

	$conn 		= connect ($config);
	$event_info = fetch_event($conn,$event_id , $tz);

	
	$user_zip 		 = get_user_zip($conn , $user_id);
	$distanceToEvent = get_distance_between_zips($conn, $event_info->postal_code, $user_zip);
	$rsvp_id 		 = user_event_rsvp_cd($event_id , $user_id , $conn );
	
	error_log("Distance : $distanceToEvent  RSVP : $rsvp_id ");
	
	// Dump x
	// ob_start();
	// var_dump($event_info);
	// $contents = ob_get_contents();
	// ob_end_clean();
	// error_log($contents);

}
require 'json/json.event.layout.php';