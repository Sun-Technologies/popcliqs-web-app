<?php
session_start();

if(!isset($_SESSION['user_id'])){
	header('Location:index.php');
	die();
}
require 'functions/pref_functions.php';
require 'functions/db_functions.php';

require 'pdo/user_preferences_class.php';


if( $_SERVER['REQUEST_METHOD'] === 'POST' ){

	$conn = connect ($config);
	$sports_cat_cd        	=  isset($_POST['1'])    ? trim($_POST['1']):0;
	$professional_cat_cd	=  isset($_POST['2'])    ? trim($_POST['2']):0;
	$educational_cat_cd   	=  isset($_POST['3'])    ? trim($_POST['3']): 0;
	$support_cat_cd          =  isset($_POST['4'])    ? trim($_POST['4']): 0;
	$arts_cat_cd             =  isset($_POST['5'])    ? trim($_POST['5']):0;
	$outdoor_cat_cd          =  isset($_POST['6'])    ? trim($_POST['6']): 0;
	$party_cat_cd            =  isset($_POST['7'])    ? trim($_POST['7']): 0;
     $social_cat_cd           =  isset($_POST['8'])    ? trim($_POST['8']): 0;

	if (empty($sports_cat_cd)) {
		$status = "select the sports category";
		# code...
	}
	else{

		$pref_list = array();

		$sports_pref = new user_preferences;
		$sports_pref->category_id  = 1;
		$sports_pref->preference_cd  = $sports_cat_cd ;


		$pref_list[] = $sports_pref;

          $professional_pref = new user_preferences;
          $professional_pref->category_id  = 2;
          $professional_pref->preference_cd  = $professional_cat_cd ;
          
          $pref_list[] = $professional_pref;

          $edu_pref = new user_preferences;
          $edu_pref->category_id = 3;
          $edu_pref->preference_cd = $educational_cat_cd;

          $pref_list[] = $edu_pref;

          $support_pref = new user_preferences;
          $support_pref->category_id = 4;
          $support_pref->preference_cd = $support_cat_cd;

          $pref_list[] = $support_pref;

          $art_pref = new user_preferences;
          $art_pref->category_id = 5;
          $art_pref->preference_cd = $arts_cat_cd;

          $pref_list[] = $art_pref;

          $outdoor_pref = new user_preferences;
          $outdoor_pref->category_id = 6;
          $outdoor_pref->preference_cd = $outdoor_cat_cd;

          $pref_list[] =  $outdoor_pref;

          $party_pref = new user_preferences;
          $party_pref->category_id = 7;
          $party_pref->preference_cd =$party_cat_cd;

          $pref_list[] = $party_pref;


          $social_pref = new user_preferences;
          $social_pref->category_id = 8;
          $social_pref->preference_cd =$social_cat_cd;

          $pref_list[] = $social_pref;
          

          $user_id = $_SESSION['user_id'];
          add_pref($conn,$pref_list,$user_id );
          header('location:home.php');

}

}

require 'web/preferences.tmpl.php';

