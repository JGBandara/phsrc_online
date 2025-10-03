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
use presentation\hrm\masterData\classes\cls_hrm_service_category;
use presentation\hrm\masterData\classes\cls_hrm_employment_type;
use presentation\hrm\masterData\classes\cls_hrm_statutory_classification;


/**
 * This is the model class for table "hrm_trn_job_status".
 * @property integer $ejs_id
* @property integer $ejs_employee_id
* @property integer $ejs_employment_type_id
* @property string $ejs_start_date
* @property string $ejs_end_date
* @property integer $ejs_statutory_classification_id
* @property integer $ejs_employment_category_id
* @property string $ejs_remarks
* @property integer $ejs_status
* @property integer $ejs_is_deleted
* @property integer $ejs_company_id
* @property integer $ejs_created_by
* @property integer $ejs_created_on
* @property integer $ejs_last_modified_by
* @property integer $ejs_last_modified_on
* @property integer $ejs_deleted_by
* @property integer $ejs_deleted_on
*/
class cls_hrm_trn_job_status {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_job_status';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'ejs_id' => 'Id', 
            'ejs_employee_id' => 'Employee', 
            'ejs_employment_type_id' => 'Employment Type', 
            'ejs_start_date' => 'Start Date', 
            'ejs_end_date' => 'End Date', 
            'ejs_statutory_classification_id' => 'Statutory Classification', 
            'ejs_employment_category_id' => 'Employment Category', 
            'ejs_remarks' => 'Remarks', 
            'ejs_status' => 'Status', 
            'ejs_is_deleted' => 'Is Deleted', 
            'ejs_company_id' => 'Company', 
            'ejs_created_by' => 'Created By', 
            'ejs_created_on' => 'Created On', 
            'ejs_last_modified_by' => 'Last Modified By', 
            'ejs_last_modified_on' => 'Last Modified On', 
            'ejs_deleted_by' => 'Deleted By', 
            'ejs_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->ejs_id)){
      $condition[] = "ejs_id='$this->ejs_id'";
    }if(!is_null($this->ejs_employee_id)){
      $condition[] = "ejs_employee_id='$this->ejs_employee_id'";
    }if(!is_null($this->ejs_employment_type_id)){
      $condition[] = "ejs_employment_type_id='$this->ejs_employment_type_id'";
    }if(!is_null($this->ejs_start_date)){
      $condition[] = "ejs_start_date='$this->ejs_start_date'";
    }if(!is_null($this->ejs_end_date)){
      $condition[] = "ejs_end_date='$this->ejs_end_date'";
    }if(!is_null($this->ejs_statutory_classification_id)){
      $condition[] = "ejs_statutory_classification_id='$this->ejs_statutory_classification_id'";
    }if(!is_null($this->ejs_employment_category_id)){
      $condition[] = "ejs_employment_category_id='$this->ejs_employment_category_id'";
    }if(!is_null($this->ejs_remarks)){
      $condition[] = "ejs_remarks='$this->ejs_remarks'";
    }if(!is_null($this->ejs_status)){
      $condition[] = "ejs_status='$this->ejs_status'";
    }if(!is_null($this->ejs_is_deleted)){
      $condition[] = "ejs_is_deleted='$this->ejs_is_deleted'";
    }if(!is_null($this->ejs_company_id)){
      $condition[] = "ejs_company_id='$this->ejs_company_id'";
    }if(!is_null($this->ejs_created_by)){
      $condition[] = "ejs_created_by='$this->ejs_created_by'";
    }if(!is_null($this->ejs_created_on)){
      $condition[] = "ejs_created_on='$this->ejs_created_on'";
    }if(!is_null($this->ejs_last_modified_by)){
      $condition[] = "ejs_last_modified_by='$this->ejs_last_modified_by'";
    }if(!is_null($this->ejs_last_modified_on)){
      $condition[] = "ejs_last_modified_on='$this->ejs_last_modified_on'";
    }if(!is_null($this->ejs_deleted_by)){
      $condition[] = "ejs_deleted_by='$this->ejs_deleted_by'";
    }if(!is_null($this->ejs_deleted_on)){
      $condition[] = "ejs_deleted_on='$this->ejs_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ejs_id, ejs_employee_id, ejs_employment_type_id, ejs_start_date, ejs_end_date, ejs_statutory_classification_id, ejs_employment_category_id, ejs_remarks, ejs_status, ejs_is_deleted, ejs_company_id, ejs_created_by, ejs_created_on, ejs_last_modified_by, ejs_last_modified_on, ejs_deleted_by, ejs_deleted_on, emt_name, emi_calling_name, emi_no
          from hrm_trn_job_status
              inner join hrm_employee_information on emi_id=ejs_employee_id
              inner join hrm_employment_type on emt_id=ejs_employment_type_id
          where ".$conditionStr."
          order by ejs_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['ejs_id'].'" '; 
      if($this->ejs_id == $row['ejs_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['emt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->ejs_id)){
      $condition[] = "ejs_id='$this->ejs_id'";
    }if(!is_null($this->ejs_employee_id)){
      $condition[] = "ejs_employee_id='$this->ejs_employee_id'";
    }if(!is_null($this->ejs_employment_type_id)){
      $condition[] = "ejs_employment_type_id='$this->ejs_employment_type_id'";
    }if(!is_null($this->ejs_start_date)){
      $condition[] = "ejs_start_date='$this->ejs_start_date'";
    }if(!is_null($this->ejs_end_date)){
      $condition[] = "ejs_end_date='$this->ejs_end_date'";
    }if(!is_null($this->ejs_statutory_classification_id)){
      $condition[] = "ejs_statutory_classification_id='$this->ejs_statutory_classification_id'";
    }if(!is_null($this->ejs_employment_category_id)){
      $condition[] = "ejs_employment_category_id='$this->ejs_employment_category_id'";
    }if(!is_null($this->ejs_remarks)){
      $condition[] = "ejs_remarks='$this->ejs_remarks'";
    }if(!is_null($this->ejs_status)){
      $condition[] = "ejs_status='$this->ejs_status'";
    }if(!is_null($this->ejs_is_deleted)){
      $condition[] = "ejs_is_deleted='$this->ejs_is_deleted'";
    }if(!is_null($this->ejs_company_id)){
      $condition[] = "ejs_company_id='$this->ejs_company_id'";
    }if(!is_null($this->ejs_created_by)){
      $condition[] = "ejs_created_by='$this->ejs_created_by'";
    }if(!is_null($this->ejs_created_on)){
      $condition[] = "ejs_created_on='$this->ejs_created_on'";
    }if(!is_null($this->ejs_last_modified_by)){
      $condition[] = "ejs_last_modified_by='$this->ejs_last_modified_by'";
    }if(!is_null($this->ejs_last_modified_on)){
      $condition[] = "ejs_last_modified_on='$this->ejs_last_modified_on'";
    }if(!is_null($this->ejs_deleted_by)){
      $condition[] = "ejs_deleted_by='$this->ejs_deleted_by'";
    }if(!is_null($this->ejs_deleted_on)){
      $condition[] = "ejs_deleted_on='$this->ejs_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ejs_id, ejs_employee_id, ejs_employment_type_id, if(ejs_start_date='0000-00-00','',ejs_start_date) as `ejs_start_date`, if(ejs_end_date='0000-00-00','',ejs_end_date) as `ejs_end_date`, ejs_statutory_classification_id, ejs_employment_category_id, ejs_remarks, ejs_status, ejs_is_deleted, ejs_company_id, ejs_created_by, ejs_created_on, ejs_last_modified_by, ejs_last_modified_on, ejs_deleted_by, ejs_deleted_on
          from hrm_trn_job_status
          where ".$conditionStr."
          order by ejs_id asc";
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
    
    $model = new cls_hrm_trn_job_status($this->db);
  
    $model->ejs_id = $result[0]['ejs_id'];
    $model->ejs_employee_id = $result[0]['ejs_employee_id'];
    $model->ejs_employment_type_id = $result[0]['ejs_employment_type_id'];
    $model->ejs_start_date = ($result[0]['ejs_start_date']=='0000-00-00')?'':$result[0]['ejs_start_date'];
    $model->ejs_end_date = ($result[0]['ejs_end_date']=='0000-00-00')?'':$result[0]['ejs_end_date'];
    $model->ejs_statutory_classification_id = $result[0]['ejs_statutory_classification_id'];
    $model->ejs_employment_category_id = $result[0]['ejs_employment_category_id'];
    $model->ejs_remarks = $result[0]['ejs_remarks'];
    $model->ejs_status = $result[0]['ejs_status'];
    $model->ejs_is_deleted = $result[0]['ejs_is_deleted'];
    $model->ejs_company_id = $result[0]['ejs_company_id'];
    $model->ejs_created_by = $result[0]['ejs_created_by'];
    $model->ejs_created_on = $result[0]['ejs_created_on'];
    $model->ejs_last_modified_by = $result[0]['ejs_last_modified_by'];
    $model->ejs_last_modified_on = $result[0]['ejs_last_modified_on'];
    $model->ejs_deleted_by = $result[0]['ejs_deleted_by'];
    $model->ejs_deleted_on = $result[0]['ejs_deleted_on'];
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
      $model = new cls_hrm_trn_job_status($this->db);
  
      $model->ejs_id = $row['ejs_id'];
      $model->ejs_employee_id = $row['ejs_employee_id'];
      $model->ejs_employment_type_id = $row['ejs_employment_type_id'];
      $model->ejs_start_date = ($row['ejs_start_date']=='0000-00-00')?'':$row['ejs_start_date'];
      $model->ejs_end_date = ($row['ejs_end_date']=='0000-00-00')?'':$row['ejs_end_date'];
      $model->ejs_statutory_classification_id = $row['ejs_statutory_classification_id'];
      $model->ejs_employment_category_id = $row['ejs_employment_category_id'];
      $model->ejs_remarks = $row['ejs_remarks'];
      $model->ejs_status = $row['ejs_status'];
      $model->ejs_is_deleted = $row['ejs_is_deleted'];
      $model->ejs_company_id = $row['ejs_company_id'];
      $model->ejs_created_by = $row['ejs_created_by'];
      $model->ejs_created_on = $row['ejs_created_on'];
      $model->ejs_last_modified_by = $row['ejs_last_modified_by'];
      $model->ejs_last_modified_on = $row['ejs_last_modified_on'];
      $model->ejs_deleted_by = $row['ejs_deleted_by'];
      $model->ejs_deleted_on = $row['ejs_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->ejs_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Employment Type
  */
  public function getEmploymentType(){
    $model = new cls_hrm_employment_type($this->db);
    $model->emt_id = $this->ejs_employment_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->emt_name;
  }
  /**
  * @return Company
  */
  public function getEmploymentCategory(){
    $model = new \presentation\hrm\masterData\classes\cls_hrm_employment_category($this->db);
    $model->emc_id = $this->ejs_employment_category_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->emc_name;
  }
  /**
  * @return Company
  */
  public function getStatutoryClassification(){
    $model = new cls_hrm_statutory_classification($this->db);
    $model->stc_id = $this->ejs_statutory_classification_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->stc_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->ejs_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->ejs_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->ejs_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejs_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->ejs_created_on))?$this->ejs_created_on:date("Y-m-d H:i:s",$this->ejs_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejs_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->ejs_last_modified_on))?$this->ejs_last_modified_on:date("Y-m-d H:i:s",$this->ejs_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ejs_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->ejs_deleted_on))?$this->ejs_deleted_on:date("Y-m-d H:i:s",$this->ejs_deleted_on);
  }
}
?>

