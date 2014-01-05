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
  
    $conn = connect ($config);
	$zip  =  isset($_POST['zip']) ? trim($_POST['zip']):null;	
}

$user_id = $_SESSION['user_id'];
update_acc_setting($conn,$user_id,$zip);
$_SESSION['zip'] = $zip;

include ('json/json.service.layout.php');