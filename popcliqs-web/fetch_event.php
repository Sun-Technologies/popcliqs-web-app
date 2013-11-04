<?php
session_start();

require 'functions/event_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_event_class.php';



if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}
$conn = connect ($config);
$user_id =$_SESSION['event_id'];
$pref_array = fetch_pref($conn,$event_id);

var_dump($pref_array);
