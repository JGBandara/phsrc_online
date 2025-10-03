
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
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



$facilityDetail = json_decode($_REQUEST['facilityDetail'], true);

if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    
    
    $entryId = $id;   
	
	if(count($facilityDetail)&&$entryId){
		//==================================Surg detail=============================================
		$sqlDel="delete from fpdm_facility_detail where facility_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($facilityDetail as $detail){
			
			$facilityId		=$detail['cbofacility'];
			$value	=$detail['txtValue'];
			$Distription  =$detail['txtDiscription'];
			
			
			 $sqlDetail="insert into fpdm_facility_detail(facility_detail_institute_id,facility_id,facility_detail_value,facility_description)
			values
			('$entryId','$facilityId','$value','$Distription')";
			
			$detailResult=$db->batchQuery($sqlDetail);
			}
		//=================================================================================

		
  }
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($detailResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
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
    $response['msg'] 		= $e->getMessage();
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





