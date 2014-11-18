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
			
			// error_log($category );

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

				$time_diff = $start_timestamp - ($start_t - (60 *  $tz) );

				 // echo ( " Time diffsdfd : " . $time_diff  . " compare " . 60 *1.5*60 ); 
				// if time diff is less than 1.5 hours , user can checking 
				// if($time_diff > (60 *1.5*60) ){
			    	// $user_event->mins_left_for_checkin = round($time_diff/60 - (1.5*60))  ;
			    	$check_sttimestamp = $start_timestamp  - (60 *1.5*60) ;
					// $start_timestamp = $timestamp - ($tz * 60 ) ;
					$user_event->mins_left_for_checkin_time = date('H:i:s', $check_sttimestamp);
					$user_event->mins_left_for_checkin_dt   = date('m/d/Y', $check_sttimestamp);

				// }
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
			// error_log(" event_id " . $event_id);
			
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



function update_event_status($conn ,$user_id , $event_id , $rsvp_cd){

	$query = " 
				update popcliqs_events set status = :rsvp_cd , update_ts = :time
				where user_id = :user_id and event_id = :event_id 
			";

	$binding = array( 
		'rsvp_cd'	  => $rsvp_cd  ,
		'user_id' 	  => $user_id  ,  
		'event_id'    => $event_id ,
		'time'        => time()
	);

	update_query_execute ($query , $conn , $binding);

}

