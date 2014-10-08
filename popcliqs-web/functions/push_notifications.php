
<?php 
	
	// Push The notification with parameters
	require_once('PushBots.class.php');

	

    function push_notification($device_token , $event_alert){

		

		$pb 			= new PushBots();
		$appID 			= '5434f0471d0ab1f8038b459e';
		$appSecret 		= '5be640235894689333cb4b234b6b6c5f';
		$platforms 		= '0';
	
		$pb->App($appID, $appSecret);
	
		// Push to Single Device
		// Notification Settings
		$pb->AlertOne($event_alert);
		$pb->PlatformOne($platforms);
		$pb->TokenOne($device_token);
		 
		//Push to Single Device
		$pb->PushOne();
	}
?>