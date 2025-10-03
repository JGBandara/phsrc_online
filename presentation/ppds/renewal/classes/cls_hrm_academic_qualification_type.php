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

/**
 * This is the model class for table "hrm_academic_qualification_type".
 * @property integer $aqt_id
* @property string $aqt_name
* @property string $aqt_remarks
* @property integer $aqt_status
* @property integer $aqt_is_deleted
* @property integer $aqt_company_id
* @property integer $aqt_created_by
* @property integer $aqt_created_on
* @property integer $aqt_last_modified_by
* @property integer $aqt_last_modified_on
* @property integer $aqt_deleted_by
* @property integer $aqt_deleted_on
*/
class cls_hrm_academic_qualification_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_academic_qualification_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'aqt_id' => 'Id', 
            'aqt_name' => 'Name', 
            'aqt_remarks' => 'Remarks', 
            'aqt_status' => 'Status', 
            'aqt_is_deleted' => 'Is Deleted', 
            'aqt_company_id' => 'Company', 
            'aqt_created_by' => 'Created By', 
            'aqt_created_on' => 'Created On', 
            'aqt_last_modified_by' => 'Last Modified By', 
            'aqt_last_modified_on' => 'Last Modified On', 
            'aqt_deleted_by' => 'Deleted By', 
            'aqt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->aqt_id)){
      $condition[] = "aqt_id='$this->aqt_id'";
    }if(!is_null($this->aqt_name)){
      $condition[] = "aqt_name='$this->aqt_name'";
    }if(!is_null($this->aqt_remarks)){
      $condition[] = "aqt_remarks='$this->aqt_remarks'";
    }if(!is_null($this->aqt_status)){
      $condition[] = "aqt_status='$this->aqt_status'";
    }if(!is_null($this->aqt_is_deleted)){
      $condition[] = "aqt_is_deleted='$this->aqt_is_deleted'";
    }if(!is_null($this->aqt_company_id)){
      $condition[] = "aqt_company_id='$this->aqt_company_id'";
    }if(!is_null($this->aqt_created_by)){
      $condition[] = "aqt_created_by='$this->aqt_created_by'";
    }if(!is_null($this->aqt_created_on)){
      $condition[] = "aqt_created_on='$this->aqt_created_on'";
    }if(!is_null($this->aqt_last_modified_by)){
      $condition[] = "aqt_last_modified_by='$this->aqt_last_modified_by'";
    }if(!is_null($this->aqt_last_modified_on)){
      $condition[] = "aqt_last_modified_on='$this->aqt_last_modified_on'";
    }if(!is_null($this->aqt_deleted_by)){
      $condition[] = "aqt_deleted_by='$this->aqt_deleted_by'";
    }if(!is_null($this->aqt_deleted_on)){
      $condition[] = "aqt_deleted_on='$this->aqt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select aqt_id, aqt_name, aqt_remarks, aqt_status, aqt_is_deleted, aqt_company_id, aqt_created_by, aqt_created_on, aqt_last_modified_by, aqt_last_modified_on, aqt_deleted_by, aqt_deleted_on
          from hrm_academic_qualification_type
          where ".$conditionStr."
          order by aqt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['aqt_id'].'" '; 
      if($this->aqt_id == $row['aqt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['aqt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->aqt_id)){
      $condition[] = "aqt_id='$this->aqt_id'";
    }if(!is_null($this->aqt_name)){
      $condition[] = "aqt_name='$this->aqt_name'";
    }if(!is_null($this->aqt_remarks)){
      $condition[] = "aqt_remarks='$this->aqt_remarks'";
    }if(!is_null($this->aqt_status)){
      $condition[] = "aqt_status='$this->aqt_status'";
    }if(!is_null($this->aqt_is_deleted)){
      $condition[] = "aqt_is_deleted='$this->aqt_is_deleted'";
    }if(!is_null($this->aqt_company_id)){
      $condition[] = "aqt_company_id='$this->aqt_company_id'";
    }if(!is_null($this->aqt_created_by)){
      $condition[] = "aqt_created_by='$this->aqt_created_by'";
    }if(!is_null($this->aqt_created_on)){
      $condition[] = "aqt_created_on='$this->aqt_created_on'";
    }if(!is_null($this->aqt_last_modified_by)){
      $condition[] = "aqt_last_modified_by='$this->aqt_last_modified_by'";
    }if(!is_null($this->aqt_last_modified_on)){
      $condition[] = "aqt_last_modified_on='$this->aqt_last_modified_on'";
    }if(!is_null($this->aqt_deleted_by)){
      $condition[] = "aqt_deleted_by='$this->aqt_deleted_by'";
    }if(!is_null($this->aqt_deleted_on)){
      $condition[] = "aqt_deleted_on='$this->aqt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select aqt_id, aqt_name, aqt_remarks, aqt_status, aqt_is_deleted, aqt_company_id, aqt_created_by, aqt_created_on, aqt_last_modified_by, aqt_last_modified_on, aqt_deleted_by, aqt_deleted_on
          from hrm_academic_qualification_type
          where ".$conditionStr."
          order by aqt_id asc";
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
    
    $model = new cls_hrm_academic_qualification_type($this->db);
  
    $model->aqt_id = $result[0]['aqt_id'];
    $model->aqt_name = $result[0]['aqt_name'];
    $model->aqt_remarks = $result[0]['aqt_remarks'];
    $model->aqt_status = $result[0]['aqt_status'];
    $model->aqt_is_deleted = $result[0]['aqt_is_deleted'];
    $model->aqt_company_id = $result[0]['aqt_company_id'];
    $model->aqt_created_by = $result[0]['aqt_created_by'];
    $model->aqt_created_on = $result[0]['aqt_created_on'];
    $model->aqt_last_modified_by = $result[0]['aqt_last_modified_by'];
    $model->aqt_last_modified_on = $result[0]['aqt_last_modified_on'];
    $model->aqt_deleted_by = $result[0]['aqt_deleted_by'];
    $model->aqt_deleted_on = $result[0]['aqt_deleted_on'];
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
      $model = new cls_hrm_academic_qualification_type($this->db);
  
      $model->aqt_id = $row['aqt_id'];
      $model->aqt_name = $row['aqt_name'];
      $model->aqt_remarks = $row['aqt_remarks'];
      $model->aqt_status = $row['aqt_status'];
      $model->aqt_is_deleted = $row['aqt_is_deleted'];
      $model->aqt_company_id = $row['aqt_company_id'];
      $model->aqt_created_by = $row['aqt_created_by'];
      $model->aqt_created_on = $row['aqt_created_on'];
      $model->aqt_last_modified_by = $row['aqt_last_modified_by'];
      $model->aqt_last_modified_on = $row['aqt_last_modified_on'];
      $model->aqt_deleted_by = $row['aqt_deleted_by'];
      $model->aqt_deleted_on = $row['aqt_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->aqt_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->aqt_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->aqt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqt_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->aqt_created_on))?$this->aqt_created_on:date("Y-m-d H:i:s",$this->aqt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqt_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->aqt_last_modified_on))?$this->aqt_last_modified_on:date("Y-m-d H:i:s",$this->aqt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqt_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->aqt_deleted_on))?$this->aqt_deleted_on:date("Y-m-d H:i:s",$this->aqt_deleted_on);
  }
}
?>

