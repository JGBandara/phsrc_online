<?php
session_start();
$backwardSeparator = "../../../../";
$backwardseperator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';



$response = array('type'=>'', 'msg'=>'');

  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];

//--------------------------------------------


$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

if($requestType=='approve'){
	$id=$_REQUEST['id'];
  try{
    $db->begin();      
    
    
    $sql="update `mcdc_new_registration`
          set
            mcdc_pd_approval = '1',
            mcdc_pd_approved_on =now(),
            mcdc_pd_approved_by = '$userId'
          where mcdc_application_id='$id' ";
                
    $finalResult = $db->singleQuery($sql);
              
    
    if($finalResult){ 
	$response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $db->commit();
	//---------------------------------------------------------------------------------------------------------
		
	$sqlSysUpdate="SELECT
mcdc_new_registration.mcdc_application_id,
mcdc_new_registration.mcdc_owner_name,
mcdc_new_registration.mcdc_owner_relationship,
mcdc_new_registration.mcdc_owner_address,
mcdc_new_registration.mcdc_institute_name,
mcdc_new_registration.mcdc_institute_address,
mcdc_new_registration.mcdc_province_id,
mcdc_new_registration.mcdc_district_id,
mcdc_new_registration.mcdc_pd_approval,
mcdc_staff_information.st_info_institute_id,
mcdc_staff_information.st_info_hours_of_practice,
mcdc_institute_information.ins_info_record_keeping_id,
mcdc_institute_information.ins_info_visiting_speciality_availability,
mcdc_institute_information.ins_info_dental_lab_facility,
mcdc_institute_information.ins_info_x_ray_facility,
mcdc_institute_information.ins_info_emargancy_kit_availability,
mcdc_institute_information.ins_info_other_facility,
mcdc_institute_information.ins_info_owner,
mcdc_institute_information.ins_info_practice_type,
mcdc_institute_information.ins_info_speciality,
mcdc_institute_information.ins_info_disposal_method,
mcdc_institute_information.ins_info_instruments_dressings,
mcdc_payment_detail.payment_detail_institute_id,
mcdc_payment_detail.payment_detail_id,
mcdc_payment_detail.payment_amount,
mcdc_payment_detail.payment_date,
mcdc_payment_detail.payment_branch,
mcdc_payment_detail.payment_type,
mcdc_payment_detail.payment_silp_name,
tbl_district.dis_id,
tbl_district.dis_name,
tbl_province.pro_name,
tbl_record_keep.record_type,
tbl_record_keep.record_keep_id,
tbl_owner.ownership,
mcdc_payment_detail.payment_reg_fee,
mcdc_payment_detail.payment_stamp_fee
FROM
mcdc_new_registration
Left Join mcdc_staff_information ON mcdc_new_registration.mcdc_application_id = mcdc_staff_information.st_info_institute_id
Left Join mcdc_institute_information ON mcdc_new_registration.mcdc_application_id = mcdc_institute_information.ins_info_institute_id
Left Join mcdc_payment_detail ON mcdc_new_registration.mcdc_application_id = mcdc_payment_detail.payment_detail_institute_id
Inner Join tbl_district ON mcdc_new_registration.mcdc_district_id = tbl_district.dis_id
left Join tbl_province ON mcdc_new_registration.mcdc_province_id = tbl_province.pro_id
left Join tbl_record_keep ON mcdc_institute_information.ins_info_record_keeping_id = tbl_record_keep.record_keep_id
left Join tbl_owner ON mcdc_institute_information.ins_info_owner = tbl_owner.ownership_id

";
	$result=$db->singleQuery($sqlSysUpdate);
	while($row=mysqli_fetch_array($result)){
		 $applicationId=$row['mcdc_application_id'];
		$ownerName=$row['mcdc_owner_name'];
		$relationsip=$row['mcdc_owner_relationship'];
		$owAddress=$row['mcdc_owner_address'];
		$insName=$row['mcdc_institute_name'];
		$insAddress=$row['mcdc_institute_address'];
		$telNo='';
		$fax='';
		$email='';
		$web='';
		$date='2019-10-10';
		$description='';
		$provinceId= $row['mcdc_province_id'];
		$distrctId= $row['mcdc_district_id'];
		$approvalStatus=$row['mcdc_pd_approval'];
		//------------------------------------------------------------------------------------------------
		$slmc=$row['st_info_slmc_reg_no'];
		$intDisplay='0';
		$intClouse='0';
		$intBo='0';
		$intBio='0';
		$bisRegistration='0';
		$is_gov_officer=$row['st_info_is_gov_officer'];
		$gov_is_name=$row['st_info_gov_ins_name'];
		$prcticeHR= $row['st_info_hours_of_practice'];
		//------------------------------------------------------------------------------------------------
		$recordKeep=$row['record_keep_id'];
		$speciality_availability=$row['ins_info_visiting_speciality_availability'];
		$lab_facility=$row['ins_info_dental_lab_facility'];
		$x_ray_facility= $row['ins_info_x_ray_facility'];
		$em_kit_availability=$row['ins_info_emargancy_kit_availability'];
		$other_facility=$row['ins_info_other_facility'];
		$ownrShip=$row['ins_info_owner'];
		$annalFee='10000';
		$prac_type= $row['ins_info_practice_type'];
		$speciality_info=$row['ins_info_speciality'];
		$disposal_method=$row['ins_info_disposal_method'];
		$instrument_dressings=$row['ins_info_instruments_dressings'];
		//------------------------------------------------------------------------------------------------
		$payAmont=$row['payment_amount'];
		$payDate=$row['payment_date'];
		$payRegAmount=$row['payment_reg_fee'];
		$payStampAmount=$row['payment_stamp_fee'];
		$payRegYear='2020';
		$payType= $row['payment_type'];
		$payImageName=$row['payment_silp_name'];
		//------------------------------------------------------------------------------------------------
		}
	//------------------------------------------------------------------------------------------------
	include "{$backwardseperator}dataAccess/misconnector.php";
	$lenght=10;
		$min =9;
	
	$sql="SELECT MAX(CAST(SUBSTRING(reg_no, $lenght, length(reg_no)-$min) AS UNSIGNED)) AS serial FROM reg_ins_comm
	where is_deleted='0' and reg_no  like '%PHSRC/MC%'";
	$result = mysqli_query($conn,$sql);
	
	while($row=mysqli_fetch_array($result))
		{
			 $serial = $row['serial'];
		}
		 $newRegNo='PHSRC/MC/'.++$serial;
	
echo $sql="INSERT INTO reg_ins_comm (mainCat_id, subCat_id, ins_name, reg_no, address, telephone, fax, email, web, Start_date, discription, is_slmc_mem, slmc_no, is_display_web, is_close, is_board_issued, is_bio_reg, bis_registration, hours_of_prctices, province_id, district_id, ownership_type, record_keeping, price_cat_id, annual_fee,created_by,created_date,is_deleted) VALUES ('2','0','$insName','$newRegNo','$address','$telNo','$fax','$email','$web','$date','$description',1,'$slmc',$intDisplay,$intClouse,$intBo,$intBio,'$bisRegistration','$prcticeHR',$provinceId,$distrctId,$ownrShip,$recordKeep,2,$annalFee,'0',now(),0)";
		$result =mysqli_query($conn,$sql);
		$lastId=$conn -> insert_id;
		
		if($result){
			
			
			$sqlReceipt="SELECT MAX(recipt_id)+1 AS reciptNo FROM pay_recept_print";
		$result=mysqli_query($conn,$sqlReceipt);
		while($row=mysqli_fetch_array($result)){

			$recept_no=$row['reciptNo'];
			}
			
			$insId=$lastId;
		$dateVal = $payDate;
		$insAmount= $payAmont;
		//$mainCat=$_REQUEST['mainCatVal'];
		$yearVal = $payRegYear;
		$insRefVal= 'ONLINE';
		$insRegVal=$newRegNo;
		$payTypVal = $payType;
		$addressVal= $_REQUEST['addressVal'];
		$amountFiVal=$_REQUEST['amountFiVal'];
		$reciptVal= $recept_no;
		$chqVal='';
		$amountVal=$payAmont;
		$regAmount=$payRegAmount;
		$stampAmount=$payStampAmount;
		
       $sql="INSERT INTO pay_recept_print  (reg_id,reg_no,reg_year,reg_date,recipt_no,our_ref,pay_type,cheque_no,reg_amount,stamp_amount,amount_text,amount,is_submit,is_print,is_deleted,created_date)VALUE('$insId','$insRegVal','$yearVal','$dateVal','$reciptVal','$insRefVal','$payTypVal','$chqVal','$regAmount','$stampAmount','$insAmount','$amountVal','1',0,'0',now())";
	   
	   $finalResult=mysqli_query($conn,$sql);
			
			}
		
		mysqli_close($conn);
	//---------------------------------------------------------------------------------------------------------
	
	
	
	                   
        
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
   echo json_encode($response);         
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage();
    $response['q'] 		= $sql;                
  }
   
} else if($requestType=='reject'){
	$id=$_REQUEST['id'];
  try{
    $db->begin();      
    
    
    $sql="update `mcdc_new_registration`
          set
            mcdc_pd_approval = '2',
            mcdc_pd_approved_on =now(),
            mcdc_pd_approved_by = '$userId'
          where mcdc_application_id='$id' ";
                
    $finalResult = $db->singleQuery($sql);
              
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
   echo json_encode($response);         
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage();
    $response['q'] 		= $sql;                
  }
   
} 

  

?>





