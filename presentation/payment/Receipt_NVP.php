
<?php
$backwardseperator = "../../";
$backwardSeparator = "../../";
session_start();
$institute_id=$_SESSION['institute_id'];
$userId 	= $_SESSION['loginId'];
$insId=$_SESSION['insId'];
$payYear=$_SESSION['regYear'];
include "api_lib.php";
include "configuration.php";
include "connection.php";
require_once $backwardSeparator.'dataAccess/connector.php';

error_reporting(E_ALL);

$errorMessage = "";
$errorCode = "";
$gatewayCode = "";
$result = "";

$responseArray = array();

$resultInd =  $_GET["resultIndicator"];
$successInd = $_SESSION['successIndicator']; 

?>
 <?php
   
   $orderID = $_SESSION['orderID'];
	 
	 $merchantObj = new Merchant($configArray);

	 $parserObj = new Parser($merchantObj);

	 $requestUrl = $parserObj->FormRequestUrl($merchantObj);

	 $request_assoc_array = array("apiOperation"=>"RETRIEVE_ORDER",
														 		"order.id"=>$orderID
														 );
	 
	 $request = $parserObj->ParseRequest($merchantObj, $request_assoc_array);
	 $response = $parserObj->SendTransaction($merchantObj, $request);
	 
	 $new_api_lib = new api_lib;
	 $parsed_array = $new_api_lib->parse_from_nvp($response);
	 
   ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <link rel="stylesheet" type="text/css" href="assets/paymentstyle.css" />
    <head>
      <title>DirectApi Example</title>
      <meta http-equiv="Content-Type" content="text/html, charset=iso-8859-1">
      <link href="../../css/sb-admin-2.css" rel="stylesheet"/>
    </head>
    
    <body>

		<div class="col-md-12"><p style="text-align:center;"><a href="./index.php.html"><img src="../../img/core/Capture.JPG" alt="Main Order Home Page" /></a></p>
    <center><h1 style="color:#096"><br/>Payment Receipt</h1></center></div>
 
    
<?php

if (strcmp($resultInd, $successInd) == 0)
	{
    
	$msg='<span style="color:#390"><b>Your Payment was successful!</b></span>';	
	//------------------------------------------------------------------------------------------------
	
		
	$sql="update `institute_payment_detail`
            set
					payment_online_payment_order_id   ='$orderID',
                                        paymet_is_success='1',
					payment_date     	=now()
            where payment_detail_institute_id='$insId' and payment_reg_year='$payYear'";
	$finalResult = $db->singleQuery($sql);
		

?>
		 <tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><center><h1>Your Payment was successful!</h1></center></strong></td>
         </tr>   
<?php

	}
	else
	{
		$msg='<span style="color:#390"><b>Your Payment was Unsuccessful!</b></span>';
		require_once $backwardSeparator.'dataAccess/connector.php';
		
	$sqlPymentUpdate="UPDATE fpds_payment_detail SET
	payment_is_approval='0',
	payment_online_payment_order_id='',
	payment_online_payment_on=now(),
	paymet_is_success='0'
	where payment_detail_institute_id='1'";
	$result=$db->singleQuery($sqlPymentUpdate);
?>

	<!--<tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><center><h1>Your Payment was Unsuccessful!</h1></center></strong></td>
         </tr>-->
<?php
	}
?>


  <table width="60%" align="center" cellpadding="5" border="0" style="color:">

  <?php
    // echo HTML displaying Error headers if error is found
    if ($errorCode != "" || $errorMessage != "") {
  ?>
      <tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;Error Response</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><i><?=$errorCode?>: </i></strong></td>
             <td width="50%"><?=$errorMessage?></td>
         </tr>
  <?php
    }
    else {
  ?>
      <tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;<?=$gatewayCode?></strong></P></td>
         </tr>
        
  <?php
     }
  ?>
         
  </table>

  <br/><br/>
   
  
   <div class="row"><div class="col-md-3"></div><div class="col-md-6">
  	<table class="table table-bordered" width="60%">

  <tbody>
    <tr>
      <td>Payment Amount</td>
      <td><?php echo $parsed_array['totalAuthorizedAmount'];?></td>
    </tr>
    <tr>
      <td>Payment Currency</td>
      <td><?php echo $parsed_array['currency']; ?></td>
    </tr>
        <tr>
      <td>Order ID</td>
      <td><?php echo $orderID; ?></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo $msg;?></td>

    </tr>
  </tbody>
</table></div><div class="col-md-3"></div></div>

  <!-- <table width="60%" align="center" cellpadding="5" border="0">
   
   	<center>
   		
  			 <tr class="title">
             <td colspan="3" height="25"><center><h1><strong>&nbsp;Payment Details</strong></h1></u></center></td>
         </tr>
         <tr>
             <td colspan="2" height="25" width="100px"><strong>&nbsp;Merchant:</strong></td>
             <td colspan="1" height="25"><center><strong>&nbsp;<?php echo $parsed_array['merchant']; ?></strong></center></td>
         </tr>
          <tr>
             <td colspan="2" height="25"><strong>&nbsp;Order Amount: </strong></td>
             <td colspan="1" height="25"><center><strong>&nbsp;<?php echo $parsed_array['totalAuthorizedAmount']; ?></strong></center></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><strong>&nbsp;Order Currency:  </strong></td><td colspan="1" height="25"><center><strong>&nbsp;<?php echo $parsed_array['currency']; ?></strong></center></td>
         </tr>
         <tr>
             <td colspan="2" height="25"><strong>&nbsp;Order ID:  </strong></td>
             <td colspan="1" height="25"><center><strong>&nbsp;<?php echo $orderID; ?></strong></center></td>
         </tr>
       
         </center>
     </table>-->
         
     <center> <a href="../../main.php"><button class="btn btn-info">Return to the Home Page</button></a></center>
		<!--<h2 align="center"><a href="http://localhost/MPGS/HC/index.html">Return to the Main Order Page</a></h2>-->

    </body>
<html>