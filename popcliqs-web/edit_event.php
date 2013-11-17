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

  $conn = connect ($config);


  // Dump x
  //ob_start();
  //var_dump($rows);
  //$contents = ob_get_contents();
  //ob_end_clean();
  //error_log($contents);

  $event_info = fetch_event($conn,$event_id , $tz);
}
require 'json/json.service.layout.php';
