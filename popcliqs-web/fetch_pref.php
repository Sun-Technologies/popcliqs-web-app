<?php
session_start();

require 'functions/pref_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_preferences.php';



if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}
$conn = connect ($config);
$user_id =$_SESSION['user_id'];
$pref_array = fetch_pref($conn,$user_id);

var_dump($pref_array);

