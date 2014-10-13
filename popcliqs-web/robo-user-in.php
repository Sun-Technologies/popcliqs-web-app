<?php 
	
	require('functions/db_functions.php');
	require('pdo/user_event_class.php');
	require('functions/mobile.functions.php');
	require('functions/geo_functions.php');

	date_default_timezone_set("UTC"); 


	$zip = isset($_GET["zip"]) 	? $_GET["zip"] : null ;
	if( !$zip) {
		$zip_array  = array('560027', '560016','562125','560105','562107','562106',
			'560051','560097','560065','560003','560063','562149','560046','560014',
			'560013','560043','560073','560010','562157','560057','560025','560024',
			'560086','560022','560021','560009','560005','560043','560010','562157',
			'560024','560015','560014','560045','560040','560104','560009','560006',
			'560002','560097','560064','560096','560094','560093','560092','560084',
			'560051','560013','562157','560065','560064','560092','562149','560086',
			'560025','560024','560045','560066','560004','560034','560002','560095',
			'560061','560004','560019','560018','560049','560017','560048','560047',
			'560078','560076','560075','560074','560011','560041','560070','560029',
			'560059','560027','560056','560087','560050','560039','562130','560037',
			'560068','560099','560098','560036','560067','560002','560026','560070' );
		
		$zip =  $zip_array[rand(0, (sizeof($zip_array) - 1))];
	}

	$user_id = 0;
	$st_hr = rand(0,72);
	$cat_cd  = rand(0,8); 
	
	$conn = connect ($config);

	$start_t  = time() - (time() % 3600);
	$st_time  =  $start_t + ($st_hr  * 60 * 60 );
	$end_time  = $st_time + ( 60 * 60 );


	error_log(" user : $user_id ,  zip : $zip  , cat : $cat_cd  , start hr : $st_hr ");
	$event_lat_log 	= get_lat_lon_zip( $zip ,  $conn);
	add_new_event($conn , $user_id ,  $zip , $cat_cd , $st_time , $end_time  , $event_lat_log);