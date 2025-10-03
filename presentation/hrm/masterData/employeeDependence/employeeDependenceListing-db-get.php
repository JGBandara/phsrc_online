
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
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

//use presentation\hrm\masterData\classes\cls_hrm_employee_dependence;

//$model = new cls_hrm_employee_dependence($db);
  
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
  $conditionStr = "1=1 and emd_company_id='$userCompanyId'";
  $sql = "select *
          from hrm_employee_dependence
          where ".$conditionStr."
          order by emd_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " emd_id, emi_no, emi_calling_name, emd_full_name, emd_date_of_birth, emd_nic_no, emd_telephone, if(emd_entitled_death_donation='1','Entitled','Not Entitled') as `death donation`, if(emd_entitled_medical_benifits='1','Entitled','Not Entitled') as `medical`, if(emd_provident_fund_nominee='1','Entitled','Not Entitled') as `fund`, if(emd_living='1','Living','Not Living') as `living`, emw_name, emd_working_address, emd_working_telephone, emd_permanent_address, emd_mobile, if(emd_same_office='1','Yes','No') as `same office`, sya_name, emd_remarks, ifnull(stat_name,'') as `status`, if(emd_is_deleted='1','Yes','No') as `is deleted`, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(emd_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(emd_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(emd_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "emd_id,emi_no,emi_calling_name,emd_full_name,emd_date_of_birth,emd_nic_no,emd_telephone,`death donation`,`medical`,`fund`,`living`,emw_name,emd_working_address,emd_working_telephone,emd_permanent_address,emd_mobile,`same office`,sya_name,emd_remarks,`status`,`is deleted`,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "emd_id like '%".$search['value']."%'";
  $condition[] = "emi_no like '%".$search['value']."%'";
  $condition[] = "emi_calling_name like '%".$search['value']."%'";
  $condition[] = "emd_full_name like '%".$search['value']."%'";
  $condition[] = "emd_date_of_birth like '%".$search['value']."%'";
  $condition[] = "emd_nic_no like '%".$search['value']."%'";
  $condition[] = "emd_telephone like '%".$search['value']."%'";
  $condition[] = "if(emd_entitled_death_donation='1','Entitled','Not Entitled') like '%".$search['value']."%'";
  $condition[] = "if(emd_entitled_medical_benifits='1','Entitled','Not Entitled') like '%".$search['value']."%'";
  $condition[] = "if(emd_provident_fund_nominee='1','Entitled','Not Entitled') like '%".$search['value']."%'";
  $condition[] = "if(emd_living='1','Living','Not Living') like '%".$search['value']."%'";
  $condition[] = "emw_name like '%".$search['value']."%'";
  $condition[] = "emd_working_address like '%".$search['value']."%'";
  $condition[] = "emd_working_telephone like '%".$search['value']."%'";
  $condition[] = "emd_permanent_address like '%".$search['value']."%'";
  $condition[] = "emd_mobile like '%".$search['value']."%'";
  $condition[] = "if(emd_same_office='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "sya_name like '%".$search['value']."%'";
  $condition[] = "emd_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "if(emd_is_deleted='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emd_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emd_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emd_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "emd_id like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_calling_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_date_of_birth like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_nic_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_telephone like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emd_entitled_death_donation='1','Entitled','Not Entitled') like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emd_entitled_medical_benifits='1','Entitled','Not Entitled') like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emd_provident_fund_nominee='1','Entitled','Not Entitled') like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emd_living='1','Living','Not Living') like '%@@value@@%'";
  $conditionColumnSearch[] = "emw_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_working_address like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_working_telephone like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_permanent_address like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_mobile like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emd_same_office='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "sya_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emd_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emd_is_deleted='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emd_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emd_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emd_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from hrm_employee_dependence
          inner join hrm_employee_information on emi_id=emd_employee_id
          left join hrm_dependence_work_type on emw_id=emd_work_type
          left join sys_marital_status on sya_id=emd_marital_status_id
          left join sys_status on emd_status=stat_id
          left join sys_companies on emd_company_id=syc_id
          left join sys_users cu on emd_created_by= cu.syu_id
          left join sys_users mu on emd_last_modified_by= mu.syu_id
          left join sys_users du on emd_deleted_by= du.syu_id
           
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





