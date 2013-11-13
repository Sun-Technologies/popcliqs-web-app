<?php
session_start();

require 'functions/pref_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_preferences_class.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';

$status_obj     = $_SUCCESS;

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}

$conn = connect ($config);
$user_id =$_SESSION['user_id'];
$pref_array = fetch_pref($conn,$user_id);

// Dump x
// ob_start();
// var_dump($pref_array);
// $contents = ob_get_contents();
// ob_end_clean();
// error_log($contents);



include ('json/json.fetchpref.layout.php');





