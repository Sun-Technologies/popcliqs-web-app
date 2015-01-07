<?php
session_start();

require_once 'functions/rsvp_functions.php';
require_once 'functions/events_functions.php';
require_once 'functions/db_functions.php';
require_once 'functions/sessions_function.php';
require_once 'functions/PushBots.class.php';
require_once 'pdo/user_event_class.php';
require_once 'functions/push_notifications.php';
require_once 'pdo/exit_code_class.php';
require_once 'pdo/exitcode_constants.php';


$status_obj = $_SUCCESS;

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}

$user_id = $_SESSION['user_id'];


if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
    
    $conn        = connect ($config);
    $event_id    = isset($_POST['event_id']) ? trim($_POST['event_id']): null;
    $tz          = isset($_POST["tz"]) ? $_POST["tz"] : 0;

    insert_rsvp_status( $conn , $event_id , $user_id  , 1 );
        
    $deviceToken = fetch_device($conn,$user_id);
    error_log(" Device token $deviceToken");

    if($deviceToken){

	   $event    = fetch_event($conn,$event_id,$tz);
   
       if($event){ 

            $event_title      = $event->title;
            $event_location   = $event->location;
            $start_dt         = $event->start_dt ;

   	        $event_alert      = 'You have popped the following Cliq; Cliq Name:'.$event_title .';Location:' .$event_location .';Starts @' .$start_dt ;

            push_notification($deviceToken, $event_alert);
        }
    }
    $conn = null;	
}
require_once 'json/json.service.layout.php';