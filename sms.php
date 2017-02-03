<?php

/*
Author : Shafraz Rahim
*/

ini_set('error_log', 'sms-app-error-jedi.log');

include 'lib/SMSSender.php';
include 'lib/SMSReceiver.php';


date_default_timezone_set("Asia/Colombo");


/*** To be filled ****/

$password= "To be filled";

$applicationId = "To be filled";

$serverurl= "To be filled";

 


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
	

	$sender = new SMSSender($serverurl, $applicationId, $password);
	
	
	list($key, $second) = explode(" ",$content);
	
	

 

	
	 if ($second=="go") {
       	
		//Broadcasting A Message
		
	     	$boradmsg = substr($content,7);
       
	     	error_log("Broadcast Message ".$content);
		
	     	$response=$sender->broadcastMessage($boradmsg);


	   }else{

		//Replying to an individual Message
		
	     	error_log("Message received ".$content);
	
	     	$sender->sendMessage("May the force be with you Jedi Master ".$second,$address);

	      
             }


						

	}catch(SMSServiceException $e){

	     	error_log("Passed Exception ".$e);

	
	}

?>
