{
	"exit_cd" : "<?php echo $status_obj->exit_cd ?>" , 
	"msg"     : "<?php echo $status_obj->exit_msg ?>",
	"pref"  : [

		<?php 
		if( $pref_array ){ 
			$startloop = true;
			foreach($pref_array as $user_pref) {

				if( $startloop){ 
					$startloop = false; 
					echo "{";
				}else{
					echo ',{';
				}
				echo ' "category_id": "'.  $user_pref->category_id .'" ,';
				echo ' "preference_cd": "'.  $user_pref->preference_cd .'" ';

				echo "}"; 
			}

		}
		?>
		
	]
}