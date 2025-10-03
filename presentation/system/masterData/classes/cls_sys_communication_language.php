<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;

/**
 * This is the model class for table "sys_communication_language".
 * @property integer $syg_id
* @property string $syg_name
* @property string $syg_remarks
* @property integer $syg_status
* @property integer $syg_is_deleted
* @property integer $syg_company_id
* @property integer $syg_created_by
* @property integer $syg_created_on
* @property integer $syg_last_modified_by
* @property integer $syg_last_modified_on
* @property integer $syg_deleted_by
* @property integer $syg_deleted_on
*/
class cls_sys_communication_language {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_communication_language';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syg_id' => 'Id', 
            'syg_name' => 'Name', 
            'syg_remarks' => 'Remarks', 
            'syg_status' => 'Status', 
            'syg_is_deleted' => 'Is Deleted', 
            'syg_company_id' => 'Company Id', 
            'syg_created_by' => 'Created By', 
            'syg_created_on' => 'Created On', 
            'syg_last_modified_by' => 'Last Modified By', 
            'syg_last_modified_on' => 'Last Modified On', 
            'syg_deleted_by' => 'Deleted By', 
            'syg_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syg_id)){
      $condition[] = "syg_id='$this->syg_id'";
    }if(!is_null($this->syg_name)){
      $condition[] = "syg_name='$this->syg_name'";
    }if(!is_null($this->syg_remarks)){
      $condition[] = "syg_remarks='$this->syg_remarks'";
    }if(!is_null($this->syg_status)){
      $condition[] = "syg_status='$this->syg_status'";
    }if(!is_null($this->syg_is_deleted)){
      $condition[] = "syg_is_deleted='$this->syg_is_deleted'";
    }if(!is_null($this->syg_company_id)){
      $condition[] = "syg_company_id='$this->syg_company_id'";
    }if(!is_null($this->syg_created_by)){
      $condition[] = "syg_created_by='$this->syg_created_by'";
    }if(!is_null($this->syg_created_on)){
      $condition[] = "syg_created_on='$this->syg_created_on'";
    }if(!is_null($this->syg_last_modified_by)){
      $condition[] = "syg_last_modified_by='$this->syg_last_modified_by'";
    }if(!is_null($this->syg_last_modified_on)){
      $condition[] = "syg_last_modified_on='$this->syg_last_modified_on'";
    }if(!is_null($this->syg_deleted_by)){
      $condition[] = "syg_deleted_by='$this->syg_deleted_by'";
    }if(!is_null($this->syg_deleted_on)){
      $condition[] = "syg_deleted_on='$this->syg_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select syg_id, syg_name, syg_remarks, syg_status, syg_is_deleted, syg_company_id, syg_created_by, syg_created_on, syg_last_modified_by, syg_last_modified_on, syg_deleted_by, syg_deleted_on
          from sys_communication_language
          where ".$conditionStr."
          order by syg_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syg_id'].'" '; 
      if($this->syg_id == $row['syg_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syg_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syg_id)){
      $condition[] = "syg_id='$this->syg_id'";
    }if(!is_null($this->syg_name)){
      $condition[] = "syg_name='$this->syg_name'";
    }if(!is_null($this->syg_remarks)){
      $condition[] = "syg_remarks='$this->syg_remarks'";
    }if(!is_null($this->syg_status)){
      $condition[] = "syg_status='$this->syg_status'";
    }if(!is_null($this->syg_is_deleted)){
      $condition[] = "syg_is_deleted='$this->syg_is_deleted'";
    }if(!is_null($this->syg_company_id)){
      $condition[] = "syg_company_id='$this->syg_company_id'";
    }if(!is_null($this->syg_created_by)){
      $condition[] = "syg_created_by='$this->syg_created_by'";
    }if(!is_null($this->syg_created_on)){
      $condition[] = "syg_created_on='$this->syg_created_on'";
    }if(!is_null($this->syg_last_modified_by)){
      $condition[] = "syg_last_modified_by='$this->syg_last_modified_by'";
    }if(!is_null($this->syg_last_modified_on)){
      $condition[] = "syg_last_modified_on='$this->syg_last_modified_on'";
    }if(!is_null($this->syg_deleted_by)){
      $condition[] = "syg_deleted_by='$this->syg_deleted_by'";
    }if(!is_null($this->syg_deleted_on)){
      $condition[] = "syg_deleted_on='$this->syg_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select syg_id, syg_name, syg_remarks, syg_status, syg_is_deleted, syg_company_id, syg_created_by, syg_created_on, syg_last_modified_by, syg_last_modified_on, syg_deleted_by, syg_deleted_on
          from sys_communication_language
          where ".$conditionStr."
          order by syg_id asc";
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
    
    $model = new cls_sys_communication_language($this->db);
  
    $model->syg_id = $result[0]['syg_id'];
    $model->syg_name = $result[0]['syg_name'];
    $model->syg_remarks = $result[0]['syg_remarks'];
    $model->syg_status = $result[0]['syg_status'];
    $model->syg_is_deleted = $result[0]['syg_is_deleted'];
    $model->syg_company_id = $result[0]['syg_company_id'];
    $model->syg_created_by = $result[0]['syg_created_by'];
    $model->syg_created_on = $result[0]['syg_created_on'];
    $model->syg_last_modified_by = $result[0]['syg_last_modified_by'];
    $model->syg_last_modified_on = $result[0]['syg_last_modified_on'];
    $model->syg_deleted_by = $result[0]['syg_deleted_by'];
    $model->syg_deleted_on = $result[0]['syg_deleted_on'];
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
      $model = new cls_sys_communication_language($this->db);
  
      $model->syg_id = $row['syg_id'];
      $model->syg_name = $row['syg_name'];
      $model->syg_remarks = $row['syg_remarks'];
      $model->syg_status = $row['syg_status'];
      $model->syg_is_deleted = $row['syg_is_deleted'];
      $model->syg_company_id = $row['syg_company_id'];
      $model->syg_created_by = $row['syg_created_by'];
      $model->syg_created_on = $row['syg_created_on'];
      $model->syg_last_modified_by = $row['syg_last_modified_by'];
      $model->syg_last_modified_on = $row['syg_last_modified_on'];
      $model->syg_deleted_by = $row['syg_deleted_by'];
      $model->syg_deleted_on = $row['syg_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->syg_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->syg_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syg_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syg_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syg_created_on))?$this->syg_created_on:date("Y-m-d H:i:s",$this->syg_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syg_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syg_last_modified_on))?$this->syg_last_modified_on:date("Y-m-d H:i:s",$this->syg_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syg_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syg_deleted_on))?$this->syg_deleted_on:date("Y-m-d H:i:s",$this->syg_deleted_on);
  }
}
?>

