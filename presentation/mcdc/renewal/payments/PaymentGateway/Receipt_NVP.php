
<?php
$backwardseperator = "../../../../../";
$backwardSeparator = "../../../../../";
session_start();

include "api_lib.php";
include "configuration.php";
include "connection.php";

error_reporting(E_ALL);

$errorMessage = "";
$errorCode = "";
$gatewayCode = "";
$result = "";

$responseArray = array();

$resultInd =  $_GET["resultIndicator"];
$successInd = $_SESSION['successIndicator']; 

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <link rel="stylesheet" type="text/css" href="assets/paymentstyle.css" />
    <head>
      <title>DirectApi Example</title>
      <meta http-equiv="Content-Type" content="text/html, charset=iso-8859-1">
      <link href="../../../../../css/sb-admin-2.css" rel="stylesheet"/>
    </head>
    
    <body>

		<div class="col-md-12"><p style="text-align:center;"><a href="./index.html"><img src="../../../../../img/core/Capture.JPG" alt="Main Order Home Page" /></a></p>
    <center><h1 style="color:#096"><br/>Payment Receipt</h1></center></div>
 
    
<?php

if (strcmp($resultInd, $successInd) == 0)
	{
	$msg='<span style="color:#390"><b>Your Payment was successful!</b></span>';	
	//------------------------------------------------------------------------------------------------
	require_once $backwardSeparator.'dataAccess/connector.php';
		
	$sqlPymentUpdate="UPDATE fpds_payment_detail SET
	payment_is_approval='1',
	payment_online_payment_order_id='dsdfsgdfsgdts',
	payment_online_payment_on=now(),
	paymet_is_success='1'
	where payment_detail_institute_id='1'";
	$result=$db->singleQuery($sqlPymentUpdate);
		
		
	$sqlSysUpdate="SELECT
fpds_new_registration.fpds_application_id,
fpds_new_registration.fpds_owner_name,
fpds_new_registration.fpds_owner_relationship,
fpds_new_registration.fpds_owner_address,
fpds_new_registration.fpds_institute_name,
fpds_new_registration.fpds_institute_address,
fpds_new_registration.fpds_province_id,
fpds_new_registration.fpds_district_id,
fpds_new_registration.fpds_pd_approval,
fpds_staff_information.st_info_institute_id,
fpds_staff_information.st_info_slmc_reg_no,
fpds_staff_information.st_info_is_gov_officer,
fpds_staff_information.st_info_gov_ins_name,
fpds_staff_information.st_info_hours_of_practice,
fpds_institute_information.ins_info_record_keeping_id,
fpds_institute_information.ins_info_visiting_speciality_availability,
fpds_institute_information.ins_info_dental_lab_facility,
fpds_institute_information.ins_info_x_ray_facility,
fpds_institute_information.ins_info_emargancy_kit_availability,
fpds_institute_information.ins_info_other_facility,
fpds_institute_information.ins_info_owner,
fpds_institute_information.ins_info_practice_type,
fpds_institute_information.ins_info_speciality,
fpds_institute_information.ins_info_disposal_method,
fpds_institute_information.ins_info_instruments_dressings,
fpds_payment_detail.payment_detail_institute_id,
fpds_payment_detail.payment_detail_id,
fpds_payment_detail.payment_amount,
fpds_payment_detail.payment_date,
fpds_payment_detail.payment_branch,
fpds_payment_detail.payment_type,
fpds_payment_detail.payment_silp_name,
fpds_staff_information.st_info_prac_type_privet_dental,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership
FROM
fpds_new_registration
Left Join fpds_staff_information ON fpds_new_registration.fpds_application_id = fpds_staff_information.st_info_institute_id
Left Join fpds_institute_information ON fpds_new_registration.fpds_application_id = fpds_institute_information.ins_info_institute_id
Left Join fpds_payment_detail ON fpds_new_registration.fpds_application_id = fpds_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON fpds_new_registration.fpds_district_id = tbl_district.dis_id
left Join tbl_province ON fpds_new_registration.fpds_province_id = tbl_province.pro_id
left Join tbl_record_keep ON fpds_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON fpds_institute_information.ins_info_owner = tbl_owner.ownership_id

";
	$result=$db->singleQuery($sqlSysUpdate);
	while($row=mysqli_fetch_array($result)){
		 $applicationId=$row['fpds_application_id'];
		$ownerName=$row['fpds_owner_name'];
		$relationsip=$row['fpds_owner_relationship'];
		$owAddress=$row['fpds_owner_address'];
		$insName=$row['fpds_institute_name'];
		$insAddress=$row['fpds_institute_address'];
		$province= $row['pro_name'];
		$district= $row['dis_name'];
		$approvalStatus=$row['fpds_pd_approval'];
		//------------------------------------------------------------------------------------------------
		$slmc=$row['st_info_slmc_reg_no'];
		$is_gov_officer=$row['st_info_is_gov_officer'];
		$gov_is_name=$row['st_info_gov_ins_name'];
		$prac_houre= $row['st_info_hours_of_practice'];
		//------------------------------------------------------------------------------------------------
		$rec_keeping=$row['record_type'];
		$speciality_availability=$row['ins_info_visiting_speciality_availability'];
		$lab_facility=$row['ins_info_dental_lab_facility'];
		$x_ray_facility= $row['ins_info_x_ray_facility'];
		$em_kit_availability=$row['ins_info_emargancy_kit_availability'];
		$other_facility=$row['ins_info_other_facility'];
		$ownership=$row['ownership'];
		$prac_type= $row['ins_info_practice_type'];
		$speciality_info=$row['ins_info_speciality'];
		$disposal_method=$row['ins_info_disposal_method'];
		$instrument_dressings=$row['ins_info_instruments_dressings'];
		//------------------------------------------------------------------------------------------------
		$payAmont=$row['payment_amount'];
		$payDate=$row['payment_date'];
		$payBranch=$row['payment_branch'];
		$payType= $row['payment_type'];
		$payImageName=$row['payment_silp_name'];
		//------------------------------------------------------------------------------------------------
		}
	//------------------------------------------------------------------------------------------------
	include "{$backwardseperator}dataAccess/misconnector.php";
	$lenght=11;
	$min =10;
	
	$sql="SELECT MAX(CAST(SUBSTRING(reg_no, $lenght, length(reg_no)-$min) AS UNSIGNED)) AS serial FROM reg_ins_comm
	where is_deleted='0' and reg_no  like '%PHSRC/FDS%'";
//	$result = mysqli_query($conn,$sql);
	
	while($row=mysqli_fetch_array($result))
		{
			 $serial = $row['serial'];
		}
	//	echo $newRegNo='PHSRC/FDS/'.++$serial;
	
	
	$sql="INSERT INTO reg_ins_comm (mainCat_id, subCat_id, ins_name, reg_no, address, telephone, fax, email, web, Start_date, discription, is_slmc_mem, slmc_no, is_display_web, is_close, is_board_issued, is_bio_reg, bis_registration, hours_of_prctices, province_id, district_id, ownership_type, record_keeping, price_cat_id, annual_fee,created_by,created_date,is_deleted) VALUES ($mainCat,$subCat,'$insName','$$newRegNo','$address','$telNo','$fax','$email','$web','$date','$description',1,'$slmc',$intDisplay,$intClouse,$intBo,$intBio,'$bisRegistration','$prcticeHR',$provinceId,$distrctId,$ownrShip,$recordKeep,$priceCat,$annalFee,$userId,now(),0)";
		//$result =mysqli_query($conn,$sql);
		
		mysqli_close($conn);
		
	
	
	//------------------------------------------------------------------------------------------------
?>
		 <!--<tr class="title">
             <td colspan="2" height="25"><P><strong>&nbsp;</strong></P></td>
         </tr>
         <tr>
             <td align="right" width="50%"><strong><center><h1>Your Payment was successful!</h1></center></strong></td>
         </tr> -->   
<?php

	}
	else
	{
		$msg='<span style="color:#390"><b>Your Payment was Unsuccessful!</b></span>';
		require_once $backwardSeparator.'dataAccess/connector.php';
		
	$sqlPymentUpdate="UPDATE fpds_payment_detail SET
	payment_is_approval='0',
	payment_online_payment_order_id='dsdfsgdfsgdts',
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
         
     <center> <a href="../../../../../main.php"><button class="btn btn-info">Return to the Home Page</button></a></center>
		<!--<h2 align="center"><a href="http://localhost/MPGS/HC/index.html">Return to the Main Order Page</a></h2>-->

    </body>
<html>