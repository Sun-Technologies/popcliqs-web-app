<?php
function add_event( $conn ,$event){

	$query = " 
		    	insert into popcliqs_events(user_id, 
					event_title ,description, category, event_location, event_address , city, state,  zip, age_limit , capacity_limit, event_start, event_end, create_ts, update_ts, status, event_latitude,event_longitude
				)
				VALUES (:user_id,:title ,:description, :category_id, :location, :address ,:city, :state, :postal_code , :age_limit , :capacity , :start_time, :end_time ,:create_ts , :update_ts ,:status , :lat, :lon
				) 
			";

	$binding = array(
	    'user_id'       => $event->creator,
		'title'         => $event->title ,
		'description'   => $event->description,
		'category_id'   => $event->category_id  , 
		'location' 		=> $event->location,
		'address' 		=> $event->address,
		'city' 			=> $event->city,
		'state'			=> $event->state,
		'postal_code'	=> $event->postal_code,
		'age_limit'		=> $event->age_limit,
		'capacity'		=> $event->capacity,
		'start_time'	=> date( "Y-m-d H:i:s", $event->start_time),
		'end_time'		=> date( "Y-m-d H:i:s", $event->end_time),
	    'create_ts'	    => date( "Y-m-d H:i:s" ),
		'update_ts' 	=> date( "Y-m-d H:i:s" ),
		'status'    	=> $event->status,
		'lat'      		=> $event->lat,
		'lon'      		=> $event->lon
		);

	return insert_query_execute ( $query , $conn , $binding );

	
}


function update_event( $conn , $event, $user_id ){

	$query = " 
		    	update popcliqs_events  
				set event_title=:title, description=:description, category=:category_id, 
				event_location=:location, event_address=:address, zip=:postal_code,
				age_limit=:age_limit ,
				capacity_limit=:capacity, event_start=:start_time, event_end=:end_time, 
				update_ts=:update_ts, event_latitude=:lat, event_longitude=:lon
				where event_id =:event_id and  user_id=:user_id 	 
			";

	$binding = array(
	  	'title'         => $event->title ,
		'description'   => $event->description,
		'category_id'   => $event->category_id  , 
		'location' 		=> $event->location,
		'address' 		=> $event->address,
		'postal_code'	=> $event->postal_code,
		'age_limit'		=> $event->age_limit,
		'capacity'		=> $event->capacity,
		'start_time'	=> date( "Y-m-d H:i:s", $event->start_time),
		'end_time'		=> date( "Y-m-d H:i:s", $event->end_time),
	    'update_ts' 	=> date( "Y-m-d H:i:s" ),
		'lat'      		=> $event->lat,
		'lon'      		=> $event->lon,
		'user_id'		=> $user_id ,
		'event_id'		=> $event->id
		);

	return update_query_execute ( $query , $conn , $binding );
}

///below code is written for fetching of events
function fetch_event($conn,$event_id ,$tz ){
	
	$event = null;
	$query = "select * from popcliqs_events where event_id = :event_id";

	$binding = array( 
		'event_id' => $event_id
	);

	$results = query( $query, $conn , $binding );
	if($results){
		foreach( $results as $row){
			extract($row);

			$timestamp = strtotime($event_start);
			$start_timestamp = $timestamp - ($tz * 60 ) ;
			$evt_st = date( 'm/d/Y h:i a', $start_timestamp ) ;


			$timestamp = strtotime($event_end);
			$end_timestamp = $timestamp - ($tz * 60 ) ;
			$evt_end = date( 'm/d/Y h:i a', $end_timestamp ) ;


			$st_evt_hr = date('H', $start_timestamp) ;
			$st_evt_mn = date('i', $start_timestamp) ;
			$ed_evt_hr = date('H', $end_timestamp) ;
			$ed_evt_mn = date('i', $end_timestamp) ;

			$event 				= new  User_Event;
			$event->event_id 	= $event_id;
			$event->category_id = $category;
			$event->start_dt    = $evt_st;
			$event->end_dt      = $evt_end;
			$event->title       = stripslashes($event_title);
			$event->location    = stripslashes($event_location);
			$event->address     = preg_replace( '/(\r\n)|\n|\r/', '', stripslashes($event_address));
			$event->description = stripslashes($description);
			$event->age_limit   = $age_limit;
			$event->capacity    = $capacity_limit;
			$event->lat		 	= $event_latitude;
			$event->lon		 	= $event_longitude;
			$event->postal_code = $zip;
			$event->start_time  = $st_evt_hr . ':'. $st_evt_mn;
			$event->end_time    = $ed_evt_hr . ':'. $ed_evt_mn;

		}
	}
	return $event;
} 

