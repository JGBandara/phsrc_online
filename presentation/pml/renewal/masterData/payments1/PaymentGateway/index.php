<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
session_start();
$backwardSeparator = "../../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];
$insId= $_SESSION['insId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';
$sql="SELECT
payment_reg_year, 
payment_reg_fee,
payment_stamp_fee,
payment_amount
FROM
institute_payment_detail
where payment_detail_institute_id=$insId
          order by payment_detail_institute_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$payregFee =$row['payment_reg_fee'];
                $paystFee  =$row['payment_stamp_fee'];
                $payAmount  =$row['payment_amount'];
		
		}

?>
<html>

    <!-- <link rel="stylesheet" type="text/css" href="../assets/paymentstyle.css" /> -->

    <head>
        <title>Return to Merchant</title>
        <meta http-equiv="Content-Type" content="text/html, charset=iso-8859-1">
        <link href="../../../../../../css/sb-admin-2.css" rel="stylesheet"/>
    </head>

    <body oncontextmenu="return false">

			<p style="text-align:center;"><a href="./index.php"><img src="../../../../../../img/core/Capture.JPG" /></a></p>


        		<form action="./HostedCheckoutReturnToMerchant_NVP.php" method="post">
				<div style="border:5;border-color:#03C">
       	 		<table width="60%" align="center" cellpadding="5" >

            <!-- Credit Card Fields -->
            <!--<tr class="title">
            	
            <td align="center" colspan="2" height="25"><h1><strong>Hosted Checkout - Return to Merchant - PHP/JavaScript/NVP</strong></h1></td>
            </tr>-->
            <br><br><!--<br><br>-->
            <td align="center" colspan="2" height="25"><h2><strong>Payment Details</strong></h2></td>
          
          	<tr class="shade">
                <td align="left"><strong>Registration Fee </strong></td>
                <td><input type="text" class="form-control form-control-sm" name="order.regAmount" value="<?php echo $payregFee;?>" size="8" maxlength="13" readonly style="text-align:right"/></td>
            </tr>
            
            <tr class="shade">
                <td align="left"><strong>Stamp Fee </strong></td>
                <td><input type="text" class="form-control form-control-sm" name="order.stampAmount" value="<?php echo $paystFee;?>" size="8" maxlength="13" readonly style="text-align:right"/></td>
            </tr>
            
            <tr class="shade">
                <td align="left"><strong>Clearing Balance </strong></td>
                <td><input type="text" class="form-control form-control-sm" name="order.amount" value="<?php echo $payAmount;?>" size="8" maxlength="13" readonly style="text-align:right"/></td>
            </tr>

            <tr>
                <td align="left"><strong>Order Currency </strong></td>
                <td><input type="text" name="order.currency" class="form-control form-control-sm" value="LKR" size="8" maxlength="3" readonly/></td>
                
                <tr>
                <td align="left"><strong>Customer Email Receipt Address</strong></td>
                <td><input type="email" name="customer_receipt_email" class="form-control form-control-sm" value="" size="20" maxlength="200" required/></td>
            </tr>
            
            <tr>
                <td colspan="2"><center><input type="submit" name="submit" class="btn btn-success" value="Check Order and Proceed to Payment"/></center></td>
            </tr>

        </table>
</div>
        </form>
        <br/><br/>
<center><h5>Copyright ©<?php echo date("Y"); ?>&nbsp; : Sri Lanka Telecom[Services] Limited. All Rights Reserved</h5></center>
    </body>
</html>
