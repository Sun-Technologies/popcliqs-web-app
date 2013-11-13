<?php
session_start();

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();
}
require 'functions/events_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_event_class.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';
require 'functions/geo_functions.php';

date_default_timezone_set("UTC");

$status_obj    = $_SUCCESS;

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

    $conn = connect ($config);

	$event_title    =  isset($_POST['event_title'])    ? trim($_POST['event_title']): null;
	$category_id    =  isset($_POST['category_id'])    ? trim($_POST['category_id']): null;
	$description    =  isset($_POST['description'])    ? trim($_POST['description']):null;
	$location		=  isset($_POST['location'])       ? trim($_POST['location']):null;
	$address    	=  isset($_POST['address'])        ? trim($_POST['address']):null;
	// $city    	=  isset($_POST['city'])           ? trim($_POST['city']):null;
	// $state      	=  isset($_POST['state'])          ? trim($_POST['state']):null;
	$zip       		=  isset($_POST['postal_code'])    ? trim($_POST['postal_code']):null;
    $start_date		=  isset($_POST['start_date'])     ? trim($_POST['start_date']):null;
    $end_date		=  isset($_POST['end_date'])       ? trim($_POST['end_date']):null;
	$start_time		=  isset($_POST['start_time'])     ? trim($_POST['start_time']):null;
	$age_limit		=  isset($_POST['age_limit'])      ? trim($_POST['age_limit']):null;
	$capacity		=  isset($_POST['capacity'])       ? trim($_POST['capacity']):null;
	$end_time		=  isset($_POST['end_time'])       ? trim($_POST['end_time']):null;
    $created_ts		=  time(); 
    $type 			=  1;
    $status         =  1;
    $tz             = isset($_POST["tz"]) ? $_POST["tz"] : 0;

    if( empty($event_title) ){

		$status = $_ERROR_INVALID_EVENT_NAME;
    }else if (empty($description)) {
    	
        $status = $_ERROR_INVALID_EVENT_DESC;
    }else if (empty($category_id) ) {
    	
    	$status = $_ERROR_INVALID_CAT;
    }else if (empty($zip) || !is_numeric($zip) || strlen($zip)!= 5 ) {

		$status = $_ERROR_INVALID_ZIP ; 
    }else if (empty($start_time) ){
   
    	$status = $_ERROR_INVALID_EVENT_START_TIME;
    }else if (empty($end_time)) {
   
    	$status = $_ERROR_INVALID_EVENT_END_TIME;
    }else if (empty($start_date)) {
   
    	$status = $_ERROR_INVALID_EVENT_START_TIME;
   }else if (empty($end_date)){
    	
        $status = $_ERROR_INVALID_EVENT_END_TIME;
    } else{
       
        $start_timestamp = strtotime( $start_date . " " . $start_time );
        $end_timestamp   = strtotime( $end_date   . " " . $end_time );

        $start_timestamp = ($tz * 60 ) + $start_timestamp;
        $end_timestamp   = ($tz * 60 ) + $end_timestamp;

        // error_log(" $start_timestamp $end_timestamp ", 0);
        if( $start_timestamp >  $end_timestamp ){

        	$status_obj = $_ERROR_INVALID_EVENT_TIME;
            
        }else{

            $event_lat_log = get_lat_lon_zip( $zip ,  $conn);
            
            $event                  = new User_Event;
            $event->title           = $event_title;
            $event->category_id     = $category_id;
            $event->description 	= $description;
            $event->location 		= $location;
            $event->address 		= $address;
            $event->city 			= $city;
            $event->state 			= $state;
            $event->postal_code 	= $zip;
            $event->start_time 	    = $start_timestamp;
            $event->capacity 		= $capacity;
            $event->end_time 		= $end_timestamp;
            $event->age_limit 		= $age_limit;
            $event->status 		    = $status;
            $event->creator         = $_SESSION['user_id'];
            $event->lat             = $event_lat_log['lat'];
            $event->lon             = $event_lat_log['lon'];

            add_event( $conn ,$event);
        }
    }
    require 'json/json.service.layout.php';
}