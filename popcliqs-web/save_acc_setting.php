<?php
session_start();

require 'functions/db_functions.php';
require 'functions/user_functions.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';

$status_obj     = $_SUCCESS;

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
  
    $conn         = connect ($config);
    $email        = $_SESSION['email'];
    $user_id      = $_SESSION['user_id'];
	$zip          = isset($_POST['zip']) ? trim($_POST['zip']):null;
	$old_password = isset($_POST['old_password']) ? trim($_POST['old_password']):null;
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']):null;
    error_log(' old_password '.$old_password.' new_password '.$new_password);
    if( $old_password != null &&  $new_password != null ) {
    	if(authenticate_user($conn, $email, $old_password)){
    		//update password 
    	  update_user_password($conn, $user_id,$new_password);
    	}
    }

}


update_acc_setting($conn,$user_id,$zip);
$_SESSION['zip'] = $zip;

include ('json/json.service.layout.php');