
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

use presentation\hrm\classes\cls_hrm_trn_job_status;

$model = new cls_hrm_trn_job_status($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->ejs_id=$id;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadExistingJobStatus'){
  $empId = $_REQUEST['id'];
  $sql = "select ejs_id, emt_name, ejs_start_date, ejs_end_date, stat_name
          from hrm_trn_job_status 
              inner join hrm_employment_type on ejs_employment_type_id=emt_id
	      inner join sys_status on ejs_status=stat_id
          where ejs_employee_id='$empId' and ejs_is_deleted='0' and ejs_company_id='$userCompanyId'
          order by ejs_start_date desc ";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row= mysqli_fetch_array($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  $model->ejs_status = 1;
  $model->ejs_is_deleted = 0;
  $model->ejs_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->ejs_id = $recordId;
    $model->ejs_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./jobStatusPartialView.php";
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





