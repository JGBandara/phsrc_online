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

/**
 * This is the model class for table "hrm_duty_type".
 * @property integer $dtt_id
* @property string $dtt_name
* @property string $dtt_remarks
* @property integer $dtt_status
* @property integer $dtt_is_deleted
* @property integer $dtt_company_id
* @property integer $dtt_created_by
* @property integer $dtt_created_on
* @property integer $dtt_last_modified_by
* @property integer $dtt_last_modified_on
* @property integer $dtt_deleted_by
* @property integer $dtt_deleted_on
*/
class cls_hrm_duty_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_duty_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dtt_id' => 'Id', 
            'dtt_name' => 'Name', 
            'dtt_remarks' => 'Remarks', 
            'dtt_status' => 'Status', 
            'dtt_is_deleted' => 'Is Deleted', 
            'dtt_company_id' => 'Company Id', 
            'dtt_created_by' => 'Created By', 
            'dtt_created_on' => 'Created On', 
            'dtt_last_modified_by' => 'Last Modified By', 
            'dtt_last_modified_on' => 'Last Modified On', 
            'dtt_deleted_by' => 'Deleted By', 
            'dtt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dtt_id)){
      $condition[] = "dtt_id='$this->dtt_id'";
    }if(!is_null($this->dtt_name)){
      $condition[] = "dtt_name='$this->dtt_name'";
    }if(!is_null($this->dtt_remarks)){
      $condition[] = "dtt_remarks='$this->dtt_remarks'";
    }if(!is_null($this->dtt_status)){
      $condition[] = "dtt_status='$this->dtt_status'";
    }if(!is_null($this->dtt_is_deleted)){
      $condition[] = "dtt_is_deleted='$this->dtt_is_deleted'";
    }if(!is_null($this->dtt_company_id)){
      $condition[] = "dtt_company_id='$this->dtt_company_id'";
    }if(!is_null($this->dtt_created_by)){
      $condition[] = "dtt_created_by='$this->dtt_created_by'";
    }if(!is_null($this->dtt_created_on)){
      $condition[] = "dtt_created_on='$this->dtt_created_on'";
    }if(!is_null($this->dtt_last_modified_by)){
      $condition[] = "dtt_last_modified_by='$this->dtt_last_modified_by'";
    }if(!is_null($this->dtt_last_modified_on)){
      $condition[] = "dtt_last_modified_on='$this->dtt_last_modified_on'";
    }if(!is_null($this->dtt_deleted_by)){
      $condition[] = "dtt_deleted_by='$this->dtt_deleted_by'";
    }if(!is_null($this->dtt_deleted_on)){
      $condition[] = "dtt_deleted_on='$this->dtt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dtt_id, dtt_name, dtt_remarks, dtt_status, dtt_is_deleted, dtt_company_id, dtt_created_by, dtt_created_on, dtt_last_modified_by, dtt_last_modified_on, dtt_deleted_by, dtt_deleted_on
          from hrm_duty_type
          where ".$conditionStr."
          order by dtt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dtt_id'].'" '; 
      if($this->dtt_id == $row['dtt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dtt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dtt_id)){
      $condition[] = "dtt_id='$this->dtt_id'";
    }if(!is_null($this->dtt_name)){
      $condition[] = "dtt_name='$this->dtt_name'";
    }if(!is_null($this->dtt_remarks)){
      $condition[] = "dtt_remarks='$this->dtt_remarks'";
    }if(!is_null($this->dtt_status)){
      $condition[] = "dtt_status='$this->dtt_status'";
    }if(!is_null($this->dtt_is_deleted)){
      $condition[] = "dtt_is_deleted='$this->dtt_is_deleted'";
    }if(!is_null($this->dtt_company_id)){
      $condition[] = "dtt_company_id='$this->dtt_company_id'";
    }if(!is_null($this->dtt_created_by)){
      $condition[] = "dtt_created_by='$this->dtt_created_by'";
    }if(!is_null($this->dtt_created_on)){
      $condition[] = "dtt_created_on='$this->dtt_created_on'";
    }if(!is_null($this->dtt_last_modified_by)){
      $condition[] = "dtt_last_modified_by='$this->dtt_last_modified_by'";
    }if(!is_null($this->dtt_last_modified_on)){
      $condition[] = "dtt_last_modified_on='$this->dtt_last_modified_on'";
    }if(!is_null($this->dtt_deleted_by)){
      $condition[] = "dtt_deleted_by='$this->dtt_deleted_by'";
    }if(!is_null($this->dtt_deleted_on)){
      $condition[] = "dtt_deleted_on='$this->dtt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dtt_id, dtt_name, dtt_remarks, dtt_status, dtt_is_deleted, dtt_company_id, dtt_created_by, dtt_created_on, dtt_last_modified_by, dtt_last_modified_on, dtt_deleted_by, dtt_deleted_on
          from hrm_duty_type
          where ".$conditionStr."
          order by dtt_id asc";
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
    
    $model = new cls_hrm_duty_type($this->db);
  
    $model->dtt_id = $result[0]['dtt_id'];
    $model->dtt_name = $result[0]['dtt_name'];
    $model->dtt_remarks = $result[0]['dtt_remarks'];
    $model->dtt_status = $result[0]['dtt_status'];
    $model->dtt_is_deleted = $result[0]['dtt_is_deleted'];
    $model->dtt_company_id = $result[0]['dtt_company_id'];
    $model->dtt_created_by = $result[0]['dtt_created_by'];
    $model->dtt_created_on = $result[0]['dtt_created_on'];
    $model->dtt_last_modified_by = $result[0]['dtt_last_modified_by'];
    $model->dtt_last_modified_on = $result[0]['dtt_last_modified_on'];
    $model->dtt_deleted_by = $result[0]['dtt_deleted_by'];
    $model->dtt_deleted_on = $result[0]['dtt_deleted_on'];
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
      $model = new cls_hrm_duty_type($this->db);
  
      $model->dtt_id = $row['dtt_id'];
      $model->dtt_name = $row['dtt_name'];
      $model->dtt_remarks = $row['dtt_remarks'];
      $model->dtt_status = $row['dtt_status'];
      $model->dtt_is_deleted = $row['dtt_is_deleted'];
      $model->dtt_company_id = $row['dtt_company_id'];
      $model->dtt_created_by = $row['dtt_created_by'];
      $model->dtt_created_on = $row['dtt_created_on'];
      $model->dtt_last_modified_by = $row['dtt_last_modified_by'];
      $model->dtt_last_modified_on = $row['dtt_last_modified_on'];
      $model->dtt_deleted_by = $row['dtt_deleted_by'];
      $model->dtt_deleted_on = $row['dtt_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dtt_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dtt_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dtt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dtt_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dtt_created_on))?$this->dtt_created_on:date("Y-m-d H:i:s",$this->dtt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dtt_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dtt_last_modified_on))?$this->dtt_last_modified_on:date("Y-m-d H:i:s",$this->dtt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dtt_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dtt_deleted_on))?$this->dtt_deleted_on:date("Y-m-d H:i:s",$this->dtt_deleted_on);
  }
}
?>

