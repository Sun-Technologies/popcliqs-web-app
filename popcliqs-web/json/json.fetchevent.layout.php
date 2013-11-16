{
	"exit_cd" : "<?php echo $status_obj->exit_cd ?>" , 
	"msg"     : "<?php echo $status_obj->exit_msg ?>",
	"events"  : [
		<?php 
		$rank = 0;
		if( $ranked_events ){ 
			$startloop = true;
			foreach($ranked_events as $user_event) { 
							
				if( $startloop){ 
					$startloop = false; 
					echo "{";
				}else{
					echo ',{';
				}
				$hour = $user_event->start_time . ':00'; ?>
				"id"        : <?php echo $user_event->event_id ?> ,
				"size"      : "<?php echo $user_event->size ?>"  ,
				"type"      : <?php echo $user_event->category_id ?> ,
				"time"      : "<?php echo $hour ?>" ,
				"fillPCent" : 0 ,
				"rank"      : <?php echo $user_event->rank ?> ,
				"mratio"    : <?php echo $user_event->mratio ?>
				<?php echo "}" ?>  
		<?php 
			$rank +=2;
			} 
		}?>
	]
}
