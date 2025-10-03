<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/serverAccessController.php";


$response = [];
  
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$txtSLMC           = isset($_REQUEST['txtSLMC'])?trim($_REQUEST['txtSLMC']):null;
$cboGovOfficer           = isset($_REQUEST['cboGovOfficer'])?trim($_REQUEST['cboGovOfficer']):null;
$txtGovInstitute           = isset($_REQUEST['txtGovInstitute'])?trim($_REQUEST['txtGovInstitute']):null;
$checkFullTime	= ($_REQUEST['checkFullTime']?1:0);	
$checkGroup	= ($_REQUEST['checkGroup']?1:0);
$checkIndividual	= ($_REQUEST['checkIndividual']?1:0);
$checkNursingHome	= ($_REQUEST['checkNursingHome']?1:0);
$checkPrivetDental	= ($_REQUEST['checkPrivetDental']?1:0);		
$txtPracHours           = isset($_REQUEST['txtPracHours'])?trim($_REQUEST['txtPracHours']):null;


//---------------------------------------------
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;


$sergDetail = json_decode($_REQUEST['sergDetail'], true);
$communication = json_decode($_REQUEST['communication'], true);
$quelification = json_decode($_REQUEST['quelification'], true);

// =======================================================
//         Insert
// =======================================================
if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
      //Update data to transaction header*******************************************
      $sql="update `fpds_staff_information`
            set
					st_info_slmc_reg_no        ='$txtSLMC',
					st_info_is_gov_officer     ='$cboGovOfficer',
					st_info_gov_ins_name       ='$txtGovInstitute',
					st_info_prac_type_full_time='$checkFullTime',
					st_info_prac_type_group    ='$checkGroup',
					st_info_prac_type_induvidual='$checkIndividual',
					st_info_prac_type_nursing_home='$checkNursingHome',
					st_info_prac_type_privet_dental='$checkPrivetDental',
					st_info_hours_of_practice ='$txtPracHours'
            where st_info_institute_id='$id' and st_info_company_id='$userCompanyId'";
    
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;   
	
	if(count($sergDetail)&&$entryId&&$finalResult){
		//==================================Surg detail=============================================
		$sqlDel="delete from fpds_staff_information_surg_detail where seg_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($sergDetail as $detail){
			
			$name		=$detail['txtSurgeonName'];
			$private	=$detail['txtPrivet'];
			$workPlace  =$detail['txtWorkPlace'];
			$privetPracI=$detail['txtPrivetPracI'];
			$privetPracII=$detail['txtPrivetPracII'];
			
			
			 $sqlDetail="insert into fpds_staff_information_surg_detail(seg_detail_institute_id,seg_detail_name,seg_detail_private,seg_detail_work_place,seg_detail_practice_i,seg_detail_practice_ii,seg_detail_created_by,seg_detail_created_on)
			values
			('$entryId','$name','$private','$workPlace','$privetPracI','$privetPracII','$createdBy',now())";
			
			$detailResult=$db->batchQuery($sqlDetail);
			}
		//=================================================================================

		}   
		if(count($communication)&&$entryId&&$finalResult){
		//==================================Surg communication detail=============================================
		$sqlDel="delete from fpds_staff_information_communication_detail where com_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($communication as $detail){
			
			$sugName=$detail['txtDenSergeonName'];
			$gen_no	=$detail['txtGeneralTel'];
			$fax  =$detail['txtFaxNo'];
			$mobile=$detail['txtMobileNo'];
			$email=$detail['txtEmail'];
			
			
			 $sqlDetail="insert into fpds_staff_information_communication_detail(com_detail_institute_id,com_detail_name,com_detail_genaral_no,com_detail_fax_no,com_detail_mobile_no,com_detail_email,com_detail_created_by,com_detail_created_on)
			values
			('$entryId','$sugName','$gen_no	','$fax','$mobile','$email','$createdBy',now())";
			
			$detailResult=$db->batchQuery($sqlDetail);
			}
		//=================================================================================
  }
  
  if(count($quelification)&&$entryId&&$finalResult){
		//==================================Surg qualification detail=============================================
		$sqlDel="delete from fpds_staff_information_qualification_detail where qualification_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($quelification as $detail){
			
			$sugQuName			=$detail['txtSurgName'];
			$qualification_name	=$detail['txtQualification'];
			$basic 				=$detail['txtBasic'];
			$postGraduate		=$detail['txtPostGraduate'];
			$year				=$detail['txtYear'];
			$university  		=$detail['txtUniversity'];
			$country			=$detail['txtCountry'];
			
			$sqlDetail="insert into fpds_staff_information_qualification_detail(qualification_detail_institute_id,qualification_detail_name,qualification_detail_qualification,qualification_detail_basic,qualification_detail_post_graduate,qualification_detail_year,qualification_detail_university,qualification_detail_country,qualification_detail_created_by,qualification_detail_created_on)
			values
			('$entryId','$sugQuName','$qualification_name','$basic','$postGraduate','$year','$university','$country','$createdBy',now())";
			
			$detailResult=$db->batchQuery($sqlDetail);
			}
		//=================================================================================
  }
    


    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
        // commit auto number
//        $clsAutoNo->setAutoNoCommit($autoNoType, $autoNo);
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
        // rollback auto number
//        $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback
    // rollback auto number
//    $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Update

echo json_encode($response);    
?>





