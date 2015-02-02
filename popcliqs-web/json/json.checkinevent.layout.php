{

	"exit_cd" : "<?php echo $exit_cd ?>",

	"checkin_event" : {

		<?php if( $checkin_eventid_list ){  
				$startloop = true;
				foreach($event_data_list as $user_event) { 
					if( $startloop){ 
						$startloop = false; 
					}else{
						echo ',';
					}
		?>
				 	"event_<?php echo $user_event->event_id ?>":	{
						"id" 	 				: "<?php echo $user_event->event_id ?>",
						"typeid" 				: "<?php echo $user_event->category_id ?>" ,
						"type"    				: "<?php echo $user_event->category ?>" ,
						"st_time" 				: "<?php echo $user_event->start_time ?>:00" ,
						"ed_time" 				: "<?php echo $user_event->end_time ?>:00" ,
						"st_dt" 				: "<?php echo $user_event->start_dt ?>" ,
						"ed_dt" 				: "<?php echo $user_event->end_dt ?>" ,
						"title" 				: "<?php echo str_replace( '\\' , '' , $user_event->title) ?>" ,
						"location" 				: "<?php echo str_replace( '\\' , '' , $user_event->location) ?>" ,
						"address" 				: "<?php echo str_replace( '\\' , '' , $user_event->address) ?>" ,
						"city" 					: "<?php echo $user_event->city ?>" ,
						"postal_code" 			: "<?php echo strlen($user_event->postal_code) == 4 ? "0".$user_event->postal_code : $user_event->postal_code ?>" ,
						"lat"   				: "<?php echo $user_event->lat ?>" ,
						"lon"   				: "<?php echo $user_event->lon ?>" ,
						"tz"   					: "<?php echo $ret_tz ?>" ,
						"is_creator"    	 	: "<?php echo ($user_event->creator === $user_id ) ? "true" : "false" ?>" ,
						"left_for_checkin_time" : "<?php echo $user_event->mins_left_for_checkin_time ?>",
						"left_for_checkin_dt"   : "<?php echo $user_event->mins_left_for_checkin_dt ?>",
						"desc"                  : "<?php echo str_replace( '\\' , '' , $user_event->description) ?>"
					}
			<?php   
				} 
			}
		?>
	}
}