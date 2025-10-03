<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_academic_qualification_type;

/**
 * This is the model class for table "hrm_academic_qualification_subject".
 * @property integer $aqb_id
* @property integer $aqb_qualification_type_id
* @property string $aqb_name
* @property string $aqb_remarks
* @property integer $aqb_status
* @property integer $aqb_is_deleted
* @property integer $aqb_company_id
* @property integer $aqb_created_by
* @property integer $aqb_created_on
* @property integer $aqb_last_modified_by
* @property integer $aqb_last_modified_on
* @property integer $aqb_deleted_by
* @property integer $aqb_deleted_on
*/
class cls_hrm_academic_qualification_subject {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_academic_qualification_subject';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'aqb_id' => 'Id', 
            'aqb_qualification_type_id' => 'Qualification Type', 
            'aqb_name' => 'Name', 
            'aqb_remarks' => 'Remarks', 
            'aqb_status' => 'Status', 
            'aqb_is_deleted' => 'Is Deleted', 
            'aqb_company_id' => 'Company', 
            'aqb_created_by' => 'Created By', 
            'aqb_created_on' => 'Created On', 
            'aqb_last_modified_by' => 'Last Modified By', 
            'aqb_last_modified_on' => 'Last Modified On', 
            'aqb_deleted_by' => 'Deleted By', 
            'aqb_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->aqb_id)){
      $condition[] = "aqb_id='$this->aqb_id'";
    }if(!is_null($this->aqb_qualification_type_id)){
      $condition[] = "aqb_qualification_type_id='$this->aqb_qualification_type_id'";
    }if(!is_null($this->aqb_name)){
      $condition[] = "aqb_name='$this->aqb_name'";
    }if(!is_null($this->aqb_remarks)){
      $condition[] = "aqb_remarks='$this->aqb_remarks'";
    }if(!is_null($this->aqb_status)){
      $condition[] = "aqb_status='$this->aqb_status'";
    }if(!is_null($this->aqb_is_deleted)){
      $condition[] = "aqb_is_deleted='$this->aqb_is_deleted'";
    }if(!is_null($this->aqb_company_id)){
      $condition[] = "aqb_company_id='$this->aqb_company_id'";
    }if(!is_null($this->aqb_created_by)){
      $condition[] = "aqb_created_by='$this->aqb_created_by'";
    }if(!is_null($this->aqb_created_on)){
      $condition[] = "aqb_created_on='$this->aqb_created_on'";
    }if(!is_null($this->aqb_last_modified_by)){
      $condition[] = "aqb_last_modified_by='$this->aqb_last_modified_by'";
    }if(!is_null($this->aqb_last_modified_on)){
      $condition[] = "aqb_last_modified_on='$this->aqb_last_modified_on'";
    }if(!is_null($this->aqb_deleted_by)){
      $condition[] = "aqb_deleted_by='$this->aqb_deleted_by'";
    }if(!is_null($this->aqb_deleted_on)){
      $condition[] = "aqb_deleted_on='$this->aqb_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select aqb_id, aqb_qualification_type_id, aqb_name, aqb_remarks, aqb_status, aqb_is_deleted, aqb_company_id, aqb_created_by, aqb_created_on, aqb_last_modified_by, aqb_last_modified_on, aqb_deleted_by, aqb_deleted_on, aqt_name
          from hrm_academic_qualification_subject
            inner join hrm_academic_qualification_type on aqt_id = aqb_qualification_type_id
          where ".$conditionStr."
          order by aqb_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['aqb_id'].'" '; 
      if($this->aqb_id == $row['aqb_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['aqt_name'].' - '.$row['aqb_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->aqb_id)){
      $condition[] = "aqb_id='$this->aqb_id'";
    }if(!is_null($this->aqb_qualification_type_id)){
      $condition[] = "aqb_qualification_type_id='$this->aqb_qualification_type_id'";
    }if(!is_null($this->aqb_name)){
      $condition[] = "aqb_name='$this->aqb_name'";
    }if(!is_null($this->aqb_remarks)){
      $condition[] = "aqb_remarks='$this->aqb_remarks'";
    }if(!is_null($this->aqb_status)){
      $condition[] = "aqb_status='$this->aqb_status'";
    }if(!is_null($this->aqb_is_deleted)){
      $condition[] = "aqb_is_deleted='$this->aqb_is_deleted'";
    }if(!is_null($this->aqb_company_id)){
      $condition[] = "aqb_company_id='$this->aqb_company_id'";
    }if(!is_null($this->aqb_created_by)){
      $condition[] = "aqb_created_by='$this->aqb_created_by'";
    }if(!is_null($this->aqb_created_on)){
      $condition[] = "aqb_created_on='$this->aqb_created_on'";
    }if(!is_null($this->aqb_last_modified_by)){
      $condition[] = "aqb_last_modified_by='$this->aqb_last_modified_by'";
    }if(!is_null($this->aqb_last_modified_on)){
      $condition[] = "aqb_last_modified_on='$this->aqb_last_modified_on'";
    }if(!is_null($this->aqb_deleted_by)){
      $condition[] = "aqb_deleted_by='$this->aqb_deleted_by'";
    }if(!is_null($this->aqb_deleted_on)){
      $condition[] = "aqb_deleted_on='$this->aqb_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select aqb_id, aqb_qualification_type_id, aqb_name, aqb_remarks, aqb_status, aqb_is_deleted, aqb_company_id, aqb_created_by, aqb_created_on, aqb_last_modified_by, aqb_last_modified_on, aqb_deleted_by, aqb_deleted_on
          from hrm_academic_qualification_subject
          where ".$conditionStr."
          order by aqb_id asc";
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
    
    $model = new cls_hrm_academic_qualification_subject($this->db);
  
    $model->aqb_id = $result[0]['aqb_id'];
    $model->aqb_qualification_type_id = $result[0]['aqb_qualification_type_id'];
    $model->aqb_name = $result[0]['aqb_name'];
    $model->aqb_remarks = $result[0]['aqb_remarks'];
    $model->aqb_status = $result[0]['aqb_status'];
    $model->aqb_is_deleted = $result[0]['aqb_is_deleted'];
    $model->aqb_company_id = $result[0]['aqb_company_id'];
    $model->aqb_created_by = $result[0]['aqb_created_by'];
    $model->aqb_created_on = $result[0]['aqb_created_on'];
    $model->aqb_last_modified_by = $result[0]['aqb_last_modified_by'];
    $model->aqb_last_modified_on = $result[0]['aqb_last_modified_on'];
    $model->aqb_deleted_by = $result[0]['aqb_deleted_by'];
    $model->aqb_deleted_on = $result[0]['aqb_deleted_on'];
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
      $model = new cls_hrm_academic_qualification_subject($this->db);
  
      $model->aqb_id = $row['aqb_id'];
      $model->aqb_qualification_type_id = $row['aqb_qualification_type_id'];
      $model->aqb_name = $row['aqb_name'];
      $model->aqb_remarks = $row['aqb_remarks'];
      $model->aqb_status = $row['aqb_status'];
      $model->aqb_is_deleted = $row['aqb_is_deleted'];
      $model->aqb_company_id = $row['aqb_company_id'];
      $model->aqb_created_by = $row['aqb_created_by'];
      $model->aqb_created_on = $row['aqb_created_on'];
      $model->aqb_last_modified_by = $row['aqb_last_modified_by'];
      $model->aqb_last_modified_on = $row['aqb_last_modified_on'];
      $model->aqb_deleted_by = $row['aqb_deleted_by'];
      $model->aqb_deleted_on = $row['aqb_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Qualification Type
  */
  public function getQualificationType(){
    $model = new cls_hrm_academic_qualification_type($this->db);
    $model->aqt_id = $this->aqb_qualification_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->aqt_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->aqb_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->aqb_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->aqb_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqb_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->aqb_created_on))?$this->aqb_created_on:date("Y-m-d H:i:s",$this->aqb_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqb_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->aqb_last_modified_on))?$this->aqb_last_modified_on:date("Y-m-d H:i:s",$this->aqb_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqb_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->aqb_deleted_on))?$this->aqb_deleted_on:date("Y-m-d H:i:s",$this->aqb_deleted_on);
  }
}
?>

