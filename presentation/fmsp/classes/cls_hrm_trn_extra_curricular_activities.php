<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
namespace presentation\hrm\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/**
 * This is the model class for table "hrm_trn_extra_curricular_activities".
 * @property integer $eca_id
* @property integer $eca_employee_id
* @property string $eca_category
* @property string $eca_type
* @property string $eca_achievement
* @property string $eca_date
* @property string $eca_remarks
* @property integer $eca_status
* @property integer $eca_is_deleted
* @property integer $eca_company_id
* @property integer $eca_created_by
* @property integer $eca_created_on
* @property integer $eca_last_modified_by
* @property integer $eca_last_modified_on
* @property integer $eca_deleted_by
* @property integer $eca_deleted_on
*/
class cls_hrm_trn_extra_curricular_activities {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_extra_curricular_activities';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'eca_id' => 'Id', 
            'eca_employee_id' => 'Employee', 
            'eca_category' => 'Category', 
            'eca_type' => 'Type', 
            'eca_achievement' => 'Achievement', 
            'eca_date' => 'Date/Year', 
            'eca_remarks' => 'Remarks', 
            'eca_status' => 'Status', 
            'eca_is_deleted' => 'Is Deleted', 
            'eca_company_id' => 'Company', 
            'eca_created_by' => 'Created By', 
            'eca_created_on' => 'Created On', 
            'eca_last_modified_by' => 'Last Modified By', 
            'eca_last_modified_on' => 'Last Modified On', 
            'eca_deleted_by' => 'Deleted By', 
            'eca_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->eca_id)){
      $condition[] = "eca_id='$this->eca_id'";
    }if(!is_null($this->eca_employee_id)){
      $condition[] = "eca_employee_id='$this->eca_employee_id'";
    }if(!is_null($this->eca_category)){
      $condition[] = "eca_category='$this->eca_category'";
    }if(!is_null($this->eca_type)){
      $condition[] = "eca_type='$this->eca_type'";
    }if(!is_null($this->eca_achievement)){
      $condition[] = "eca_achievement='$this->eca_achievement'";
    }if(!is_null($this->eca_date)){
      $condition[] = "eca_date='$this->eca_date'";
    }if(!is_null($this->eca_remarks)){
      $condition[] = "eca_remarks='$this->eca_remarks'";
    }if(!is_null($this->eca_status)){
      $condition[] = "eca_status='$this->eca_status'";
    }if(!is_null($this->eca_is_deleted)){
      $condition[] = "eca_is_deleted='$this->eca_is_deleted'";
    }if(!is_null($this->eca_company_id)){
      $condition[] = "eca_company_id='$this->eca_company_id'";
    }if(!is_null($this->eca_created_by)){
      $condition[] = "eca_created_by='$this->eca_created_by'";
    }if(!is_null($this->eca_created_on)){
      $condition[] = "eca_created_on='$this->eca_created_on'";
    }if(!is_null($this->eca_last_modified_by)){
      $condition[] = "eca_last_modified_by='$this->eca_last_modified_by'";
    }if(!is_null($this->eca_last_modified_on)){
      $condition[] = "eca_last_modified_on='$this->eca_last_modified_on'";
    }if(!is_null($this->eca_deleted_by)){
      $condition[] = "eca_deleted_by='$this->eca_deleted_by'";
    }if(!is_null($this->eca_deleted_on)){
      $condition[] = "eca_deleted_on='$this->eca_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eca_id, eca_employee_id, eca_category, eca_type, eca_achievement, eca_date, eca_remarks, eca_status, eca_is_deleted, eca_company_id, eca_created_by, eca_created_on, eca_last_modified_by, eca_last_modified_on, eca_deleted_by, eca_deleted_on, emi_calling_name, emi_no
          from hrm_trn_extra_curricular_activities
              inner join hrm_employee_information on emi_id=eca_employee_id
          where ".$conditionStr."
          order by eca_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['eca_id'].'" '; 
      if($this->eca_id == $row['eca_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['eca_category'].' - '. $row['eca_type'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->eca_id)){
      $condition[] = "eca_id='$this->eca_id'";
    }if(!is_null($this->eca_employee_id)){
      $condition[] = "eca_employee_id='$this->eca_employee_id'";
    }if(!is_null($this->eca_category)){
      $condition[] = "eca_category='$this->eca_category'";
    }if(!is_null($this->eca_type)){
      $condition[] = "eca_type='$this->eca_type'";
    }if(!is_null($this->eca_achievement)){
      $condition[] = "eca_achievement='$this->eca_achievement'";
    }if(!is_null($this->eca_date)){
      $condition[] = "eca_date='$this->eca_date'";
    }if(!is_null($this->eca_remarks)){
      $condition[] = "eca_remarks='$this->eca_remarks'";
    }if(!is_null($this->eca_status)){
      $condition[] = "eca_status='$this->eca_status'";
    }if(!is_null($this->eca_is_deleted)){
      $condition[] = "eca_is_deleted='$this->eca_is_deleted'";
    }if(!is_null($this->eca_company_id)){
      $condition[] = "eca_company_id='$this->eca_company_id'";
    }if(!is_null($this->eca_created_by)){
      $condition[] = "eca_created_by='$this->eca_created_by'";
    }if(!is_null($this->eca_created_on)){
      $condition[] = "eca_created_on='$this->eca_created_on'";
    }if(!is_null($this->eca_last_modified_by)){
      $condition[] = "eca_last_modified_by='$this->eca_last_modified_by'";
    }if(!is_null($this->eca_last_modified_on)){
      $condition[] = "eca_last_modified_on='$this->eca_last_modified_on'";
    }if(!is_null($this->eca_deleted_by)){
      $condition[] = "eca_deleted_by='$this->eca_deleted_by'";
    }if(!is_null($this->eca_deleted_on)){
      $condition[] = "eca_deleted_on='$this->eca_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eca_id, eca_employee_id, eca_category, eca_type, eca_achievement, eca_date, eca_remarks, eca_status, eca_is_deleted, eca_company_id, eca_created_by, eca_created_on, eca_last_modified_by, eca_last_modified_on, eca_deleted_by, eca_deleted_on
          from hrm_trn_extra_curricular_activities
          where ".$conditionStr."
          order by eca_id asc";
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
    
    $model = new cls_hrm_trn_extra_curricular_activities($this->db);
  
    $model->eca_id = $result[0]['eca_id'];
    $model->eca_employee_id = $result[0]['eca_employee_id'];
    $model->eca_category = $result[0]['eca_category'];
    $model->eca_type = $result[0]['eca_type'];
    $model->eca_achievement = $result[0]['eca_achievement'];
    $model->eca_date = $result[0]['eca_date'];
    $model->eca_remarks = $result[0]['eca_remarks'];
    $model->eca_status = $result[0]['eca_status'];
    $model->eca_is_deleted = $result[0]['eca_is_deleted'];
    $model->eca_company_id = $result[0]['eca_company_id'];
    $model->eca_created_by = $result[0]['eca_created_by'];
    $model->eca_created_on = $result[0]['eca_created_on'];
    $model->eca_last_modified_by = $result[0]['eca_last_modified_by'];
    $model->eca_last_modified_on = $result[0]['eca_last_modified_on'];
    $model->eca_deleted_by = $result[0]['eca_deleted_by'];
    $model->eca_deleted_on = $result[0]['eca_deleted_on'];
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
      $model = new cls_hrm_trn_extra_curricular_activities($this->db);
  
      $model->eca_id = $row['eca_id'];
      $model->eca_employee_id = $row['eca_employee_id'];
      $model->eca_category = $row['eca_category'];
      $model->eca_type = $row['eca_type'];
      $model->eca_achievement = $row['eca_achievement'];
      $model->eca_date = $row['eca_date'];
      $model->eca_remarks = $row['eca_remarks'];
      $model->eca_status = $row['eca_status'];
      $model->eca_is_deleted = $row['eca_is_deleted'];
      $model->eca_company_id = $row['eca_company_id'];
      $model->eca_created_by = $row['eca_created_by'];
      $model->eca_created_on = $row['eca_created_on'];
      $model->eca_last_modified_by = $row['eca_last_modified_by'];
      $model->eca_last_modified_on = $row['eca_last_modified_on'];
      $model->eca_deleted_by = $row['eca_deleted_by'];
      $model->eca_deleted_on = $row['eca_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->eca_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->eca_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->eca_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->eca_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eca_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->eca_created_on))?$this->eca_created_on:date("Y-m-d H:i:s",$this->eca_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eca_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->eca_last_modified_on))?$this->eca_last_modified_on:date("Y-m-d H:i:s",$this->eca_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eca_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->eca_deleted_on))?$this->eca_deleted_on:date("Y-m-d H:i:s",$this->eca_deleted_on);
  }
}
?>

