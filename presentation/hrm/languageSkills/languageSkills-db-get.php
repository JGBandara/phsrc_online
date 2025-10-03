
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
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

use presentation\hrm\classes\cls_hrm_trn_language_skills;

$model = new cls_hrm_trn_language_skills($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->lgs_id=$id;
  $model = $model->findModel();
  // get skill Type
  $modelLanguageSkill = new cls_hrm_trn_language_skills($db);
  $modelLanguageSkill->lgs_is_deleted = 0;
  $modelLanguageSkill->lgs_employee_id = $model->lgs_employee_id;
  $modelLanguageSkill->lgs_language_id = $model->lgs_language_id;
  $modelLanguageSkill->lgs_company_id = $model->lgs_company_id;
  $response = $modelLanguageSkill->getRecords();
  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $model->lgs_is_deleted = 0;
  $model->lgs_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->lgs_id = $recordId;
    $model->lgs_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./languageSkillsPartialView.php";
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





