<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header('Location:index.php');
  die();
}
require_once 'functions/events_functions.php';
require_once 'functions/db_functions.php';
require_once 'pdo/exit_code_class.php';
require_once 'pdo/exitcode_constants.php';

$status_obj = $_SUCCESS;
$user_id    = $_SESSION['user_id'];
$event_id   = isset($_POST["event_id"]) ? $_POST["event_id"] : 0;

error_log(" event_id $event_id");
if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

  $conn = connect ($config);
  update_rsvp_events( $conn , $user_id  , $event_id );

  // Dump x
  // ob_start();
  // var_dump($rows);
  // $contents = ob_get_contents();
  // ob_end_clean();
  // error_log($contents);

  $conn = null;
}
require_once 'json/json.service.layout.php';