<?php

function  updateSession($conn,  $deviceToken , $sessionType , $status , $user_id) { 

	$query = "
				insert into mobile_session 
				( deviceToken,  sessionType , user_id , status , create_ts, update_ts ) 
				values
				(  :device_token, :session_type  , :user_id, :status, :create_ts, :update_ts)  
				on duplicate key 
				update deviceToken= :device_token, sessionType = :session_type , 
				status = :status , update_ts = :update_ts ";

	$binding = array(
	    'device_token'      => $deviceToken,
		'session_type'      => $sessionType,
		'user_id' 			=> $user_id,
		'status'			=> $status,
		'create_ts'	    	=> date( "Y-m-d H:i:s" ),
		'update_ts' 		=> date( "Y-m-d H:i:s" )
	);

	return insert_query_execute ( $query , $conn , $binding );
}

function fetch_device($conn,$user_id)
{
	$query = "select deviceToken from mobile_session where user_id=:user_id";

	$binding = array( 
		'user_id' => $user_id
	);

	$results = query( $query, $conn , $binding );
		
	if($results)
	{
		foreach( $results as $row)
		{
			extract($row);
			return $deviceToken;
		}
	}
    return null;
}
?>