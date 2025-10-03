<?php
	//session_start();
//	$userId 	= $_SESSION['userId'];
	//$companyId 	= $_SESSION['headCompanyId'];
	//$x_locationId	= $_SESSION['CompanyID'];
	//$backwardSeperator = "../../../../";
	//include "{$backwardSeperator}dataAccess/Connector.php";
	//ini_set('display_errors',1);
	function sendMessage($senderEmail,$senderName,$reciever,$subject,$body)
	{
		$header .= "Reply-To: " . $senderName . " <" . $senderEmail .">\r\n"; 
		$header .= "Return-Path: " . $senderName . " <" . $senderEmail .">\r\n"; 
		$header .= "From: " . $senderName . " <" . $senderEmail .">\r\n"; 
		$header .= "Organization: efinancer ERP SOLUTIONS\r\n"; 
		$header .= "Content-Type: text/html;charset=ISO-8859-1\r\n";
		
		ini_set("SMTP",'122.255.62.147'/*'122.255.62.147'*/);//122.255.62.147
		ini_set("sendmail_from",$senderEmail);
		$result = mail($reciever, $subject, $body, $header);
		return $result;
		//echo $header;
	}
?>