
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
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

//use presentation\dms\classes\cls_dms_trn_file;

//$model = new cls_dms_trn_file($db);
  
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
  $conditionStr = "1=1 and dfi_company_id='$userCompanyId'";
  $sql = "select *
          from dms_trn_file
          where ".$conditionStr."
          order by dfi_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " dfi_id, dfi_file_name, dfi_file_extension, dfi_store_location, dfi_url, dfi_reference_no, dfi_reference_id, dfg_name, dfc_name, dfi_file_version, dfi_meta_data, dfi_remarks, ifnull(stat_name,'') as `status`, if(dfi_is_deleted='1','Yes','No') as `is deleted`, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(dfi_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(dfi_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(dfi_deleted_on,'%Y-%m-%d') as `deleted on`, ifnull(dfp_id,0) as `permission`";
  $fieldNameStrOrder = "dfi_id,dfi_file_name,dfi_file_extension,dfi_store_location,dfi_url,dfi_reference_no,dfi_reference_id,dfg_name,dfc_name,dfi_file_version,dfi_meta_data,dfi_remarks,`status`,`is deleted`,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`,`permission`";
  $condition[] = "dfi_id like '%".$search['value']."%'";
  $condition[] = "dfi_file_name like '%".$search['value']."%'";
  $condition[] = "dfi_file_extension like '%".$search['value']."%'";
  $condition[] = "dfi_store_location like '%".$search['value']."%'";
  $condition[] = "dfi_url like '%".$search['value']."%'";
  $condition[] = "dfi_reference_no like '%".$search['value']."%'";
  $condition[] = "dfi_reference_id like '%".$search['value']."%'";
  $condition[] = "dfg_name like '%".$search['value']."%'";
  $condition[] = "dfc_name like '%".$search['value']."%'";
  $condition[] = "dfi_file_version like '%".$search['value']."%'";
  $condition[] = "dfi_meta_data like '%".$search['value']."%'";
  $condition[] = "dfi_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "if(dfi_is_deleted='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(dfi_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(dfi_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(dfi_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "dfi_id like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_file_name like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_file_extension like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_store_location like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_url like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_reference_no like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_reference_id like '%@@value@@%'";
  $conditionColumnSearch[] = "dfg_name like '%@@value@@%'";
  $conditionColumnSearch[] = "dfc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_file_version like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_meta_data like '%@@value@@%'";
  $conditionColumnSearch[] = "dfi_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "if(dfi_is_deleted='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(dfi_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(dfi_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(dfi_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from dms_trn_file
          inner join dms_file_category on dfi_file_category_id=dfc_id
          inner join dms_file_group on dfc_file_group_id=dfg_id
          left join sys_status on dfi_status=stat_id
          left join sys_companies on dfi_company_id=syc_id
          left join sys_users cu on dfi_created_by= cu.syu_id
          left join sys_users mu on dfi_last_modified_by= mu.syu_id
          left join sys_users du on dfi_deleted_by= du.syu_id
          left join dms_file_permission on dfp_file_category_id=dfi_file_category_id and dfp_user_id='$userId' and dfp_status='1' and dfp_is_deleted='0'
           
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





