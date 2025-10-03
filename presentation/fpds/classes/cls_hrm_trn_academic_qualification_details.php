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
use presentation\hrm\masterData\classes\cls_hrm_academic_qualification_subject;
use presentation\hrm\classes\cls_hrm_trn_language_skills;
/**
 * This is the model class for table "hrm_trn_academic_qualification_details".
 * @property integer $eaqd_id
* @property integer $eaqd_qualification_id
* @property integer $eaqd_subject_id
* @property string $eaqd_grade
* @property string $eaqd_remarks
* @property integer $eaqd_status
* @property integer $eaqd_is_deleted
* @property integer $eaqd_location_id
* @property integer $eaqd_company_id
* @property integer $eaqd_created_by
* @property integer $eaqd_created_on
* @property integer $eaqd_last_modified_by
* @property integer $eaqd_last_modified_on
* @property integer $eaqd_deleted_by
* @property integer $eaqd_deleted_on
*/
class cls_hrm_trn_academic_qualification_details {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_academic_qualification_details';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'eaqd_id' => 'Id', 
            'eaqd_qualification_id' => 'Qualification Id', 
            'eaqd_subject_id' => 'Subject Id', 
            'eaqd_grade' => 'Grade', 
            'eaqd_remarks' => 'Remarks', 
            'eaqd_status' => 'Status', 
            'eaqd_is_deleted' => 'Is Deleted', 
            'eaqd_location_id' => 'Location Id', 
            'eaqd_company_id' => 'Company Id', 
            'eaqd_created_by' => 'Created By', 
            'eaqd_created_on' => 'Created On', 
            'eaqd_last_modified_by' => 'Last Modified By', 
            'eaqd_last_modified_on' => 'Last Modified On', 
            'eaqd_deleted_by' => 'Deleted By', 
            'eaqd_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->eaqd_id)){
      $condition[] = "eaqd_id='$this->eaqd_id'";
    }if(!is_null($this->eaqd_qualification_id)){
      $condition[] = "eaqd_qualification_id='$this->eaqd_qualification_id'";
    }if(!is_null($this->eaqd_subject_id)){
      $condition[] = "eaqd_subject_id='$this->eaqd_subject_id'";
    }if(!is_null($this->eaqd_grade)){
      $condition[] = "eaqd_grade='$this->eaqd_grade'";
    }if(!is_null($this->eaqd_remarks)){
      $condition[] = "eaqd_remarks='$this->eaqd_remarks'";
    }if(!is_null($this->eaqd_status)){
      $condition[] = "eaqd_status='$this->eaqd_status'";
    }if(!is_null($this->eaqd_is_deleted)){
      $condition[] = "eaqd_is_deleted='$this->eaqd_is_deleted'";
    }if(!is_null($this->eaqd_location_id)){
      $condition[] = "eaqd_location_id='$this->eaqd_location_id'";
    }if(!is_null($this->eaqd_company_id)){
      $condition[] = "eaqd_company_id='$this->eaqd_company_id'";
    }if(!is_null($this->eaqd_created_by)){
      $condition[] = "eaqd_created_by='$this->eaqd_created_by'";
    }if(!is_null($this->eaqd_created_on)){
      $condition[] = "eaqd_created_on='$this->eaqd_created_on'";
    }if(!is_null($this->eaqd_last_modified_by)){
      $condition[] = "eaqd_last_modified_by='$this->eaqd_last_modified_by'";
    }if(!is_null($this->eaqd_last_modified_on)){
      $condition[] = "eaqd_last_modified_on='$this->eaqd_last_modified_on'";
    }if(!is_null($this->eaqd_deleted_by)){
      $condition[] = "eaqd_deleted_by='$this->eaqd_deleted_by'";
    }if(!is_null($this->eaqd_deleted_on)){
      $condition[] = "eaqd_deleted_on='$this->eaqd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eaqd_id, eaqd_qualification_id, eaqd_subject_id, eaqd_grade, eaqd_remarks, eaqd_status, eaqd_is_deleted, eaqd_location_id, eaqd_company_id, eaqd_created_by, eaqd_created_on, eaqd_last_modified_by, eaqd_last_modified_on, eaqd_deleted_by, eaqd_deleted_on
          from hrm_trn_academic_qualification_details
          where ".$conditionStr."
          order by eaqd_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['eaqd_id'].'" '; 
      if($this->eaqd_id == $row['eaqd_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['eaqd_qualification_id'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->eaqd_id)){
      $condition[] = "eaqd_id='$this->eaqd_id'";
    }if(!is_null($this->eaqd_qualification_id)){
      $condition[] = "eaqd_qualification_id='$this->eaqd_qualification_id'";
    }if(!is_null($this->eaqd_subject_id)){
      $condition[] = "eaqd_subject_id='$this->eaqd_subject_id'";
    }if(!is_null($this->eaqd_grade)){
      $condition[] = "eaqd_grade='$this->eaqd_grade'";
    }if(!is_null($this->eaqd_remarks)){
      $condition[] = "eaqd_remarks='$this->eaqd_remarks'";
    }if(!is_null($this->eaqd_status)){
      $condition[] = "eaqd_status='$this->eaqd_status'";
    }if(!is_null($this->eaqd_is_deleted)){
      $condition[] = "eaqd_is_deleted='$this->eaqd_is_deleted'";
    }if(!is_null($this->eaqd_location_id)){
      $condition[] = "eaqd_location_id='$this->eaqd_location_id'";
    }if(!is_null($this->eaqd_company_id)){
      $condition[] = "eaqd_company_id='$this->eaqd_company_id'";
    }if(!is_null($this->eaqd_created_by)){
      $condition[] = "eaqd_created_by='$this->eaqd_created_by'";
    }if(!is_null($this->eaqd_created_on)){
      $condition[] = "eaqd_created_on='$this->eaqd_created_on'";
    }if(!is_null($this->eaqd_last_modified_by)){
      $condition[] = "eaqd_last_modified_by='$this->eaqd_last_modified_by'";
    }if(!is_null($this->eaqd_last_modified_on)){
      $condition[] = "eaqd_last_modified_on='$this->eaqd_last_modified_on'";
    }if(!is_null($this->eaqd_deleted_by)){
      $condition[] = "eaqd_deleted_by='$this->eaqd_deleted_by'";
    }if(!is_null($this->eaqd_deleted_on)){
      $condition[] = "eaqd_deleted_on='$this->eaqd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eaqd_id, eaqd_qualification_id, eaqd_subject_id, eaqd_grade, eaqd_remarks, eaqd_status, eaqd_is_deleted, eaqd_location_id, eaqd_company_id, eaqd_created_by, eaqd_created_on, eaqd_last_modified_by, eaqd_last_modified_on, eaqd_deleted_by, eaqd_deleted_on
          from hrm_trn_academic_qualification_details
          where ".$conditionStr."
          order by eaqd_id asc";
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
    
    $model = new cls_hrm_trn_academic_qualification_details($this->db);
  
    $model->eaqd_id = $result[0]['eaqd_id'];
    $model->eaqd_qualification_id = $result[0]['eaqd_qualification_id'];
    $model->eaqd_subject_id = $result[0]['eaqd_subject_id'];
    $model->eaqd_grade = $result[0]['eaqd_grade'];
    $model->eaqd_remarks = $result[0]['eaqd_remarks'];
    $model->eaqd_status = $result[0]['eaqd_status'];
    $model->eaqd_is_deleted = $result[0]['eaqd_is_deleted'];
    $model->eaqd_location_id = $result[0]['eaqd_location_id'];
    $model->eaqd_company_id = $result[0]['eaqd_company_id'];
    $model->eaqd_created_by = $result[0]['eaqd_created_by'];
    $model->eaqd_created_on = $result[0]['eaqd_created_on'];
    $model->eaqd_last_modified_by = $result[0]['eaqd_last_modified_by'];
    $model->eaqd_last_modified_on = $result[0]['eaqd_last_modified_on'];
    $model->eaqd_deleted_by = $result[0]['eaqd_deleted_by'];
    $model->eaqd_deleted_on = $result[0]['eaqd_deleted_on'];
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
      $model = new cls_hrm_trn_academic_qualification_details($this->db);
  
      $model->eaqd_id = $row['eaqd_id'];
      $model->eaqd_qualification_id = $row['eaqd_qualification_id'];
      $model->eaqd_subject_id = $row['eaqd_subject_id'];
      $model->eaqd_grade = $row['eaqd_grade'];
      $model->eaqd_remarks = $row['eaqd_remarks'];
      $model->eaqd_status = $row['eaqd_status'];
      $model->eaqd_is_deleted = $row['eaqd_is_deleted'];
      $model->eaqd_location_id = $row['eaqd_location_id'];
      $model->eaqd_company_id = $row['eaqd_company_id'];
      $model->eaqd_created_by = $row['eaqd_created_by'];
      $model->eaqd_created_on = $row['eaqd_created_on'];
      $model->eaqd_last_modified_by = $row['eaqd_last_modified_by'];
      $model->eaqd_last_modified_on = $row['eaqd_last_modified_on'];
      $model->eaqd_deleted_by = $row['eaqd_deleted_by'];
      $model->eaqd_deleted_on = $row['eaqd_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Subject
  */
  public function getSubject(){
    $model = new cls_hrm_academic_qualification_subject($this->db);
    $model->aqb_id = $this->eaqd_subject_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->aqb_name;
  } 
  /**
  * @return languageSkills 
  */
  public function getModelLanguageSkills(){
    $model = new cls_hrm_trn_language_skills($this->db);
    $model->lgs_id = $this->eaqd_qualification_id;
    return (is_null($model->getRecords()))?null:$model->findModel();
  }
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->eaqd_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->eaqd_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->eaqd_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->eaqd_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eaqd_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->eaqd_created_on))?$this->eaqd_created_on:date("Y-m-d H:i:s",$this->eaqd_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eaqd_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->eaqd_last_modified_on))?$this->eaqd_last_modified_on:date("Y-m-d H:i:s",$this->eaqd_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eaqd_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->eaqd_deleted_on))?$this->eaqd_deleted_on:date("Y-m-d H:i:s",$this->eaqd_deleted_on);
  }
}
?>

