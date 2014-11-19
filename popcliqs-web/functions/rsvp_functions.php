<?php

function insert_rsvp_status( $conn , $event_id , $user_id ,  $rsvp_cd ){

	$query = " 
		    	insert into phpfox_event_rsvp
		    	(
		    		user_id, event_id ,rsvp_cd, create_ts, update_ts
				)
				VALUES 
				( 
					:uid, :event_id, :rsvp_cd, :create_ts, :update_ts 
				) 
			";

	$binding = array(
		'uid' 		=> $user_id ,
		'event_id' 	=> $event_id , 
		'rsvp_cd' 	=> $rsvp_cd ,
		'create_ts' => date( "Y-m-d H:i:s" ),
		'update_ts' => date( "Y-m-d H:i:s" )
	);
	return insert_query_execute ( $query , $conn , $binding );
}


function update_rsvp_status( $conn , $event_id , $user_id , $rsvp_cd ) {

	$query = "update phpfox_event_rsvp  set  rsvp_cd= :rsvp_cd, update_ts= :update_ts 
				where  event_id = :eid and user_id = :uid
			";

	$binding = array(
		'rsvp_cd' 	=> $rsvp_cd ,
		'update_ts' => date( "Y-m-d H:i:s" ),
		'eid' 		=> $event_id , 
		'uid' 		=> $user_id 
	);
	update_query_execute($query,$conn,$binding);
}

function user_event_rsvp_cd($event_id , $user_id , $conn ){

	$query = "select *  from phpfox_event_rsvp 
				where  event_id = :eid and user_id = :uid
			";

	$binding = array(
		'eid' => $event_id , 
		'uid' => $user_id 
	);
	$results = query( $query, $conn , $binding );

	if($results){
		foreach( $results as $row){
			extract($row);
			return $rsvp_cd;
		}
	}
	return 0;
}

function user_event_rsvp_count($event_id , $conn ){

	$query = "select * from phpfox_event_rsvp 
				where  event_id = :eid";

	$binding = array(
		'eid' => $event_id  
		
	);
	$results = query( $query, $conn , $binding );

	if($results){
		return sizeof($results);
	}
	return 0;
}

function users_rsvp_event($event_id , $conn ){

	$users 	=	array();
	$query  = "select *  from phpfox_event_rsvp where event_id = :eid";

	$binding 	= array(
		'eid' => $event_id
	);

	$results = query( $query, $conn , $binding );

	if( $results ){

		foreach( $results as $row){
			extract($row);
			$users[] =  $user_id;
		}
	} 
	return $users;
}
	
function rsvp_event_male_count($event_id , $conn ){

	error_log (" Event id $event_id");

	$users 	=	array();
	$query  = "select * from phpfox_event_rsvp  
			   INNER JOIN popcliqs_users
 			   ON phpfox_event_rsvp.user_id = popcliqs_users.user_id 
 			   where popcliqs_users.gender='1' and phpfox_event_rsvp.event_id=:eid";

	$binding = array(
		'eid' => $event_id
	);

	$results = query( $query, $conn , $binding );
	if($results){
		return sizeof($results);
	}
	return 0;
}