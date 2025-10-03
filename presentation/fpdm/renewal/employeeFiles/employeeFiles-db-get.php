
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-14
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

use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$modelEmpInformation = new cls_hrm_employee_information($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql = "select dfi_id, dfi_file_name, dfi_file_extension, dfi_store_location, dfi_url, dfi_reference_no, dfi_reference_id, 
		dfg_name, dfc_name, dfi_file_version, dfi_meta_data, dfi_remarks, ifnull(stat_name,'') as `status`, 
		if(dfi_is_deleted='1','Yes','No') as `is deleted`, ifnull(dfp_id,0) as `permission`
        from dms_trn_file
          inner join dms_file_category on dfi_file_category_id=dfc_id
          inner join dms_file_group on dfc_file_group_id=dfg_id
          left join sys_status on dfi_status=stat_id
          left join dms_file_permission on dfp_file_category_id=dfi_file_category_id and dfp_user_id='$userId' and dfp_status='1' and dfp_is_deleted='0'
        where 1=1 and dfi_company_id='$userCompanyId' and dfi_reference_id='$id' and dfg_id='1' and dfi_is_deleted='0'
        order by dfc_name asc, dfi_file_name asc, dfi_file_version asc ";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  $modelEmpInformation->emi_is_deleted = 0;
  $modelEmpInformation->emi_company_id = $userCompanyId;
  echo $modelEmpInformation->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->ema_id = $recordId;
    $model->ema_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./employeeFilesPartialView.php";
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





