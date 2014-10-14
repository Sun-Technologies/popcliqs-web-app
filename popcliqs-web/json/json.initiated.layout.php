<?php
if( $rows ){ 
	$index = 0;
	foreach( $rows as $row ) { 
				
	 	$index++ ;
	 	extract($row);

	 	$timestamp = strtotime($event_start);
	 	$start_timestamp = $timestamp - ($tz * 60 ) ;
	 	$evt_st   = date( 'M d Y h:i a', $start_timestamp );
	 	$canEdit = false;  

	 	$now = time()- ($tz * 60 );
	 	if( $now < $start_timestamp ) {
			$canEdit = true;
		}
	?>
	<tr>
	  <td><?php echo stripslashes($event_title) ?></td>
	  <td><?php echo $evt_st  ?></td>
	  <td><?php echo stripslashes($event_location) ?></td>
	  <td>
	 	<?php if( $canEdit ) { ?>
	 		<button type="button" class="btn backgroundColor1" onclick="delete_event(<?php echo $event_id?>)">
      			<span class="glyphicon glyphicon-remove"></span>
    		</button>
    		<button type="button" class="btn backgroundColor1"  onclick="edit_event(<?php echo $event_id?>)">
      			<span class="glyphicon glyphicon-pencil"></span>
    		</button>
	 	<?php } ?>
	</td>
	</tr>
	<?php
	}
}
?>