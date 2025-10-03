<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
 */
namespace presentation\hrm\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_language_merit;
use presentation\system\masterData\classes\cls_sys_communication_language;
use presentation\hrm\masterData\classes\cls_hrm_language_skill;

/**
 * This is the model class for table "hrm_trn_language_skills".
 * @property integer $lgs_id
* @property integer $lgs_employee_id
* @property integer $lgs_language_id
* @property integer $lgs_skill_type_id
* @property integer $lgs_merit_id
* @property string $lgs_remarks
* @property integer $lgs_status
* @property integer $lgs_is_deleted
* @property integer $lgs_company_id
* @property integer $lgs_created_by
* @property integer $lgs_created_on
* @property integer $lgs_last_modified_by
* @property integer $lgs_last_modified_on
* @property integer $lgs_deleted_by
* @property integer $lgs_deleted_on
*/
class cls_hrm_trn_language_skills {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_language_skills';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'lgs_id' => 'Id', 
            'lgs_employee_id' => 'Employee', 
            'lgs_language_id' => 'Language', 
            'lgs_skill_type_id' => 'Skill Type', 
            'lgs_merit_id' => 'Merit', 
            'lgs_remarks' => 'Remarks', 
            'lgs_status' => 'Status', 
            'lgs_is_deleted' => 'Is Deleted', 
            'lgs_company_id' => 'Company', 
            'lgs_created_by' => 'Created By', 
            'lgs_created_on' => 'Created On', 
            'lgs_last_modified_by' => 'Last Modified By', 
            'lgs_last_modified_on' => 'Last Modified On', 
            'lgs_deleted_by' => 'Deleted By', 
            'lgs_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->lgs_id)){
      $condition[] = "lgs_id='$this->lgs_id'";
    }if(!is_null($this->lgs_employee_id)){
      $condition[] = "lgs_employee_id='$this->lgs_employee_id'";
    }if(!is_null($this->lgs_language_id)){
      $condition[] = "lgs_language_id='$this->lgs_language_id'";
    }if(!is_null($this->lgs_skill_type_id)){
      $condition[] = "lgs_skill_type_id='$this->lgs_skill_type_id'";
    }if(!is_null($this->lgs_merit_id)){
      $condition[] = "lgs_merit_id='$this->lgs_merit_id'";
    }if(!is_null($this->lgs_remarks)){
      $condition[] = "lgs_remarks='$this->lgs_remarks'";
    }if(!is_null($this->lgs_status)){
      $condition[] = "lgs_status='$this->lgs_status'";
    }if(!is_null($this->lgs_is_deleted)){
      $condition[] = "lgs_is_deleted='$this->lgs_is_deleted'";
    }if(!is_null($this->lgs_company_id)){
      $condition[] = "lgs_company_id='$this->lgs_company_id'";
    }if(!is_null($this->lgs_created_by)){
      $condition[] = "lgs_created_by='$this->lgs_created_by'";
    }if(!is_null($this->lgs_created_on)){
      $condition[] = "lgs_created_on='$this->lgs_created_on'";
    }if(!is_null($this->lgs_last_modified_by)){
      $condition[] = "lgs_last_modified_by='$this->lgs_last_modified_by'";
    }if(!is_null($this->lgs_last_modified_on)){
      $condition[] = "lgs_last_modified_on='$this->lgs_last_modified_on'";
    }if(!is_null($this->lgs_deleted_by)){
      $condition[] = "lgs_deleted_by='$this->lgs_deleted_by'";
    }if(!is_null($this->lgs_deleted_on)){
      $condition[] = "lgs_deleted_on='$this->lgs_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select lgs_id, lgs_employee_id, lgs_language_id, lgs_skill_type_id, lgs_merit_id, lgs_remarks, lgs_status, lgs_is_deleted, lgs_company_id, lgs_created_by, lgs_created_on, lgs_last_modified_by, lgs_last_modified_on, lgs_deleted_by, lgs_deleted_on, emi_calling_name, emi_no, syg_name, ski_name
          from hrm_trn_language_skills
              inner join hrm_employee_information on emi_id=lgs_employee_id
              inner join sys_communication_language on syg_id=lgs_language_id
              inner join hrm_language_skill on ski_id=lgs_skill_type_id
          where ".$conditionStr."
          group by lgs_employee_id, lgs_language_id
          order by emi_no asc, syg_name asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['lgs_id'].'" '; 
      if($this->lgs_id == $row['lgs_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['syg_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->lgs_id)){
      $condition[] = "lgs_id='$this->lgs_id'";
    }if(!is_null($this->lgs_employee_id)){
      $condition[] = "lgs_employee_id='$this->lgs_employee_id'";
    }if(!is_null($this->lgs_language_id)){
      $condition[] = "lgs_language_id='$this->lgs_language_id'";
    }if(!is_null($this->lgs_skill_type_id)){
      $condition[] = "lgs_skill_type_id='$this->lgs_skill_type_id'";
    }if(!is_null($this->lgs_merit_id)){
      $condition[] = "lgs_merit_id='$this->lgs_merit_id'";
    }if(!is_null($this->lgs_remarks)){
      $condition[] = "lgs_remarks='$this->lgs_remarks'";
    }if(!is_null($this->lgs_status)){
      $condition[] = "lgs_status='$this->lgs_status'";
    }if(!is_null($this->lgs_is_deleted)){
      $condition[] = "lgs_is_deleted='$this->lgs_is_deleted'";
    }if(!is_null($this->lgs_company_id)){
      $condition[] = "lgs_company_id='$this->lgs_company_id'";
    }if(!is_null($this->lgs_created_by)){
      $condition[] = "lgs_created_by='$this->lgs_created_by'";
    }if(!is_null($this->lgs_created_on)){
      $condition[] = "lgs_created_on='$this->lgs_created_on'";
    }if(!is_null($this->lgs_last_modified_by)){
      $condition[] = "lgs_last_modified_by='$this->lgs_last_modified_by'";
    }if(!is_null($this->lgs_last_modified_on)){
      $condition[] = "lgs_last_modified_on='$this->lgs_last_modified_on'";
    }if(!is_null($this->lgs_deleted_by)){
      $condition[] = "lgs_deleted_by='$this->lgs_deleted_by'";
    }if(!is_null($this->lgs_deleted_on)){
      $condition[] = "lgs_deleted_on='$this->lgs_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select lgs_id, lgs_employee_id, lgs_language_id, lgs_skill_type_id, lgs_merit_id, lgs_remarks, lgs_status, lgs_is_deleted, lgs_company_id, lgs_created_by, lgs_created_on, lgs_last_modified_by, lgs_last_modified_on, lgs_deleted_by, lgs_deleted_on
          from hrm_trn_language_skills
          where ".$conditionStr."
          order by lgs_id asc";
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
    
    $model = new cls_hrm_trn_language_skills($this->db);
  
    $model->lgs_id = $result[0]['lgs_id'];
    $model->lgs_employee_id = $result[0]['lgs_employee_id'];
    $model->lgs_language_id = $result[0]['lgs_language_id'];
    $model->lgs_skill_type_id = $result[0]['lgs_skill_type_id'];
    $model->lgs_merit_id = $result[0]['lgs_merit_id'];
    $model->lgs_remarks = $result[0]['lgs_remarks'];
    $model->lgs_status = $result[0]['lgs_status'];
    $model->lgs_is_deleted = $result[0]['lgs_is_deleted'];
    $model->lgs_company_id = $result[0]['lgs_company_id'];
    $model->lgs_created_by = $result[0]['lgs_created_by'];
    $model->lgs_created_on = $result[0]['lgs_created_on'];
    $model->lgs_last_modified_by = $result[0]['lgs_last_modified_by'];
    $model->lgs_last_modified_on = $result[0]['lgs_last_modified_on'];
    $model->lgs_deleted_by = $result[0]['lgs_deleted_by'];
    $model->lgs_deleted_on = $result[0]['lgs_deleted_on'];
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
      $model = new cls_hrm_trn_language_skills($this->db);
  
      $model->lgs_id = $row['lgs_id'];
      $model->lgs_employee_id = $row['lgs_employee_id'];
      $model->lgs_language_id = $row['lgs_language_id'];
      $model->lgs_skill_type_id = $row['lgs_skill_type_id'];
      $model->lgs_merit_id = $row['lgs_merit_id'];
      $model->lgs_remarks = $row['lgs_remarks'];
      $model->lgs_status = $row['lgs_status'];
      $model->lgs_is_deleted = $row['lgs_is_deleted'];
      $model->lgs_company_id = $row['lgs_company_id'];
      $model->lgs_created_by = $row['lgs_created_by'];
      $model->lgs_created_on = $row['lgs_created_on'];
      $model->lgs_last_modified_by = $row['lgs_last_modified_by'];
      $model->lgs_last_modified_on = $row['lgs_last_modified_on'];
      $model->lgs_deleted_by = $row['lgs_deleted_by'];
      $model->lgs_deleted_on = $row['lgs_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Skill
  */
  public function getSkill(){
    $model = new cls_hrm_language_skill($this->db);
    $model->ski_id = $this->lgs_skill_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->ski_name;
  }
  /**
  * @return Language
  */
  public function getLanguage(){
    $model = new cls_sys_communication_language($this->db);
    $model->syg_id = $this->lgs_language_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syg_name;
  }
  /**
  * @return Merit
  */
  public function getMerit(){
    $model = new cls_hrm_language_merit($this->db);
    $model->lmt_id = $this->lgs_merit_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->lmt_name;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->lgs_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->lgs_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->lgs_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->lgs_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->lgs_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->lgs_created_on))?$this->lgs_created_on:date("Y-m-d H:i:s",$this->lgs_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->lgs_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->lgs_last_modified_on))?$this->lgs_last_modified_on:date("Y-m-d H:i:s",$this->lgs_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->lgs_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->lgs_deleted_on))?$this->lgs_deleted_on:date("Y-m-d H:i:s",$this->lgs_deleted_on);
  }
}
?>

