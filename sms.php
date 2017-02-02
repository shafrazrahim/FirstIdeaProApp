<?php

/*
Author : Shafraz Rahim
*/

ini_set('error_log', 'sms-app-error-jedi.log');

include 'lib/SMSSender.php';
include 'lib/SMSReceiver.php';


date_default_timezone_set("Asia/Colombo");


/*** To be filled ****/

$password= <to be filled>;

$applicationId = <to be filled>;

$serverurl= <to be filled>;

 


try{
	/*************************************************************/
	$receiver = new SMSReceiver(file_get_contents('php://input'));
	$content =$receiver->getMessage();
	$content=preg_replace('/\s{2,}/',' ', $content); 
	$address = $receiver->getAddress();
	$address = $receiver->getAddress();
	$requestId = $receiver->getRequestID();
	$applicationId = $receiver->getApplicationId();
	/*************************************************************/
	

	$sender = new SMSSender( $serverurl, $applicationId, $password);
	
	
	list($key, $second) = explode(" ",$content);
	
	

 

	
	 if ($second=="go") {
       	
		//Broadcasting A Message
		
	     	$boradmsg = substr($content,10);
       
	     	error_log("Broadcast Message ".$content);
		
	     	$response=$sender->broadcastMessage($boradmsg);


	   }elseif ($second==""){

		//Replying to an individual Message
		
	     	error_log("Message received ".$content);
	
	     	$sender->sendMessage($reply, $address);

	      
	}


						


	}catch(SMSServiceException $e){

	     	error_log("Passed Exception ".$e);

	
	}

?>