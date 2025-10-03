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
 * This is the model class for table "hrm_statutory_classification".
 * @property integer $stc_id
* @property string $stc_name
* @property string $stc_remarks
* @property integer $stc_status
* @property integer $stc_is_deleted
* @property integer $stc_company_id
* @property integer $stc_created_by
* @property integer $stc_created_on
* @property integer $stc_last_modified_by
* @property integer $stc_last_modified_on
* @property integer $stc_deleted_by
* @property integer $stc_deleted_on
*/
class cls_hrm_statutory_classification {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_statutory_classification';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'stc_id' => 'Id', 
            'stc_name' => 'Name', 
            'stc_remarks' => 'Remarks', 
            'stc_status' => 'Status', 
            'stc_is_deleted' => 'Is Deleted', 
            'stc_company_id' => 'Company Id', 
            'stc_created_by' => 'Created By', 
            'stc_created_on' => 'Created On', 
            'stc_last_modified_by' => 'Last Modified By', 
            'stc_last_modified_on' => 'Last Modified On', 
            'stc_deleted_by' => 'Deleted By', 
            'stc_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->stc_id)){
      $condition[] = "stc_id='$this->stc_id'";
    }if(!is_null($this->stc_name)){
      $condition[] = "stc_name='$this->stc_name'";
    }if(!is_null($this->stc_remarks)){
      $condition[] = "stc_remarks='$this->stc_remarks'";
    }if(!is_null($this->stc_status)){
      $condition[] = "stc_status='$this->stc_status'";
    }if(!is_null($this->stc_is_deleted)){
      $condition[] = "stc_is_deleted='$this->stc_is_deleted'";
    }if(!is_null($this->stc_company_id)){
      $condition[] = "stc_company_id='$this->stc_company_id'";
    }if(!is_null($this->stc_created_by)){
      $condition[] = "stc_created_by='$this->stc_created_by'";
    }if(!is_null($this->stc_created_on)){
      $condition[] = "stc_created_on='$this->stc_created_on'";
    }if(!is_null($this->stc_last_modified_by)){
      $condition[] = "stc_last_modified_by='$this->stc_last_modified_by'";
    }if(!is_null($this->stc_last_modified_on)){
      $condition[] = "stc_last_modified_on='$this->stc_last_modified_on'";
    }if(!is_null($this->stc_deleted_by)){
      $condition[] = "stc_deleted_by='$this->stc_deleted_by'";
    }if(!is_null($this->stc_deleted_on)){
      $condition[] = "stc_deleted_on='$this->stc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select stc_id, stc_name, stc_remarks, stc_status, stc_is_deleted, stc_company_id, stc_created_by, stc_created_on, stc_last_modified_by, stc_last_modified_on, stc_deleted_by, stc_deleted_on
          from hrm_statutory_classification
          where ".$conditionStr."
          order by stc_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['stc_id'].'" '; 
      if($this->stc_id == $row['stc_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['stc_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->stc_id)){
      $condition[] = "stc_id='$this->stc_id'";
    }if(!is_null($this->stc_name)){
      $condition[] = "stc_name='$this->stc_name'";
    }if(!is_null($this->stc_remarks)){
      $condition[] = "stc_remarks='$this->stc_remarks'";
    }if(!is_null($this->stc_status)){
      $condition[] = "stc_status='$this->stc_status'";
    }if(!is_null($this->stc_is_deleted)){
      $condition[] = "stc_is_deleted='$this->stc_is_deleted'";
    }if(!is_null($this->stc_company_id)){
      $condition[] = "stc_company_id='$this->stc_company_id'";
    }if(!is_null($this->stc_created_by)){
      $condition[] = "stc_created_by='$this->stc_created_by'";
    }if(!is_null($this->stc_created_on)){
      $condition[] = "stc_created_on='$this->stc_created_on'";
    }if(!is_null($this->stc_last_modified_by)){
      $condition[] = "stc_last_modified_by='$this->stc_last_modified_by'";
    }if(!is_null($this->stc_last_modified_on)){
      $condition[] = "stc_last_modified_on='$this->stc_last_modified_on'";
    }if(!is_null($this->stc_deleted_by)){
      $condition[] = "stc_deleted_by='$this->stc_deleted_by'";
    }if(!is_null($this->stc_deleted_on)){
      $condition[] = "stc_deleted_on='$this->stc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select stc_id, stc_name, stc_remarks, stc_status, stc_is_deleted, stc_company_id, stc_created_by, stc_created_on, stc_last_modified_by, stc_last_modified_on, stc_deleted_by, stc_deleted_on
          from hrm_statutory_classification
          where ".$conditionStr."
          order by stc_id asc";
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
    
    $model = new cls_hrm_statutory_classification($this->db);
  
    $model->stc_id = $result[0]['stc_id'];
    $model->stc_name = $result[0]['stc_name'];
    $model->stc_remarks = $result[0]['stc_remarks'];
    $model->stc_status = $result[0]['stc_status'];
    $model->stc_is_deleted = $result[0]['stc_is_deleted'];
    $model->stc_company_id = $result[0]['stc_company_id'];
    $model->stc_created_by = $result[0]['stc_created_by'];
    $model->stc_created_on = $result[0]['stc_created_on'];
    $model->stc_last_modified_by = $result[0]['stc_last_modified_by'];
    $model->stc_last_modified_on = $result[0]['stc_last_modified_on'];
    $model->stc_deleted_by = $result[0]['stc_deleted_by'];
    $model->stc_deleted_on = $result[0]['stc_deleted_on'];
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
      $model = new cls_hrm_statutory_classification($this->db);
  
      $model->stc_id = $row['stc_id'];
      $model->stc_name = $row['stc_name'];
      $model->stc_remarks = $row['stc_remarks'];
      $model->stc_status = $row['stc_status'];
      $model->stc_is_deleted = $row['stc_is_deleted'];
      $model->stc_company_id = $row['stc_company_id'];
      $model->stc_created_by = $row['stc_created_by'];
      $model->stc_created_on = $row['stc_created_on'];
      $model->stc_last_modified_by = $row['stc_last_modified_by'];
      $model->stc_last_modified_on = $row['stc_last_modified_on'];
      $model->stc_deleted_by = $row['stc_deleted_by'];
      $model->stc_deleted_on = $row['stc_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->stc_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->stc_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->stc_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->stc_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->stc_created_on))?$this->stc_created_on:date("Y-m-d H:i:s",$this->stc_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->stc_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->stc_last_modified_on))?$this->stc_last_modified_on:date("Y-m-d H:i:s",$this->stc_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->stc_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->stc_deleted_on))?$this->stc_deleted_on:date("Y-m-d H:i:s",$this->stc_deleted_on);
  }
}
?>

