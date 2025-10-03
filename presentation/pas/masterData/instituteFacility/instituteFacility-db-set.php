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
$autoNoType = "";   
$txtNoAmbulance = isset($_REQUEST['txtNoAmbulance'])?trim($_REQUEST['txtNoAmbulance']):null;
$txtModal = isset($_REQUEST['txtModal'])?trim($_REQUEST['txtModal']):null;
$txtHealthStaff = isset($_REQUEST['txtHealthStaff'])?trim($_REQUEST['txtHealthStaff']):null;
$txtRMVreg = isset($_REQUEST['txtRMVreg'])?trim($_REQUEST['txtRMVreg']):null;
  
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
    
     $sql = "select * from institute_facility where ins_faci_institute_id='$id' ";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
			
      //Update data to transaction header*******************************************
      $sql="update `institute_facility`
            set
					ins_no_of_ambulance        	='$txtNoAmbulance',
					ins_am_modal   				='$txtModal',
					ins_health_staff     		='$txtHealthStaff',
					ins_rmv_reg			='$txtRMVreg'
          		    where ins_faci_institute_id='$id'";
					

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `institute_facility`
            ( ins_faci_institute_id,ins_no_of_ambulance,ins_am_modal,ins_health_staff,ins_rmv_reg,ins_info_company_id, ins_info_created_by, ins_info_created_on)
              values              ('$id','$txtNoAmbulance','$txtModal','$txtHealthStaff','$txtRMVreg', '1', '1', '". time()."')";

    }
    
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;   
	
	if(count($facilityDetail)&&$entryId){
		//==================================Surg detail========================================
		$sqlDel="delete from institute_facility_detail where facility_detail_institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
		foreach($facilityDetail as $detail){
			
			$facilityId		=$detail['cbofacility'];
			$value	=$detail['txtValue'];
			$Distription  =$detail['txtDiscription'];
			
			
			 $sqlDetail="insert into institute_facility_detail(facility_detail_institute_id,facility_id,facility_detail_value,facility_description)
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





