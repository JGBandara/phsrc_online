
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
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

use presentation\hrm\classes\cls_hrm_trn_academic_qualification;
use presentation\hrm\masterData\classes\cls_hrm_academic_qualification_subject;

$model = new cls_hrm_trn_academic_qualification($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $model->eaq_id=$id;
  $model->eaq_location_id = $userLocationId;
  $response['header'] = $model->getRecords();
  $response['details'] = $model->getDetailRecordsAcademicQualification();
  echo json_encode($response);
  
} 
elseif($requestType=='loadExistingAcademicQualification'){
  $empId = $_REQUEST['id'];
  $sql = "select eaq_id, eaq_employee_id, eaq_type_id, eaq_stream_id, eaq_institute, eaq_year, eaq_index_no, eaq_remarks, eaq_status, eaq_location_id, eaq_company_id, eaq_created_by, eaq_created_on, stat_name, aqt_name, ifnull(aqs_name,'') as 'aqs_name'
          from hrm_trn_academic_qualification 
              inner join sys_status on eaq_status=stat_id
              inner join hrm_academic_qualification_type on eaq_type_id=aqt_id
              left join hrm_academic_qualification_stream on eaq_stream_id=aqs_id
          where eaq_employee_id='$empId' and eaq_is_deleted='0' and eaq_company_id='$userCompanyId'
          order by stat_name asc ";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row= mysqli_fetch_assoc($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSubjectCombo'){
  $recordId = $_REQUEST['type_id'];
  $modelSubject = new cls_hrm_academic_qualification_subject($db);
  $modelSubject->aqb_qualification_type_id = $recordId;
  $modelSubject->aqb_is_deleted = 0;
  $modelSubject->aqb_company_id = $userCompanyId;
  echo $modelSubject->combo(true);
}
elseif($requestType=='loadSearchCombo'){
  $model->eaq_is_deleted = 0;
  $model->eaq_location_id = $userLocationId;
  $model->eaq_company_id = $userCompanyId;
  echo $model->combo(true);
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->eaq_id = $recordId;
    $model->eaq_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./academicQualificationPartialView.php";
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





