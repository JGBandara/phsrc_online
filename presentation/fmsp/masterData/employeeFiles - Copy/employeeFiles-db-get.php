<?php

session_start();
$backwardSeparator = "../../../../";
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
  $sql = "select dfi_id, dfi_file_name, dfi_file_extension, dfi_store_location, dfi_url, dfi_reference_no, dfi_reference_id, 
		dfg_name, dfc_name, dfi_file_version, dfi_meta_data, dfi_remarks, ifnull(stat_name,'') as `status`, 
		if(dfi_is_deleted='1','Yes','No') as `is deleted`, ifnull(dfp_id,0) as `permission`
        from dms_trn_file
          inner join dms_file_category on dfi_file_category_id=dfc_id
          inner join dms_file_group on dfc_file_group_id=dfg_id
          left join sys_status on dfi_status=stat_id
          left join dms_file_permission on dfp_file_category_id=dfi_file_category_id and dfp_user_id='$userId' and dfp_status='1' and dfp_is_deleted='0'
        where 1=1 and dfi_company_id='$userCompanyId' and dfi_reference_id='$id' and dfg_id='4' and dfi_is_deleted='0'
        order by dfc_name asc, dfi_file_name asc, dfi_file_version asc ";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}elseif($requestType=='loadFileList'){
  $id = $_REQUEST['id'];
  $sql = "SELECT
dms_file_category.dfc_id,
dms_file_category.dfc_name,
dms_file_category.dfc_file_group_id,
if(dms_file_category.dfc_is_mandatory=1,'Mandatory','Optional') as dfc_is_mandatory ,
dms_file_category.dfc_status,
dms_file_category.dfc_is_deleted
FROM
dms_file_category
WHERE NOT EXISTS (
    SELECT dfi_file_category_id
    FROM
        dms_trn_file
    WHERE
        dms_trn_file.dfi_file_category_id = dms_file_category.dfc_id and dfi_reference_id=$id
) and dms_file_category.dfc_file_group_id=4 and dms_file_category.dfc_status=1 and dms_file_category.dfc_is_deleted=0";
  $result = $db->singleQuery($sql);
  $arr = [];
  while($row = mysqli_fetch_assoc($result)){
    $arr[] = $row;
  }
  echo json_encode($arr);
}
elseif($requestType=='loadSearchCombo'){
  
$sql="SELECT
ins_application_id,
ins_institute_name
FROM
institute_registration where ins_is_deleted='0' and ins_type_id='9' and ins_created_by=$userId
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





