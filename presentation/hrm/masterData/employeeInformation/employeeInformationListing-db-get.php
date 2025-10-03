
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
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

//use presentation\hrm\masterData\classes\cls_hrm_employee_information;

//$model = new cls_hrm_employee_information($db);
  
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
  $conditionStr = "1=1 and emi_company_id='$userCompanyId'";
  $sql = "select *
          from hrm_employee_information
          where ".$conditionStr."
          order by emi_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " emi_id, emi_no, emi_calling_name, emi_epf_no, emi_finger_print_no, emi_joined_date, emi_permanent_date, emi_confirm_date, if(emi_confirm_status='1','Yes','No') as `confirm status`, if(emi_medical_status='1','Yes','No') as `medical status`, emi_resigned_date, emi_retirement_date, emi_image_name, emi_remarks, ifnull(stat_name,'') as `status`, if(emi_is_deleted='1','Yes','No') as `is deleted`, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(emi_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(emi_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(emi_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "emi_id,emi_no,emi_calling_name,emi_epf_no,emi_finger_print_no,emi_joined_date,emi_permanent_date,emi_confirm_date,`confirm status`,`medical status`,emi_resigned_date,emi_retirement_date,emi_image_name,emi_remarks,`status`,`is deleted`,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "emi_id like '%".$search['value']."%'";
  $condition[] = "emi_no like '%".$search['value']."%'";
  $condition[] = "emi_calling_name like '%".$search['value']."%'";
  $condition[] = "emi_epf_no like '%".$search['value']."%'";
  $condition[] = "emi_finger_print_no like '%".$search['value']."%'";
  $condition[] = "emi_joined_date like '%".$search['value']."%'";
  $condition[] = "emi_permanent_date like '%".$search['value']."%'";
  $condition[] = "emi_confirm_date like '%".$search['value']."%'";
  $condition[] = "if(emi_confirm_status='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "if(emi_medical_status='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "emi_resigned_date like '%".$search['value']."%'";
  $condition[] = "emi_retirement_date like '%".$search['value']."%'";
  $condition[] = "emi_image_name like '%".$search['value']."%'";
  $condition[] = "emi_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "if(emi_is_deleted='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emi_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emi_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emi_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "emi_id like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_calling_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_epf_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_finger_print_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_joined_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_permanent_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_confirm_date like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emi_confirm_status='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emi_medical_status='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_resigned_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_retirement_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_image_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emi_is_deleted='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emi_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emi_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emi_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from hrm_employee_information
          left join sys_status on emi_status=stat_id
          left join sys_companies on emi_company_id=syc_id
          left join sys_users cu on emi_created_by= cu.syu_id
          left join sys_users mu on emi_last_modified_by= mu.syu_id
          left join sys_users du on emi_deleted_by= du.syu_id
           
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





