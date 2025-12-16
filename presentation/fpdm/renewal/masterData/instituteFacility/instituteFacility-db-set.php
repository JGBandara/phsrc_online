<?php
session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";
require "{$backwardSeparator}classes/cls_reject.php";
include  "{$backwardSeparator}dataAccess/serverAccessController.php";
//require_once $backwardSeparator.'dataAccess/connector.php';

use classes\cls_auto_number;
use classes\cls_approval;
use presentation\hrm\masterData\classes\cls_hrm_employee_residential;

$model = new cls_hrm_employee_residential($db);

$response = [];
$autoNoType = "";   

$cboAtomicEnergy = isset($_REQUEST['cboAtomicEnergy'])?trim($_REQUEST['cboAtomicEnergy']):null;
$txtNoLicense = isset($_REQUEST['txtNoLicense'])?trim($_REQUEST['txtNoLicense']):null;
$txtclinicalDis = isset($_REQUEST['txtclinicalDis'])?trim($_REQUEST['txtclinicalDis']):null;
$txtInsDress = isset($_REQUEST['txtInsDress'])?trim($_REQUEST['txtInsDress']):null;
$cboEmgKit = isset($_REQUEST['cboEmgKit'])?trim($_REQUEST['cboEmgKit']):null;
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
$instituteId             = $_REQUEST['cboSearch'];

$facilityDetail = json_decode($_REQUEST['facilityDetail'], true);

if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    $sql = "select ins_application_id from institute_registration where institute_reg_id='$id' ";
    $result = $db->batchQuery($sql);
    while($row=  mysqli_fetch_array($result)){
        $id=$row['ins_application_id'];
        $referenceId=$row['ins_application_id'];
    }
     $sql = "select * from institute_facility where ins_faci_institute_id='$id' ";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
			
      //Update data to transaction header*******************************************
      $sql="update `institute_facility`
            set
					ins_radio_service		='$cboAtomicEnergy',
					ins_waste_disposal						='$txtclinicalDis',
					ins_inst_dress							='$txtInsDress',
					ins_emergency_kit					='$cboEmgKit'
          		    where ins_faci_institute_id='$id'";
					

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `institute_facility`
            ( ins_faci_institute_id,ins_radio_service,ins_waste_disposal,ins_inst_dress,ins_emergency_kit, ins_info_company_id, ins_info_created_by, ins_info_created_on)
              values              ('$id','$cboAtomicEnergy','$txtclinicalDis','$txtInsDress','$cboEmgKit', '1', '1', '". time()."')";

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
    
    $classApprove = new cls_reject($db, $userCompanyId, $userLocationId, $userId);
    $classApprove->reject($referenceId);
    if($detailResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Facilities saved successfully! Proceed to Documents...';
        $response['id'] 	= $instituteId;
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





