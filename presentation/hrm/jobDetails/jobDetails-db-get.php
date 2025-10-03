
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

use presentation\hrm\classes\cls_hrm_trn_job_details;

$model = new cls_hrm_trn_job_details($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->ejd_id=$id;
  $model->ejd_location_id = $userLocationId;
  $model->ejd_company_id = $userCompanyId;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadExistingJobDetails'){
  $empId = $_REQUEST['id'];
  $sql = "select ejd_id, dsg_name, ejd_job_description, ejd_working_hours, stat_name
          from hrm_trn_job_details 
              inner join hrm_designation on dsg_id=ejd_designation_id
	      inner join sys_status on ejd_status=stat_id
          where ejd_employee_id='$empId' and ejd_is_deleted='0' and ejd_company_id='$userCompanyId'
          order by stat_name asc ";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row= mysqli_fetch_array($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  $model->ejd_is_deleted = 0;
  $model->ejd_location_id = $userLocationId;
  $model->ejd_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->ejd_id = $recordId;
    $model->ejd_location_id = $userLocationId;
    $model->ejd_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./jobDetailsPartialView.php";
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





