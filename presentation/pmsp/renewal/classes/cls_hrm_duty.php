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
 * This is the model class for table "hrm_duty".
 * @property integer $dty_id
* @property string $dty_name
* @property string $dty_remarks
* @property integer $dty_status
* @property integer $dty_is_deleted
* @property integer $dty_location_id
* @property integer $dty_company_id
* @property integer $dty_created_by
* @property integer $dty_created_on
* @property integer $dty_last_modified_by
* @property integer $dty_last_modified_on
* @property integer $dty_deleted_by
* @property integer $dty_deleted_on
*/
class cls_hrm_duty {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_duty';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dty_id' => 'Id', 
            'dty_name' => 'Name', 
            'dty_remarks' => 'Remarks', 
            'dty_status' => 'Status', 
            'dty_is_deleted' => 'Is Deleted', 
            'dty_location_id' => 'Location Id', 
            'dty_company_id' => 'Company Id', 
            'dty_created_by' => 'Created By', 
            'dty_created_on' => 'Created On', 
            'dty_last_modified_by' => 'Last Modified By', 
            'dty_last_modified_on' => 'Last Modified On', 
            'dty_deleted_by' => 'Deleted By', 
            'dty_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dty_id)){
      $condition[] = "dty_id='$this->dty_id'";
    }if(!is_null($this->dty_name)){
      $condition[] = "dty_name='$this->dty_name'";
    }if(!is_null($this->dty_remarks)){
      $condition[] = "dty_remarks='$this->dty_remarks'";
    }if(!is_null($this->dty_status)){
      $condition[] = "dty_status='$this->dty_status'";
    }if(!is_null($this->dty_is_deleted)){
      $condition[] = "dty_is_deleted='$this->dty_is_deleted'";
    }if(!is_null($this->dty_location_id)){
      $condition[] = "dty_location_id='$this->dty_location_id'";
    }if(!is_null($this->dty_company_id)){
      $condition[] = "dty_company_id='$this->dty_company_id'";
    }if(!is_null($this->dty_created_by)){
      $condition[] = "dty_created_by='$this->dty_created_by'";
    }if(!is_null($this->dty_created_on)){
      $condition[] = "dty_created_on='$this->dty_created_on'";
    }if(!is_null($this->dty_last_modified_by)){
      $condition[] = "dty_last_modified_by='$this->dty_last_modified_by'";
    }if(!is_null($this->dty_last_modified_on)){
      $condition[] = "dty_last_modified_on='$this->dty_last_modified_on'";
    }if(!is_null($this->dty_deleted_by)){
      $condition[] = "dty_deleted_by='$this->dty_deleted_by'";
    }if(!is_null($this->dty_deleted_on)){
      $condition[] = "dty_deleted_on='$this->dty_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dty_id, dty_name, dty_remarks, dty_status, dty_is_deleted, dty_location_id, dty_company_id, dty_created_by, dty_created_on, dty_last_modified_by, dty_last_modified_on, dty_deleted_by, dty_deleted_on
          from hrm_duty
          where ".$conditionStr."
          order by dty_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dty_id'].'" '; 
      if($this->dty_id == $row['dty_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dty_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dty_id)){
      $condition[] = "dty_id='$this->dty_id'";
    }if(!is_null($this->dty_name)){
      $condition[] = "dty_name='$this->dty_name'";
    }if(!is_null($this->dty_remarks)){
      $condition[] = "dty_remarks='$this->dty_remarks'";
    }if(!is_null($this->dty_status)){
      $condition[] = "dty_status='$this->dty_status'";
    }if(!is_null($this->dty_is_deleted)){
      $condition[] = "dty_is_deleted='$this->dty_is_deleted'";
    }if(!is_null($this->dty_location_id)){
      $condition[] = "dty_location_id='$this->dty_location_id'";
    }if(!is_null($this->dty_company_id)){
      $condition[] = "dty_company_id='$this->dty_company_id'";
    }if(!is_null($this->dty_created_by)){
      $condition[] = "dty_created_by='$this->dty_created_by'";
    }if(!is_null($this->dty_created_on)){
      $condition[] = "dty_created_on='$this->dty_created_on'";
    }if(!is_null($this->dty_last_modified_by)){
      $condition[] = "dty_last_modified_by='$this->dty_last_modified_by'";
    }if(!is_null($this->dty_last_modified_on)){
      $condition[] = "dty_last_modified_on='$this->dty_last_modified_on'";
    }if(!is_null($this->dty_deleted_by)){
      $condition[] = "dty_deleted_by='$this->dty_deleted_by'";
    }if(!is_null($this->dty_deleted_on)){
      $condition[] = "dty_deleted_on='$this->dty_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dty_id, dty_name, dty_remarks, dty_status, dty_is_deleted, dty_location_id, dty_company_id, dty_created_by, dty_created_on, dty_last_modified_by, dty_last_modified_on, dty_deleted_by, dty_deleted_on
          from hrm_duty
          where ".$conditionStr."
          order by dty_id asc";
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
    
    $model = new cls_hrm_duty($this->db);
  
    $model->dty_id = $result[0]['dty_id'];
    $model->dty_name = $result[0]['dty_name'];
    $model->dty_remarks = $result[0]['dty_remarks'];
    $model->dty_status = $result[0]['dty_status'];
    $model->dty_is_deleted = $result[0]['dty_is_deleted'];
    $model->dty_location_id = $result[0]['dty_location_id'];
    $model->dty_company_id = $result[0]['dty_company_id'];
    $model->dty_created_by = $result[0]['dty_created_by'];
    $model->dty_created_on = $result[0]['dty_created_on'];
    $model->dty_last_modified_by = $result[0]['dty_last_modified_by'];
    $model->dty_last_modified_on = $result[0]['dty_last_modified_on'];
    $model->dty_deleted_by = $result[0]['dty_deleted_by'];
    $model->dty_deleted_on = $result[0]['dty_deleted_on'];
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
      $model = new cls_hrm_duty($this->db);
  
      $model->dty_id = $row['dty_id'];
      $model->dty_name = $row['dty_name'];
      $model->dty_remarks = $row['dty_remarks'];
      $model->dty_status = $row['dty_status'];
      $model->dty_is_deleted = $row['dty_is_deleted'];
      $model->dty_location_id = $row['dty_location_id'];
      $model->dty_company_id = $row['dty_company_id'];
      $model->dty_created_by = $row['dty_created_by'];
      $model->dty_created_on = $row['dty_created_on'];
      $model->dty_last_modified_by = $row['dty_last_modified_by'];
      $model->dty_last_modified_on = $row['dty_last_modified_on'];
      $model->dty_deleted_by = $row['dty_deleted_by'];
      $model->dty_deleted_on = $row['dty_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->dty_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dty_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dty_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dty_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dty_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dty_created_on))?$this->dty_created_on:date("Y-m-d H:i:s",$this->dty_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dty_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dty_last_modified_on))?$this->dty_last_modified_on:date("Y-m-d H:i:s",$this->dty_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dty_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dty_deleted_on))?$this->dty_deleted_on:date("Y-m-d H:i:s",$this->dty_deleted_on);
  }
}
?>

