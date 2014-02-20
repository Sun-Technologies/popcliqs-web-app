<?php
session_start();
require 'functions/user_functions.php';
require 'functions/db_functions.php';
require 'functions/pref_functions.php';
require 'pdo/user_class.php';
require 'pdo/user_preferences_class.php';

if(isset($_SESSION['user_id'])){
	header('Location:home.php');
	die();
}

$error_map = array();

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
  
    $conn = connect ($config);

	$email    	=  isset($_POST['semail'])    ? trim($_POST['semail']): null;
	$reemail  	=  isset($_POST['sreemail'])  ? trim($_POST['sreemail']):null;
	$password 	=  isset($_POST['spassword']) ? trim($_POST['spassword']):null;
	$zip      	=  isset($_POST['zip'])       ? trim($_POST['zip']):null;
	$month      =  isset($_POST['month'])     ? trim($_POST['month']):null;
	$day        =  isset($_POST['day'])       ? trim($_POST['day']):null;
	$year       =  isset($_POST['year'])      ? trim($_POST['year']):null;
	$sex 		=  isset($_POST['sex'])       ? $_POST['sex']:null;
	$created_ts	=  time(); 
	$status 	=  1;
	$type 		=  1;
	

	if( empty($email) || !valid_email($email)){
	
		$status = "Please enter a valid email address.";
		$error_id  = "#semail";
		$error_map[$error_id] = $status;
	
   	} 

   	if( empty($reemail)){ 

   		$status = "Please enter a valid email address.";
    	$error_id  = "#sreemail";
    	$error_map[$error_id] = $status ;

   	} else if ( $email != $reemail ){

   		$status 	= "Email address does not match.";
    	$error_id  	= "#sreemail";
    	$error_map[$error_id] = $status ;
	}

	if(empty($password) || strlen($password) < 6){

		$status = "Please enter a valid password greater than 6 chars.";
        $error_id ="#spassword";
        $error_map[$error_id] = $status ;
	}
	 
	if (empty($sex)) {

		$status = "Please select the gender."; 
		$error_id ="#sex";
		$error_map[$error_id] = $status ;

	} 

	if (empty($month) || empty($day) || empty($year) ) {

		$status = "Please enter a valid date of birth.";
        $error_id ="#dob";
        $error_map[$error_id] = $status ;

	}
	
	if (empty($zip) || !is_numeric($zip) || strlen($zip)!= 5 ) {

		$status = "Please enter a valid zip.";
		$error_id = "#zip";
		$error_map[$error_id] = $status ;

	}


	if(is_user_exist( $conn, $email )){

		$status  = "Email already exists, try another email id.";
		$error_id = "#semail";
		$error_map[$error_id] = $status ;
	}
	

	if( sizeof($error_map) == 0 ){ 
     	$dob = $month.'/'.$day.'/'.$year;

        $user = new User;
        $user->email = $email;
        $user->password = $password;
        $user->zip = $zip;
        $user->status = $status;
        $user->type = $type;
        $user->sex = $sex;
        $user->dob = $dob;
		
		$user_id = add_registered_user($conn  ,$user);
		send_welcome_mail($email);
		$_SESSION['email'] = $email;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['zip'] = $zip;
		setcookie('user_id', $user_id , time()+60*60);

		insert_default_pref( $conn  , $user_id);
		header('Location:home.php');
	}
}
require 'web/index.tmpl.php';