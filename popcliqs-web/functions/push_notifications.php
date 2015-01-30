
<?php 
	
	// Push The notification with parameters
	require_once('PushBots.class.php');

	

    function push_notification($device_token , $event_alert){

		

		$pb 			= new PushBots();
		$appID 			= '54afb4b01d0ab1b55e8b4646';
		$appSecret 		= 'bc292cf7788242005cb3eeadb282993f';
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