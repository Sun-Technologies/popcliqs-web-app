<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header('Location:index.php');
  die();
}
require 'functions/events_functions.php';
require 'functions/db_functions.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';

$status_obj = $_SUCCESS;
$user_id    = $_SESSION['user_id'];


if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

	$event_id = isset($_POST['event_id']) ? trim($_POST['event_id']): null;
  	$conn = connect ($config);
  	error_log( " $event_id ===  $user_id  " );
	delete_event( $conn , $user_id , $event_id  );

}
require 'json/json.service.layout.php';
