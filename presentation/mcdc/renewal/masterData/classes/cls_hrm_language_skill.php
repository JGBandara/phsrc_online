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
 * This is the model class for table "hrm_language_skill".
 * @property integer $ski_id
* @property string $ski_name
* @property string $ski_remarks
* @property integer $ski_status
* @property integer $ski_is_deleted
* @property integer $ski_company_id
* @property integer $ski_created_by
* @property integer $ski_created_on
* @property integer $ski_last_modified_by
* @property integer $ski_last_modified_on
* @property integer $ski_deleted_by
* @property integer $ski_deleted_on
*/
class cls_hrm_language_skill {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_language_skill';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'ski_id' => 'Id', 
            'ski_name' => 'Name', 
            'ski_remarks' => 'Remarks', 
            'ski_status' => 'Status', 
            'ski_is_deleted' => 'Is Deleted', 
            'ski_company_id' => 'Company Id', 
            'ski_created_by' => 'Created By', 
            'ski_created_on' => 'Created On', 
            'ski_last_modified_by' => 'Last Modified By', 
            'ski_last_modified_on' => 'Last Modified On', 
            'ski_deleted_by' => 'Deleted By', 
            'ski_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->ski_id)){
      $condition[] = "ski_id='$this->ski_id'";
    }if(!is_null($this->ski_name)){
      $condition[] = "ski_name='$this->ski_name'";
    }if(!is_null($this->ski_remarks)){
      $condition[] = "ski_remarks='$this->ski_remarks'";
    }if(!is_null($this->ski_status)){
      $condition[] = "ski_status='$this->ski_status'";
    }if(!is_null($this->ski_is_deleted)){
      $condition[] = "ski_is_deleted='$this->ski_is_deleted'";
    }if(!is_null($this->ski_company_id)){
      $condition[] = "ski_company_id='$this->ski_company_id'";
    }if(!is_null($this->ski_created_by)){
      $condition[] = "ski_created_by='$this->ski_created_by'";
    }if(!is_null($this->ski_created_on)){
      $condition[] = "ski_created_on='$this->ski_created_on'";
    }if(!is_null($this->ski_last_modified_by)){
      $condition[] = "ski_last_modified_by='$this->ski_last_modified_by'";
    }if(!is_null($this->ski_last_modified_on)){
      $condition[] = "ski_last_modified_on='$this->ski_last_modified_on'";
    }if(!is_null($this->ski_deleted_by)){
      $condition[] = "ski_deleted_by='$this->ski_deleted_by'";
    }if(!is_null($this->ski_deleted_on)){
      $condition[] = "ski_deleted_on='$this->ski_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select ski_id, ski_name, ski_remarks, ski_status, ski_is_deleted, ski_company_id, ski_created_by, ski_created_on, ski_last_modified_by, ski_last_modified_on, ski_deleted_by, ski_deleted_on
          from hrm_language_skill
          where ".$conditionStr."
          order by ski_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['ski_id'].'" '; 
      if($this->ski_id == $row['ski_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['ski_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->ski_id)){
      $condition[] = "ski_id='$this->ski_id'";
    }if(!is_null($this->ski_name)){
      $condition[] = "ski_name='$this->ski_name'";
    }if(!is_null($this->ski_remarks)){
      $condition[] = "ski_remarks='$this->ski_remarks'";
    }if(!is_null($this->ski_status)){
      $condition[] = "ski_status='$this->ski_status'";
    }if(!is_null($this->ski_is_deleted)){
      $condition[] = "ski_is_deleted='$this->ski_is_deleted'";
    }if(!is_null($this->ski_company_id)){
      $condition[] = "ski_company_id='$this->ski_company_id'";
    }if(!is_null($this->ski_created_by)){
      $condition[] = "ski_created_by='$this->ski_created_by'";
    }if(!is_null($this->ski_created_on)){
      $condition[] = "ski_created_on='$this->ski_created_on'";
    }if(!is_null($this->ski_last_modified_by)){
      $condition[] = "ski_last_modified_by='$this->ski_last_modified_by'";
    }if(!is_null($this->ski_last_modified_on)){
      $condition[] = "ski_last_modified_on='$this->ski_last_modified_on'";
    }if(!is_null($this->ski_deleted_by)){
      $condition[] = "ski_deleted_by='$this->ski_deleted_by'";
    }if(!is_null($this->ski_deleted_on)){
      $condition[] = "ski_deleted_on='$this->ski_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select ski_id, ski_name, ski_remarks, ski_status, ski_is_deleted, ski_company_id, ski_created_by, ski_created_on, ski_last_modified_by, ski_last_modified_on, ski_deleted_by, ski_deleted_on
          from hrm_language_skill
          where ".$conditionStr."
          order by ski_id asc";
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
    
    $model = new cls_hrm_language_skill($this->db);
  
    $model->ski_id = $result[0]['ski_id'];
    $model->ski_name = $result[0]['ski_name'];
    $model->ski_remarks = $result[0]['ski_remarks'];
    $model->ski_status = $result[0]['ski_status'];
    $model->ski_is_deleted = $result[0]['ski_is_deleted'];
    $model->ski_company_id = $result[0]['ski_company_id'];
    $model->ski_created_by = $result[0]['ski_created_by'];
    $model->ski_created_on = $result[0]['ski_created_on'];
    $model->ski_last_modified_by = $result[0]['ski_last_modified_by'];
    $model->ski_last_modified_on = $result[0]['ski_last_modified_on'];
    $model->ski_deleted_by = $result[0]['ski_deleted_by'];
    $model->ski_deleted_on = $result[0]['ski_deleted_on'];
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
      $model = new cls_hrm_language_skill($this->db);
  
      $model->ski_id = $row['ski_id'];
      $model->ski_name = $row['ski_name'];
      $model->ski_remarks = $row['ski_remarks'];
      $model->ski_status = $row['ski_status'];
      $model->ski_is_deleted = $row['ski_is_deleted'];
      $model->ski_company_id = $row['ski_company_id'];
      $model->ski_created_by = $row['ski_created_by'];
      $model->ski_created_on = $row['ski_created_on'];
      $model->ski_last_modified_by = $row['ski_last_modified_by'];
      $model->ski_last_modified_on = $row['ski_last_modified_on'];
      $model->ski_deleted_by = $row['ski_deleted_by'];
      $model->ski_deleted_on = $row['ski_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->ski_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->ski_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->ski_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ski_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->ski_created_on))?$this->ski_created_on:date("Y-m-d H:i:s",$this->ski_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ski_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->ski_last_modified_on))?$this->ski_last_modified_on:date("Y-m-d H:i:s",$this->ski_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ski_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->ski_deleted_on))?$this->ski_deleted_on:date("Y-m-d H:i:s",$this->ski_deleted_on);
  }
}
?>

