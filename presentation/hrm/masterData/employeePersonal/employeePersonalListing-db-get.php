
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

//use presentation\hrm\masterData\classes\cls_hrm_employee_personal;

//$model = new cls_hrm_employee_personal($db);
  
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
  $conditionStr = "1=1 and emp_company_id='$userCompanyId'";
  $sql = "select *
          from hrm_employee_personal
          where ".$conditionStr."
          order by emp_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " emp_id, emi_no, emi_calling_name, emp_initials, emp_middle_name, emp_surname, emp_name_denoted_by_initials, emp_full_name, emp_other_name, emp_nic_no, emp_nic_issue_date, emp_nationality, emp_race, emp_religion, if(emp_gender='1','Male','Female') as `gender`, emp_date_of_birth, emp_blood_group, ifnull(sya_name,'') as `marital status`, emp_married_date, emp_passport_no, ifnull(syb_name,'') as `passport type`, emp_passport_issue_date, emp_passport_issue_place, emp_passport_expiry_date, emp_passport_countries, emp_driving_license_no, emp_driving_license_issue_date, emp_driving_license_expiry_date, emp_driving_license_vehicle_class, emp_remarks, ifnull(stat_name,'') as `status`, if(emp_is_deleted='1','Yes','No') as `is deleted`, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(emp_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(emp_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(emp_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "emp_id,emi_no,emi_calling_name,emp_initials,emp_middle_name,emp_surname,emp_name_denoted_by_initials,emp_full_name,emp_other_name,emp_nic_no,emp_nic_issue_date,emp_nationality,emp_race,emp_religion,`gender`,emp_date_of_birth,emp_blood_group,`marital status`,emp_married_date,emp_passport_no,`passport type`,emp_passport_issue_date,emp_passport_issue_place,emp_passport_expiry_date,emp_passport_countries,emp_driving_license_no,emp_driving_license_issue_date,emp_driving_license_expiry_date,emp_driving_license_vehicle_class,emp_remarks,`status`,`is deleted`,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "emp_id like '%".$search['value']."%'";
  $condition[] = "emi_no like '%".$search['value']."%'";
  $condition[] = "emi_calling_name like '%".$search['value']."%'";
  $condition[] = "emp_initials like '%".$search['value']."%'";
  $condition[] = "emp_middle_name like '%".$search['value']."%'";
  $condition[] = "emp_surname like '%".$search['value']."%'";
  $condition[] = "emp_name_denoted_by_initials like '%".$search['value']."%'";
  $condition[] = "emp_full_name like '%".$search['value']."%'";
  $condition[] = "emp_other_name like '%".$search['value']."%'";
  $condition[] = "emp_nic_no like '%".$search['value']."%'";
  $condition[] = "emp_nic_issue_date like '%".$search['value']."%'";
  $condition[] = "emp_nationality like '%".$search['value']."%'";
  $condition[] = "emp_race like '%".$search['value']."%'";
  $condition[] = "emp_religion like '%".$search['value']."%'";
  $condition[] = "if(emp_gender='1','Male','Female') like '%".$search['value']."%'";
  $condition[] = "emp_date_of_birth like '%".$search['value']."%'";
  $condition[] = "emp_blood_group like '%".$search['value']."%'";
  $condition[] = "sya_name like '%".$search['value']."%'";
  $condition[] = "emp_married_date like '%".$search['value']."%'";
  $condition[] = "emp_passport_no like '%".$search['value']."%'";
  $condition[] = "syb_name like '%".$search['value']."%'";
  $condition[] = "emp_passport_issue_date like '%".$search['value']."%'";
  $condition[] = "emp_passport_issue_place like '%".$search['value']."%'";
  $condition[] = "emp_passport_expiry_date like '%".$search['value']."%'";
  $condition[] = "emp_passport_countries like '%".$search['value']."%'";
  $condition[] = "emp_driving_license_no like '%".$search['value']."%'";
  $condition[] = "emp_driving_license_issue_date like '%".$search['value']."%'";
  $condition[] = "emp_driving_license_expiry_date like '%".$search['value']."%'";
  $condition[] = "emp_driving_license_vehicle_class like '%".$search['value']."%'";
  $condition[] = "emp_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "if(emp_is_deleted='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emp_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emp_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emp_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "emp_id like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_calling_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_initials like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_middle_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_surname like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_name_denoted_by_initials like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_other_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_nic_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_nic_issue_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_nationality like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_race like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_religion like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emp_gender='1','Male','Female') like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_date_of_birth like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_blood_group like '%@@value@@%'";
  $conditionColumnSearch[] = "sya_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_married_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_passport_no like '%@@value@@%'";
  $conditionColumnSearch[] = "syb_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_passport_issue_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_passport_issue_place like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_passport_expiry_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_passport_countries like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_driving_license_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_driving_license_issue_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_driving_license_expiry_date like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_driving_license_vehicle_class like '%@@value@@%'";
  $conditionColumnSearch[] = "emp_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emp_is_deleted='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emp_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emp_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emp_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from hrm_employee_personal 
          inner join hrm_employee_information on emp_id=emi_id
          left join sys_status on emp_status=stat_id
          left join sys_companies on emp_company_id=syc_id
          left join sys_users cu on emp_created_by= cu.syu_id
          left join sys_users mu on emp_last_modified_by= mu.syu_id
          left join sys_users du on emp_deleted_by= du.syu_id
          left join sys_marital_status on emp_maritial_status_id = sya_id
          left join sys_passport_type on emp_passport_type = syb_id
           
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





