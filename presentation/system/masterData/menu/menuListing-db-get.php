
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

//require_once '../class/cls_sys_menus.php';
require_once $backwardSeparator.'dataAccess/connector.php';

//$model = new cls_sys_menus($db);
  
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
$conditionStr = "1=1 and sym_company_id='$userCompanyId'";
$sql = "select *
        from sys_menus
        where ".$conditionStr."
        order by sym_id asc";
$response['recordsTotal'] = $db->getNumRows($sql);  
// =======================================================
//         Get Filtered Array
// -------------------------------------------------------
$condition = [];
  
$fieldNameStr = " sym_id, sym_code, sym_parent_id, sym_name, sym_url, sym_status, sym_order_by, sym_show_menu, sym_view, sym_list, sym_add, sym_edit, sym_delete, sym_approval_1, sym_approval_2, sym_approval_3, sym_approval_4, sym_approval_5, sym_send_to_approval, sym_print, sym_reject, sym_revise, sym_admin_right, sym_copy_to_clipboard, sym_export_to_excel, sym_export_to_pdf, sym_without_permission, sym_behaviour, sym_awesome_icon, sym_module";
$condition[] = "sym_id like '%".$search['value']."%'";
$condition[] = "sym_code like '%".$search['value']."%'";
$condition[] = "sym_parent_id like '%".$search['value']."%'";
$condition[] = "sym_name like '%".$search['value']."%'";
$condition[] = "sym_url like '%".$search['value']."%'";
$condition[] = "sym_status like '%".$search['value']."%'";
$condition[] = "sym_order_by like '%".$search['value']."%'";
$condition[] = "sym_show_menu like '%".$search['value']."%'";
$condition[] = "sym_view like '%".$search['value']."%'";
$condition[] = "sym_list like '%".$search['value']."%'";
$condition[] = "sym_add like '%".$search['value']."%'";
$condition[] = "sym_edit like '%".$search['value']."%'";
$condition[] = "sym_delete like '%".$search['value']."%'";
$condition[] = "sym_approval_1 like '%".$search['value']."%'";
$condition[] = "sym_approval_2 like '%".$search['value']."%'";
$condition[] = "sym_approval_3 like '%".$search['value']."%'";
$condition[] = "sym_approval_4 like '%".$search['value']."%'";
$condition[] = "sym_approval_5 like '%".$search['value']."%'";
$condition[] = "sym_send_to_approval like '%".$search['value']."%'";
$condition[] = "sym_print like '%".$search['value']."%'";
$condition[] = "sym_reject like '%".$search['value']."%'";
$condition[] = "sym_revise like '%".$search['value']."%'";
$condition[] = "sym_admin_right like '%".$search['value']."%'";
$condition[] = "sym_copy_to_clipboard like '%".$search['value']."%'";
$condition[] = "sym_export_to_excel like '%".$search['value']."%'";
$condition[] = "sym_export_to_pdf like '%".$search['value']."%'";
$condition[] = "sym_without_permission like '%".$search['value']."%'";
$condition[] = "sym_behaviour like '%".$search['value']."%'";
$condition[] = "sym_awesome_icon like '%".$search['value']."%'";
$condition[] = "sym_module like '%".$search['value']."%'";

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
      from sys_menus
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





