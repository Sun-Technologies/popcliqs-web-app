{

	"exit_cd" : "<?php echo $status_obj->exit_cd ?>" , 
	"msg"     : "<?php echo $status_obj->exit_msg ?>",
	<?php 
	if( $event_info ) { ?>
		"id"          : <?php echo $event_info->event_id ?> ,
		"size"        : "S" ,
		"typeid"      : <?php echo $event_info->category_id ?> ,
		"type"        : "<?php echo $cat_list[$event_info->category_id]  ?>" ,
		"st_time"     : "<?php echo $event_info->start_time ?>" ,
		"ed_time"     : "<?php echo $event_info->end_time ?>" ,
		"st_dt"       : "<?php echo $event_info->start_dt ?>" ,
		"ed_dt"       : "<?php echo $event_info->end_dt ?>" ,
		"title"       : "<?php echo $event_info->title?>" ,
		"location"    : "<?php echo $event_info->location ?>" ,
		"address"     : "<?php echo $event_info->address ?>" ,
		"postal_code" : "<?php echo $event_info->postal_code ?>" ,
		"fillPCent"   : 25 ,
		"mratio"      : 0.5 ,
		"distance"    : "<?php echo $distanceToEvent ?>", 
		"rsvp"        : "<?php echo $rsvp_id ?>", 
		"description" : "<?php echo $event_info->description ?>",
		"age_limit"   : <?php echo $event_info->age_limit ?>,
		"capacity"    : "<?php echo $event_info->capacity ?>"
	<?php
	}?>
}