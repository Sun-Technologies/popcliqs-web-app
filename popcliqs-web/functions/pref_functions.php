<?php

function add_pref($conn,$pref_list,$user_id ){
    $query = " 
		   		insert into user_cat_pref(user_id, 
				category_id , pref_cd,  create_ts ,update_ts
				)
				VALUES (:user_id ,
				 	:category_id , :preference_cd,:create_ts, :update_ts 
				) 
			";

    foreach ($pref_list as $pref) {
		$binding = array(
		             'user_id'      =>$user_id,
	     			 'category_id'  =>$pref->category_id,
	     			 'preference_cd'=>$pref->preference_cd,
	    			 'create_ts'    => date( "Y-m-d H:i:s" ),
					 'update_ts' 	=> date( "Y-m-d H:i:s" )
	     );
		# code...
		insert_query_execute($query,$conn,$binding);
	}
}

 /////below code is written for fetch pref 
function fetch_pref($conn,$user_id){


	$query = "select * from user_cat_pref where user_id = :user_id";

	$binding = array( 
		'user_id' => $user_id
	);

	$results = query( $query, $conn , $binding );
	$pref_list = array();
	
	if($results){
		foreach( $results as $row){
			extract($row);
			
			$pref = new user_preferences;

			$pref->preference_id  = $preference_id;
			$pref->category_id    = $category_id;
			$pref->preference_cd  = $pref_cd ;
			$pref->user_id        = $user_id;
			$pref_list[] = $pref;
		}
	}
    return $pref_list;
}


function insert_default_pref($conn  , $user_id){
	$query = " 
		   		insert into user_cat_pref(user_id, 
				category_id , pref_cd,  create_ts ,update_ts
				)
				VALUES (:user_id ,
				 	:category_id , :preference_cd,:create_ts, :update_ts 
				) 
			";

    for ($index = 1 ;  $index < 9 ; $index++) {
		$binding = array(
		             'user_id'      => $user_id,
	     			 'category_id'  => $index  ,
	     			 'preference_cd'=> 2,
	    			 'create_ts'    => date( "Y-m-d H:i:s" ),
					 'update_ts' 	=> date( "Y-m-d H:i:s" )
	     );
		insert_query_execute($query,$conn,$binding);
	}
}

function get_user_cat_pref($conn , $user_id){

	$query = "select * from user_cat_pref where user_id = :uid and pref_cd <> 0 ";

	$binding = array(
		'uid' => $user_id 
	);
	
	$results = query( $query, $conn , $binding);
	
	if ($results) { 
		return $results;
	}
	return false;
}

function update_pref($conn,$pref_list,$user_id ){

	$update_query = " update user_cat_pref set pref_cd= :preference_cd, update_ts= :update_ts 
					where user_id = :user_id and category_id = :category_id ";

	$insert_query = "
						insert into user_cat_pref
						(user_id, category_id , pref_cd,  create_ts ,update_ts)
				        VALUES (:user_id ,:category_id , :preference_cd,:create_ts, :update_ts )
					";
	foreach ($pref_list as $pref) {
		
		$update_binding = array(
		        'user_id'       => $user_id,
	     	    'category_id'   => $pref->category_id , 
	     		'preference_cd' => $pref->preference_cd,
				'update_ts' 	=> date( "Y-m-d H:i:s" )
	    );
		$result  =  update_query_execute($update_query,$conn,$update_binding);
		
		if( $result  == false){

			$insert_binding = array(
		             'user_id'      => $user_id,
	     			 'category_id'  => $pref->category_id ,
	     			 'preference_cd'=> $pref->preference_cd,
	    			 'create_ts'    => date( "Y-m-d H:i:s" ),
					 'update_ts' 	=> date( "Y-m-d H:i:s" )
	     	);
			insert_query_execute($insert_query,$conn,$insert_binding);
		}
	}
}
