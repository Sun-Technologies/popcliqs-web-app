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

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
  
    $conn = connect ($config);

	$email    	=  isset($_POST['semail'])    ? trim($_POST['semail']): null;
	$reemail  	=  isset($_POST['sreemail'])  ? trim($_POST['sreemail']):null;
	$password 	=  isset($_POST['spassword']) ? trim($_POST['spassword']):null;
	$zip      	=  isset($_POST['zip'])      ? trim($_POST['zip']):null;
	$month      =  isset($_POST['month'])    ? trim($_POST['month']):null;
	$day        =  isset($_POST['day'])      ? trim($_POST['day']):null;
	$year       =  isset($_POST['year'])     ? trim($_POST['year']):null;
	$sex 		=  isset($_POST['sex'])      ? $_POST['sex']:null;
	$created_ts	=  time(); 
	$status 	=  1;
	$type 		=  1;
	

	if( empty($email) ){
	
		$email_status = "please enter the  email id";
		$error_id  = "#semail";

	}
	elseif (!valid_email($email)) {
		$email_status="please enter the valid email id";
         $error_id ="#semail";

	}elseif (!valid_email($reemail)) {
		$status="please enter the correct email id";
         $error_id ="#sreemail";

	}elseif (empty($reemail)) {
		$status = "please re enter the email";
		$error_id = "#sreemail";

   }else if($email !=$reemail){

	$status = "email match not found";
    $error_id  = "#sreemail";
	
	}else if(empty($password) || strlen($password) < 6){

		$status = "enter password";
        $error_id ="#spassword";
	}
	else if (empty($sex)) {

		$status = "select the gender"; 
		$error_id ="#sex";

	} else if (empty($month)) {

		$status = "enter a valid date of birth mm";
        $error_id ="#month";

	}else if (empty($day)) {

		$status = "enter a valid date of birth /dd/";
		$error_id = "#day";
	
	}else if (empty($year)) {

		$status = "enter a valid date of birth yyyy";
		$error_id ="#year";
	
	}else if (empty($zip) || !is_numeric($zip) || strlen($zip)!= 5 ) {

		$status = "enter valid zip";
		$error_id = "#zip";

	}else if (is_user_exist( $conn, $email )){

		$email_status  = "email already exists, try another email id.";
		$error_id = "#email";
	}
	else{

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