{
	<?php 
	$rank = 0;
	if( $ranked_events ){ 
		$startloop = true;
		foreach($ranked_events as $user_event) { 
						
			if( $startloop){ 
				$startloop = false; 
			}else{
				echo ',';
			}
			$hour = $user_event->start_time . ':00'; ?>
			"event_<?php echo $user_event->event_id ?>" :{
				"id" : <?php echo $user_event->event_id ?> ,
				"size" : "<?php echo $user_event->size ?>"  ,
				"type" : <?php echo $user_event->category_id ?> ,
				"time" : "<?php echo $hour ?>" ,
				"fillPCent" : 25 ,
				"rank" : <?php echo $user_event->rank ?> ,
				"mratio" : <?php echo $user_event->mratio ?> 
			}
	<?php 
		$rank +=2;
		} 
	}?>
}
