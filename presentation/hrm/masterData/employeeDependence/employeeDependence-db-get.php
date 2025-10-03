
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
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

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\hrm\masterData\classes\cls_hrm_employee_dependence;

$model = new cls_hrm_employee_dependence($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->emd_id=$id;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadExistingDependence'){
  $empId = $_REQUEST['id'];
  $sql = "select emd_id, emd_full_name, emd_date_of_birth, emd_telephone, stat_name
          from hrm_employee_dependence 
              inner join sys_status on stat_id=emd_status
          where emd_employee_id='$empId' and emd_is_deleted='0' and emd_company_id='$userCompanyId'
          order by emd_full_name asc";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row= mysqli_fetch_array($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  $model->emd_is_deleted = 0;
  $model->emd_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->emd_id = $recordId;
    $model->emd_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./employeeDependencePartialView.php";
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





