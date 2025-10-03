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
 * This is the model class for table "hrm_transport_mode".
 * @property integer $tmd_id
* @property string $tmd_name
* @property string $tmd_remarks
* @property integer $tmd_status
* @property integer $tmd_is_deleted
* @property integer $tmd_company_id
* @property integer $tmd_created_by
* @property integer $tmd_created_on
* @property integer $tmd_last_modified_by
* @property integer $tmd_last_modified_on
* @property integer $tmd_deleted_by
* @property integer $tmd_deleted_on
*/
class cls_hrm_transport_mode {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_transport_mode';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'tmd_id' => 'Id', 
            'tmd_name' => 'Name', 
            'tmd_remarks' => 'Remarks', 
            'tmd_status' => 'Status', 
            'tmd_is_deleted' => 'Is Deleted', 
            'tmd_company_id' => 'Company Id', 
            'tmd_created_by' => 'Created By', 
            'tmd_created_on' => 'Created On', 
            'tmd_last_modified_by' => 'Last Modified By', 
            'tmd_last_modified_on' => 'Last Modified On', 
            'tmd_deleted_by' => 'Deleted By', 
            'tmd_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->tmd_id)){
      $condition[] = "tmd_id='$this->tmd_id'";
    }if(!is_null($this->tmd_name)){
      $condition[] = "tmd_name='$this->tmd_name'";
    }if(!is_null($this->tmd_remarks)){
      $condition[] = "tmd_remarks='$this->tmd_remarks'";
    }if(!is_null($this->tmd_status)){
      $condition[] = "tmd_status='$this->tmd_status'";
    }if(!is_null($this->tmd_is_deleted)){
      $condition[] = "tmd_is_deleted='$this->tmd_is_deleted'";
    }if(!is_null($this->tmd_company_id)){
      $condition[] = "tmd_company_id='$this->tmd_company_id'";
    }if(!is_null($this->tmd_created_by)){
      $condition[] = "tmd_created_by='$this->tmd_created_by'";
    }if(!is_null($this->tmd_created_on)){
      $condition[] = "tmd_created_on='$this->tmd_created_on'";
    }if(!is_null($this->tmd_last_modified_by)){
      $condition[] = "tmd_last_modified_by='$this->tmd_last_modified_by'";
    }if(!is_null($this->tmd_last_modified_on)){
      $condition[] = "tmd_last_modified_on='$this->tmd_last_modified_on'";
    }if(!is_null($this->tmd_deleted_by)){
      $condition[] = "tmd_deleted_by='$this->tmd_deleted_by'";
    }if(!is_null($this->tmd_deleted_on)){
      $condition[] = "tmd_deleted_on='$this->tmd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select tmd_id, tmd_name, tmd_remarks, tmd_status, tmd_is_deleted, tmd_company_id, tmd_created_by, tmd_created_on, tmd_last_modified_by, tmd_last_modified_on, tmd_deleted_by, tmd_deleted_on
          from hrm_transport_mode
          where ".$conditionStr."
          order by tmd_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['tmd_id'].'" '; 
      if($this->tmd_id == $row['tmd_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['tmd_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->tmd_id)){
      $condition[] = "tmd_id='$this->tmd_id'";
    }if(!is_null($this->tmd_name)){
      $condition[] = "tmd_name='$this->tmd_name'";
    }if(!is_null($this->tmd_remarks)){
      $condition[] = "tmd_remarks='$this->tmd_remarks'";
    }if(!is_null($this->tmd_status)){
      $condition[] = "tmd_status='$this->tmd_status'";
    }if(!is_null($this->tmd_is_deleted)){
      $condition[] = "tmd_is_deleted='$this->tmd_is_deleted'";
    }if(!is_null($this->tmd_company_id)){
      $condition[] = "tmd_company_id='$this->tmd_company_id'";
    }if(!is_null($this->tmd_created_by)){
      $condition[] = "tmd_created_by='$this->tmd_created_by'";
    }if(!is_null($this->tmd_created_on)){
      $condition[] = "tmd_created_on='$this->tmd_created_on'";
    }if(!is_null($this->tmd_last_modified_by)){
      $condition[] = "tmd_last_modified_by='$this->tmd_last_modified_by'";
    }if(!is_null($this->tmd_last_modified_on)){
      $condition[] = "tmd_last_modified_on='$this->tmd_last_modified_on'";
    }if(!is_null($this->tmd_deleted_by)){
      $condition[] = "tmd_deleted_by='$this->tmd_deleted_by'";
    }if(!is_null($this->tmd_deleted_on)){
      $condition[] = "tmd_deleted_on='$this->tmd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select tmd_id, tmd_name, tmd_remarks, tmd_status, tmd_is_deleted, tmd_company_id, tmd_created_by, tmd_created_on, tmd_last_modified_by, tmd_last_modified_on, tmd_deleted_by, tmd_deleted_on
          from hrm_transport_mode
          where ".$conditionStr."
          order by tmd_id asc";
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
    
    $model = new cls_hrm_transport_mode($this->db);
  
    $model->tmd_id = $result[0]['tmd_id'];
    $model->tmd_name = $result[0]['tmd_name'];
    $model->tmd_remarks = $result[0]['tmd_remarks'];
    $model->tmd_status = $result[0]['tmd_status'];
    $model->tmd_is_deleted = $result[0]['tmd_is_deleted'];
    $model->tmd_company_id = $result[0]['tmd_company_id'];
    $model->tmd_created_by = $result[0]['tmd_created_by'];
    $model->tmd_created_on = $result[0]['tmd_created_on'];
    $model->tmd_last_modified_by = $result[0]['tmd_last_modified_by'];
    $model->tmd_last_modified_on = $result[0]['tmd_last_modified_on'];
    $model->tmd_deleted_by = $result[0]['tmd_deleted_by'];
    $model->tmd_deleted_on = $result[0]['tmd_deleted_on'];
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
      $model = new cls_hrm_transport_mode($this->db);
  
      $model->tmd_id = $row['tmd_id'];
      $model->tmd_name = $row['tmd_name'];
      $model->tmd_remarks = $row['tmd_remarks'];
      $model->tmd_status = $row['tmd_status'];
      $model->tmd_is_deleted = $row['tmd_is_deleted'];
      $model->tmd_company_id = $row['tmd_company_id'];
      $model->tmd_created_by = $row['tmd_created_by'];
      $model->tmd_created_on = $row['tmd_created_on'];
      $model->tmd_last_modified_by = $row['tmd_last_modified_by'];
      $model->tmd_last_modified_on = $row['tmd_last_modified_on'];
      $model->tmd_deleted_by = $row['tmd_deleted_by'];
      $model->tmd_deleted_on = $row['tmd_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->tmd_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->tmd_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->tmd_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tmd_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->tmd_created_on))?$this->tmd_created_on:date("Y-m-d H:i:s",$this->tmd_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tmd_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->tmd_last_modified_on))?$this->tmd_last_modified_on:date("Y-m-d H:i:s",$this->tmd_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tmd_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->tmd_deleted_on))?$this->tmd_deleted_on:date("Y-m-d H:i:s",$this->tmd_deleted_on);
  }
}
?>

