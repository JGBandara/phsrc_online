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
 * This is the model class for table "hrm_salary_scale".
 * @property integer $scl_id
* @property string $scl_code
* @property string $scl_name
* @property string $scl_remarks
* @property integer $scl_status
* @property integer $scl_is_deleted
* @property integer $scl_company_id
* @property integer $scl_created_by
* @property integer $scl_created_on
* @property integer $scl_last_modified_by
* @property integer $scl_last_modified_on
* @property integer $scl_deleted_by
* @property integer $scl_deleted_on
*/
class cls_hrm_salary_scale {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_salary_scale';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'scl_id' => 'Id', 
            'scl_code' => 'Code', 
            'scl_name' => 'Name', 
            'scl_remarks' => 'Remarks', 
            'scl_status' => 'Status', 
            'scl_is_deleted' => 'Is Deleted', 
            'scl_company_id' => 'Company Id', 
            'scl_created_by' => 'Created By', 
            'scl_created_on' => 'Created On', 
            'scl_last_modified_by' => 'Last Modified By', 
            'scl_last_modified_on' => 'Last Modified On', 
            'scl_deleted_by' => 'Deleted By', 
            'scl_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->scl_id)){
      $condition[] = "scl_id='$this->scl_id'";
    }if(!is_null($this->scl_code)){
      $condition[] = "scl_code='$this->scl_code'";
    }if(!is_null($this->scl_name)){
      $condition[] = "scl_name='$this->scl_name'";
    }if(!is_null($this->scl_remarks)){
      $condition[] = "scl_remarks='$this->scl_remarks'";
    }if(!is_null($this->scl_status)){
      $condition[] = "scl_status='$this->scl_status'";
    }if(!is_null($this->scl_is_deleted)){
      $condition[] = "scl_is_deleted='$this->scl_is_deleted'";
    }if(!is_null($this->scl_company_id)){
      $condition[] = "scl_company_id='$this->scl_company_id'";
    }if(!is_null($this->scl_created_by)){
      $condition[] = "scl_created_by='$this->scl_created_by'";
    }if(!is_null($this->scl_created_on)){
      $condition[] = "scl_created_on='$this->scl_created_on'";
    }if(!is_null($this->scl_last_modified_by)){
      $condition[] = "scl_last_modified_by='$this->scl_last_modified_by'";
    }if(!is_null($this->scl_last_modified_on)){
      $condition[] = "scl_last_modified_on='$this->scl_last_modified_on'";
    }if(!is_null($this->scl_deleted_by)){
      $condition[] = "scl_deleted_by='$this->scl_deleted_by'";
    }if(!is_null($this->scl_deleted_on)){
      $condition[] = "scl_deleted_on='$this->scl_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select scl_id, scl_code, scl_name, scl_remarks, scl_status, scl_is_deleted, scl_company_id, scl_created_by, scl_created_on, scl_last_modified_by, scl_last_modified_on, scl_deleted_by, scl_deleted_on
          from hrm_salary_scale
          where ".$conditionStr."
          order by scl_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['scl_id'].'" '; 
      if($this->scl_id == $row['scl_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['scl_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->scl_id)){
      $condition[] = "scl_id='$this->scl_id'";
    }if(!is_null($this->scl_code)){
      $condition[] = "scl_code='$this->scl_code'";
    }if(!is_null($this->scl_name)){
      $condition[] = "scl_name='$this->scl_name'";
    }if(!is_null($this->scl_remarks)){
      $condition[] = "scl_remarks='$this->scl_remarks'";
    }if(!is_null($this->scl_status)){
      $condition[] = "scl_status='$this->scl_status'";
    }if(!is_null($this->scl_is_deleted)){
      $condition[] = "scl_is_deleted='$this->scl_is_deleted'";
    }if(!is_null($this->scl_company_id)){
      $condition[] = "scl_company_id='$this->scl_company_id'";
    }if(!is_null($this->scl_created_by)){
      $condition[] = "scl_created_by='$this->scl_created_by'";
    }if(!is_null($this->scl_created_on)){
      $condition[] = "scl_created_on='$this->scl_created_on'";
    }if(!is_null($this->scl_last_modified_by)){
      $condition[] = "scl_last_modified_by='$this->scl_last_modified_by'";
    }if(!is_null($this->scl_last_modified_on)){
      $condition[] = "scl_last_modified_on='$this->scl_last_modified_on'";
    }if(!is_null($this->scl_deleted_by)){
      $condition[] = "scl_deleted_by='$this->scl_deleted_by'";
    }if(!is_null($this->scl_deleted_on)){
      $condition[] = "scl_deleted_on='$this->scl_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select scl_id, scl_code, scl_name, scl_remarks, scl_status, scl_is_deleted, scl_company_id, scl_created_by, scl_created_on, scl_last_modified_by, scl_last_modified_on, scl_deleted_by, scl_deleted_on
          from hrm_salary_scale
          where ".$conditionStr."
          order by scl_id asc";
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
    
    $model = new cls_hrm_salary_scale($this->db);
  
    $model->scl_id = $result[0]['scl_id'];
    $model->scl_code = $result[0]['scl_code'];
    $model->scl_name = $result[0]['scl_name'];
    $model->scl_remarks = $result[0]['scl_remarks'];
    $model->scl_status = $result[0]['scl_status'];
    $model->scl_is_deleted = $result[0]['scl_is_deleted'];
    $model->scl_company_id = $result[0]['scl_company_id'];
    $model->scl_created_by = $result[0]['scl_created_by'];
    $model->scl_created_on = $result[0]['scl_created_on'];
    $model->scl_last_modified_by = $result[0]['scl_last_modified_by'];
    $model->scl_last_modified_on = $result[0]['scl_last_modified_on'];
    $model->scl_deleted_by = $result[0]['scl_deleted_by'];
    $model->scl_deleted_on = $result[0]['scl_deleted_on'];
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
      $model = new cls_hrm_salary_scale($this->db);
  
      $model->scl_id = $row['scl_id'];
      $model->scl_code = $row['scl_code'];
      $model->scl_name = $row['scl_name'];
      $model->scl_remarks = $row['scl_remarks'];
      $model->scl_status = $row['scl_status'];
      $model->scl_is_deleted = $row['scl_is_deleted'];
      $model->scl_company_id = $row['scl_company_id'];
      $model->scl_created_by = $row['scl_created_by'];
      $model->scl_created_on = $row['scl_created_on'];
      $model->scl_last_modified_by = $row['scl_last_modified_by'];
      $model->scl_last_modified_on = $row['scl_last_modified_on'];
      $model->scl_deleted_by = $row['scl_deleted_by'];
      $model->scl_deleted_on = $row['scl_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->scl_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->scl_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->scl_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->scl_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->scl_created_on))?$this->scl_created_on:date("Y-m-d H:i:s",$this->scl_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->scl_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->scl_last_modified_on))?$this->scl_last_modified_on:date("Y-m-d H:i:s",$this->scl_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->scl_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->scl_deleted_on))?$this->scl_deleted_on:date("Y-m-d H:i:s",$this->scl_deleted_on);
  }
}
?>

