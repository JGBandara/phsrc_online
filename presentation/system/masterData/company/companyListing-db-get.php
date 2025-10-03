
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

//use presentation\system\masterData\classes\cls_sys_companies;

//$model = new cls_sys_companies($db);
  
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
  $conditionStr = "1=1 ";
  $sql = "select *
          from sys_companies
          where ".$conditionStr."
          order by syc_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " syc_id, syc_code, syc_name, ifnull(syt_name,'') as `country`, syc_web_site, syc_remarks, syc_account_no, syc_registration_no, syc_vat_no, syc_svat_no, syc_working_day_type, ifnull(syy_code,'') as `base currency`, syc_tax_applicable, syc_nopay_consider, syc_menu_order, ifnull(stat_name,'') as `status`, syc_is_deleted, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(syc_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(syc_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(syc_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "syc_id,syc_code,syc_name,`country`,syc_web_site,syc_remarks,syc_account_no,syc_registration_no,syc_vat_no,syc_svat_no,syc_working_day_type,`base currency`,syc_tax_applicable,syc_nopay_consider,syc_menu_order,`status`,syc_is_deleted,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "syc_id like '%".$search['value']."%'";
  $condition[] = "syc_code like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "syt_name like '%".$search['value']."%'";
  $condition[] = "syc_web_site like '%".$search['value']."%'";
  $condition[] = "syc_remarks like '%".$search['value']."%'";
  $condition[] = "syc_account_no like '%".$search['value']."%'";
  $condition[] = "syc_registration_no like '%".$search['value']."%'";
  $condition[] = "syc_vat_no like '%".$search['value']."%'";
  $condition[] = "syc_svat_no like '%".$search['value']."%'";
  $condition[] = "syc_working_day_type like '%".$search['value']."%'";
  $condition[] = "syy_code like '%".$search['value']."%'";
  $condition[] = "syc_tax_applicable like '%".$search['value']."%'";
  $condition[] = "syc_nopay_consider like '%".$search['value']."%'";
  $condition[] = "syc_menu_order like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "syc_is_deleted like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(syc_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(syc_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(syc_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "syc_id like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_code like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syt_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_web_site like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_account_no like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_registration_no like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_vat_no like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_svat_no like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_working_day_type like '%@@value@@%'";
  $conditionColumnSearch[] = "syy_code like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_tax_applicable like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_nopay_consider like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_menu_order like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_is_deleted like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(syc_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(syc_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(syc_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from sys_companies
          left join sys_status on syc_status=stat_id
          left join sys_users cu on syc_created_by= cu.syu_id
          left join sys_users mu on syc_last_modified_by= mu.syu_id
          left join sys_users du on syc_deleted_by= du.syu_id
          left join sys_country on syc_country_id = syt_id
          left join sys_currency on syc_base_currency_id = syy_id
           
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





