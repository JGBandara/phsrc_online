<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "hrm_dependence_work_type".
 * @property integer $emw_id
* @property string $emw_name
* @property string $emw_remarks
* @property integer $emw_status
* @property integer $emw_is_deleted
* @property integer $emw_company_id
* @property integer $emw_created_by
* @property integer $emw_created_on
* @property integer $emw_last_modified_by
* @property integer $emw_last_modified_on
* @property integer $emw_deleted_by
* @property integer $emw_deleted_on
*/
class cls_hrm_dependence_work_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_dependence_work_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'emw_id' => 'Id', 
            'emw_name' => 'Name', 
            'emw_remarks' => 'Remarks', 
            'emw_status' => 'Status', 
            'emw_is_deleted' => 'Is Deleted', 
            'emw_company_id' => 'Company Id', 
            'emw_created_by' => 'Created By', 
            'emw_created_on' => 'Created On', 
            'emw_last_modified_by' => 'Last Modified By', 
            'emw_last_modified_on' => 'Last Modified On', 
            'emw_deleted_by' => 'Deleted By', 
            'emw_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->emw_id)){
      $condition[] = "emw_id='$this->emw_id'";
    }if(!is_null($this->emw_name)){
      $condition[] = "emw_name='$this->emw_name'";
    }if(!is_null($this->emw_remarks)){
      $condition[] = "emw_remarks='$this->emw_remarks'";
    }if(!is_null($this->emw_status)){
      $condition[] = "emw_status='$this->emw_status'";
    }if(!is_null($this->emw_is_deleted)){
      $condition[] = "emw_is_deleted='$this->emw_is_deleted'";
    }if(!is_null($this->emw_company_id)){
      $condition[] = "emw_company_id='$this->emw_company_id'";
    }if(!is_null($this->emw_created_by)){
      $condition[] = "emw_created_by='$this->emw_created_by'";
    }if(!is_null($this->emw_created_on)){
      $condition[] = "emw_created_on='$this->emw_created_on'";
    }if(!is_null($this->emw_last_modified_by)){
      $condition[] = "emw_last_modified_by='$this->emw_last_modified_by'";
    }if(!is_null($this->emw_last_modified_on)){
      $condition[] = "emw_last_modified_on='$this->emw_last_modified_on'";
    }if(!is_null($this->emw_deleted_by)){
      $condition[] = "emw_deleted_by='$this->emw_deleted_by'";
    }if(!is_null($this->emw_deleted_on)){
      $condition[] = "emw_deleted_on='$this->emw_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emw_id, emw_name, emw_remarks, emw_status, emw_is_deleted, emw_company_id, emw_created_by, emw_created_on, emw_last_modified_by, emw_last_modified_on, emw_deleted_by, emw_deleted_on
          from hrm_dependence_work_type
          where ".$conditionStr."
          order by emw_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['emw_id'].'" '; 
      if($this->emw_id == $row['emw_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emw_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->emw_id)){
      $condition[] = "emw_id='$this->emw_id'";
    }if(!is_null($this->emw_name)){
      $condition[] = "emw_name='$this->emw_name'";
    }if(!is_null($this->emw_remarks)){
      $condition[] = "emw_remarks='$this->emw_remarks'";
    }if(!is_null($this->emw_status)){
      $condition[] = "emw_status='$this->emw_status'";
    }if(!is_null($this->emw_is_deleted)){
      $condition[] = "emw_is_deleted='$this->emw_is_deleted'";
    }if(!is_null($this->emw_company_id)){
      $condition[] = "emw_company_id='$this->emw_company_id'";
    }if(!is_null($this->emw_created_by)){
      $condition[] = "emw_created_by='$this->emw_created_by'";
    }if(!is_null($this->emw_created_on)){
      $condition[] = "emw_created_on='$this->emw_created_on'";
    }if(!is_null($this->emw_last_modified_by)){
      $condition[] = "emw_last_modified_by='$this->emw_last_modified_by'";
    }if(!is_null($this->emw_last_modified_on)){
      $condition[] = "emw_last_modified_on='$this->emw_last_modified_on'";
    }if(!is_null($this->emw_deleted_by)){
      $condition[] = "emw_deleted_by='$this->emw_deleted_by'";
    }if(!is_null($this->emw_deleted_on)){
      $condition[] = "emw_deleted_on='$this->emw_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emw_id, emw_name, emw_remarks, emw_status, emw_is_deleted, emw_company_id, emw_created_by, emw_created_on, emw_last_modified_by, emw_last_modified_on, emw_deleted_by, emw_deleted_on
          from hrm_dependence_work_type
          where ".$conditionStr."
          order by emw_id asc";
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
    
    $model = new cls_hrm_dependence_work_type($this->db);
  
    $model->emw_id = $result[0]['emw_id'];
    $model->emw_name = $result[0]['emw_name'];
    $model->emw_remarks = $result[0]['emw_remarks'];
    $model->emw_status = $result[0]['emw_status'];
    $model->emw_is_deleted = $result[0]['emw_is_deleted'];
    $model->emw_company_id = $result[0]['emw_company_id'];
    $model->emw_created_by = $result[0]['emw_created_by'];
    $model->emw_created_on = $result[0]['emw_created_on'];
    $model->emw_last_modified_by = $result[0]['emw_last_modified_by'];
    $model->emw_last_modified_on = $result[0]['emw_last_modified_on'];
    $model->emw_deleted_by = $result[0]['emw_deleted_by'];
    $model->emw_deleted_on = $result[0]['emw_deleted_on'];
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
      $model = new cls_hrm_dependence_work_type($this->db);
  
      $model->emw_id = $row['emw_id'];
      $model->emw_name = $row['emw_name'];
      $model->emw_remarks = $row['emw_remarks'];
      $model->emw_status = $row['emw_status'];
      $model->emw_is_deleted = $row['emw_is_deleted'];
      $model->emw_company_id = $row['emw_company_id'];
      $model->emw_created_by = $row['emw_created_by'];
      $model->emw_created_on = $row['emw_created_on'];
      $model->emw_last_modified_by = $row['emw_last_modified_by'];
      $model->emw_last_modified_on = $row['emw_last_modified_on'];
      $model->emw_deleted_by = $row['emw_deleted_by'];
      $model->emw_deleted_on = $row['emw_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->emw_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->emw_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->emw_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emw_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->emw_created_on))?$this->emw_created_on:date("Y-m-d H:i:s",$this->emw_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emw_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->emw_last_modified_on))?$this->emw_last_modified_on:date("Y-m-d H:i:s",$this->emw_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emw_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->emw_deleted_on))?$this->emw_deleted_on:date("Y-m-d H:i:s",$this->emw_deleted_on);
  }
}
?>

