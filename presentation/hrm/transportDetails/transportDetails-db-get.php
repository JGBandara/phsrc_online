
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

use presentation\hrm\classes\cls_hrm_trn_transport_details;

$model = new cls_hrm_trn_transport_details($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->etd_id=$id;
  $model->etd_location_id = $userLocationId;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadExistingTransportDetails'){
  $empId = $_REQUEST['id'];
  $sql = "select etd_id, tmd_name, dwm_name, etd_travelling_time, etd_distance, etd_duration, stat_name
          from hrm_trn_transport_details 
              inner join hrm_transport_mode on tmd_id=etd_transport_mode_id
              inner join hrm_transport_vehicle_type on tvt_id=etd_transport_vehicle_type_id
              inner join hrm_dwelling_mode on dwm_id=etd_dwelling_mode_id
	      inner join sys_status on etd_status=stat_id
          where etd_employee_id='$empId' and etd_is_deleted='0' and etd_company_id='$userCompanyId'
          order by tmd_name asc";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row= mysqli_fetch_array($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  $model->etd_is_deleted = 0;
  $model->etd_location_id = $userLocationId;
  $model->etd_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->etd_id = $recordId;
    $model->etd_location_id = $userLocationId;
    $model->etd_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./transportDetailsPartialView.php";
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





