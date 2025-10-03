
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

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\hrm\masterData\classes\cls_hrm_employee_bank_account;
use presentation\system\masterData\classes\cls_sys_bank_branch;

$model = new cls_hrm_employee_bank_account($db);
$modelBranch = new cls_sys_bank_branch($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->ema_id=$id;
  $response = $model->getRecords();
  echo json_encode($response); 
}
elseif($requestType=='loadExistingBankAccounts'){
  $empId = $_REQUEST['id'];
  $sql = "select ema_id, sye_name, syf_name, ema_account_no, ema_amount, stat_name
          from hrm_employee_bank_account 
              inner join sys_bank on sye_id=ema_bank_id
              inner join sys_bank_branch on syf_id=ema_branch_id
              inner join sys_status on stat_id=ema_status
          where ema_employee_id='$empId' and ema_is_deleted='0' and ema_company_id='$userCompanyId'
          order by sye_name asc, syf_name asc";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row= mysqli_fetch_array($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  $model->ema_is_deleted = 0;
  $model->ema_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadBranchCombo'){
  $bankId = $_REQUEST['id'];
  $modelBranch->syf_bank_id = $bankId;
  $modelBranch->syf_is_deleted = 0;
  echo $modelBranch->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->ema_id = $recordId;
    $model->ema_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./employeeBankAccountPartialView.php";
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





