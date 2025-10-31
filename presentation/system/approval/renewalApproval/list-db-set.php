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

$sql="SELECT
institute_registration.ins_application_id,
institute_registration.ins_mobile,
institute_registration.institute_reg_id

FROM
institute_registration
where institute_registration.ins_application_id=$id";
$result=$db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
	$newMobile=$row['ins_mobile'];
	$lastId=$row['institute_reg_id'];
}



	 $msg="Your application Approved by PDHS.
	 
	 More information please contact PDHS office.";
	
	 require_once $backwardSeparator.'classes/ESMSWS.php';
$session=createSession('','esmsusr_1f7m','3esotc9','');
sendMessages($session,'PHSRC',$msg,array($newMobile),1);  
closeSession($session);
  try{
    $db->begin();      

 $sql="update `institute_payment_detail`
          set
            payment_is_approval = '1'
          where payment_detail_institute_id='$id'";
                
    $finalResult = $db->singleQuery($sql);
              
    
    if($finalResult){ 
	$response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $db->commit();
	//---------------------------------------------------------------------------------------------------------
		
	 $sqlSysUpdate="SELECT
institute_registration.ins_application_id,
institute_registration.ins_type_id,
institute_registration.ins_owner_name,
institute_registration.ins_owner_relationship,
institute_registration.ins_owner_offic_address,
institute_registration.ins_owner_address,
institute_registration.ins_institute_name,
institute_registration.ins_institute_address,
institute_registration.ins_telephone,
institute_registration.ins_email,
institute_registration.ins_website,
institute_registration.ins_province_id,
institute_registration.ins_district_id,
institute_information.ins_info_institute_id,
institute_information.ins_date_of_stablishment,
institute_information.ins_br_no,
institute_information.ins_boi_registration,
institute_information.ins_is_pvt_hospital,
institute_information.ins_is_nursing_home,
institute_information.ins_is_mat_home,
institute_information.ins_is_medical_center,
institute_information.ins_is_screen_center,
institute_information.ins_is_day_care,
institute_information.ins_is_automated,
institute_information.ins_is_channel_consultation,
institute_information.ins_is_semi_automated,
institute_information.ins_is_mobile_lab,
institute_information.ins_is_collecting_center,
institute_information.ins_is_group,
institute_information.ins_is_individual,
institute_information.ins_is_fulltime,
institute_information.ins_other,
institute_information.ins_is_pub_company,
institute_information.ins_is_pvt_company,
institute_information.ins_is_pro_pvt_hospital,
institute_information.ins_is_co_hospital,
institute_information.ins_is_std_hospital,
institute_information.ins_is_com_base,
institute_information.ins_is_manual,
institute_information.ins_is_pvt_hs_ns_home,
institute_information.ins_own_other,
institute_information.ins_practice_hr,
institute_information.ins_company_type,
institute_staff_information.st_info_id,
institute_staff_information.st_info_institute_id,
institute_staff_information.st_info_prac_type_group,
institute_staff_information.st_info_prac_type_induvidual,
institute_staff_information.st_info_prac_type_other,
institute_staff_information.st_info_slmc_reg_no,
institute_staff_information.st_info_hours_of_practice,
institute_staff_information.st_info_is_gov_officer,
institute_staff_information.st_info_gov_ins_name,
institute_facility.ins_faci_id,
institute_facility.ins_faci_institute_id,
institute_facility.ins_no_of_bed,
institute_facility.ins_no_of_room,
institute_facility.ins_no_of_ward,
institute_facility.ins_radio_service,
institute_facility.ins_no_of_license,
institute_facility.ins_waste_disposal,
institute_facility.ins_inst_dress,
institute_facility.ins_emergency_kit,
institute_facility.ins_no_of_ambulance,
institute_facility.ins_am_modal,
institute_facility.ins_health_staff,
institute_facility.ins_rmv_reg,
institute_payment_detail.payment_detail_id,
institute_payment_detail.payment_detail_institute_id,
institute_payment_detail.payment_reg_year,
institute_payment_detail.payment_reg_fee,
institute_payment_detail.payment_amount,
institute_payment_detail.payment_stamp_fee,
institute_payment_detail.payment_date,
institute_payment_detail.payment_branch,
institute_payment_detail.payment_silp_name,
institute_payment_detail.payment_type,
institute_payment_detail.payment_reg_type_id,
institute_payment_detail.payment_is_approval,
institute_payment_detail.payment_online_payment_order_id,
institute_payment_detail.payment_online_payment_on,
institute_payment_detail.paymet_is_success
FROM
institute_registration
left Join institute_information ON institute_registration.ins_application_id = institute_information.ins_info_institute_id
left Join institute_staff_information ON institute_registration.ins_application_id = institute_staff_information.st_info_institute_id
left Join institute_facility ON institute_registration.ins_application_id = institute_facility.ins_faci_institute_id
left Join institute_payment_detail ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id
where institute_registration.ins_application_id=$id
limit 1

";
	$result=$db->singleQuery($sqlSysUpdate);
	while($row=mysqli_fetch_array($result)){
            
                $insType=$row['ins_type_id'];
            
            
		$applicationId=$row['ins_application_id'];
		$ownerName=$row['fpds_owner_name'];
		$relationsip=$row['fpds_owner_relationship'];
		$owAddress=$row['fpds_owner_address'];
		$insName=$row['ins_institute_name'];
		$insAddress=$row['ins_institute_address'];
		$telNo=$row['ins_telephone'];
		$fax='';
		$email=$row['ins_email'];
		$web=$row['ins_website'];
		$date=$row['ins_date_of_stablishment'];
		$description='';
		$br_no=$row['ins_br_no'];
        $prc_hr=$row['ins_practice_hr'];
		$provinceId= $row['ins_province_id'];
		$distrctId= $row['ins_district_id'];
        $anuFee=$row['payment_reg_fee'];
		$approvalStatus=$row['fpds_pd_approval'];
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

        
        if($insType==1){
           $mainCat_id=1; 
           $prf='PHSRC/PH/';
           $lenght=10;
		$min =9;
            
        }
        
	//$lenght=11;
	//$min =10;
	
	$sql="SELECT MAX(CAST(SUBSTRING(reg_no, $lenght, length(reg_no)-$min) AS UNSIGNED)) AS serial FROM reg_ins_comm
	where is_deleted='0' and reg_no  like '%$prf%'";
	//$result = mysqli_query($conn,$sql);
	
	while($row=mysqli_fetch_array($result))
		{
			 $serial = $row['serial'];
		}
		$newRegNo=$prf.++$serial;
	
/* $sql="INSERT INTO reg_ins_comm (mainCat_id, subCat_id, ins_name, reg_no, address, telephone, fax, email, web, Start_date, discription, is_slmc_mem, slmc_no, is_display_web, is_close, is_board_issued, is_bio_reg, bis_registration, hours_of_prctices, province_id, district_id, ownership_type, record_keeping, price_cat_id, annual_fee,created_by,created_date,is_deleted) VALUES ('5','0','$insName','$newRegNo','$address','$telNo','$fax','$email','$web','$date','$description',1,'$slmc',$intDisplay,$intClouse,$intBo,$intBio,'$bisRegistration','$prcticeHR',$provinceId,$distrctId,$ownrShip,$recordKeep,5,$annalFee,'0',now(),0)";*/
//   $sql="INSERT INTO reg_ins_comm (mainCat_id, subCat_id, ins_name, reg_no, address, telephone, fax, email, web, Start_date, discription, is_slmc_mem, slmc_no, is_display_web, is_close, is_board_issued, is_bio_reg, bis_registration, hours_of_prctices, province_id, district_id, ownership_type, record_keeping, price_cat_id, annual_fee,created_by,created_date,is_deleted,online_application_id) VALUES ($mainCat_id,'0','$insName','$newRegNo','$insAddress','$telNo','','$email','$web',now(),'',0,'',1,0,0,0,'$br_no','$prc_hr',$provinceId,$distrctId,1,1,1,'$anuFee',1,now(),0,$applicationId)
//   ";

 $sql="update reg_ins_comm set
  mainCat_id='$mainCat_id',
  ins_name='$insName',
  address='$insAddress',
  telephone='$telNo',
  fax='',
  email='$email',
  web='$web',
  Start_date='$date',
  discription='$descriptio',
  is_slmc_mem='0',
  slmc_no='',
  is_display_web='1',
  is_close='0',
  is_board_issued='0',
  is_bio_reg='0',
  bis_registration='$br_no',
  hours_of_prctices='$prc_hr',
  province_id='$provinceId',
  district_id='$distrctId',
  ownership_type='$ownrShip',
  record_keeping='$recordKeep',
  annual_fee='$payAmont' where institute_id='$lastId'"; 
		$result =mysqli_query($conn,$sql);
		//$lastId=$conn -> insert_id;
                
                
                
		
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
              $sqlFaci="SELECT
institute_facility_detail.facility_detail_institute_id,
institute_facility_detail.facility_id,
institute_facility_detail.facility_detail_value,
institute_facility_detail.facility_description
FROM
institute_facility_detail where institute_facility_detail.facility_detail_institute_id=$id";
                $resultf=$db->singleQuery($sqlFaci);
	while($row=mysqli_fetch_array($resultf)){
                    $Facility		= $row['facility_id'];
		   $Value 	        = $row['facility_detail_value'];
		   $Discription	        = $row['facility_description'];
            include "{$backwardseperator}dataAccess/misconnector.php";
            
                   
					
					 $sql = "INSERT INTO reg_ins_faci (institute_id,facility,value,description,created_by,created_date) 
				VALUES ($lastId,$Facility,'$Value','$Discription',1,now())";
				
					$result =mysqli_query($conn,$sql);
                                        
                                        mysqli_close($conn);
            
        }
        
        
        
 $sqlSt="SELECT
institute_staff_information_stf_detail.institute_id,
institute_staff_information_stf_detail.Name,
institute_staff_information_stf_detail.Qulification,
institute_staff_information_stf_detail.institute,
institute_staff_information_stf_detail.country,
institute_staff_information_stf_detail.post_gradu,
institute_staff_information_stf_detail.speciality,
institute_staff_information_stf_detail.Register_id
FROM
institute_staff_information_stf_detail where institute_staff_information_stf_detail.institute_id=$id";
                $resultf=$db->singleQuery($sqlSt);
	while($row=mysqli_fetch_array($resultf)){
                        $Name		= $row['Name'];
                        $Qulifications 	= $row['Qulification'];
			$Institute	= $row['institute'];
			$Country	= $row['country'];
			$PostGraduate 	= $row['post_gradu'];
			$Speciality	= $row['speciality'];
			$Registerd	= $row['Register_id'];
            include "{$backwardseperator}dataAccess/misconnector.php";
            

					
					$sql = "INSERT INTO reg_ins_doctor (institute_id,Name,Qulification,institute,country,post_gradu,speciality,Register_id,created_by,created_date) 
				VALUES ($lastId,'$Name','$Qulifications','$Institute','$Country','$PostGraduate','$Speciality','$Registerd',1,now())";
				
					$result =mysqli_query($conn,$sql);
                                        
                                        mysqli_close($conn);
            
        }
                
        
         $sqlMan="SELECT
		 institute_staff_information_managment_detail.institute_id,
institute_staff_information_managment_detail.position_id,
institute_staff_information_managment_detail.name,
institute_staff_information_managment_detail.contact_detail,
institute_staff_information_managment_detail.info
FROM
institute_staff_information_managment_detail where institute_staff_information_managment_detail.institute_id=$id";
                $resultf=$db->singleQuery($sqlMan);
	while($row=mysqli_fetch_array($resultf)){
                        $Position		= $row['position_id'];
			$Name 			= $row['name'];
			$Contact	        = $row['contact_detail'];
			$Information	        = $row['info'];
            include "{$backwardseperator}dataAccess/misconnector.php";
            

					
			$sql = "INSERT INTO reg_ins_managment (institute_id,position_id,name,contact_detail,info,created_by,created_date) 
				VALUES ($lastId,'$Position','$Name','$Contact','$Information',1,now())";
				
					$result =mysqli_query($conn,$sql);
                                        
                                        mysqli_close($conn);
            
        }
                
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
	$txtRemark=$_REQUEST['txtRemark'];

	$sql="SELECT
institute_registration.ins_application_id,
institute_registration.ins_mobile
FROM
institute_registration
where institute_registration.ins_application_id=$id";
$result=$db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
	$newMobile=$row['ins_mobile'];
}
	
$msg="Your application Rejected by PDHS.
	 
More information please contact PDHS office.";

	 require_once $backwardSeparator.'classes/ESMSWS.php';
$session=createSession('','esmsusr_1f7m','3esotc9','');
sendMessages($session,'PHSRC',$msg,array($newMobile),1); // 1 for promotional messages, 0 for normal message 
closeSession($session);

  try{
    $db->begin();      
    
    
    $sql="update `institute_payment_detail`
          set
            payment_is_approval = '2',
			reject_remark='$txtRemark'
          where payment_detail_institute_id='$id'";
                
    $finalResult = $db->batchQuery($sql);
              
    
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