function getSplashEvent($conn , $start_t  , $end_t , $latlong , $search_term , $age  , $cat_id ,$miles = 25 ){



	error_log("$$$ AGE  ::: $age ");
	$milesperdegree = 69;
    $degreesdiff = $miles / $milesperdegree;

	$lat1 = $latlong['lat'] - $degreesdiff;
	$lat2 = $latlong['lat'] + $degreesdiff;
	$lon1 = $latlong['lon'] - $degreesdiff;
	$lon2 = $latlong['lon'] + $degreesdiff;

	error_log(  " start    " . date( "Y-m-d H:i:s", $start_t) . " End date " . date( "Y-m-d H:i:s", $end_t) );
	$query = "SELECT * FROM 
			popcliqs_events as evt
			WHERE  evt.event_start >= :st and evt.event_start <= :et  and
			evt.event_latitude between :lat1 and :lat2 and evt.event_longitude between :lon1 and :lon2 
			and evt.age_limit <= $age and evt.status = 1 
			and (
				evt.event_title LIKE :search_t or evt.event_location    LIKE :search_t or   
				evt.zip LIKE :search_t or 
				evt.description  LIKE :search_t  or evt.event_address  LIKE :search_t
			) 
	";	

	if ( $cat_id ) { 

		$query = $query. " and  evt.category =".$cat_id; 
	}

	// error_log( " query :>>> $query ");
	$binding = array(
		'st' 	=> date( "Y-m-d H:i:s", $start_t), 
		'et' 	=> date( "Y-m-d H:i:s", $end_t), 
		'lat1'	=> $lat1,
		'lat2' 	=> $lat2,
		'lon1' 	=> $lon1,
		'lon2' 	=> $lon2,
		'search_t' 	=> '%'.$search_term.'%'
	);
	return query( $query, $conn , $binding);
}

function getUserEvent($results, $tz ){

	$user_events = array();

	if($results){
		foreach( $results as $row){

			extract($row);
		
			// $evt_hr = date( 'H', $event_start ) ;
			$timestamp = strtotime($event_start);
			$time_diff = ($timestamp - time()) / (60*60);
			$start_timestamp = $timestamp - ($tz * 60 ) ;
			$evt_hr = date( 'H', $start_timestamp ) ;
			// error_log( "$event_id ::: $tz ::  $event_start ::: $evt_hr :: ts : $timestamp  : diff : "  .$time_diff/(60*60));
			
			$user_event 				= new User_Event();
			$user_event->event_id		= $event_id;
			$user_event->start_time 	= $evt_hr;
			$user_event->category_id	= $category;
			$user_event->lat			= $event_latitude;
			$user_event->lon			= $event_longitude;
			$user_event->size 			= "S";
			$user_event->mratio 		= 2;
			$user_event->time_diff      = $time_diff;

			$user_events[] =  $user_event;


		}
	}
	return $user_events;
}

