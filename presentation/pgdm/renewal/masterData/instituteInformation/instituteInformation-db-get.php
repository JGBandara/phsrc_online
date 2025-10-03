<?php
session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$model = new cls_hrm_employee_information($db);
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql = "select ins_application_id from institute_registration where institute_reg_id='$id' ";
    $result = $db->singleQuery($sql);
    while($row= mysqli_fetch_array($result)){
        $id=$row['ins_application_id'];
    }
  $sql="SELECT
ins_info_institute_id,
ins_date_of_stablishment,
ins_br_no,
ins_boi_registration,
ins_is_group,
ins_is_individual,
ins_other,
ins_is_com_base,
ins_is_manual,
ins_own_other,
ins_practice_hr
FROM
institute_information
where ins_info_institute_id=$id ";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['stDate']=$row['ins_date_of_stablishment'];
		$response['brNo']=$row['ins_br_no'];
		$response['boiReg']=$row['ins_boi_registration'];
		$response['isGroup']=$row['ins_is_group'];
		$response['isIndividual']=$row['ins_is_individual'];
		$response['other']= $row['ins_other'];
		$response['isComBase'] =$row['ins_is_com_base'];
		$response['isManual'] =$row['ins_is_manual'];
		$response['own_other']= $row['ins_own_other'];
		$response['ins_practice_hr'] = $row['ins_practice_hr'];
		
		}
		

  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
    $id=$_REQUEST['id'];
   $sql="SELECT
       ins_application_id,
institute_reg_id,
reg_no
FROM
institute_registration where ins_is_deleted='0' and ins_type_id='6'  and institute_reg_id='$id'
          order by ins_application_id asc";
		 
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['institute_reg_id']."\">".$row['reg_no']."</option>";
		
		}
	echo $html;	
		  
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->emi_id = $recordId;
    $model->emi_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./employeeInformationPartialView.php";
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





