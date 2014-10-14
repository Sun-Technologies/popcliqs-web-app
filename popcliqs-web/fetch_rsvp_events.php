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
$tz         = isset($_POST["tz"]) ? $_POST["tz"] : 0;
$action     = isset($_POST["action"]) ? $_POST["action"] : 0;

error_log(" action $action");
if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

  $conn = connect ($config);
  
  date_default_timezone_set("UTC");  

  $now_ts  = time();
  $now_utc = date( "Y-m-d H:i:s", $now_ts) ;

  $rows = fetch_rsvp_events( $conn , $user_id  , $action  , $now_utc );

  // Dump x
  // ob_start();
  // var_dump($rows);
  // $contents = ob_get_contents();
  // ob_end_clean();
  // error_log($contents);
}
require 'json/json.interested.layout.php';