
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
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

//use presentation\system\masterData\classes\cls_sys_location;

//$model = new cls_sys_location($db);
  
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
  $conditionStr = "1=1 and syl_company_id='$userCompanyId'";
  $sql = "select *
          from sys_location
          where ".$conditionStr."
          order by syl_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " syl_id, syl_code, syl_name, syl_address, syl_street, syl_city, syl_phone_no, syl_fax_no, syl_email, syl_attendance_format, syl_zip_code, syl_remarks, ifnull(stat_name,'') as `status`, syl_is_deleted, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(syl_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(syl_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(syl_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "syl_id,syl_code,syl_name,syl_address,syl_street,syl_city,syl_phone_no,syl_fax_no,syl_email,syl_attendance_format,syl_zip_code,syl_remarks,`status`,syl_is_deleted,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "syl_id like '%".$search['value']."%'";
  $condition[] = "syl_code like '%".$search['value']."%'";
  $condition[] = "syl_name like '%".$search['value']."%'";
  $condition[] = "syl_address like '%".$search['value']."%'";
  $condition[] = "syl_street like '%".$search['value']."%'";
  $condition[] = "syl_city like '%".$search['value']."%'";
  $condition[] = "syl_phone_no like '%".$search['value']."%'";
  $condition[] = "syl_fax_no like '%".$search['value']."%'";
  $condition[] = "syl_email like '%".$search['value']."%'";
  $condition[] = "syl_attendance_format like '%".$search['value']."%'";
  $condition[] = "syl_zip_code like '%".$search['value']."%'";
  $condition[] = "syl_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "syl_is_deleted like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(syl_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(syl_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(syl_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "syl_id like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_code like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_address like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_street like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_city like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_phone_no like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_fax_no like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_email like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_attendance_format like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_zip_code like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syl_is_deleted like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(syl_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(syl_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(syl_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from sys_location
          left join sys_status on syl_status=stat_id
          left join sys_companies on syl_company_id=syc_id
          left join sys_users cu on syl_created_by= cu.syu_id
          left join sys_users mu on syl_last_modified_by= mu.syu_id
          left join sys_users du on syl_deleted_by= du.syu_id
           
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





