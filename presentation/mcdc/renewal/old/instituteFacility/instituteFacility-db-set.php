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
		$sqlDel="delete from fpds_facility_detail where facility_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($facilityDetail as $detail){
			
			$facilityId		=$detail['cbofacility'];
			$value	=$detail['txtValue'];
			$Distription  =$detail['txtDiscription'];
			
			
			 $sqlDetail="insert into fpds_facility_detail(facility_detail_institute_id,facility_id,facility_detail_value,facility_description)
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

echo json_encode($response);    
?>





