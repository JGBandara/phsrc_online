<?php
	
	session_start();
	//ini_set('display_errors',1);

	//$db_mail =  new DBManager_mail();
	//$db_mail->SetConnectionString($_SESSION["Server"],$_SESSION["UserName"],$_SESSION["Password"],$_SESSION["Database"]);
	$userId 	= ($_SESSION['userId']==''?2:$_SESSION['userId']);
	$x_locationId	= ($_SESSION['CompanyID']==''?2:$_SESSION['CompanyID']);
	function sendMessage($senderEmail,$senderName,$reciever,$subject,$body)
	{		
		global $db;
		global $userId;
		global $x_locationId;
		
		$body 	 = replace($body);
		$subject = replace($subject);
		
		$sql_final = "INSERT INTO  sys_emailpool (`intLocationId`,strFromName,`strFromEmail`,`strToEmail`,`strMailHeader`,`strEmailBody`,`intEnterUserId`,`dtmEnterDate`) 
		VALUES ('$x_locationId','$senderName','$senderEmail','$reciever','$subject','$body','$userId',now())";
		$db->RunQuery($sql_final);
	}
	
	function replace($value)
	{
		$value = str_replace("'","\'",$value);
		$value = str_replace('"','\"',$value);	
		return $value;
	}
?>