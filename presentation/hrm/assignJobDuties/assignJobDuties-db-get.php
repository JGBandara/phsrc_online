
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\hrm\classes\cls_hrm_trn_job_duties;

$model = new cls_hrm_trn_job_duties($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->ejt_id=$id;
  $model->ejt_location_id = $userLocationId;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadExistingJobDuties'){
  $empId = $_REQUEST['id'];
  $sql = "select ejt_id, dty_name, ejt_assign_date, ejt_release_date, dtt_name, stat_name
          from hrm_trn_job_duties 
              inner join hrm_duty on dty_id=ejt_duty_id
              inner join hrm_duty_type on dtt_id=ejt_duty_type_id
	      inner join sys_status on ejt_status=stat_id
          where ejt_employee_id='$empId' and ejt_is_deleted='0' and ejt_company_id='$userCompanyId'
          order by ejt_assign_date desc, dtt_id asc ";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row= mysqli_fetch_array($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  $model->ejt_is_deleted = 0;
  $model->ejt_location_id = $userLocationId;
  $model->ejt_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->ejt_id = $recordId;
    $model->ejt_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./assignJobDutiesPartialView.php";
    $value = ob_get_clean();
    $response['content'] 	= $value;
    $response['type'] 	= 'pass';
    $response['msg'] 	= 'Saved successfully.';
    
  }catch(Exception $e){
    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  echo json_encode($response);
}
?>





