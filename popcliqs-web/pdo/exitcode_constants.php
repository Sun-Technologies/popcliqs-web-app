<?php 

$_SUCCESS 			=  new Exit_Code_Class;
$_SUCCESS->exit_cd  = "0";
$_SUCCESS->exit_msg	= "Success";

$_ERROR_AUTH 			=  new Exit_Code_Class;
$_ERROR_AUTH->exit_cd  	= "-1000";
$_ERROR_AUTH->exit_msg	= "Error in operation";

$_ERROR_INVALID_EVENT_ID 			=  new Exit_Code_Class;
$_ERROR_INVALID_EVENT_ID->exit_cd  	= "-1001";
$_ERROR_INVALID_EVENT_ID->exit_msg	= "Error in Authentication";

$_ERROR_INVALID_EVENT_ID 			=  new Exit_Code_Class;
$_ERROR_INVALID_EVENT_ID->exit_cd 	= "-1002";
$_ERROR_INVALID_EVENT_ID->exit_msg	= "Invalid Event ID";

$_ERROR_INVALID_RSP_CD 				=  new Exit_Code_Class;
$_ERROR_INVALID_RSP_CD->exit_cd  	= "-1003";
$_ERROR_INVALID_RSP_CD->exit_msg	= "Invalid Response code";

$_ERROR_INVALID_CAT 			=  new Exit_Code_Class;
$_ERROR_INVALID_CAT->exit_cd  	= "-1004";
$_ERROR_INVALID_CAT->exit_msg	= "Please select Category code";

$_ERROR_INVALID_ZIP 			=  new Exit_Code_Class;
$_ERROR_INVALID_ZIP->exit_cd  	= "-1005";
$_ERROR_INVALID_ZIP->exit_msg	= "Invalid Zip code";

$_ERROR_INVALID_EVENT_NAME 				=  new Exit_Code_Class;
$_ERROR_INVALID_EVENT_NAME->exit_cd 	= "-1006";
$_ERROR_INVALID_EVENT_NAME->exit_msg	= "Please enter the event name.";

$_ERROR_INVALID_EVENT_DESC 				=  new Exit_Code_Class;
$_ERROR_INVALID_EVENT_DESC->exit_cd  	= "-1006";
$_ERROR_INVALID_EVENT_DESC->exit_msg 	= "Please enter the event description.";

$_ERROR_INVALID_EVENT_START_TIME 			=  new Exit_Code_Class;
$_ERROR_INVALID_EVENT_START_TIME->exit_cd   = "-1007";
$_ERROR_INVALID_EVENT_START_TIME->exit_msg	= "Invalid start time.";

$_ERROR_INVALID_EVENT_END_TIME 				=  new Exit_Code_Class;
$_ERROR_INVALID_EVENT_END_TIME->exit_cd   	= "-1008";
$_ERROR_INVALID_EVENT_END_TIME->exit_msg	= "Invalid end time.";

$_ERROR_INVALID_EVENT_TIME 				=  new Exit_Code_Class;
$_ERROR_INVALID_EVENT_TIME->exit_cd   	= "-1009";
$_ERROR_INVALID_EVENT_TIME->exit_msg	= "Start time cannot be greater than end time.";


$_ERROR_INVALID_USER_EMAIL 				=  new Exit_Code_Class;
$_ERROR_INVALID_USER_EMAIL->exit_cd   	= "-1010";
$_ERROR_INVALID_USER_EMAIL->exit_msg	= "There is no account with this email address.";

