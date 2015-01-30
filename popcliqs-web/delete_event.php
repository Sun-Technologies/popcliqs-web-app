<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header('Location:index.php');
  die();
}
require_once 'functions/events_functions.php';
require_once 'functions/db_functions.php';
require_once 'pdo/exit_code_class.php';
require_once 'functions/rsvp_functions.php';
require_once 'functions/sessions_function.php';
require_once 'functions/PushBots.class.php';
require_once 'pdo/user_event_class.php';
require_once 'functions/push_notifications.php';
require_once 'pdo/exitcode_constants.php';

$status_obj = $_SUCCESS;
$user_id    = $_SESSION['user_id'];


if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

	$event_id 	 = isset($_POST['event_id']) ? trim($_POST['event_id']): null;
	$tz          = isset($_POST["tz"]) ? $_POST["tz"] : 0;
  $conn   		 = connect ($config);
 
	delete_event( $conn , $user_id , $event_id);

  $event  = fetch_event($conn,$event_id,$tz);
   
    if($event){ 

        $users          = users_rsvp_event($event_id , $conn );
        $event_title    = $event->title;
        $event_location = $event->location;
        $start_dt       = $event->start_dt ;

        $event_alert    = 'Event :'.$event_title .' has been deleted,' .$event_location .'@' .$start_dt ."(GMT)";

        foreach ($users as $user_id ) {

          $deviceToken    = fetch_device($conn,$user_id);
          error_log("device token for each user $deviceToken");

          push_notification( $deviceToken, $event_alert);
        }
    }
    $conn = null;     
}
require 'json/json.service.layout.php';
