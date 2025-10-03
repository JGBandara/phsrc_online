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
 * This is the model class for table "hrm_dwelling_mode".
 * @property integer $dwm_id
* @property string $dwm_name
* @property string $dwm_remarks
* @property integer $dwm_status
* @property integer $dwm_is_deleted
* @property integer $dwm_company_id
* @property integer $dwm_created_by
* @property integer $dwm_created_on
* @property integer $dwm_last_modified_by
* @property integer $dwm_last_modified_on
* @property integer $dwm_deleted_by
* @property integer $dwm_deleted_on
*/
class cls_hrm_dwelling_mode {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_dwelling_mode';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dwm_id' => 'Id', 
            'dwm_name' => 'Name', 
            'dwm_remarks' => 'Remarks', 
            'dwm_status' => 'Status', 
            'dwm_is_deleted' => 'Is Deleted', 
            'dwm_company_id' => 'Company Id', 
            'dwm_created_by' => 'Created By', 
            'dwm_created_on' => 'Created On', 
            'dwm_last_modified_by' => 'Last Modified By', 
            'dwm_last_modified_on' => 'Last Modified On', 
            'dwm_deleted_by' => 'Deleted By', 
            'dwm_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dwm_id)){
      $condition[] = "dwm_id='$this->dwm_id'";
    }if(!is_null($this->dwm_name)){
      $condition[] = "dwm_name='$this->dwm_name'";
    }if(!is_null($this->dwm_remarks)){
      $condition[] = "dwm_remarks='$this->dwm_remarks'";
    }if(!is_null($this->dwm_status)){
      $condition[] = "dwm_status='$this->dwm_status'";
    }if(!is_null($this->dwm_is_deleted)){
      $condition[] = "dwm_is_deleted='$this->dwm_is_deleted'";
    }if(!is_null($this->dwm_company_id)){
      $condition[] = "dwm_company_id='$this->dwm_company_id'";
    }if(!is_null($this->dwm_created_by)){
      $condition[] = "dwm_created_by='$this->dwm_created_by'";
    }if(!is_null($this->dwm_created_on)){
      $condition[] = "dwm_created_on='$this->dwm_created_on'";
    }if(!is_null($this->dwm_last_modified_by)){
      $condition[] = "dwm_last_modified_by='$this->dwm_last_modified_by'";
    }if(!is_null($this->dwm_last_modified_on)){
      $condition[] = "dwm_last_modified_on='$this->dwm_last_modified_on'";
    }if(!is_null($this->dwm_deleted_by)){
      $condition[] = "dwm_deleted_by='$this->dwm_deleted_by'";
    }if(!is_null($this->dwm_deleted_on)){
      $condition[] = "dwm_deleted_on='$this->dwm_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select dwm_id, dwm_name, dwm_remarks, dwm_status, dwm_is_deleted, dwm_company_id, dwm_created_by, dwm_created_on, dwm_last_modified_by, dwm_last_modified_on, dwm_deleted_by, dwm_deleted_on
          from hrm_dwelling_mode
          where ".$conditionStr."
          order by dwm_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dwm_id'].'" '; 
      if($this->dwm_id == $row['dwm_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dwm_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dwm_id)){
      $condition[] = "dwm_id='$this->dwm_id'";
    }if(!is_null($this->dwm_name)){
      $condition[] = "dwm_name='$this->dwm_name'";
    }if(!is_null($this->dwm_remarks)){
      $condition[] = "dwm_remarks='$this->dwm_remarks'";
    }if(!is_null($this->dwm_status)){
      $condition[] = "dwm_status='$this->dwm_status'";
    }if(!is_null($this->dwm_is_deleted)){
      $condition[] = "dwm_is_deleted='$this->dwm_is_deleted'";
    }if(!is_null($this->dwm_company_id)){
      $condition[] = "dwm_company_id='$this->dwm_company_id'";
    }if(!is_null($this->dwm_created_by)){
      $condition[] = "dwm_created_by='$this->dwm_created_by'";
    }if(!is_null($this->dwm_created_on)){
      $condition[] = "dwm_created_on='$this->dwm_created_on'";
    }if(!is_null($this->dwm_last_modified_by)){
      $condition[] = "dwm_last_modified_by='$this->dwm_last_modified_by'";
    }if(!is_null($this->dwm_last_modified_on)){
      $condition[] = "dwm_last_modified_on='$this->dwm_last_modified_on'";
    }if(!is_null($this->dwm_deleted_by)){
      $condition[] = "dwm_deleted_by='$this->dwm_deleted_by'";
    }if(!is_null($this->dwm_deleted_on)){
      $condition[] = "dwm_deleted_on='$this->dwm_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select dwm_id, dwm_name, dwm_remarks, dwm_status, dwm_is_deleted, dwm_company_id, dwm_created_by, dwm_created_on, dwm_last_modified_by, dwm_last_modified_on, dwm_deleted_by, dwm_deleted_on
          from hrm_dwelling_mode
          where ".$conditionStr."
          order by dwm_id asc";
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
    
    $model = new cls_hrm_dwelling_mode($this->db);
  
    $model->dwm_id = $result[0]['dwm_id'];
    $model->dwm_name = $result[0]['dwm_name'];
    $model->dwm_remarks = $result[0]['dwm_remarks'];
    $model->dwm_status = $result[0]['dwm_status'];
    $model->dwm_is_deleted = $result[0]['dwm_is_deleted'];
    $model->dwm_company_id = $result[0]['dwm_company_id'];
    $model->dwm_created_by = $result[0]['dwm_created_by'];
    $model->dwm_created_on = $result[0]['dwm_created_on'];
    $model->dwm_last_modified_by = $result[0]['dwm_last_modified_by'];
    $model->dwm_last_modified_on = $result[0]['dwm_last_modified_on'];
    $model->dwm_deleted_by = $result[0]['dwm_deleted_by'];
    $model->dwm_deleted_on = $result[0]['dwm_deleted_on'];
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
      $model = new cls_hrm_dwelling_mode($this->db);
  
      $model->dwm_id = $row['dwm_id'];
      $model->dwm_name = $row['dwm_name'];
      $model->dwm_remarks = $row['dwm_remarks'];
      $model->dwm_status = $row['dwm_status'];
      $model->dwm_is_deleted = $row['dwm_is_deleted'];
      $model->dwm_company_id = $row['dwm_company_id'];
      $model->dwm_created_by = $row['dwm_created_by'];
      $model->dwm_created_on = $row['dwm_created_on'];
      $model->dwm_last_modified_by = $row['dwm_last_modified_by'];
      $model->dwm_last_modified_on = $row['dwm_last_modified_on'];
      $model->dwm_deleted_by = $row['dwm_deleted_by'];
      $model->dwm_deleted_on = $row['dwm_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dwm_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dwm_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dwm_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dwm_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dwm_created_on))?$this->dwm_created_on:date("Y-m-d H:i:s",$this->dwm_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dwm_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dwm_last_modified_on))?$this->dwm_last_modified_on:date("Y-m-d H:i:s",$this->dwm_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dwm_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dwm_deleted_on))?$this->dwm_deleted_on:date("Y-m-d H:i:s",$this->dwm_deleted_on);
  }
}
?>