function assign_rank_to_events($user_events , $user_cat_pref , $user_lat_lon, $start_t, $end_t , $radius_mls ){
	
	//$st_hour = date('H', $start_t) ;
	//$ed_hour = date('H', $end_t) ;
	$rank = 0;
	
	$ranked_events = array();
	$evt_hr_bucket = array();

	if($user_events){
		foreach( $user_events as $user_event){
			
			$pref_code = get_user_event_preffered($user_event->category_id , $user_cat_pref);
			
			if($pref_code){
				
				//$evt_hr = date('H', $start_time) ;
				$distance =  degrees_difference($user_event->lat , $user_event->lon , $user_lat_lon['lat'] , $user_lat_lon['lon'] );

				$distance_per = $radius_mls/($radius_mls - $distance) * 100;

				if( $distance_per > 210  &&   $pref_code ==1 ){
					$rank = 9.2;
				}else if( $distance_per > 210 &&   $pref_code ==2 ){
					$rank = 8.5;
				}else if( $distance_per > 210  &&   $pref_code ==1 ){
					$rank = 9;
				}else if( $distance_per > 210 &&   $pref_code ==2 ){
					$rank = 8;
				}else if( $distance_per > 190 &&   $pref_code ==1 ){
					$rank = 7.8;
				}else if( $distance_per > 190 &&   $pref_code ==2 ){
					$rank = 7.4;
				}else if( $distance_per > 170 &&   $pref_code ==1 ){
					$rank = 7.5;
				}else if( $distance_per > 170 &&   $pref_code ==2 ){
					$rank = 7;
				}else if( $distance_per > 165 &&   $pref_code ==1 ){
					$rank = 6.5;
				}else if( $distance_per > 165 &&   $pref_code ==2 ){
					$rank = 5.5;
				}else if( $distance_per > 150 &&   $pref_code ==1 ){
					$rank = 6;
				}else if( $distance_per > 150 &&   $pref_code ==2 ){
					$rank = 5;
				}else if( $distance_per > 140 &&   $pref_code ==1 ){
					$rank = 4.5;
				}else if( $distance_per > 140 &&   $pref_code ==2 ){
					$rank = 3.5;
				}else if( $distance_per > 130 &&   $pref_code ==1 ){
					$rank = 4;
				}else if( $distance_per > 130 &&   $pref_code ==2 ){
					$rank = 3;
				}else if( $distance_per > 120 &&   $pref_code ==1 ){
					$rank = 2.5;
				}else if( $distance_per > 120 &&   $pref_code ==2 ){
					$rank = 1.5; 
				}else if( $distance_per > 110 &&   $pref_code ==1 ){
					$rank = 2;
				}else if( $distance_per > 110 &&   $pref_code ==2 ){
					$rank = 1; 	
				}

				error_log(" distance =  $distance ::: rank = $rank :::: prefcode = $pref_code ::: distance_per = $distance_per"); 
				$user_event->distance 	= $distance;
				$user_event->rank   	= $rank;
				$user_event->pref_code 	= $pref_code;
				$ranked_events[]		= $user_event;
		
			}
		}
	}
	return $ranked_events;
}

function get_user_event_preffered( $evt_cat_id, $user_cat_prefs ) {

	if($user_cat_prefs ) {
		foreach( $user_cat_prefs as $user_cat_pref){
		
			extract($user_cat_pref);
			if($category_id === $evt_cat_id){
				return $pref_cd;
			}
		}
	}
	return false;
}

function fetch_init_events( $conn , $user_id ){

	$query = "select * from popcliqs_events where user_id = :user_id and status = 1 order by event_start desc ";

	$binding = array( 
		'user_id' => $user_id
	);

	return query( $query, $conn , $binding );
}

function fetch_rsvp_events($conn , $user_id  , $action){

	$query = "select * from phpfox_event_rsvp as rsvp , popcliqs_events as evnt where 
			rsvp.user_id = :user_id and rsvp_cd = :action  
			and rsvp.event_id = evnt.event_id and status = 1 
			order by event_start desc limit 10 ";
	
	$binding = array( 
		'user_id' => $user_id ,
		'action'  => $action
	);
	return query( $query, $conn , $binding );

}

function update_rsvp_events($conn , $user_id  , $event_id){
	$query = "update  phpfox_event_rsvp set rsvp_cd = 0 where
			user_id = :user_id and event_id = :event_id ";
	
	$binding = array( 
		'user_id'   => $user_id ,
		'event_id'  => $event_id
	);
	return update_query_execute( $query, $conn , $binding );
}
function delete_event( $conn , $user_id , $event_id  ){

	$query = " update popcliqs_events set status= :status , update_ts= :update_ts 
					where user_id = :user_id and event_id = :event_id ";

	$binding = array( 
		'user_id' 	=> $user_id , 
		'event_id' 	=> $event_id , 
		'status' 	=> 0 , 
		'update_ts' => date( "Y-m-d H:i:s" ) 
	);

	update_query_execute($query,$conn,$binding);
}

