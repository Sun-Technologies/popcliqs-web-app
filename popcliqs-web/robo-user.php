<?php 
	
	require('functions/db_functions.php');
	require('pdo/user_event_class.php');
	require('functions/mobile.functions.php');
	require('functions/geo_functions.php');

	date_default_timezone_set("UTC"); 

	
	$zip_array  = array('30067' , '30069', '30339' , '30327' , '30060', '30008',
						'30082' , '30126', '30106', '30126' , '30168' ,
						'30336', '30080' ,'30066', '30144' , '30152', '30101',
						'30127', '30141' , '30106', '30134', '30122',
						'30064' , '95014' , '342005' , '342011');

	$user_id = 0;
	$st_hr = rand(0,30);
	$cat_cd  = rand(0,8); 
	$zip =  $zip_array[rand(0, (sizeof($zip_array) - 1))];
	$conn = connect ($config);

	$start_t  = time() - (time() % 3600);
	$st_time  =  $start_t + ($st_hr  * 60 * 60 );
	$end_time  = $st_time + ( 60 * 60 );


	error_log(" user : $user_id ,  zip : $zip  , cat : $cat_cd  , start hr : $st_hr ");
	$event_lat_log 	= get_lat_lon_zip( $zip ,  $conn);
	add_new_event($conn , $user_id ,  $zip , $cat_cd , $st_time , $end_time  , $event_lat_log);