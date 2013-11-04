<?php
session_start();
require 'functions/user_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_class.php';

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

    $conn = connect ($config);

	$email    	=  isset($_POST['email'])    ? trim($_POST['email']): null;
	$reemail  	=  isset($_POST['reemail'])  ? trim($_POST['reemail']):null;
	$password 	=  isset($_POST['password']) ? trim($_POST['password']):null;
	$zip      	=  isset($_POST['zip'])      ? trim($_POST['zip']):null;
	$month      =  isset($_POST['month'])    ? trim($_POST['month']):null;
	$day        =  isset($_POST['day'])      ? trim($_POST['day']):null;
	$year       =  isset($_POST['year'])     ? trim($_POST['year']):null;
	$created_ts	=  time(); 
	$status 	=  1;
	$type 		=  1;
	$sex 		=  isset($_POST['sex'])     ? $_POST['sex']:null;


	if( empty($email) || empty($reemail) || !valid_email($reemail) ){

		$status = "please enter the valid email id";
		
    }else if($email !=$reemail){

		$status = "email match not found";
	
	}else if(empty($password)){
		$status = "enter password";
	}
	else if (empty($sex)) {

		$status = "select the gender"; 
		# code...
	} else if (empty($month)) {

	$status = "enter a valid date of birth mm";
	# code...
	}else if (empty($day)) {

	$status = "enter a valid date of birth /dd/";
	# code...
	}else if (empty($year)) {

	$status = "enter a valid date of birth yyyy";
	# code...
	}else if (empty($zip) || !is_numeric($zip) || strlen($zip)!= 5 ) {

		$status = "enter valid zip";

		# code...
	}else if (is_user_exist( $conn, $email )){

		$status  = "email already exists,,,try another email id";
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
		$_SESSION['email'] = $email;
		$_SESSION['user_id'] = $user_id;
		header('Location:home.php');

	}
	
	
	}
		require 'web/index.tmpl.php';
	

	//require 'index.tmpl.php';