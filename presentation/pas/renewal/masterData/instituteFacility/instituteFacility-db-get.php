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
  
  $sql= "select ins_faci_institute_id,ins_no_of_ambulance,ins_am_modal,ins_health_staff,ins_rmv_reg from institute_facility where ins_faci_institute_id= $id";
  
  $result=$db->singleQuery($sql);
  while($row=mysqli_fetch_array($result)){
	  $response['noAmbulance'] = $row['ins_no_of_ambulance'];
	  $response['noModal'] = $row['ins_am_modal'];
	  $response['noHealthStaff'] = $row['ins_health_staff'];
	  $response['rmvReg'] = $row['ins_rmv_reg'];
	  
	  }
 
			$sql = "select
				facility_id,facility_detail_value,facility_description
				from institute_facility_detail
				where facility_detail_institute_id=$id order by facility_detail_id
				";
		$result = $db->singleQuery($sql);
		$arrDetail1;
		while($row=mysqli_fetch_array($result))
		{
			$val1['facility']		= $row['facility_id'];
			$val1['value'] 	= $row['facility_detail_value'];
			$val1['description']	= $row['facility_description'];
			
			$arrDetail1[] = $val1;
		}
		$response['detailVal1'] = $arrDetail1;
//-----------------------------------------------------------------------------


  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
$id=$_REQUEST['id'];
   $sql="SELECT
       ins_application_id,
institute_reg_id,
reg_no
FROM
institute_registration where ins_is_deleted='0' and ins_type_id='4' and  institute_reg_id='$id'
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





