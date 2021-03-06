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
		foreach( $results as $row){
			extract($row);
			$_SESSION['zip'] = strlen ($zip) === 4 ? "0".$zip : $zip ;;
			return $user_id;

		}
	} else{
		return false;
	}
}

function send_welcome_mail($email){
	$subject ="Mail from popcliqs.";
	$messege  = "thankyou for registering.";
	mail($email, $subject,$messege);
}

function send_password_mail($conn ,$email){
	$subject  = "Reset your Popcliqs password.";
	$key = md5($email.'|'. time());
	$reset_url = "http://popcliqs.com/beta/reset.php?key=$key";
	$messege  = "Link to reset password:$reset_url";

	update_user_session($conn, $key , $email);
	mail($email, $subject,$messege);
}

function update_user_session($conn ,$key , $email){

	$query = " 
				insert into popcliqs_reset( 
					email , sessionkey, create_ts ,update_ts
				)
				VALUES (
					 :emailid , :key, :create_ts, :update_ts 
				) 
			";

	$binding = array( 
		'emailid'   => $email ,
		'key'  		=> $key,
		'create_ts' => date( "Y-m-d H:i:s" ),
		'update_ts' => date( "Y-m-d H:i:s" )
	);
	insert_query_execute ( $query , $conn , $binding );
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

function get_user_age($date_of_birth){
	
	$bday  = new DateTime($date_of_birth);
	$today = new DateTime('00:00:00');
	$diff  = $today->diff($bday);
	return $diff->y; 
}

function get_user_zip($conn , $user_id){

	$query = "select zip from popcliqs_users where user_id = :uid LIMIT 1";

	$binding = array(
		'uid' => $user_id 
	);

	$results = query( $query, $conn , $binding);

	if ($results) { 
		$zip = $results[0][0]; 
		return strlen ($zip) === 4 ? "0".$zip : $zip ;
	}
	return false;
} 

function fetch_acc_setting($conn,$user_id){
	$query = "select zip from popcliqs_users where user_id = :uid LIMIT 1";
	$binding = array(
		'uid' => $user_id
		);
	$results = query($query,$conn,$binding);
    
	if ($results) {
		return $results; 
	}
	return false;
}

function update_acc_setting( $conn , $user_id , $zip  ){

	$query = " update popcliqs_users set zip=:zip where user_id = :user_id";

	$binding = array( 
		'user_id' 	=> $user_id , 
		
		'zip'       =>$zip 
	);

	update_query_execute($query,$conn,$binding);
}

function update_user_password($conn, $user_id,$password){
	$query = "update popcliqs_users set password = :new_password where user_id = :user_id";
	
	$binding = array(

		'user_id'  => $user_id ,

		'new_password' => $password,
		);
	update_query_execute($query,$conn,$binding);
}

function does_user_email_exist($conn,$email){
	$query = "select email from popcliqs_users where email = :email";
	$binding = array(
		'email' => $email
		);
	$results = query($query,$conn,$binding);
    
	if ($results) {
		return true;
	}
	return false;
}

function getUserIdFromKey( $conn , $key ){

	$query = "select  u.user_id , u.email , u.zip from popcliqs_reset as s , popcliqs_users as u   
			 where sessionkey = :key and s.email = u.email ";
	
	$binding = array(
		'key' => $key
	);

	$results = query($query,$conn,$binding);
	
	if($results){
		foreach( $results as $row){
			extract($row);
			$_SESSION['email']   = $email; 
			$_SESSION['user_id'] = $user_id;
			$_SESSION['zip']     = strlen ($zip) === 4 ? "0".$zip : $zip ;;

			return $user_id;
		}
	}	
}
