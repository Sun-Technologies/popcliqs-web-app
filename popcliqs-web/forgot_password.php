<?php
session_start();
require 'functions/user_functions.php';
require 'functions/db_functions.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';

$status_obj = $_SUCCESS;
if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
  
    $conn = connect ($config);

	$user_email = isset($_POST['user_email']) ? trim($_POST['user_email']): null;
	
	if( empty($user_email) ){
	
		$email_status = "please enter the  email id";
		$error_id  = "#user_email";

	  }
	else {
		
		if (does_user_email_exist($conn,$user_email)) {
        	
        	send_password_mail($conn ,$user_email);
           error_log("forgot password email sent");
         }else {
        	$status_obj = $_ERROR_INVALID_USER_EMAIL ;
        	error_log("Email Address does not exists");
          }
	}
 } 
include ('json/json.service.layout.php');