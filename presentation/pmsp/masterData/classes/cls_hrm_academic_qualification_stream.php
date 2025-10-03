<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;

/**
 * This is the model class for table "hrm_academic_qualification_stream".
 * @property integer $aqs_id
* @property string $aqs_name
* @property string $aqs_remarks
* @property integer $aqs_status
* @property integer $aqs_is_deleted
* @property integer $aqs_company_id
* @property integer $aqs_created_by
* @property integer $aqs_created_on
* @property integer $aqs_last_modified_by
* @property integer $aqs_last_modified_on
* @property integer $aqs_deleted_by
* @property integer $aqs_deleted_on
*/
class cls_hrm_academic_qualification_stream {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_academic_qualification_stream';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'aqs_id' => 'Id', 
            'aqs_name' => 'Name', 
            'aqs_remarks' => 'Remarks', 
            'aqs_status' => 'Status', 
            'aqs_is_deleted' => 'Is Deleted', 
            'aqs_company_id' => 'Company', 
            'aqs_created_by' => 'Created By', 
            'aqs_created_on' => 'Created On', 
            'aqs_last_modified_by' => 'Last Modified By', 
            'aqs_last_modified_on' => 'Last Modified On', 
            'aqs_deleted_by' => 'Deleted By', 
            'aqs_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->aqs_id)){
      $condition[] = "aqs_id='$this->aqs_id'";
    }if(!is_null($this->aqs_name)){
      $condition[] = "aqs_name='$this->aqs_name'";
    }if(!is_null($this->aqs_remarks)){
      $condition[] = "aqs_remarks='$this->aqs_remarks'";
    }if(!is_null($this->aqs_status)){
      $condition[] = "aqs_status='$this->aqs_status'";
    }if(!is_null($this->aqs_is_deleted)){
      $condition[] = "aqs_is_deleted='$this->aqs_is_deleted'";
    }if(!is_null($this->aqs_company_id)){
      $condition[] = "aqs_company_id='$this->aqs_company_id'";
    }if(!is_null($this->aqs_created_by)){
      $condition[] = "aqs_created_by='$this->aqs_created_by'";
    }if(!is_null($this->aqs_created_on)){
      $condition[] = "aqs_created_on='$this->aqs_created_on'";
    }if(!is_null($this->aqs_last_modified_by)){
      $condition[] = "aqs_last_modified_by='$this->aqs_last_modified_by'";
    }if(!is_null($this->aqs_last_modified_on)){
      $condition[] = "aqs_last_modified_on='$this->aqs_last_modified_on'";
    }if(!is_null($this->aqs_deleted_by)){
      $condition[] = "aqs_deleted_by='$this->aqs_deleted_by'";
    }if(!is_null($this->aqs_deleted_on)){
      $condition[] = "aqs_deleted_on='$this->aqs_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select aqs_id, aqs_name, aqs_remarks, aqs_status, aqs_is_deleted, aqs_company_id, aqs_created_by, aqs_created_on, aqs_last_modified_by, aqs_last_modified_on, aqs_deleted_by, aqs_deleted_on
          from hrm_academic_qualification_stream
          where ".$conditionStr."
          order by aqs_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['aqs_id'].'" '; 
      if($this->aqs_id == $row['aqs_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['aqs_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->aqs_id)){
      $condition[] = "aqs_id='$this->aqs_id'";
    }if(!is_null($this->aqs_name)){
      $condition[] = "aqs_name='$this->aqs_name'";
    }if(!is_null($this->aqs_remarks)){
      $condition[] = "aqs_remarks='$this->aqs_remarks'";
    }if(!is_null($this->aqs_status)){
      $condition[] = "aqs_status='$this->aqs_status'";
    }if(!is_null($this->aqs_is_deleted)){
      $condition[] = "aqs_is_deleted='$this->aqs_is_deleted'";
    }if(!is_null($this->aqs_company_id)){
      $condition[] = "aqs_company_id='$this->aqs_company_id'";
    }if(!is_null($this->aqs_created_by)){
      $condition[] = "aqs_created_by='$this->aqs_created_by'";
    }if(!is_null($this->aqs_created_on)){
      $condition[] = "aqs_created_on='$this->aqs_created_on'";
    }if(!is_null($this->aqs_last_modified_by)){
      $condition[] = "aqs_last_modified_by='$this->aqs_last_modified_by'";
    }if(!is_null($this->aqs_last_modified_on)){
      $condition[] = "aqs_last_modified_on='$this->aqs_last_modified_on'";
    }if(!is_null($this->aqs_deleted_by)){
      $condition[] = "aqs_deleted_by='$this->aqs_deleted_by'";
    }if(!is_null($this->aqs_deleted_on)){
      $condition[] = "aqs_deleted_on='$this->aqs_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select aqs_id, aqs_name, aqs_remarks, aqs_status, aqs_is_deleted, aqs_company_id, aqs_created_by, aqs_created_on, aqs_last_modified_by, aqs_last_modified_on, aqs_deleted_by, aqs_deleted_on
          from hrm_academic_qualification_stream
          where ".$conditionStr."
          order by aqs_id asc";
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
    
    $model = new cls_hrm_academic_qualification_stream($this->db);
  
    $model->aqs_id = $result[0]['aqs_id'];
    $model->aqs_name = $result[0]['aqs_name'];
    $model->aqs_remarks = $result[0]['aqs_remarks'];
    $model->aqs_status = $result[0]['aqs_status'];
    $model->aqs_is_deleted = $result[0]['aqs_is_deleted'];
    $model->aqs_company_id = $result[0]['aqs_company_id'];
    $model->aqs_created_by = $result[0]['aqs_created_by'];
    $model->aqs_created_on = $result[0]['aqs_created_on'];
    $model->aqs_last_modified_by = $result[0]['aqs_last_modified_by'];
    $model->aqs_last_modified_on = $result[0]['aqs_last_modified_on'];
    $model->aqs_deleted_by = $result[0]['aqs_deleted_by'];
    $model->aqs_deleted_on = $result[0]['aqs_deleted_on'];
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
      $model = new cls_hrm_academic_qualification_stream($this->db);
  
      $model->aqs_id = $row['aqs_id'];
      $model->aqs_name = $row['aqs_name'];
      $model->aqs_remarks = $row['aqs_remarks'];
      $model->aqs_status = $row['aqs_status'];
      $model->aqs_is_deleted = $row['aqs_is_deleted'];
      $model->aqs_company_id = $row['aqs_company_id'];
      $model->aqs_created_by = $row['aqs_created_by'];
      $model->aqs_created_on = $row['aqs_created_on'];
      $model->aqs_last_modified_by = $row['aqs_last_modified_by'];
      $model->aqs_last_modified_on = $row['aqs_last_modified_on'];
      $model->aqs_deleted_by = $row['aqs_deleted_by'];
      $model->aqs_deleted_on = $row['aqs_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->aqs_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->aqs_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->aqs_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqs_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->aqs_created_on))?$this->aqs_created_on:date("Y-m-d H:i:s",$this->aqs_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqs_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->aqs_last_modified_on))?$this->aqs_last_modified_on:date("Y-m-d H:i:s",$this->aqs_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->aqs_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->aqs_deleted_on))?$this->aqs_deleted_on:date("Y-m-d H:i:s",$this->aqs_deleted_on);
  }
}
?>

