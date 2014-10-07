<?php
session_start();

require 'functions/rsvp_functions.php';
require 'functions/events_functions.php';
require 'functions/db_functions.php';
require 'functions/sessions_function.php';
require 'functions/PushBots.class.php';
require 'pdo/user_event_class.php';
require 'functions/push_notifications.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';


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

   	        $event_alert      = 'Popped :'.$event_title .',' .$event_location .'@' .$start_dt ;
            push_notification($deviceToken, $event_alert);
        }
    }	
}
require 'json/json.service.layout.php';