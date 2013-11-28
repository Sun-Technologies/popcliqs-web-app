<?php 
		

function is_operation_authorised( $conn  , $user_id, $pwd){

	$query = "select * from popcliqs_users  where user_id = :uid 
				and password =  :pwd
			";
	$binding = array( 
		'uid' => $user_id ,
		'pwd' => $pwd
	);

	$results = query( $query, $conn , $binding );
	
	if($results){
		return true;
	}else{
		return false;
	}
}

function get_event_by_id($event_id , $conn , $tz, $start_t = null){

	$event_data = array();

	$query = "select * from popcliqs_events where event_id = :event_id";

	$binding = array(
		'event_id' => $event_id 
	);
	$results = query( $query, $conn , $binding );

	if($results){
		foreach( $results as $row){
			//var_dump($results);

			extract($row);

			$timestamp = strtotime($event_start);
			$start_timestamp = $timestamp - ($tz * 60 ) ;
			$st_evt_hr = date('H', $start_timestamp) ;
			$st_evt_mn = date('i', $start_timestamp) ;

			$timestamp = strtotime($event_end);
			$end_timestamp = $timestamp - ($tz * 60 ) ;
			$ed_evt_hr = date('H', $end_timestamp) ;
			$ed_evt_mn = date('i', $end_timestamp) ;

			// $latlong  = get_lat_lon_zip( $postal_code ,  $conn );
			
			error_log($category );

			$user_event = new User_Event();
			$user_event->event_id   	= $event_id;
			$user_event->start_time		= $st_evt_hr . ':'. $st_evt_mn;
			$user_event->end_time		= $ed_evt_hr . ':'. $ed_evt_mn;
			$user_event->title			= $event_title;
			$user_event->location		= $event_location;
			$user_event->address		= $event_address;
			$user_event->postal_code	= $zip;
			$user_event->category_id 	= $category;
			$user_event->description    = $description;
			$user_event->age_limit      = $age_limit;
			$user_event->lat      		= $event_latitude;
			$user_event->lon      		= $event_longitude;
			$user_event->creator        = $user_id;
			
			$user_event->start_dt       =  date('m', $start_timestamp) .'/'. date('d', $start_timestamp) . '/' . date('Y', $start_timestamp);
			$user_event->end_dt         =  date('m', $end_timestamp)   .'/'. date('d', $end_timestamp)   . '/' . date('Y', $end_timestamp);
			
			if($start_t != null){

				$time_diff = $start_timestamp - $start_t ;
				// if time diff is less than 1.5 hours , user can checking 
				if($time_diff > (60 *1.5*60) ){
			    	$user_event->mins_left_for_checkin = round($time_diff/60 - (1.5*60))  ;
				}
			}
			$event_data[] = $user_event;
		}
	}
	return $event_data;
}


function fetch_checkin_event($conn ,$user_id , $start_t){
	
	$checkin_eventid_list = array();

	$st_time = time();
	$query = " 
				select evt.event_id from phpfox_event_rsvp  as invt , popcliqs_events as evt where invt.rsvp_cd = 1 
				and invt.user_id = :uid 
				and invt.event_id = evt.event_id  
				and evt.event_start >:start_t 
				and evt.status = 1
			";

	$binding = array( 
		'uid' 	  => $user_id ,
		'start_t' =>  date( "Y-m-d H:i:s", $start_t)
	);

	$results = query( $query, $conn , $binding );
	
	if($results){
		foreach( $results as $row){
			extract($row);
			$checkin_eventid_list[] = $event_id;
			error_log(" event_id " . $event_id);
			
		}
	}
	return $checkin_eventid_list ;
}

function authenticate_user($conn, $usernm , $pwd) {

	$key = null;

	$query = " 
				select user_id , password   from popcliqs_users where email = :usernm 	
			";

	$binding = array( 
		'usernm' => $usernm 
	);

	$results = query( $query, $conn , $binding );
	if($results){
		foreach( $results as $row){

			$pwd_hash_db 	= $row[1];
			// $spwd   		= $row[2];
			// $pwd_hash_in	= setHash($pwd , $spwd);

			if($pwd_hash_db === $pwd){
				$key =  $row[0]. "$" . $row[1];
			}
		}
	}


	return $key;
}
	
function setHash($sPassword, $sSalt )
{
	if (!$sSalt)
	{
		$sSalt = "1d8063761ad359aee04db8acffc4b217";
	}
	return md5(md5($sPassword) . md5($sSalt));
}

function update_rsvp_status($conn ,$user_id , $event_id , $resp_cd){

	$query = " 
				update phpfox_event_rsvp set rsvp_cd = :resp_cd , update_ts = :time
				where user_id = :user_id and event_id = :event_id 
			";

	$binding = array( 
		'resp_cd' 	  => $resp_cd  , 
		'user_id' 	  => $user_id  , 
		'event_id'    => $event_id ,
		'time'        => time()
	);

	update_query_execute ($query , $conn , $binding);

}


function update_event_status($conn ,$user_id , $event_id , $resp_cd){

	$query = " 
				update popcliqs_events set status = :resp_cd , update_ts = :time
				where user_id = :user_id and event_id = :event_id 
			";

	$binding = array( 
		'resp_cd' 	  => $resp_cd  ,
		'user_id' 	  => $user_id  ,  
		'event_id'    => $event_id ,
		'time'        => time()
	);

	update_query_execute ($query , $conn , $binding);

}

function add_new_event($conn , $user_id ,  $zip , $cat_cd , $st_time , $end_time ,$event_lat_log ){

	error_log( "  $user_id ,  $zip , $cat_cd , $st_time , $end_time , $cat_id " );

	//add event 
	$evt_id = add_event($conn , $user_id ,  $zip , $st_time , $end_time , $cat_cd , $event_lat_log);

	//add event invite
	add_event_invite($conn , $user_id  , $evt_id );
}


function add_event_invite($conn , $user_id  , $evt_id ){

	$query = " 
				insert into phpfox_event_rsvp ( 
					user_id ,  event_id , rsvp_cd , update_ts , create_ts
				)
				VALUES (
					:uid , :eid , 1 , :time , :time
				) 
			";

	$binding = array( 
		'uid' => $user_id  ,
		'eid' => $evt_id  ,
		'time' => date( "Y-m-d H:i:s" )
	);
	insert_query_execute ($query , $conn , $binding);
}

function add_event($conn , $user_id ,  $zip , $st_time , $end_time , $cat_cd , $event_lat_log){

	$query = " 
				insert into popcliqs_events  ( 

					user_id, event_title , description ,
					category , event_location , event_address ,
					zip , event_start , event_end , create_ts ,
					update_ts, status , event_latitude , event_longitude , age_limit

				)
				VALUES (

					:uid , 'Simple title' , 'Simple description'  , 
					:cat_id , 'Park' , '660 1st Street Northcross' ,
					:zip  , :st_time , :end_time, :time , 
					:time , 1 , :lat ,:lon , 1
				) 
			";
	
	$lat = $event_lat_log[0];
	$lon = $event_lat_log[1];

	$binding = array( 
		'uid' 	  	=> $user_id  , 
		'cat_id' 	=> $cat_cd  , 
		'zip' 	  	=> $zip      , 
		'time'   	=> date( "Y-m-d H:i:s" ) ,
		'st_time'   => date( "Y-m-d H:i:s", $st_time ),
		'end_time'	=> date( "Y-m-d H:i:s", $end_time ), 
		'lat'		=> $lat , 
		'lon'		=> $lon 

	);

	return insert_query_execute ($query , $conn , $binding);

}

?>

