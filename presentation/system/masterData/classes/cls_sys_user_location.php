<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-21
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;

/**
 * This is the model class for table "sys_user_location".
 * @property integer $syo_id
* @property integer $syo_location_id
* @property integer $syo_user_id
* @property string $syo_remarks
* @property integer $syo_status
* @property integer $syo_is_deleted
* @property integer $syo_company_id
* @property integer $syo_created_by
* @property integer $syo_created_on
* @property integer $syo_last_modified_by
* @property integer $syo_last_modified_on
* @property integer $syo_deleted_by
* @property integer $syo_deleted_on
*/
class cls_sys_user_location {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_user_location';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syo_id' => 'Id', 
            'syo_location_id' => 'Location Id', 
            'syo_user_id' => 'User Id', 
            'syo_remarks' => 'Remarks', 
            'syo_status' => 'Status', 
            'syo_is_deleted' => 'Is Deleted', 
            'syo_company_id' => 'Company Id', 
            'syo_created_by' => 'Created By', 
            'syo_created_on' => 'Created On', 
            'syo_last_modified_by' => 'Last Modified By', 
            'syo_last_modified_on' => 'Last Modified On', 
            'syo_deleted_by' => 'Deleted By', 
            'syo_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syo_id)){
      $condition[] = "syo_id='$this->syo_id'";
    }if(!is_null($this->syo_location_id)){
      $condition[] = "syo_location_id='$this->syo_location_id'";
    }if(!is_null($this->syo_user_id)){
      $condition[] = "syo_user_id='$this->syo_user_id'";
    }if(!is_null($this->syo_remarks)){
      $condition[] = "syo_remarks='$this->syo_remarks'";
    }if(!is_null($this->syo_status)){
      $condition[] = "syo_status='$this->syo_status'";
    }if(!is_null($this->syo_is_deleted)){
      $condition[] = "syo_is_deleted='$this->syo_is_deleted'";
    }if(!is_null($this->syo_company_id)){
      $condition[] = "syo_company_id='$this->syo_company_id'";
    }if(!is_null($this->syo_created_by)){
      $condition[] = "syo_created_by='$this->syo_created_by'";
    }if(!is_null($this->syo_created_on)){
      $condition[] = "syo_created_on='$this->syo_created_on'";
    }if(!is_null($this->syo_last_modified_by)){
      $condition[] = "syo_last_modified_by='$this->syo_last_modified_by'";
    }if(!is_null($this->syo_last_modified_on)){
      $condition[] = "syo_last_modified_on='$this->syo_last_modified_on'";
    }if(!is_null($this->syo_deleted_by)){
      $condition[] = "syo_deleted_by='$this->syo_deleted_by'";
    }if(!is_null($this->syo_deleted_on)){
      $condition[] = "syo_deleted_on='$this->syo_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syo_id, syo_location_id, syo_user_id, syo_remarks, syo_status, syo_is_deleted, syo_company_id, syo_created_by, syo_created_on, syo_last_modified_by, syo_last_modified_on, syo_deleted_by, syo_deleted_on
          from sys_user_location
          where ".$conditionStr."
          order by syo_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syo_id'].'" '; 
      if($this->syo_id == $row['syo_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syo_location_id'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syo_id)){
      $condition[] = "syo_id='$this->syo_id'";
    }if(!is_null($this->syo_location_id)){
      $condition[] = "syo_location_id='$this->syo_location_id'";
    }if(!is_null($this->syo_user_id)){
      $condition[] = "syo_user_id='$this->syo_user_id'";
    }if(!is_null($this->syo_remarks)){
      $condition[] = "syo_remarks='$this->syo_remarks'";
    }if(!is_null($this->syo_status)){
      $condition[] = "syo_status='$this->syo_status'";
    }if(!is_null($this->syo_is_deleted)){
      $condition[] = "syo_is_deleted='$this->syo_is_deleted'";
    }if(!is_null($this->syo_company_id)){
      $condition[] = "syo_company_id='$this->syo_company_id'";
    }if(!is_null($this->syo_created_by)){
      $condition[] = "syo_created_by='$this->syo_created_by'";
    }if(!is_null($this->syo_created_on)){
      $condition[] = "syo_created_on='$this->syo_created_on'";
    }if(!is_null($this->syo_last_modified_by)){
      $condition[] = "syo_last_modified_by='$this->syo_last_modified_by'";
    }if(!is_null($this->syo_last_modified_on)){
      $condition[] = "syo_last_modified_on='$this->syo_last_modified_on'";
    }if(!is_null($this->syo_deleted_by)){
      $condition[] = "syo_deleted_by='$this->syo_deleted_by'";
    }if(!is_null($this->syo_deleted_on)){
      $condition[] = "syo_deleted_on='$this->syo_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syo_id, syo_location_id, syo_user_id, syo_remarks, syo_status, syo_is_deleted, syo_company_id, syo_created_by, syo_created_on, syo_last_modified_by, syo_last_modified_on, syo_deleted_by, syo_deleted_on
          from sys_user_location
          where ".$conditionStr."
          order by syo_id asc";
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
    
    $model = new cls_sys_user_location($this->db);
  
    $model->syo_id = $result[0]['syo_id'];
    $model->syo_location_id = $result[0]['syo_location_id'];
    $model->syo_user_id = $result[0]['syo_user_id'];
    $model->syo_remarks = $result[0]['syo_remarks'];
    $model->syo_status = $result[0]['syo_status'];
    $model->syo_is_deleted = $result[0]['syo_is_deleted'];
    $model->syo_company_id = $result[0]['syo_company_id'];
    $model->syo_created_by = $result[0]['syo_created_by'];
    $model->syo_created_on = $result[0]['syo_created_on'];
    $model->syo_last_modified_by = $result[0]['syo_last_modified_by'];
    $model->syo_last_modified_on = $result[0]['syo_last_modified_on'];
    $model->syo_deleted_by = $result[0]['syo_deleted_by'];
    $model->syo_deleted_on = $result[0]['syo_deleted_on'];
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
      $model = new cls_sys_user_location($this->db);
  
      $model->syo_id = $row['syo_id'];
      $model->syo_location_id = $row['syo_location_id'];
      $model->syo_user_id = $row['syo_user_id'];
      $model->syo_remarks = $row['syo_remarks'];
      $model->syo_status = $row['syo_status'];
      $model->syo_is_deleted = $row['syo_is_deleted'];
      $model->syo_company_id = $row['syo_company_id'];
      $model->syo_created_by = $row['syo_created_by'];
      $model->syo_created_on = $row['syo_created_on'];
      $model->syo_last_modified_by = $row['syo_last_modified_by'];
      $model->syo_last_modified_on = $row['syo_last_modified_on'];
      $model->syo_deleted_by = $row['syo_deleted_by'];
      $model->syo_deleted_on = $row['syo_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Location
  */
  public function getUser(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syo_user_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->syo_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->syo_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->syo_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syo_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syo_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syo_created_on))?$this->syo_created_on:date("Y-m-d H:i:s",$this->syo_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syo_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syo_last_modified_on))?$this->syo_last_modified_on:date("Y-m-d H:i:s",$this->syo_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syo_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syo_deleted_on))?$this->syo_deleted_on:date("Y-m-d H:i:s",$this->syo_deleted_on);
  }
}
?>

