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
 * This is the model class for table "hrm_employment_type".
 * @property integer $emt_id
* @property string $emt_name
* @property string $emt_remarks
* @property integer $emt_status
* @property integer $emt_is_deleted
* @property integer $emt_company_id
* @property integer $emt_created_by
* @property integer $emt_created_on
* @property integer $emt_last_modified_by
* @property integer $emt_last_modified_on
* @property integer $emt_deleted_by
* @property integer $emt_deleted_on
*/
class cls_hrm_employment_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employment_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'emt_id' => 'Id', 
            'emt_name' => 'Name', 
            'emt_remarks' => 'Remarks', 
            'emt_status' => 'Status', 
            'emt_is_deleted' => 'Is Deleted', 
            'emt_company_id' => 'Company Id', 
            'emt_created_by' => 'Created By', 
            'emt_created_on' => 'Created On', 
            'emt_last_modified_by' => 'Last Modified By', 
            'emt_last_modified_on' => 'Last Modified On', 
            'emt_deleted_by' => 'Deleted By', 
            'emt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->emt_id)){
      $condition[] = "emt_id='$this->emt_id'";
    }if(!is_null($this->emt_name)){
      $condition[] = "emt_name='$this->emt_name'";
    }if(!is_null($this->emt_remarks)){
      $condition[] = "emt_remarks='$this->emt_remarks'";
    }if(!is_null($this->emt_status)){
      $condition[] = "emt_status='$this->emt_status'";
    }if(!is_null($this->emt_is_deleted)){
      $condition[] = "emt_is_deleted='$this->emt_is_deleted'";
    }if(!is_null($this->emt_company_id)){
      $condition[] = "emt_company_id='$this->emt_company_id'";
    }if(!is_null($this->emt_created_by)){
      $condition[] = "emt_created_by='$this->emt_created_by'";
    }if(!is_null($this->emt_created_on)){
      $condition[] = "emt_created_on='$this->emt_created_on'";
    }if(!is_null($this->emt_last_modified_by)){
      $condition[] = "emt_last_modified_by='$this->emt_last_modified_by'";
    }if(!is_null($this->emt_last_modified_on)){
      $condition[] = "emt_last_modified_on='$this->emt_last_modified_on'";
    }if(!is_null($this->emt_deleted_by)){
      $condition[] = "emt_deleted_by='$this->emt_deleted_by'";
    }if(!is_null($this->emt_deleted_on)){
      $condition[] = "emt_deleted_on='$this->emt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emt_id, emt_name, emt_remarks, emt_status, emt_is_deleted, emt_company_id, emt_created_by, emt_created_on, emt_last_modified_by, emt_last_modified_on, emt_deleted_by, emt_deleted_on
          from hrm_employment_type
          where ".$conditionStr."
          order by emt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['emt_id'].'" '; 
      if($this->emt_id == $row['emt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->emt_id)){
      $condition[] = "emt_id='$this->emt_id'";
    }if(!is_null($this->emt_name)){
      $condition[] = "emt_name='$this->emt_name'";
    }if(!is_null($this->emt_remarks)){
      $condition[] = "emt_remarks='$this->emt_remarks'";
    }if(!is_null($this->emt_status)){
      $condition[] = "emt_status='$this->emt_status'";
    }if(!is_null($this->emt_is_deleted)){
      $condition[] = "emt_is_deleted='$this->emt_is_deleted'";
    }if(!is_null($this->emt_company_id)){
      $condition[] = "emt_company_id='$this->emt_company_id'";
    }if(!is_null($this->emt_created_by)){
      $condition[] = "emt_created_by='$this->emt_created_by'";
    }if(!is_null($this->emt_created_on)){
      $condition[] = "emt_created_on='$this->emt_created_on'";
    }if(!is_null($this->emt_last_modified_by)){
      $condition[] = "emt_last_modified_by='$this->emt_last_modified_by'";
    }if(!is_null($this->emt_last_modified_on)){
      $condition[] = "emt_last_modified_on='$this->emt_last_modified_on'";
    }if(!is_null($this->emt_deleted_by)){
      $condition[] = "emt_deleted_by='$this->emt_deleted_by'";
    }if(!is_null($this->emt_deleted_on)){
      $condition[] = "emt_deleted_on='$this->emt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emt_id, emt_name, emt_remarks, emt_status, emt_is_deleted, emt_company_id, emt_created_by, emt_created_on, emt_last_modified_by, emt_last_modified_on, emt_deleted_by, emt_deleted_on
          from hrm_employment_type
          where ".$conditionStr."
          order by emt_id asc";
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
    
    $model = new cls_hrm_employment_type($this->db);
  
    $model->emt_id = $result[0]['emt_id'];
    $model->emt_name = $result[0]['emt_name'];
    $model->emt_remarks = $result[0]['emt_remarks'];
    $model->emt_status = $result[0]['emt_status'];
    $model->emt_is_deleted = $result[0]['emt_is_deleted'];
    $model->emt_company_id = $result[0]['emt_company_id'];
    $model->emt_created_by = $result[0]['emt_created_by'];
    $model->emt_created_on = $result[0]['emt_created_on'];
    $model->emt_last_modified_by = $result[0]['emt_last_modified_by'];
    $model->emt_last_modified_on = $result[0]['emt_last_modified_on'];
    $model->emt_deleted_by = $result[0]['emt_deleted_by'];
    $model->emt_deleted_on = $result[0]['emt_deleted_on'];
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
      $model = new cls_hrm_employment_type($this->db);
  
      $model->emt_id = $row['emt_id'];
      $model->emt_name = $row['emt_name'];
      $model->emt_remarks = $row['emt_remarks'];
      $model->emt_status = $row['emt_status'];
      $model->emt_is_deleted = $row['emt_is_deleted'];
      $model->emt_company_id = $row['emt_company_id'];
      $model->emt_created_by = $row['emt_created_by'];
      $model->emt_created_on = $row['emt_created_on'];
      $model->emt_last_modified_by = $row['emt_last_modified_by'];
      $model->emt_last_modified_on = $row['emt_last_modified_on'];
      $model->emt_deleted_by = $row['emt_deleted_by'];
      $model->emt_deleted_on = $row['emt_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->emt_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->emt_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->emt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emt_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->emt_created_on))?$this->emt_created_on:date("Y-m-d H:i:s",$this->emt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emt_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->emt_last_modified_on))?$this->emt_last_modified_on:date("Y-m-d H:i:s",$this->emt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emt_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->emt_deleted_on))?$this->emt_deleted_on:date("Y-m-d H:i:s",$this->emt_deleted_on);
  }
}
?>

