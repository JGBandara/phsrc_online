<?php
session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================
if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];
  $sql="SELECT
ins_application_id,
ins_owner_name,
ins_owner_relationship,
ins_owner_offic_address,
ins_owner_address,
ins_institute_name,
ins_institute_address,
ins_telephone,
ins_mobile,
ins_email,
ins_website,
ins_province_id,
ins_district_id,
ins_profile,
ins_is_deleted
FROM
institute_registration
 where institute_reg_id=$id
          order by ins_application_id asc";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['ownerName']=$row['ins_owner_name'];
		$response['relationsip']=$row['ins_owner_relationship'];
		$response['officeAddress']=$row['ins_owner_offic_address'];
		$response['owAddress']=$row['ins_owner_address'];
		$response['insName']=$row['ins_institute_name'];
		$response['insAddress']=$row['ins_institute_address'];
		$response['telephone']=$row['ins_telephone'];
                $response['mobile']=$row['ins_mobile'];
		$response['email']=$row['ins_email'];
		$response['website']=$row['ins_website'];
		$response['province']= $row['ins_province_id'];
		$response['district']= $row['ins_district_id'];
    $response['profileImageName']	=$row['ins_profile'];
		}

  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
   $sql="SELECT
ins_application_id,
ins_institute_name
FROM
institute_registration where ins_is_deleted='0' and ins_type_id='11'
          order by ins_application_id asc";
		  $html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['ins_application_id']."\">".$row['ins_institute_name']."</option>";
		
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





