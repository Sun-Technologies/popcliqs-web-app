<?php
session_start();


if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();
}
require 'functions/events_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_event_class.php';

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

    $conn = connect ($config);

	$event_title    =  isset($_POST['event_title'])    ? trim($_POST['event_title']): null;
	$category_id    =  isset($_POST['category_id'])    ? trim($_POST['category_id']): null;
	$description    =  isset($_POST['description'])    ? trim($_POST['description']):null;
	$location		=  isset($_POST['location'])       ? trim($_POST['location']):null;
	$address    	=  isset($_POST['address'])        ? trim($_POST['address']):null;
	$city    		=  isset($_POST['city'])           ? trim($_POST['city']):null;
	$state      	=  isset($_POST['state'])          ? trim($_POST['state']):null;
	$zip       		=  isset($_POST['postal_code'])    ? trim($_POST['postal_code']):null;
    $start_date		=  isset($_POST['start_date'])     ? trim($_POST['start_date']):null;
    $end_date		=  isset($_POST['end_date'])     ? trim($_POST['end_date']):null;
	$start_time		=  isset($_POST['start_time'])     ? trim($_POST['start_time']):null;
	$age_limit		=  isset($_POST['age_limit'])      ? trim($_POST['age_limit']):null;
	$capacity		=  isset($_POST['capacity'])       ? trim($_POST['capacity']):null;
	$end_time		=  isset($_POST['end_time'])       ? trim($_POST['end_time']):null;
    $created_ts		=  time(); 
    $type 			=  1;
    $status         =  1;
	
	if( empty($event_title) ){

		$status = "please enter the event name.";
		
    }else if (empty($description)) {
    	$status = "please enter the description.";
    	# code...
    }else if (empty($category_id) ) {
    	# code...
    	$status = "please select the category.";
    }else if (empty($location)) {
    	# code...
    	$status = "please enter the location.";
    }else if (empty($address)) {
        # code...
        $status = "please enter the address.";
    }else if (empty($city)) {
    	# code...
    	$status = "please enter the city.";
    }else if (empty($state)) {
    	# code...
    	$status = "please enter the state.";
    }else if (empty($zip)) {
    	# code...
    	$status = "please enter the postal code.";
    }else if (empty($zip) || !is_numeric($zip) || strlen($zip)!= 5 ) {

		$status = "enter valid postal code.";
    }else if (empty($age_limit)) {
    	# code...
    	$status = "please select the age limit.";
    }
    else if (empty($capacity)) {
    	# code...
    	$status ="please enter the capacity.";
    }else if (empty($start_time) ){
    	# code...
    	$status = "please select the start time.";
    }else if (empty($end_time)) {
    	# code...
    	$status = "please select the end time.";
    }else if (empty($start_date)) {
    	$status = "please enter the start date.";
    	# code...
    }else if (empty($end_date)){
    	$status = "please enter the end date.";
    }


    else{


    $start_timestamp = strtotime( $start_date . " " . $start_time );
    $end_timestamp   = strtotime( $end_date   . " " . $end_time );

    if( $start_timestamp >  $end_timestamp ){

    	$status = "start time cannot be greater than end time.";
    	require 'event.tmpl.php';
    	die();

    }
    $event = new User_Event;
     $event->title          = $event_title;
     $event->category_id    = $category_id;
     $event->description 	= $description;
     $event->location 		= $location;
     $event->address 		= $address;
     $event->city 			= $city;
     $event->state 			= $state;
     $event->postal_code 	= $zip;
     $event->start_time 	= $start_timestamp;
     $event->capacity 		= $capacity;
     $event->end_time 		= $end_timestamp;
     $event->age_limit 		= $age_limit;
     $event->status 		= $status;
     $event->creator        = $_SESSION['user_id'];


 add_event( $conn ,$event);
 header('location:home.php');

     }

}

require 'web/event.tmpl.php';


