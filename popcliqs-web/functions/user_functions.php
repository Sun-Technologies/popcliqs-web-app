<?php
function add_registered_user( $conn ,$user ){

	$query = " 
				insert into popcliqs_users( 
					email , password,zip , create_ts ,update_ts, status , type,gender,dob
				)
				VALUES (
					 :emailid , :password,:zip , :create_ts, :update_ts , :status , :type,:sex,:dob
				) 
			";

	$timestamp = strtotime( $user->dob );

	$binding = array( 
		'emailid'   => $user->email ,
		'password'  => $user->password,
		'zip'       => $user->zip  , 
		'create_ts' => date( "Y-m-d H:i:s" ),
		'update_ts' => date( "Y-m-d H:i:s" ),
		'status'    => $user->status ,
		'type'      => $user->type ,
		'sex'       => $user->sex ,
		'dob'       => date( "Y-m-d H:i:s", $timestamp) 
	);
	$user_id = insert_query_execute ( $query , $conn , $binding );

	return $user_id;	
}

function valid_email( $reemail ) {

	return filter_var( $reemail, FILTER_VALIDATE_EMAIL );
}
   
function is_user_exist( $conn, $email ){

	$query = "select * from popcliqs_users where email = :email";

	$binding = array( 
		'email' => $email
	);

	$results = query( $query, $conn , $binding );
	
	$user_id_val = null;
	if($results){
		foreach( $results as $row){
			extract($row);
			$user_id_val =  $user_id ;
		}
	}

	return $user_id_val;
}

function authenticate_user( $conn, $email, $password ){

	$query = "select * from popcliqs_users where email = :email and password = :password";

	$binding = array( 
		'email'    => $email,
		'password' => $password
	);

	$results = query( $query, $conn , $binding );
	if( $results ){
		return true;
	} else{
		return false;
	}
}

function send_welcome_mail($email){
	$subject ="Mail from popcliqs.";
	$messege  = "thankyou for registering.";
	mail($email, $subject,$messege);
}