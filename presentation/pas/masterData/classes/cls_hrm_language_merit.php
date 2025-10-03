<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;

/**
 * This is the model class for table "hrm_language_merit".
 * @property integer $lmt_id
* @property string $lmt_name
* @property string $lmt_remarks
* @property integer $lmt_status
* @property integer $lmt_is_deleted
* @property integer $lmt_company_id
* @property integer $lmt_created_by
* @property integer $lmt_created_on
* @property integer $lmt_last_modified_by
* @property integer $lmt_last_modified_on
* @property integer $lmt_deleted_by
* @property integer $lmt_deleted_on
*/
class cls_hrm_language_merit {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_language_merit';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'lmt_id' => 'Id', 
            'lmt_name' => 'Name', 
            'lmt_remarks' => 'Remarks', 
            'lmt_status' => 'Status', 
            'lmt_is_deleted' => 'Is Deleted', 
            'lmt_company_id' => 'Company Id', 
            'lmt_created_by' => 'Created By', 
            'lmt_created_on' => 'Created On', 
            'lmt_last_modified_by' => 'Last Modified By', 
            'lmt_last_modified_on' => 'Last Modified On', 
            'lmt_deleted_by' => 'Deleted By', 
            'lmt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->lmt_id)){
      $condition[] = "lmt_id='$this->lmt_id'";
    }if(!is_null($this->lmt_name)){
      $condition[] = "lmt_name='$this->lmt_name'";
    }if(!is_null($this->lmt_remarks)){
      $condition[] = "lmt_remarks='$this->lmt_remarks'";
    }if(!is_null($this->lmt_status)){
      $condition[] = "lmt_status='$this->lmt_status'";
    }if(!is_null($this->lmt_is_deleted)){
      $condition[] = "lmt_is_deleted='$this->lmt_is_deleted'";
    }if(!is_null($this->lmt_company_id)){
      $condition[] = "lmt_company_id='$this->lmt_company_id'";
    }if(!is_null($this->lmt_created_by)){
      $condition[] = "lmt_created_by='$this->lmt_created_by'";
    }if(!is_null($this->lmt_created_on)){
      $condition[] = "lmt_created_on='$this->lmt_created_on'";
    }if(!is_null($this->lmt_last_modified_by)){
      $condition[] = "lmt_last_modified_by='$this->lmt_last_modified_by'";
    }if(!is_null($this->lmt_last_modified_on)){
      $condition[] = "lmt_last_modified_on='$this->lmt_last_modified_on'";
    }if(!is_null($this->lmt_deleted_by)){
      $condition[] = "lmt_deleted_by='$this->lmt_deleted_by'";
    }if(!is_null($this->lmt_deleted_on)){
      $condition[] = "lmt_deleted_on='$this->lmt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select lmt_id, lmt_name, lmt_remarks, lmt_status, lmt_is_deleted, lmt_company_id, lmt_created_by, lmt_created_on, lmt_last_modified_by, lmt_last_modified_on, lmt_deleted_by, lmt_deleted_on
          from hrm_language_merit
          where ".$conditionStr."
          order by lmt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['lmt_id'].'" '; 
      if($this->lmt_id == $row['lmt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['lmt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->lmt_id)){
      $condition[] = "lmt_id='$this->lmt_id'";
    }if(!is_null($this->lmt_name)){
      $condition[] = "lmt_name='$this->lmt_name'";
    }if(!is_null($this->lmt_remarks)){
      $condition[] = "lmt_remarks='$this->lmt_remarks'";
    }if(!is_null($this->lmt_status)){
      $condition[] = "lmt_status='$this->lmt_status'";
    }if(!is_null($this->lmt_is_deleted)){
      $condition[] = "lmt_is_deleted='$this->lmt_is_deleted'";
    }if(!is_null($this->lmt_company_id)){
      $condition[] = "lmt_company_id='$this->lmt_company_id'";
    }if(!is_null($this->lmt_created_by)){
      $condition[] = "lmt_created_by='$this->lmt_created_by'";
    }if(!is_null($this->lmt_created_on)){
      $condition[] = "lmt_created_on='$this->lmt_created_on'";
    }if(!is_null($this->lmt_last_modified_by)){
      $condition[] = "lmt_last_modified_by='$this->lmt_last_modified_by'";
    }if(!is_null($this->lmt_last_modified_on)){
      $condition[] = "lmt_last_modified_on='$this->lmt_last_modified_on'";
    }if(!is_null($this->lmt_deleted_by)){
      $condition[] = "lmt_deleted_by='$this->lmt_deleted_by'";
    }if(!is_null($this->lmt_deleted_on)){
      $condition[] = "lmt_deleted_on='$this->lmt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select lmt_id, lmt_name, lmt_remarks, lmt_status, lmt_is_deleted, lmt_company_id, lmt_created_by, lmt_created_on, lmt_last_modified_by, lmt_last_modified_on, lmt_deleted_by, lmt_deleted_on
          from hrm_language_merit
          where ".$conditionStr."
          order by lmt_id asc";
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
    
    $model = new cls_hrm_language_merit($this->db);
  
    $model->lmt_id = $result[0]['lmt_id'];
    $model->lmt_name = $result[0]['lmt_name'];
    $model->lmt_remarks = $result[0]['lmt_remarks'];
    $model->lmt_status = $result[0]['lmt_status'];
    $model->lmt_is_deleted = $result[0]['lmt_is_deleted'];
    $model->lmt_company_id = $result[0]['lmt_company_id'];
    $model->lmt_created_by = $result[0]['lmt_created_by'];
    $model->lmt_created_on = $result[0]['lmt_created_on'];
    $model->lmt_last_modified_by = $result[0]['lmt_last_modified_by'];
    $model->lmt_last_modified_on = $result[0]['lmt_last_modified_on'];
    $model->lmt_deleted_by = $result[0]['lmt_deleted_by'];
    $model->lmt_deleted_on = $result[0]['lmt_deleted_on'];
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
      $model = new cls_hrm_language_merit($this->db);
  
      $model->lmt_id = $row['lmt_id'];
      $model->lmt_name = $row['lmt_name'];
      $model->lmt_remarks = $row['lmt_remarks'];
      $model->lmt_status = $row['lmt_status'];
      $model->lmt_is_deleted = $row['lmt_is_deleted'];
      $model->lmt_company_id = $row['lmt_company_id'];
      $model->lmt_created_by = $row['lmt_created_by'];
      $model->lmt_created_on = $row['lmt_created_on'];
      $model->lmt_last_modified_by = $row['lmt_last_modified_by'];
      $model->lmt_last_modified_on = $row['lmt_last_modified_on'];
      $model->lmt_deleted_by = $row['lmt_deleted_by'];
      $model->lmt_deleted_on = $row['lmt_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->lmt_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->lmt_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->lmt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->lmt_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->lmt_created_on))?$this->lmt_created_on:date("Y-m-d H:i:s",$this->lmt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->lmt_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->lmt_last_modified_on))?$this->lmt_last_modified_on:date("Y-m-d H:i:s",$this->lmt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->lmt_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->lmt_deleted_on))?$this->lmt_deleted_on:date("Y-m-d H:i:s",$this->lmt_deleted_on);
  }
}
?>

