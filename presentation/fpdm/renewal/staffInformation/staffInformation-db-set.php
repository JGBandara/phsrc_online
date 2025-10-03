<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/serverAccessController.php";
//require_once $backwardSeparator.'dataAccess/connector.php';

use classes\cls_auto_number;
use classes\cls_approval;
use presentation\hrm\masterData\classes\cls_hrm_employee_residential;

$model = new cls_hrm_employee_residential($db);

$response = [];
$autoNoType = "employeeResidential";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$checkGroup	= ($_REQUEST['checkGroup']?1:0);
$checkIndividual	= ($_REQUEST['checkIndividual']?1:0);
$checkOther	= ($_REQUEST['checkOther']?1:0);	
$txtPracHours           = isset($_REQUEST['txtPracHours'])?trim($_REQUEST['txtPracHours']):null;


//---------------------------------------------
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);


$officerDetail = json_decode($_REQUEST['officerDetail'], true);
$quelification = json_decode($_REQUEST['quelification'], true);

// =======================================================
//         Insert
// =======================================================
if($requestType=='add'){
  try{
    $db->begin();      
    if(!$intAddx){
      throw new exception('Permission is Denied ...');
    }
    // Number Generation *******************************************
    if($anStatus == "Auto"){
//      $clsAutoNo = new cls_auto_number($db, $userCompanyId, $userLocationId);
//      $autoNo = $clsAutoNo->getAutoNo($autoNoType);
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Em");
    }
    
        //Add data to transaction header*******************************************
    $sql="insert into `fpdm_staff_information`
            ( st_info_institute_id,st_info_slmc_reg_no,st_info_is_gov_officer,st_info_gov_ins_name,st_info_prac_type_full_time,st_info_prac_type_group,st_info_prac_type_induvidual,st_info_prac_type_nursing_home,st_info_prac_type_privet_dental,st_info_hours_of_practice,st_info_status, st_info_company_id, st_info_created_by, st_info_created_on)
              values 
                ('$id','$txtSLMC','$cboGovOfficer','$cboGovOfficer','$txtGovInstitute','$checkFullTime','$checkGroup','$checkIndividual','$checkNursingHome','$checkPrivetDental','$txtPracHours','1', '$companyId', '$createdBy', 'now()')";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;           
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
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
  
} // End If - Insert
// =======================================================
//         Update
// =======================================================
elseif($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    $sql = "select * from fpdm_staff_information where st_info_institute_id='$id' and st_info_company_id='$userCompanyId'";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `fpdm_staff_information`
           		 set
					st_info_prac_type_group    ='$checkGroup',
					st_info_prac_type_induvidual='$checkIndividual',
					st_info_prac_type_other ='$checkOther',
					st_info_hours_of_practice ='$txtPracHours'
            where st_info_institute_id='$id' and st_info_company_id='$userCompanyId'";

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `fpdm_staff_information`
            ( st_info_institute_id,st_info_prac_type_group,st_info_prac_type_induvidual,st_info_prac_type_other,st_info_hours_of_practice,st_info_status, st_info_company_id, st_info_created_by, st_info_created_on)
              values 
                ('$id','$checkGroup','$checkIndividual','$checkOther','$txtPracHours','1','$companyId', '$createdBy', now())";

    }
    
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;   
	
	if(count($officerDetail)&&$entryId&&$finalResult){
		//==================================Surg detail=============================================
		$sqlDel="delete from fpdm_staff_information_officer_detail where off_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($officerDetail as $detail){
			
			$name		=$detail['txtMedName'];
			$category	=$detail['txtCategory'];
			$permanent  =$detail['txtPermanent'];
			$type		=$detail['cboType'];
			
			
			 $sqlDetail="insert into fpdm_staff_information_officer_detail(off_detail_institute_id,off_detail_name,off_detail_category,off_detail_place,off_detail_type,off_detail_created_by,off_detail_created_on)
			values
			('$entryId','$name','$category','$permanent','$type','$createdBy',now())";
			
			$detailResult=$db->batchQuery($sqlDetail);
			}
		//=================================================================================
	}
  if(count($quelification)&&$entryId&&$finalResult){
		//==================================Surg qualification detail=============================================
		$sqlDel="delete from fpdm_staff_information_qualification_detail where qualification_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($quelification as $detail){
			
			$txtDocName			=$detail['txtDocName'];
			$qualification_name	=$detail['txtQualification'];
			$basic 				=$detail['txtBasic'];
			$postGraduate		=$detail['txtPostGraduate'];
			$year				=$detail['txtYear'];
			$university  		=$detail['txtUniversity'];
			$country			=$detail['txtCountry'];
			$txtSlmcNo  		=$detail['txtSlmcNo'];
			$txtSlmcDate		=$detail['txtSlmcDate'];
			
			$sqlDetail="insert into fpdm_staff_information_qualification_detail(qualification_detail_institute_id,qualification_detail_name,qualification_detail_qualification,qualification_detail_basic,qualification_detail_post_graduate,qualification_detail_year,qualification_detail_university,qualification_detail_country,qualification_detail_slmc_no,qualification_detail_slmc_date,qualification_detail_created_by,qualification_detail_created_on)
			values
			('$entryId','$txtDocName','$qualification_name','$basic','$postGraduate','$year','$university','$country','$txtSlmcNo','$txtSlmcDate','$createdBy',now())";
			
			$detailResult=$db->batchQuery($sqlDetail);
			}
		//=================================================================================
  }
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
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
// =======================================================
//         Delete
// =======================================================
elseif($requestType=='delete'){
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `hrm_employee_residential`
          set
            emr_is_deleted = '1',
            emr_deleted_on = '". time()."',
            emr_deleted_by = '$userId'
          where emr_id='$id' and emr_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['id'] 	= $entryId;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} // End If - Delete

echo json_encode($response);    
?>





