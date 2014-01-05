<?php
session_start();

require 'functions/rsvp_functions.php';
require 'functions/db_functions.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';

$status_obj = $_SUCCESS;

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}

$user_id =$_SESSION['user_id'];


if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

    $conn = connect ($config);
    $event_id = isset($_POST['event_id']) ? trim($_POST['event_id']): null;
    insert_rsvp_status( $conn , $event_id , $user_id  , 1 );
}	
require 'json/json.service.layout.php';