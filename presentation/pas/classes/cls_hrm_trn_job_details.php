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
use presentation\hrm\masterData\classes\cls_hrm_designation;

/**
 * This is the model class for table "hrm_trn_job_details".
 * @property integer $ejd_id
* @property integer $ejd_employee_id
* @property integer $ejd_designation_id
* @property string $ejd_job_description
* @property string $ejd_working_hours
* @property string $ejd_remarks
* @property integer $ejd_status
* @property integer $ejd_is_deleted
* @property integer $ejd_location_id
* @property integer $ejd_company_id
* @property integer $ejd_created_by
* @property integer $ejd_created_on
* @property integer $ejd_last_modified_by
* @property integer $ejd_last_modified_on
* @property integer $ejd_deleted_by
* @property integer $ejd_deleted_on
*/
class cls_hrm_trn_job_details {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_job_details';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'ejd_id' => 'Id', 
            'ejd_employee_id' => 'Employee', 
            'ejd_designation_id' => 'Designation', 
            'ejd_job_description' => 'Job Description', 
            'ejd_working_hours' => 'Working Hours', 
            'ejd_remarks' => 'Remarks', 
            'ejd_status' => 'Status', 
            'ejd_is_deleted' => 'Is Deleted', 
            'ejd_location_id' => 'Location', 
            'ejd_company_id' => 'Company', 
            'ejd_created_by' => 'Created By', 
            'ejd_created_on' => 'Created On', 
            'ejd_last_modified_by' => 'Last Modified By', 
            'ejd_last_modified_on' => 'Last Modified On', 
            'ejd_deleted_by' => 'Deleted By', 
            'ejd_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->ejd_id)){
      $condition[] = "ejd_id='$this->ejd_id'";
    }if(!is_null($this->ejd_employee_id)){
      $condition[] = "ejd_employee_id='$this->ejd_employee_id'";
    }if(!is_null($this->ejd_designation_id)){
      $condition[] = "ejd_designation_id='$this->ejd_designation_id'";
    }if(!is_null($this->ejd_job_description)){
      $condition[] = "ejd_job_description='$this->ejd_job_description'";
    }if(!is_null($this->ejd_working_hours)){
      $condition[] = "ejd_working_hours='$this->ejd_working_hours'";
    }if(!is_null($this->ejd_remarks)){
      $condition[] = "ejd_remarks='$this->ejd_remarks'";
    }if(!is_null($this->ejd_status)){
      $condition[] = "ejd_status='$this->ejd_status'";
    }if(!is_null($this->ejd_is_deleted)){
      $condition[] = "ejd_is_deleted='$this->ejd_is_deleted'";
    }if(!is_null($this->ejd_location_id)){
      $condition[] = "ejd_location_id='$this->ejd_location_id'";
    }if(!is_null($this->ejd_company_id)){
      $condition[] = "ejd_company_id='$this->ejd_company_id'";
    }if(!is_null($this->ejd_created_by)){
      $condition[] = "ejd_created_by='$this->ejd_created_by'";
    }if(!is_null($this->ejd_created_on)){
      $condition[] = "ejd_created_on='$this->ejd_created_on'";
    }if(!is_null($this->ejd_last_modified_by)){
      $condition[] = "ejd_last_modified_by='$this->ejd_last_modified_by'";
    }if(!is_null($this->ejd_last_modified_on)){
      $condition[] = "ejd_last_modified_on='$this->ejd_last_modified_on'";
    }if(!is_null($this->ejd_deleted_by)){
      $condition[] = "ejd_deleted_by='$this->ejd_deleted_by'";
    }if(!is_null($this->ejd_deleted_on)){
      $condition[] = "ejd_deleted_on='$this->ejd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ejd_id, ejd_employee_id, ejd_designation_id, ejd_job_description, ejd_working_hours, ejd_remarks, ejd_status, ejd_is_deleted, ejd_location_id, ejd_company_id, ejd_created_by, ejd_created_on, ejd_last_modified_by, ejd_last_modified_on, ejd_deleted_by, ejd_deleted_on, emi_calling_name, emi_no, dsg_name
          from hrm_trn_job_details
              inner join hrm_employee_information on emi_id=ejd_employee_id
              inner join hrm_designation on dsg_id=ejd_designation_id
          where ".$conditionStr."
          order by ejd_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['ejd_id'].'" '; 
      if($this->ejd_id == $row['ejd_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['dsg_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->ejd_id)){
      $condition[] = "ejd_id='$this->ejd_id'";
    }if(!is_null($this->ejd_employee_id)){
      $condition[] = "ejd_employee_id='$this->ejd_employee_id'";
    }if(!is_null($this->ejd_designation_id)){
      $condition[] = "ejd_designation_id='$this->ejd_designation_id'";
    }if(!is_null($this->ejd_job_description)){
      $condition[] = "ejd_job_description='$this->ejd_job_description'";
    }if(!is_null($this->ejd_working_hours)){
      $condition[] = "ejd_working_hours='$this->ejd_working_hours'";
    }if(!is_null($this->ejd_remarks)){
      $condition[] = "ejd_remarks='$this->ejd_remarks'";
    }if(!is_null($this->ejd_status)){
      $condition[] = "ejd_status='$this->ejd_status'";
    }if(!is_null($this->ejd_is_deleted)){
      $condition[] = "ejd_is_deleted='$this->ejd_is_deleted'";
    }if(!is_null($this->ejd_location_id)){
      $condition[] = "ejd_location_id='$this->ejd_location_id'";
    }if(!is_null($this->ejd_company_id)){
      $condition[] = "ejd_company_id='$this->ejd_company_id'";
    }if(!is_null($this->ejd_created_by)){
      $condition[] = "ejd_created_by='$this->ejd_created_by'";
    }if(!is_null($this->ejd_created_on)){
      $condition[] = "ejd_created_on='$this->ejd_created_on'";
    }if(!is_null($this->ejd_last_modified_by)){
      $condition[] = "ejd_last_modified_by='$this->ejd_last_modified_by'";
    }if(!is_null($this->ejd_last_modified_on)){
      $condition[] = "ejd_last_modified_on='$this->ejd_last_modified_on'";
    }if(!is_null($this->ejd_deleted_by)){
      $condition[] = "ejd_deleted_by='$this->ejd_deleted_by'";
    }if(!is_null($this->ejd_deleted_on)){
      $condition[] = "ejd_deleted_on='$this->ejd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ejd_id, ejd_employee_id, ejd_designation_id, ejd_job_description, ejd_working_hours, ejd_remarks, ejd_status, ejd_is_deleted, ejd_location_id, ejd_company_id, ejd_created_by, ejd_created_on, ejd_last_modified_by, ejd_last_modified_on, ejd_deleted_by, ejd_deleted_on
          from hrm_trn_job_details
          where ".$conditionStr."
          order by ejd_id asc";
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
    
    $model = new cls_hrm_trn_job_details($this->db);
  
    $model->ejd_id = $result[0]['ejd_id'];
    $model->ejd_employee_id = $result[0]['ejd_employee_id'];
    $model->ejd_designation_id = $result[0]['ejd_designation_id'];
    $model->ejd_job_description = $result[0]['ejd_job_description'];
    $model->ejd_working_hours = $result[0]['ejd_working_hours'];
    $model->ejd_remarks = $result[0]['ejd_remarks'];
    $model->ejd_status = $result[0]['ejd_status'];
    $model->ejd_is_deleted = $result[0]['ejd_is_deleted'];
    $model->ejd_location_id = $result[0]['ejd_location_id'];
    $model->ejd_company_id = $result[0]['ejd_company_id'];
    $model->ejd_created_by = $result[0]['ejd_created_by'];
    $model->ejd_created_on = $result[0]['ejd_created_on'];
    $model->ejd_last_modified_by = $result[0]['ejd_last_modified_by'];
    $model->ejd_last_modified_on = $result[0]['ejd_last_modified_on'];
    $model->ejd_deleted_by = $result[0]['ejd_deleted_by'];
    $model->ejd_deleted_on = $result[0]['ejd_deleted_on'];
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
      $model = new cls_hrm_trn_job_details($this->db);
  
      $model->ejd_id = $row['ejd_id'];
      $model->ejd_employee_id = $row['ejd_employee_id'];
      $model->ejd_designation_id = $row['ejd_designation_id'];
      $model->ejd_job_description = $row['ejd_job_description'];
      $model->ejd_working_hours = $row['ejd_working_hours'];
      $model->ejd_remarks = $row['ejd_remarks'];
      $model->ejd_status = $row['ejd_status'];
      $model->ejd_is_deleted = $row['ejd_is_deleted'];
      $model->ejd_location_id = $row['ejd_location_id'];
      $model->ejd_company_id = $row['ejd_company_id'];
      $model->ejd_created_by = $row['ejd_created_by'];
      $model->ejd_created_on = $row['ejd_created_on'];
      $model->ejd_last_modified_by = $row['ejd_last_modified_by'];
      $model->ejd_last_modified_on = $row['ejd_last_modified_on'];
      $model->ejd_deleted_by = $row['ejd_deleted_by'];
      $model->ejd_deleted_on = $row['ejd_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->ejd_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Designation
  */
  public function getDesignation(){
    $model = new cls_hrm_designation($this->db);
    $model->dsg_id = $this->ejd_designation_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->dsg_name;
  } 
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->ejd_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->ejd_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->ejd_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->ejd_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejd_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->ejd_created_on))?$this->ejd_created_on:date("Y-m-d H:i:s",$this->ejd_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejd_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->ejd_last_modified_on))?$this->ejd_last_modified_on:date("Y-m-d H:i:s",$this->ejd_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejd_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->ejd_deleted_on))?$this->ejd_deleted_on:date("Y-m-d H:i:s",$this->ejd_deleted_on);
  }
}
?>

