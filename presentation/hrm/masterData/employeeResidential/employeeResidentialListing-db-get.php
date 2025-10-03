
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
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

//use presentation\hrm\masterData\classes\cls_hrm_employee_residential;

//$model = new cls_hrm_employee_residential($db);
  
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
  $conditionStr = "1=1 and emr_company_id='$userCompanyId'";
  $sql = "select *
          from hrm_employee_residential
          where ".$conditionStr."
          order by emr_id asc";
  $response['recordsTotal'] = $db->getNumRows($sql);  
  // =======================================================
  //         Get Filtered Array
  // -------------------------------------------------------
  $condition = [];
  $conditionColumnSearch = [];
    
  $fieldNameStr = " emr_id, emi_no, emi_calling_name, emr_permanent_address, emr_permanent_street, emr_permanent_city, emr_permanent_postal_code, emr_permanent_telephone, emr_permanent_mobile_no, emr_permanent_email, ifnull(pc.syt_name,'') as `permanent country`, ifnull(pp.syv_name,'') as `permanent province`, ifnull(pd.syd_name,'') as `permanent district`, ifnull(ps.syi_name,'') as `permanent ds`, emr_permanent_electorate, emr_current_address, emr_current_street, emr_current_city, emr_current_postal_code, emr_current_telephone_general_line, emr_current_telephone_direct_line, emr_current_mobile_no, emr_current_fax, emr_current_email, ifnull(cc.syt_name,'') as `current country`, ifnull(cp.syv_name,'') as `current province`, ifnull(cd.syd_name,'') as `current district`, ifnull(cs.syi_name,'') as `current ds`, emr_current_electorate, emr_remarks, ifnull(stat_name,'') as `status`, if(emr_is_deleted='1','Yes','No') as `is deleted`, ifnull(syc_name,'') as `company`, ifnull(cu.syu_full_name,'') as `created by`, from_unixtime(emr_created_on,'%Y-%m-%d') as `created on`, ifnull(mu.syu_full_name,'') as `modified by`, from_unixtime(emr_last_modified_on,'%Y-%m-%d') as `last modified on`, ifnull(du.syu_full_name,'') as `deleted by`, from_unixtime(emr_deleted_on,'%Y-%m-%d') as `deleted on`";
  $fieldNameStrOrder = "emr_id,emi_no,emi_calling_name,emr_permanent_address,emr_permanent_street,emr_permanent_city,emr_permanent_postal_code,emr_permanent_telephone,emr_permanent_mobile_no,emr_permanent_email,`permanent country`,`permanent province`,`permanent district`,`permanent ds`,emr_permanent_electorate,emr_current_address,emr_current_street,emr_current_city,emr_current_postal_code,emr_current_telephone_general_line,emr_current_telephone_direct_line,emr_current_mobile_no,emr_current_fax,emr_current_email,`current country`,`current province`,`current district`,`current ds`,emr_current_electorate,emr_remarks,`status`,`is deleted`,`company`,`created by`,`created on`,`modified by`,`last modified on`,`deleted by`,`deleted on`";
  $condition[] = "emr_id like '%".$search['value']."%'";
  $condition[] = "emi_no like '%".$search['value']."%'";
  $condition[] = "emi_calling_name like '%".$search['value']."%'";
  $condition[] = "emr_permanent_address like '%".$search['value']."%'";
  $condition[] = "emr_permanent_street like '%".$search['value']."%'";
  $condition[] = "emr_permanent_city like '%".$search['value']."%'";
  $condition[] = "emr_permanent_postal_code like '%".$search['value']."%'";
  $condition[] = "emr_permanent_telephone like '%".$search['value']."%'";
  $condition[] = "emr_permanent_mobile_no like '%".$search['value']."%'";
  $condition[] = "emr_permanent_email like '%".$search['value']."%'";
  $condition[] = "pc.syt_name like '%".$search['value']."%'";
  $condition[] = "pp.syv_name like '%".$search['value']."%'";
  $condition[] = "pd.syd_name like '%".$search['value']."%'";
  $condition[] = "ps.syi_name like '%".$search['value']."%'";
  $condition[] = "emr_permanent_electorate like '%".$search['value']."%'";
  $condition[] = "emr_current_address like '%".$search['value']."%'";
  $condition[] = "emr_current_street like '%".$search['value']."%'";
  $condition[] = "emr_current_city like '%".$search['value']."%'";
  $condition[] = "emr_current_postal_code like '%".$search['value']."%'";
  $condition[] = "emr_current_telephone_general_line like '%".$search['value']."%'";
  $condition[] = "emr_current_telephone_direct_line like '%".$search['value']."%'";
  $condition[] = "emr_current_mobile_no like '%".$search['value']."%'";
  $condition[] = "emr_current_fax like '%".$search['value']."%'";
  $condition[] = "emr_current_email like '%".$search['value']."%'";
  $condition[] = "cc.syt_name like '%".$search['value']."%'";
  $condition[] = "cp.syv_name like '%".$search['value']."%'";
  $condition[] = "cd.syd_name like '%".$search['value']."%'";
  $condition[] = "cs.syi_name like '%".$search['value']."%'";
  $condition[] = "emr_current_electorate like '%".$search['value']."%'";
  $condition[] = "emr_remarks like '%".$search['value']."%'";
  $condition[] = "stat_name like '%".$search['value']."%'";
  $condition[] = "if(emr_is_deleted='1','Yes','No') like '%".$search['value']."%'";
  $condition[] = "syc_name like '%".$search['value']."%'";
  $condition[] = "cu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emr_created_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "mu.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emr_last_modified_on,'%Y-%m-%d') = '".$search['value']."'";
  $condition[] = "du.syu_full_name like '%".$search['value']."%'";
  $condition[] = "from_unixtime(emr_deleted_on,'%Y-%m-%d') = '".$search['value']."'";
  
  $conditionColumnSearch[] = "emr_id like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emi_calling_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_address like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_street like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_city like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_postal_code like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_telephone like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_mobile_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_email like '%@@value@@%'";
  $conditionColumnSearch[] = "pc.syt_name like '%@@value@@%'";
  $conditionColumnSearch[] = "pp.syv_name like '%@@value@@%'";
  $conditionColumnSearch[] = "pd.syd_name like '%@@value@@%'";
  $conditionColumnSearch[] = "ps.syi_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_permanent_electorate like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_address like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_street like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_city like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_postal_code like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_telephone_general_line like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_telephone_direct_line like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_mobile_no like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_fax like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_email like '%@@value@@%'";
  $conditionColumnSearch[] = "cc.syt_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cp.syv_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cd.syd_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cs.syi_name like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_current_electorate like '%@@value@@%'";
  $conditionColumnSearch[] = "emr_remarks like '%@@value@@%'";
  $conditionColumnSearch[] = "stat_name like '%@@value@@%'";
  $conditionColumnSearch[] = "if(emr_is_deleted='1','Yes','No') like '%@@value@@%'";
  $conditionColumnSearch[] = "syc_name like '%@@value@@%'";
  $conditionColumnSearch[] = "cu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emr_created_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "mu.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emr_last_modified_on,'%Y-%m-%d') = '@@value@@'";
  $conditionColumnSearch[] = "du.syu_full_name like '%@@value@@%'";
  $conditionColumnSearch[] = "from_unixtime(emr_deleted_on,'%Y-%m-%d') = '@@value@@'";
   
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
        from hrm_employee_residential
          inner join hrm_employee_information on emr_id=emi_id
          left join sys_status on emr_status=stat_id
          left join sys_companies on emr_company_id=syc_id
          left join sys_users cu on emr_created_by= cu.syu_id
          left join sys_users mu on emr_last_modified_by= mu.syu_id
          left join sys_users du on emr_deleted_by= du.syu_id
          left join sys_country pc on emr_permanent_country_id=pc.syt_id
          left join sys_province pp on emr_permanent_province_id=pp.syv_id
          left join sys_district pd on emr_permanent_district_id=pd.syd_id
          left join sys_ds_division ps on emr_permanent_ds_division_id=ps.syi_id
          left join sys_country cc on emr_current_country_id=cc.syt_id
          left join sys_province cp on emr_current_province_id=cp.syv_id
          left join sys_district cd on emr_current_province_id=cd.syd_id
          left join sys_ds_division cs on emr_current_ds_division_id=cs.syi_id
           
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





