
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

//require_once '../class/cls_sys_permission.php';
require_once $backwardSeparator.'dataAccess/connector.php';

//$model = new cls_sys_permission($db);
  
$draw = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
$start = (isset($_REQUEST['start']))?$_REQUEST['start']:'';
$length = (isset($_REQUEST['length']))?$_REQUEST['length']:'';
$columns = (isset($_REQUEST['draw']))?$_REQUEST['columns']:''; // [data,name,searchable,orderable,search[value,regex]] 
$order = (isset($_REQUEST['order']))?$_REQUEST['order']:''; // [column,dir]
$search = (isset($_REQUEST['search']))?$_REQUEST['search']:''; // [value,regex]

$response = [];

$response['draw'] = $draw++;
$response['recordsTotal'] = 8;
$response['recordsFiltered'] = 8;
// =======================================================
//         Get Total Count
// -------------------------------------------------------
// Query Filter Condition
$conditionStr = "1=1 and syp_company_id='$userCompanyId'";
$sql = "select *
        from sys_permission
        where ".$conditionStr."
        order by syp_menu_id asc";
$response['recordsTotal'] = $db->getNumRows($sql);  
// =======================================================
//         Get Filtered Array
// -------------------------------------------------------
$condition = [];
  
$fieldNameStr = " syp_menu_id, syp_user_id, syp_view, syp_list, syp_add, syp_edit, syp_delete, syp_approval_1, syp_approval_2, syp_approval_3, syp_approval_4, syp_approval_5, syp_send_to_approval, syp_print, syp_reject, syp_revise, syp_admin_right, syp_copy_to_clipboard, syp_export_to_excel, syp_export_to_pdf";
$condition[] = "syp_menu_id like '%".$search['value']."%'";
$condition[] = "syp_user_id like '%".$search['value']."%'";
$condition[] = "syp_view like '%".$search['value']."%'";
$condition[] = "syp_list like '%".$search['value']."%'";
$condition[] = "syp_add like '%".$search['value']."%'";
$condition[] = "syp_edit like '%".$search['value']."%'";
$condition[] = "syp_delete like '%".$search['value']."%'";
$condition[] = "syp_approval_1 like '%".$search['value']."%'";
$condition[] = "syp_approval_2 like '%".$search['value']."%'";
$condition[] = "syp_approval_3 like '%".$search['value']."%'";
$condition[] = "syp_approval_4 like '%".$search['value']."%'";
$condition[] = "syp_approval_5 like '%".$search['value']."%'";
$condition[] = "syp_send_to_approval like '%".$search['value']."%'";
$condition[] = "syp_print like '%".$search['value']."%'";
$condition[] = "syp_reject like '%".$search['value']."%'";
$condition[] = "syp_revise like '%".$search['value']."%'";
$condition[] = "syp_admin_right like '%".$search['value']."%'";
$condition[] = "syp_copy_to_clipboard like '%".$search['value']."%'";
$condition[] = "syp_export_to_excel like '%".$search['value']."%'";
$condition[] = "syp_export_to_pdf like '%".$search['value']."%'";

// =======================================================
//        Query Filter Condition
// ----------------------------------------------
if($search['value']!="" && count($condition)>0){
  $conditionStr .= " and (";
  foreach($condition as $k => $cond){
    if($k==0)
      $conditionStr .= $cond;
    else
      $conditionStr .= " or ".$cond;
  }
  $conditionStr .= ")";
}
// =======================================================
//        Query Order
// ----------------------------------------------
$fieldNameArray = explode(',',$fieldNameStr);
array_walk($fieldNameArray, create_function('&$val', '$val = trim($val);')); // remove white spaces

$orderString = "";
foreach($order as $k=>$orderOne){
  if($k==0)
    $orderString .= $fieldNameArray[$orderOne['column']]." ". $orderOne['dir'];
  else
    $orderString .= ",".$fieldNameArray[$orderOne['column']]." ". $orderOne['dir'];
}

$sql = "select ".$fieldNameStr."
      from sys_permission
      where ".$conditionStr."
      order by ".$orderString;
$response['recordsFiltered'] = $db->getNumRows($sql);

// =======================================================
//        Get Table Data
// ----------------------------------------------
$sql .= " limit ".$length."
      offset ".$start;
$result = $db->singleQuery($sql);
if(mysqli_num_rows($result)){
  $arr = [];
  while($row = mysqli_fetch_array($result)){
    $arr[] = $row;
  }
  $response['data'] = $arr;
}
else{
  $response['data'] = [];
}

echo json_encode($response);
?>





