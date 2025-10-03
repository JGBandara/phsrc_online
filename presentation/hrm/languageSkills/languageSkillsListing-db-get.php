
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
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

//use presentation\hrm\classes\cls_hrm_trn_language_skills;

//$model = new cls_hrm_trn_language_skills($db);
  
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
$conditionStr = "1=1 and lgs_company_id='$userCompanyId'"; 
  $sql = "select *
          from hrm_trn_language_skills
          where ".$conditionStr."
          order by lgs_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " lgs_id, emi_no, emi_calling_name, syg_name, ski_name, lmt_name, lgs_remarks, ifnull(stat_name,'') as `status`, if(lgs_is_deleted='1','Yes','No') as `is deleted`, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(lgs_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(lgs_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(lgs_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "lgs_id,emi_no,emi_calling_name,syg_name,ski_name,lmt_name,lgs_remarks,`status`,`is deleted`,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "lgs_id like '%".$search['value']."%'";
  $condition[] = "emi_no like '%".$search['value']."%'";
  $condition[] = "emi_calling_name like '%".$search['value']."%'";
  $condition[] = "syg_name like '%".$search['value']."%'";
  $condition[] = "ski_name like '%".$search['value']."%'";
  $condition[] = "lmt_name like '%".$search['value']."%'";
  $condition[] = "lgs_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "if(lgs_is_deleted='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(lgs_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(lgs_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(lgs_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "lgs_id like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_calling_name like '%@@value@@%'";
  $conditionColumnSearch[] = "syg_name like '%@@value@@%'";
  $conditionColumnSearch[] = "ski_name like '%@@value@@%'";
  $conditionColumnSearch[] = "lmt_name like '%@@value@@%'";
  $conditionColumnSearch[] = "lgs_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "if(lgs_is_deleted='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(lgs_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(lgs_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(lgs_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from hrm_trn_language_skills
          inner join hrm_employee_information on emi_id=lgs_employee_id
          inner join sys_communication_language on syg_id=lgs_language_id
          inner join hrm_language_merit on lmt_id=lgs_merit_id
          inner join hrm_language_skill on ski_id=lgs_skill_type_id
          left join sys_status on lgs_status=stat_id
          left join sys_companies on lgs_company_id=syc_id
          left join sys_users cu on lgs_created_by= cu.syu_id
          left join sys_users mu on lgs_last_modified_by= mu.syu_id
          left join sys_users du on lgs_deleted_by= du.syu_id
           
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





