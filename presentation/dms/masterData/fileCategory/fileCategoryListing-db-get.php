
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-11
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

//use presentation\dms\masterData\classes\cls_dms_file_category;

//$model = new cls_dms_file_category($db);
  
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
  $conditionStr = "1=1 and dfc_company_id='$userCompanyId'";
  $sql = "select *
          from dms_file_category
          where ".$conditionStr."
          order by dfc_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " dfc_id, dfc_name, dfc_code, dfg_name, dfc_url, dfc_prefix_format, dfc_meta_data, if(dfc_is_related_to_system='1','Yes','No') as `dfc_is_related_to_system`, dfc_remarks, ifnull(stat_name,'') as `status`, if(dfc_is_deleted='1','Yes','No') as `is deleted`, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(dfc_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(dfc_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(dfc_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "dfc_id,dfc_name,dfc_code,dfg_name,dfc_url,dfc_prefix_format,dfc_meta_data,dfc_is_related_to_system,dfc_remarks,`status`,`is deleted`,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "dfc_id like '%".$search['value']."%'";
  $condition[] = "dfc_name like '%".$search['value']."%'";
  $condition[] = "dfc_code like '%".$search['value']."%'";
  $condition[] = "dfg_name like '%".$search['value']."%'";
  $condition[] = "dfc_url like '%".$search['value']."%'";
  $condition[] = "dfc_prefix_format like '%".$search['value']."%'";
  $condition[] = "dfc_meta_data like '%".$search['value']."%'";
  $condition[] = "if(dfc_is_related_to_system='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "dfc_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "if(dfc_is_deleted='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(dfc_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(dfc_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(dfc_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "dfc_id like '%@@value@@%'";
  $conditionColumnSearch[] = "dfc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "dfc_code like '%@@value@@%'";
  $conditionColumnSearch[] = "dfg_name like '%@@value@@%'";
  $conditionColumnSearch[] = "dfc_url like '%@@value@@%'";
  $conditionColumnSearch[] = "dfc_prefix_format like '%@@value@@%'";
  $conditionColumnSearch[] = "dfc_meta_data like '%@@value@@%'";
  $conditionColumnSearch[] = "if(dfc_is_related_to_system='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "dfc_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "if(dfc_is_deleted='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(dfc_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(dfc_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(dfc_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from dms_file_category
          inner join dms_file_group on dfg_id=dfc_file_group_id
          left join sys_status on dfc_status=stat_id
          left join sys_companies on dfc_company_id=syc_id
          left join sys_users cu on dfc_created_by= cu.syu_id
          left join sys_users mu on dfc_last_modified_by= mu.syu_id
          left join sys_users du on dfc_deleted_by= du.syu_id
           
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





