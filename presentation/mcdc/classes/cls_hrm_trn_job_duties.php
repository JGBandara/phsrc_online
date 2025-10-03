<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
namespace presentation\hrm\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_duty;
use presentation\hrm\masterData\classes\cls_hrm_duty_type;

/**
 * This is the model class for table "hrm_trn_job_duties".
 * @property integer $ejt_id
* @property integer $ejt_employee_id
* @property integer $ejt_duty_id
* @property string $ejt_assign_date
* @property string $ejt_release_date
* @property integer $ejt_duty_type_id
* @property string $ejt_remarks
* @property integer $ejt_status
* @property integer $ejt_is_deleted
* @property integer $ejt_location_id
* @property integer $ejt_company_id
* @property integer $ejt_created_by
* @property integer $ejt_created_on
* @property integer $ejt_last_modified_by
* @property integer $ejt_last_modified_on
* @property integer $ejt_deleted_by
* @property integer $ejt_deleted_on
*/
class cls_hrm_trn_job_duties {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_job_duties';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'ejt_id' => 'Id', 
            'ejt_employee_id' => 'Employee', 
            'ejt_duty_id' => 'Duty', 
            'ejt_assign_date' => 'Assign Date', 
            'ejt_release_date' => 'Release Date', 
            'ejt_duty_type_id' => 'Duty Type', 
            'ejt_remarks' => 'Remarks', 
            'ejt_status' => 'Status', 
            'ejt_is_deleted' => 'Is Deleted', 
            'ejt_location_id' => 'Location', 
            'ejt_company_id' => 'Company', 
            'ejt_created_by' => 'Created By', 
            'ejt_created_on' => 'Created On', 
            'ejt_last_modified_by' => 'Last Modified By', 
            'ejt_last_modified_on' => 'Last Modified On', 
            'ejt_deleted_by' => 'Deleted By', 
            'ejt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->ejt_id)){
      $condition[] = "ejt_id='$this->ejt_id'";
    }if(!is_null($this->ejt_employee_id)){
      $condition[] = "ejt_employee_id='$this->ejt_employee_id'";
    }if(!is_null($this->ejt_duty_id)){
      $condition[] = "ejt_duty_id='$this->ejt_duty_id'";
    }if(!is_null($this->ejt_assign_date)){
      $condition[] = "ejt_assign_date='$this->ejt_assign_date'";
    }if(!is_null($this->ejt_release_date)){
      $condition[] = "ejt_release_date='$this->ejt_release_date'";
    }if(!is_null($this->ejt_duty_type_id)){
      $condition[] = "ejt_duty_type_id='$this->ejt_duty_type_id'";
    }if(!is_null($this->ejt_remarks)){
      $condition[] = "ejt_remarks='$this->ejt_remarks'";
    }if(!is_null($this->ejt_status)){
      $condition[] = "ejt_status='$this->ejt_status'";
    }if(!is_null($this->ejt_is_deleted)){
      $condition[] = "ejt_is_deleted='$this->ejt_is_deleted'";
    }if(!is_null($this->ejt_location_id)){
      $condition[] = "ejt_location_id='$this->ejt_location_id'";
    }if(!is_null($this->ejt_company_id)){
      $condition[] = "ejt_company_id='$this->ejt_company_id'";
    }if(!is_null($this->ejt_created_by)){
      $condition[] = "ejt_created_by='$this->ejt_created_by'";
    }if(!is_null($this->ejt_created_on)){
      $condition[] = "ejt_created_on='$this->ejt_created_on'";
    }if(!is_null($this->ejt_last_modified_by)){
      $condition[] = "ejt_last_modified_by='$this->ejt_last_modified_by'";
    }if(!is_null($this->ejt_last_modified_on)){
      $condition[] = "ejt_last_modified_on='$this->ejt_last_modified_on'";
    }if(!is_null($this->ejt_deleted_by)){
      $condition[] = "ejt_deleted_by='$this->ejt_deleted_by'";
    }if(!is_null($this->ejt_deleted_on)){
      $condition[] = "ejt_deleted_on='$this->ejt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ejt_id, ejt_employee_id, ejt_duty_id, ejt_assign_date, ejt_release_date, ejt_duty_type_id, ejt_remarks, ejt_status, ejt_is_deleted, ejt_location_id, ejt_company_id, ejt_created_by, ejt_created_on, ejt_last_modified_by, ejt_last_modified_on, ejt_deleted_by, ejt_deleted_on, emi_calling_name, emi_no, dty_name
          from hrm_trn_job_duties
              inner join hrm_employee_information on emi_id=ejt_employee_id
              inner join hrm_duty on dty_id=ejt_duty_id
          where ".$conditionStr."
          order by ejt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['ejt_id'].'" '; 
      if($this->ejt_id == $row['ejt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['dty_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->ejt_id)){
      $condition[] = "ejt_id='$this->ejt_id'";
    }if(!is_null($this->ejt_employee_id)){
      $condition[] = "ejt_employee_id='$this->ejt_employee_id'";
    }if(!is_null($this->ejt_duty_id)){
      $condition[] = "ejt_duty_id='$this->ejt_duty_id'";
    }if(!is_null($this->ejt_assign_date)){
      $condition[] = "ejt_assign_date='$this->ejt_assign_date'";
    }if(!is_null($this->ejt_release_date)){
      $condition[] = "ejt_release_date='$this->ejt_release_date'";
    }if(!is_null($this->ejt_duty_type_id)){
      $condition[] = "ejt_duty_type_id='$this->ejt_duty_type_id'";
    }if(!is_null($this->ejt_remarks)){
      $condition[] = "ejt_remarks='$this->ejt_remarks'";
    }if(!is_null($this->ejt_status)){
      $condition[] = "ejt_status='$this->ejt_status'";
    }if(!is_null($this->ejt_is_deleted)){
      $condition[] = "ejt_is_deleted='$this->ejt_is_deleted'";
    }if(!is_null($this->ejt_location_id)){
      $condition[] = "ejt_location_id='$this->ejt_location_id'";
    }if(!is_null($this->ejt_company_id)){
      $condition[] = "ejt_company_id='$this->ejt_company_id'";
    }if(!is_null($this->ejt_created_by)){
      $condition[] = "ejt_created_by='$this->ejt_created_by'";
    }if(!is_null($this->ejt_created_on)){
      $condition[] = "ejt_created_on='$this->ejt_created_on'";
    }if(!is_null($this->ejt_last_modified_by)){
      $condition[] = "ejt_last_modified_by='$this->ejt_last_modified_by'";
    }if(!is_null($this->ejt_last_modified_on)){
      $condition[] = "ejt_last_modified_on='$this->ejt_last_modified_on'";
    }if(!is_null($this->ejt_deleted_by)){
      $condition[] = "ejt_deleted_by='$this->ejt_deleted_by'";
    }if(!is_null($this->ejt_deleted_on)){
      $condition[] = "ejt_deleted_on='$this->ejt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ejt_id, ejt_employee_id, ejt_duty_id, if(ejt_assign_date='0000-00-00','',ejt_assign_date) as `ejt_assign_date`, if(ejt_release_date='0000-00-00','',ejt_release_date) as `ejt_release_date`, ejt_duty_type_id, ejt_remarks, ejt_status, ejt_is_deleted, ejt_location_id, ejt_company_id, ejt_created_by, ejt_created_on, ejt_last_modified_by, ejt_last_modified_on, ejt_deleted_by, ejt_deleted_on
          from hrm_trn_job_duties
          where ".$conditionStr."
          order by ejt_id asc";
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
    
    $model = new cls_hrm_trn_job_duties($this->db);
  
    $model->ejt_id = $result[0]['ejt_id'];
    $model->ejt_employee_id = $result[0]['ejt_employee_id'];
    $model->ejt_duty_id = $result[0]['ejt_duty_id'];
    $model->ejt_assign_date = ($result[0]['ejt_assign_date']=='0000-00-00')?'':$result[0]['ejt_assign_date'];
    $model->ejt_release_date = ($result[0]['ejt_release_date']=='0000-00-00')?'':$result[0]['ejt_release_date'];
    $model->ejt_duty_type_id = $result[0]['ejt_duty_type_id'];
    $model->ejt_remarks = $result[0]['ejt_remarks'];
    $model->ejt_status = $result[0]['ejt_status'];
    $model->ejt_is_deleted = $result[0]['ejt_is_deleted'];
    $model->ejt_location_id = $result[0]['ejt_location_id'];
    $model->ejt_company_id = $result[0]['ejt_company_id'];
    $model->ejt_created_by = $result[0]['ejt_created_by'];
    $model->ejt_created_on = $result[0]['ejt_created_on'];
    $model->ejt_last_modified_by = $result[0]['ejt_last_modified_by'];
    $model->ejt_last_modified_on = $result[0]['ejt_last_modified_on'];
    $model->ejt_deleted_by = $result[0]['ejt_deleted_by'];
    $model->ejt_deleted_on = $result[0]['ejt_deleted_on'];
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
      $model = new cls_hrm_trn_job_duties($this->db);
  
      $model->ejt_id = $row['ejt_id'];
      $model->ejt_employee_id = $row['ejt_employee_id'];
      $model->ejt_duty_id = $row['ejt_duty_id'];
      $model->ejt_assign_date = ($row['ejt_assign_date']=='0000-00-00')?'':$row['ejt_assign_date'];
      $model->ejt_release_date = ($row['ejt_release_date']=='0000-00-00')?'':$row['ejt_release_date'];
      $model->ejt_duty_type_id = $row['ejt_duty_type_id'];
      $model->ejt_remarks = $row['ejt_remarks'];
      $model->ejt_status = $row['ejt_status'];
      $model->ejt_is_deleted = $row['ejt_is_deleted'];
      $model->ejt_location_id = $row['ejt_location_id'];
      $model->ejt_company_id = $row['ejt_company_id'];
      $model->ejt_created_by = $row['ejt_created_by'];
      $model->ejt_created_on = $row['ejt_created_on'];
      $model->ejt_last_modified_by = $row['ejt_last_modified_by'];
      $model->ejt_last_modified_on = $row['ejt_last_modified_on'];
      $model->ejt_deleted_by = $row['ejt_deleted_by'];
      $model->ejt_deleted_on = $row['ejt_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->ejt_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Duty Type
  */
  public function getDutyType(){
    $model = new cls_hrm_duty_type($this->db);
    $model->dtt_id = $this->ejt_duty_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->dtt_name;
  } 
  /**
  * @return Duty
  */
  public function getDuty(){
    $model = new cls_hrm_duty($this->db);
    $model->dty_id = $this->ejt_duty_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->dty_name;
  } 
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->ejt_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->ejt_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->ejt_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->ejt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejt_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->ejt_created_on))?$this->ejt_created_on:date("Y-m-d H:i:s",$this->ejt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejt_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->ejt_last_modified_on))?$this->ejt_last_modified_on:date("Y-m-d H:i:s",$this->ejt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejt_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->ejt_deleted_on))?$this->ejt_deleted_on:date("Y-m-d H:i:s",$this->ejt_deleted_on);
  }
}
?>

