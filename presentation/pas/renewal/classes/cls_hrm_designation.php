<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_salary_scale;
use presentation\hrm\masterData\classes\cls_hrm_service_category;

/**
 * This is the model class for table "hrm_designation".
 * @property integer $dsg_id
* @property integer $dsg_service_category_id
* @property string $dsg_name
* @property string $dsg_code
* @property integer $dsg_salary_code_id
* @property integer $dsg_ot_allowed
* @property integer $dsg_early_ot_allowed
* @property integer $dsg_cadre
* @property integer $dsg_rank
* @property string $dsg_remarks
* @property integer $dsg_status
* @property integer $dsg_is_deleted
* @property integer $dsg_company_id
* @property integer $dsg_created_by
* @property integer $dsg_created_on
* @property integer $dsg_last_modified_by
* @property integer $dsg_last_modified_on
* @property integer $dsg_deleted_by
* @property integer $dsg_deleted_on
*/
class cls_hrm_designation {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_designation';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dsg_id' => 'Id', 
            'dsg_service_category_id' => 'Service Category', 
            'dsg_name' => 'Name', 
            'dsg_code' => 'Code', 
            'dsg_salary_code_id' => 'Salary Code', 
            'dsg_ot_allowed' => 'Ot Allowed', 
            'dsg_early_ot_allowed' => 'Early Ot Allowed', 
            'dsg_cadre' => 'Cadre', 
            'dsg_rank' => 'Rank', 
            'dsg_remarks' => 'Remarks', 
            'dsg_status' => 'Status', 
            'dsg_is_deleted' => 'Is Deleted', 
            'dsg_company_id' => 'Company', 
            'dsg_created_by' => 'Created By', 
            'dsg_created_on' => 'Created On', 
            'dsg_last_modified_by' => 'Last Modified By', 
            'dsg_last_modified_on' => 'Last Modified On', 
            'dsg_deleted_by' => 'Deleted By', 
            'dsg_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dsg_id)){
      $condition[] = "dsg_id='$this->dsg_id'";
    }if(!is_null($this->dsg_service_category_id)){
      $condition[] = "dsg_service_category_id='$this->dsg_service_category_id'";
    }if(!is_null($this->dsg_name)){
      $condition[] = "dsg_name='$this->dsg_name'";
    }if(!is_null($this->dsg_code)){
      $condition[] = "dsg_code='$this->dsg_code'";
    }if(!is_null($this->dsg_salary_code_id)){
      $condition[] = "dsg_salary_code_id='$this->dsg_salary_code_id'";
    }if(!is_null($this->dsg_ot_allowed)){
      $condition[] = "dsg_ot_allowed='$this->dsg_ot_allowed'";
    }if(!is_null($this->dsg_early_ot_allowed)){
      $condition[] = "dsg_early_ot_allowed='$this->dsg_early_ot_allowed'";
    }if(!is_null($this->dsg_cadre)){
      $condition[] = "dsg_cadre='$this->dsg_cadre'";
    }if(!is_null($this->dsg_rank)){
      $condition[] = "dsg_rank='$this->dsg_rank'";
    }if(!is_null($this->dsg_remarks)){
      $condition[] = "dsg_remarks='$this->dsg_remarks'";
    }if(!is_null($this->dsg_status)){
      $condition[] = "dsg_status='$this->dsg_status'";
    }if(!is_null($this->dsg_is_deleted)){
      $condition[] = "dsg_is_deleted='$this->dsg_is_deleted'";
    }if(!is_null($this->dsg_company_id)){
      $condition[] = "dsg_company_id='$this->dsg_company_id'";
    }if(!is_null($this->dsg_created_by)){
      $condition[] = "dsg_created_by='$this->dsg_created_by'";
    }if(!is_null($this->dsg_created_on)){
      $condition[] = "dsg_created_on='$this->dsg_created_on'";
    }if(!is_null($this->dsg_last_modified_by)){
      $condition[] = "dsg_last_modified_by='$this->dsg_last_modified_by'";
    }if(!is_null($this->dsg_last_modified_on)){
      $condition[] = "dsg_last_modified_on='$this->dsg_last_modified_on'";
    }if(!is_null($this->dsg_deleted_by)){
      $condition[] = "dsg_deleted_by='$this->dsg_deleted_by'";
    }if(!is_null($this->dsg_deleted_on)){
      $condition[] = "dsg_deleted_on='$this->dsg_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dsg_id, dsg_service_category_id, dsg_name, dsg_code, dsg_salary_code_id, dsg_ot_allowed, dsg_early_ot_allowed, dsg_cadre, dsg_rank, dsg_remarks, dsg_status, dsg_is_deleted, dsg_company_id, dsg_created_by, dsg_created_on, dsg_last_modified_by, dsg_last_modified_on, dsg_deleted_by, dsg_deleted_on
          from hrm_designation
          where ".$conditionStr."
          order by dsg_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dsg_id'].'" '; 
      if($this->dsg_id == $row['dsg_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dsg_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dsg_id)){
      $condition[] = "dsg_id='$this->dsg_id'";
    }if(!is_null($this->dsg_service_category_id)){
      $condition[] = "dsg_service_category_id='$this->dsg_service_category_id'";
    }if(!is_null($this->dsg_name)){
      $condition[] = "dsg_name='$this->dsg_name'";
    }if(!is_null($this->dsg_code)){
      $condition[] = "dsg_code='$this->dsg_code'";
    }if(!is_null($this->dsg_salary_code_id)){
      $condition[] = "dsg_salary_code_id='$this->dsg_salary_code_id'";
    }if(!is_null($this->dsg_ot_allowed)){
      $condition[] = "dsg_ot_allowed='$this->dsg_ot_allowed'";
    }if(!is_null($this->dsg_early_ot_allowed)){
      $condition[] = "dsg_early_ot_allowed='$this->dsg_early_ot_allowed'";
    }if(!is_null($this->dsg_cadre)){
      $condition[] = "dsg_cadre='$this->dsg_cadre'";
    }if(!is_null($this->dsg_rank)){
      $condition[] = "dsg_rank='$this->dsg_rank'";
    }if(!is_null($this->dsg_remarks)){
      $condition[] = "dsg_remarks='$this->dsg_remarks'";
    }if(!is_null($this->dsg_status)){
      $condition[] = "dsg_status='$this->dsg_status'";
    }if(!is_null($this->dsg_is_deleted)){
      $condition[] = "dsg_is_deleted='$this->dsg_is_deleted'";
    }if(!is_null($this->dsg_company_id)){
      $condition[] = "dsg_company_id='$this->dsg_company_id'";
    }if(!is_null($this->dsg_created_by)){
      $condition[] = "dsg_created_by='$this->dsg_created_by'";
    }if(!is_null($this->dsg_created_on)){
      $condition[] = "dsg_created_on='$this->dsg_created_on'";
    }if(!is_null($this->dsg_last_modified_by)){
      $condition[] = "dsg_last_modified_by='$this->dsg_last_modified_by'";
    }if(!is_null($this->dsg_last_modified_on)){
      $condition[] = "dsg_last_modified_on='$this->dsg_last_modified_on'";
    }if(!is_null($this->dsg_deleted_by)){
      $condition[] = "dsg_deleted_by='$this->dsg_deleted_by'";
    }if(!is_null($this->dsg_deleted_on)){
      $condition[] = "dsg_deleted_on='$this->dsg_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dsg_id, dsg_service_category_id, dsg_name, dsg_code, dsg_salary_code_id, dsg_ot_allowed, dsg_early_ot_allowed, dsg_cadre, dsg_rank, dsg_remarks, dsg_status, dsg_is_deleted, dsg_company_id, dsg_created_by, dsg_created_on, dsg_last_modified_by, dsg_last_modified_on, dsg_deleted_by, dsg_deleted_on
          from hrm_designation
          where ".$conditionStr."
          order by dsg_id asc";
    $result = $this->db->singleQuery($sql);

    if(mysqli_num_rows($result)){
      $arr = [];
      while($row = mysqli_fetch_assoc($result)){
        $arr[] = $row;
      }
      return $arr;
    }

    return null;
  }
  /**
  * @inheritdoc
  */
  public function findModel(){
    $result = $this->getRecords();
    if(is_null($result)){
      return new self($this->db);
    }
    
    $model = new cls_hrm_designation($this->db);
  
    $model->dsg_id = $result[0]['dsg_id'];
    $model->dsg_service_category_id = $result[0]['dsg_service_category_id'];
    $model->dsg_name = $result[0]['dsg_name'];
    $model->dsg_code = $result[0]['dsg_code'];
    $model->dsg_salary_code_id = $result[0]['dsg_salary_code_id'];
    $model->dsg_ot_allowed = $result[0]['dsg_ot_allowed'];
    $model->dsg_early_ot_allowed = $result[0]['dsg_early_ot_allowed'];
    $model->dsg_cadre = $result[0]['dsg_cadre'];
    $model->dsg_rank = $result[0]['dsg_rank'];
    $model->dsg_remarks = $result[0]['dsg_remarks'];
    $model->dsg_status = $result[0]['dsg_status'];
    $model->dsg_is_deleted = $result[0]['dsg_is_deleted'];
    $model->dsg_company_id = $result[0]['dsg_company_id'];
    $model->dsg_created_by = $result[0]['dsg_created_by'];
    $model->dsg_created_on = $result[0]['dsg_created_on'];
    $model->dsg_last_modified_by = $result[0]['dsg_last_modified_by'];
    $model->dsg_last_modified_on = $result[0]['dsg_last_modified_on'];
    $model->dsg_deleted_by = $result[0]['dsg_deleted_by'];
    $model->dsg_deleted_on = $result[0]['dsg_deleted_on'];
    return $model;
  }
  /**
  * @inheritdoc
  */
  public function getModels(){
    $result = $this->getRecords();
    if(is_null($result)){
      return null;
    }
    $models = [];
    foreach ($result as $row) {
      $model = new cls_hrm_designation($this->db);
  
      $model->dsg_id = $row['dsg_id'];
      $model->dsg_service_category_id = $row['dsg_service_category_id'];
      $model->dsg_name = $row['dsg_name'];
      $model->dsg_code = $row['dsg_code'];
      $model->dsg_salary_code_id = $row['dsg_salary_code_id'];
      $model->dsg_ot_allowed = $row['dsg_ot_allowed'];
      $model->dsg_early_ot_allowed = $row['dsg_early_ot_allowed'];
      $model->dsg_cadre = $row['dsg_cadre'];
      $model->dsg_rank = $row['dsg_rank'];
      $model->dsg_remarks = $row['dsg_remarks'];
      $model->dsg_status = $row['dsg_status'];
      $model->dsg_is_deleted = $row['dsg_is_deleted'];
      $model->dsg_company_id = $row['dsg_company_id'];
      $model->dsg_created_by = $row['dsg_created_by'];
      $model->dsg_created_on = $row['dsg_created_on'];
      $model->dsg_last_modified_by = $row['dsg_last_modified_by'];
      $model->dsg_last_modified_on = $row['dsg_last_modified_on'];
      $model->dsg_deleted_by = $row['dsg_deleted_by'];
      $model->dsg_deleted_on = $row['dsg_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Salary Code
  */
  public function getSalaryCode(){
    $model = new cls_hrm_salary_scale($this->db);
    $model->scl_id = $this->dsg_salary_code_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->scl_code;
  }
  /**
  * @return Service Category
  */
  public function getServiceCategory(){
    $model = new cls_hrm_service_category($this->db);
    $model->sct_id = $this->dsg_service_category_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->sct_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dsg_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dsg_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dsg_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dsg_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dsg_created_on))?$this->dsg_created_on:date("Y-m-d H:i:s",$this->dsg_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dsg_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dsg_last_modified_on))?$this->dsg_last_modified_on:date("Y-m-d H:i:s",$this->dsg_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dsg_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dsg_deleted_on))?$this->dsg_deleted_on:date("Y-m-d H:i:s",$this->dsg_deleted_on);
  }
}
?>

