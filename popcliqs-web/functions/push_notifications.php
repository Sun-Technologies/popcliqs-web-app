
<?php 
	
	// Push The notification with parameters
	require_once('PushBots.class.php');

	

    function push_notification($device_token , $event_alert){

		

		$pb 			= new PushBots();
		$appID 			= '542a9a4e1d0ab1f7038b4574';
		$appSecret 		= '0f458953c6c70b5e3b6a6c159125a2a3';
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