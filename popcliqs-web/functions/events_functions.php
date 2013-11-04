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
		'lat'      		=> 0,
		'lon'      		=> 0
		);

	insert_query_execute ( $query , $conn , $binding );
	
}

///below code is written for fetching of events
function fetch_event($conn,$event_id){
	
	$query = "select * from popcliqs_events where event_id = :event_id";

	$binding = array( 
		'event_id' => $event_id
	);

	$results = query( $query, $conn , $binding );
	$pref_list = array();
     if($results){
		foreach( $results as $row){
			extract($row);

			$event = new  User_Event;
			$event->event_id = $event_id;
		}
	}
} 

 