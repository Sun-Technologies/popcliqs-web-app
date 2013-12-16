<?php
session_start();

require 'functions/pref_functions.php';
require 'functions/db_functions.php';
require 'pdo/user_preferences_class.php';
require 'pdo/exit_code_class.php';
require 'pdo/exitcode_constants.php';

$status_obj = $_SUCCESS;

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();

}

$user_id =$_SESSION['user_id'];

// sport_pref_val=2&prof_pref_val=2&arts_pref_val=1&edu_pref_val=2&help_pref_val=0&outdoor_pref_val=2&party_pref_val=2


if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

    $conn = connect ($config);

	$sport_pref_val   =  isset($_POST['sport_pref_val'])   ? trim($_POST['sport_pref_val']): 2;
	$prof_pref_val    =  isset($_POST['prof_pref_val'])    ? trim($_POST['prof_pref_val']): 2;
	$arts_pref_val    =  isset($_POST['arts_pref_val'])    ? trim($_POST['arts_pref_val']): 2;
	$edu_pref_val     =  isset($_POST['edu_pref_val'])     ? trim($_POST['edu_pref_val']): 2;
	$help_pref_val    =  isset($_POST['help_pref_val'])    ? trim($_POST['help_pref_val']): 2;
	$outdoor_pref_val =  isset($_POST['outdoor_pref_val']) ? trim($_POST['outdoor_pref_val']): 2;
	$party_pref_val   =  isset($_POST['party_pref_val'])   ? trim($_POST['party_pref_val']): 2;
	$social_pref_val  =  isset($_POST['social_pref_val'])   ? trim($_POST['social_pref_val']): 2;
	

	$pref_list = array();

	$sports_pref = new user_preferences;
	$sports_pref->category_id  = 1;
	$sports_pref->preference_cd  = $sport_pref_val ;

	$pref_list[] = $sports_pref;

	$professional_pref = new user_preferences;
	$professional_pref->category_id  = 2;
	$professional_pref->preference_cd  = $prof_pref_val ;
	  
	$pref_list[] = $professional_pref;


	$art_pref = new user_preferences;
	$art_pref->category_id = 3;
	$art_pref->preference_cd = $arts_pref_val;

	$pref_list[] = $art_pref;

	$edu_pref = new user_preferences;
	$edu_pref->category_id = 4;
	$edu_pref->preference_cd = $edu_pref_val;

	$pref_list[] = $edu_pref;

	$support_pref = new user_preferences;
	$support_pref->category_id = 5;
	$support_pref->preference_cd = $help_pref_val;

	$pref_list[] = $support_pref;


	$outdoor_pref = new user_preferences;
	$outdoor_pref->category_id = 6;
	$outdoor_pref->preference_cd = $outdoor_pref_val;

	$pref_list[] =  $outdoor_pref;

	$party_pref = new user_preferences;
	$party_pref->category_id = 7;
	$party_pref->preference_cd =$party_pref_val;

	$pref_list[] = $party_pref;

	$social_pref = new user_preferences;
	$social_pref->category_id = 8;
	$social_pref->preference_cd =$social_pref_val;

	error_log("social_pref_val : $social_pref_val ");

	$pref_list[] = $social_pref;

	$user_id = $_SESSION['user_id'];
    update_pref($conn,$pref_list,$user_id );

    require 'json/json.service.layout.php';
}