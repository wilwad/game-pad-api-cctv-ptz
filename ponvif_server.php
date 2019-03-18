<?php
	header('Access-Control-Allow-Origin: *');
	 
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	$url  = @ $_GET['url'];
	$move = @ $_GET['move'];
	
	if (!strlen(trim($url)) || !strlen(trim($move))){
		die("Specify url & move parameter");
	}
	
	switch ($move){
		case 'left':
		case 'right':
		case 'up':
		case 'down':
		case 'zoom-up':
		case 'zoom-down':
			break;
			
		default:
			die("Invalid move specified. Must be left, right, up or down");
			break;
	}
	
	require 'lib/class.ponvif.php';

	// url == '192.168.0.100:5000/onvif/device_service'
	
	$test = new ponvif();
	$test->setUsername('');
	$test->setPassword('');
	$test->setIPAddress($url);
		
	try {
		$test->initialize();

		if ($test->isFault($sources=$test->getSources())) die("Error getting sources");

	   $profileToken=$sources[0][0]['profiletoken'];
	   $ptzNodeToken=$sources[0][0]['ptz']['nodetoken'];

		/*
		$mediaUri=$test->media_GetStreamUri($profileToken);
		echo $mediaUri;
		* 
		$arr_dev = $test->core_GetDeviceInformation();
		foreach ($arr_dev as $key=>$val)
			echo "$key == $val <BR>";
			
		echo "<HR>";

		$arr_caps = $test->core_GetCapabilities();
		foreach ($arr_caps as $key=>$val){
			echo "<b>$key</b> <BR>";         
		    foreach ($val as $k=>$v)
				echo "$k == $v <BR>";
		}
		*/
		
		$speed_x = 0;
		$speed_y = 0;
		$x = 0;
		$y = 0;
		
		switch ($move){
			case 'left':
			case 'right':
			case 'up':
			case 'down':
				if ($move == 'left')  $x = -1;
				if ($move == 'right') $x = 1;
				if ($move == 'up')    $y = 1;
				if ($move == 'down')  $y = -1;
				
	   		$test->ptz_RelativeMove($profileToken, $x, $y, $speed_x, $speed_y);
				echo "moved: $move";				
				break;
				
			case 'zoom-up':
			case 'zoom-down':
				$speedZoom = 1;
				$zoom = 1;
								
				$zoom = $move == 'zoom-up' ? 1 : -1;
				
			   $test->ptz_RelativeMoveZoom($profileToken,$zoom,$speedZoom);
				echo "Zoomed: $move";
				break;
		}
		
		
	} catch (Exception $e) {
		echo 'Exception: ',  $e->getMessage(), "\n";
	}
?>
