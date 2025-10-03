
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-17
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

//use presentation\system\classes\cls_sys_trn_login;

//$model = new cls_sys_trn_login($db);
  
$draw = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
$start = (isset($_REQUEST['start']))?$_REQUEST['start']:'';
$length = (isset($_REQUEST['length']))?$_REQUEST['length']:'';
$columns = (isset($_REQUEST['columns']))?$_REQUEST['columns']:''; // [data,name,searchable,orderable,search[value,regex]] 
$order = (isset($_REQUEST['order']))?$_REQUEST['order']:''; // [column,dir]
$search = (isset($_REQUEST['search']))?$_REQUEST['search']:''; // [value,regex]

$response = [];

$response['draw'] = $draw++;
$response['recordsTotal'] = 8;
$response['recordsFiltered'] = 8;
try{
  // =======================================================
  //         Get Total Count
  // -------------------------------------------------------
  // Query Filter Condition
  $conditionStr = "1=1 and tlg_company_id='$userCompanyId'";
  $sql = "select *
          from sys_trn_login
          where ".$conditionStr."
          order by tlg_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " tlg_id, syu_full_name, ifnull(syc_name,'') as `company`, ifnull(syl_name,'') as `location`, tlg_ip_address, tlg_login_datetime, tlg_login_out_datetime, tlg_remarks";
  $fieldNameStrOrder = "tlg_id,syu_full_name,`company`,`location`,tlg_ip_address,tlg_login_datetime,tlg_login_out_datetime,tlg_remarks";
  $condition[] = "tlg_id like '%".$search['value']."%'";
  $condition[] = "syu_full_name like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "syl_name like '%".$search['value']."%'";
  $condition[] = "tlg_ip_address like '%".$search['value']."%'";
  $condition[] = "tlg_login_datetime like '%".$search['value']."%'";
  $condition[] = "tlg_login_out_datetime like '%".$search['value']."%'";
  $condition[] = "tlg_remarks like '%".$search['value']."%'";
  
  $conditionColumnSearch[] = "tlg_id like '%@@value@@%'";
  $conditionColumnSearch[] = "syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_name like '%@@value@@%'";
  $conditionColumnSearch[] = "tlg_ip_address like '%@@value@@%'";
  $conditionColumnSearch[] = "tlg_login_datetime like '%@@value@@%'";
  $conditionColumnSearch[] = "tlg_login_out_datetime like '%@@value@@%'";
  $conditionColumnSearch[] = "tlg_remarks like '%@@value@@%'";
   
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
  //        Column Filter Condition
  // ----------------------------------------------
  else{
    $rawCondition = $conditionColumnSearch;
    foreach($columns as $k => $column){
      $columnSearchValue = $column['search']['value'];
      if($column['searchable'] && $columnSearchValue!=''){
        $cond = $conditionColumnSearch[$column['data']];
        $conditionStr .= " and (".str_replace('@@value@@', $columnSearchValue, $cond).")";
      }
    }
  }
  // =======================================================
  //        Query Order
  // ----------------------------------------------
  $fieldNameArray = explode(',',$fieldNameStrOrder);
  array_walk($fieldNameArray, create_function('&$val', '$val = trim($val);')); // remove white spaces

  $orderString = "";
  foreach($order as $k=>$orderOne){
    if($k==0)
      $orderString .= $fieldNameArray[$orderOne['column']]." ". $orderOne['dir'];
    else
      $orderString .= ",".$fieldNameArray[$orderOne['column']]." ". $orderOne['dir'];
  }

  $sql = "select ".$fieldNameStr."
        from sys_trn_login
          inner join sys_users on tlg_user_id=syu_id
          left join sys_companies on tlg_company_id=syc_id
          left join sys_location on tlg_location_id=syl_id
           
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
    while($row = mysqli_fetch_row($result)){
      $arr[] = $row;
    }
    $response['data'] = $arr;
  }
  else{
    $response['data'] = [];
  }
}catch(Exception $e){
  $response['error'] 		= $e->getMessage();
  $response['q'] 			= $sql;                
}
echo json_encode($response);
?>