function add_new_event($conn , $user_id ,  $zip , $cat_cd , $st_time , $end_time ,$event_lat_log ){

	error_log( "  $user_id ,  $zip , $cat_cd , $st_time , $end_time " );

	$evt_id = add_event_lat_lon($conn , $user_id ,  $zip , $st_time , $end_time , $cat_cd , $event_lat_log);

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

function add_event_lat_lon($conn , $user_id ,  $zip , $st_time , $end_time , $cat_cd , $event_lat_log){

	$event_title	= "New Event";
	$event_decs  	= "New Desc";
	$event_location = "World Center";
	$event_address  = " New Blvd";



	if( $cat_cd == "1"){ //SPORTS 
		$event_title 	= "Rise Up & Run 5K";
		$event_decs 	= "Join the Falcons for the Rise Up & Run 5K presented by  Track Club. This family friendly event offers something for the whole family including a One Mile Fun Run and Play 60 Fun Run. All 5K and One Mile Fun Run participants will have the opportunity to finish on the  Falcons 50-yard line inside the Dome while the Play 60 Fun Run will be an end zone to end zone dash.";
		$event_location = "World Sports Center";
		$event_address  =  "285 Andrew Young International Blvd NW";
	
	}else if( $cat_cd == "2"){ //Professional 
		$event_title 	= "Ecthical Hacker Halted Conference";
		$event_decs 	= "The EC-Council will host its premier security conference, Hacker Halted USA, at the  World Congress Center on Oct. 16 and 17. Business leaders and computer and information security professionals across multiple industries worldwide will come together and discuss the biggest threats to cybersecurity. This year's theme, Technology and the Zombie Apocalypse, plays off the current preoccupation with zombies, while tying in how technology would hurt and more importantly help in a disaster scenario.";
		$event_location = "International Ecthical Hacking ";
		$event_address  =  "190 Marry Street Northwest";
	

	}else if( $cat_cd == "3"){ //Education 
		$event_title 	= "Space Activity";
		$event_decs 	= "The Centre National d'Etudes Spatiales (CNES), the French Space Agency, is a pivotal player in Europe's space program and a major source of initiatives and proposals that aim to maintain France and Europe's competitive edge. Mr. Philippe Hazane, Space Attaché and CNES Representative at the French Embassy in the United States, will discuss recent French and European space activities.";
		$event_location = " State Tech Library";
		$event_address  =  "285 Andrew Young International Blvd NW";
	

	}else if( $cat_cd == "4"){ //Support Group 
		$event_title 	= "A Holistic Approach to Loss & Grief";
		$event_decs 	= "In this class for woman and children, Certified Ayurvedic Lifestyle Consultant, Gedalia Genin, discusses natural alternatives to Prozac and the unique and simple practices to transform your energy.";
		$event_location = "Center For Holistic & Integrative Medicine";
		$event_address  =  "1401 Dresden Dr";
	

	}else if( $cat_cd == "5"){ //Arts 
		$event_title 	= "Art on the State BeltLine";
		$event_decs 	= "The shows take place at the Historic Fourth Ward Outdoor Theater beginning at 1 p.m., with performances suitable for all ages. Expect to see performances from Esther de Monteflores, Kollaboration.";
		$event_location = "Historic Fourth Ward Park";
		$event_address  = "800 Dallas St NE";
	

	}else if( $cat_cd == "6"){ //Outdoor 
		$event_title 	= "Fan Days at the World of Coca-Cola";
		$event_decs 	= "With the Chick-fil-A Kickoff Games coming up Aug. 28 and Aug. 30, the World of Coca-Cola is hosting Fan Days for football fans. Now through Oct. 15, fans can text WOCC to 66937 to get two tickets for $25 - a total savings of $7 from regular adult admission.";
		$event_location = "World of Coca Cola";
		$event_address  =  "121 Baker St NW";
	

	}else if( $cat_cd == "7"){ //Party 
		$event_title 	= "Latin Nights Dance Party";
		$event_decs 	= "Looking for a place to dance Salsa, Bachata & Merengue, check out Noche Caliente Tropical Salsa Saturdays! MC Lexx will be playing the best mix of Tropical Latin music, with a nice mix of international flair.";
		$event_location = "Thirsty Bar & Grill";
		$event_address  =  "3907 Burns Rd";
	

	}else if( $cat_cd == "8"){ //Social 
		$event_title 	= "The Book Of Life Halloween Carnival";
		$event_decs 	= "Children in their Halloween costume can win $1,000 gift certificate for a mall shopping spree! But the fun doesn't stop there! There will be face painting, photo booth, balloon artists, cookies, arts & crafts.";
		$event_location = "Perimeter Mall";
		$event_address  =  "4400 Ashford Dunwoody Rd";
	}

	$query = " 
				insert into popcliqs_events  ( 
					user_id, event_title , description ,
					category , event_location , event_address ,
					zip , event_start , event_end , create_ts ,
					update_ts, status , event_latitude , event_longitude , age_limit
				)
				VALUES (
					:uid , :event_title , :event_decs  , 
					:cat_id , :event_location ,  :event_address ,
					:zip  , :st_time , :end_time, :time , 
					:time , 1 , :lat ,:lon , 1
				) 
			";
	
	$lat = $event_lat_log[0];
	$lon = $event_lat_log[1];

	$binding = array( 
		'uid' 	  			=> $user_id  , 
		'cat_id' 			=> $cat_cd  , 
		'zip' 	  			=> $zip      , 
		'time'   			=> date( "Y-m-d H:i:s" ) ,
		'st_time'   		=> date( "Y-m-d H:i:s", $st_time ),
		'end_time'			=> date( "Y-m-d H:i:s", $end_time ), 
		'lat'				=> $lat , 
		'lon'				=> $lon ,
		'event_title' 		=> $event_title , 
		'event_decs'  		=> $event_decs , 
		'event_location' 	=> $event_location , 
		'event_address'     => $event_address 
	);

	return insert_query_execute ($query , $conn , $binding);

}

function get_user($conn , $user_id ){

	$query = "select * from popcliqs_users where user_id = :user_id";

	$binding = array( 
		'user_id'    => $user_id
	);

	$results = query( $query, $conn , $binding );

	if( $results ){
		
		foreach( $results as $row){
			extract($row);
			$user = new User;
			$user->email  = $email;
			$user->zip    = strlen ($zip) === 4 ? "0".$zip : $zip ;
			$user->status = $status;
			$user->type   = $type;
			$user->sex    = $gender;
			$user->dob    = $dob;

			return $user;
		}

	} else{
		return false;
	}
}

?>

