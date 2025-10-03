
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

use presentation\hrm\masterData\classes\cls_hrm_employee_residential;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\system\masterData\classes\cls_sys_province;
use presentation\system\masterData\classes\cls_sys_district;
use presentation\system\masterData\classes\cls_sys_ds_division;

$model = new cls_hrm_employee_residential($db);
$modelEmpInformation = new cls_hrm_employee_information($db);
$modelProvince = new cls_sys_province($db);
$modelDistrict = new cls_sys_district($db);
$modelDsDivision = new cls_sys_ds_division($db);

$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->emr_id=$id;
  $response = $model->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $modelEmpInformation->emi_is_deleted = 0;
  $modelEmpInformation->emi_company_id = $userCompanyId;
  echo $modelEmpInformation->combo(true);
}
elseif($requestType=='loadPermanentProvinceCombo'){
  $countryId = $_REQUEST['id'];
  $modelProvince->syv_country_id = $countryId;
  $modelProvince->syv_is_deleted = 0;
  echo $modelProvince->combo(true);
}
elseif($requestType=='loadPermanentDistrictCombo'){
  $provinceId = $_REQUEST['id'];
  $modelDistrict->syd_province_id = $provinceId;
  $modelDistrict->syd_is_deleted = 0;
  echo $modelDistrict->combo(true);
}
elseif($requestType=='loadPermanentDsDivisionCombo'){
  $districtId = $_REQUEST['id'];
  $modelDsDivision->syi_district_id = $districtId;
  $modelDsDivision->syi_is_deleted = 0;
  echo $modelDsDivision->combo(true);
}
elseif($requestType=='loadCurrentProvinceCombo'){
  $countryId = $_REQUEST['id'];
  $modelProvince->syv_country_id = $countryId;
  $modelProvince->syv_is_deleted = 0;
  echo $modelProvince->combo(true);
}
elseif($requestType=='loadCurrentDistrictCombo'){
  $provinceId = $_REQUEST['id'];
  $modelDistrict->syd_province_id = $provinceId;
  $modelDistrict->syd_is_deleted = 0;
  echo $modelDistrict->combo(true);
}
elseif($requestType=='loadCurrentDsDivisionCombo'){
  $districtId = $_REQUEST['id'];
  $modelDsDivision->syi_district_id = $districtId;
  $modelDsDivision->syi_is_deleted = 0;
  echo $modelDsDivision->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->emr_id = $recordId;
    $model->emr_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./employeeResidentialPartialView.php";
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





