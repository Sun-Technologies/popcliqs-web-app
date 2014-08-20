<?php
session_start();

require 'functions/db_functions.php';
require 'functions/user_functions.php';

$_SUCCESS    = 0;
$exit_cd 	= $_SUCCESS;

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}

$conn = connect ($config);
$user_id =$_SESSION['user_id'];
$acc_setting_array = fetch_acc_setting($conn,$user_id);

// Dump x
ob_start();
var_dump($acc_setting_array);
$contents = ob_get_contents();
ob_end_clean();
error_log($contents);


//extract($acc_setting_array);
$zip = $acc_setting_array[0][0];

error_log(" Zip code ::: " . $zip);

include ('json/json.fetch_acc_setting_layout.php');





