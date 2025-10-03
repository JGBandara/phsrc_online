<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-19
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "hrm_service_category".
 * @property integer $sct_id
* @property string $sct_name
* @property string $sct_code
* @property string $sct_remarks
* @property integer $sct_status
* @property integer $sct_is_deleted
* @property integer $sct_company_id
* @property integer $sct_created_by
* @property integer $sct_created_on
* @property integer $sct_last_modified_by
* @property integer $sct_last_modified_on
* @property integer $sct_deleted_by
* @property integer $sct_deleted_on
*/
class cls_hrm_service_category {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_service_category';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'sct_id' => 'Id', 
            'sct_name' => 'Name', 
            'sct_code' => 'Code', 
            'sct_remarks' => 'Remarks', 
            'sct_status' => 'Status', 
            'sct_is_deleted' => 'Is Deleted', 
            'sct_company_id' => 'Company Id', 
            'sct_created_by' => 'Created By', 
            'sct_created_on' => 'Created On', 
            'sct_last_modified_by' => 'Last Modified By', 
            'sct_last_modified_on' => 'Last Modified On', 
            'sct_deleted_by' => 'Deleted By', 
            'sct_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->sct_id)){
      $condition[] = "sct_id='$this->sct_id'";
    }if(!is_null($this->sct_name)){
      $condition[] = "sct_name='$this->sct_name'";
    }if(!is_null($this->sct_code)){
      $condition[] = "sct_code='$this->sct_code'";
    }if(!is_null($this->sct_remarks)){
      $condition[] = "sct_remarks='$this->sct_remarks'";
    }if(!is_null($this->sct_status)){
      $condition[] = "sct_status='$this->sct_status'";
    }if(!is_null($this->sct_is_deleted)){
      $condition[] = "sct_is_deleted='$this->sct_is_deleted'";
    }if(!is_null($this->sct_company_id)){
      $condition[] = "sct_company_id='$this->sct_company_id'";
    }if(!is_null($this->sct_created_by)){
      $condition[] = "sct_created_by='$this->sct_created_by'";
    }if(!is_null($this->sct_created_on)){
      $condition[] = "sct_created_on='$this->sct_created_on'";
    }if(!is_null($this->sct_last_modified_by)){
      $condition[] = "sct_last_modified_by='$this->sct_last_modified_by'";
    }if(!is_null($this->sct_last_modified_on)){
      $condition[] = "sct_last_modified_on='$this->sct_last_modified_on'";
    }if(!is_null($this->sct_deleted_by)){
      $condition[] = "sct_deleted_by='$this->sct_deleted_by'";
    }if(!is_null($this->sct_deleted_on)){
      $condition[] = "sct_deleted_on='$this->sct_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sct_id, sct_name, sct_code, sct_remarks, sct_status, sct_is_deleted, sct_company_id, sct_created_by, sct_created_on, sct_last_modified_by, sct_last_modified_on, sct_deleted_by, sct_deleted_on
          from hrm_service_category
          where ".$conditionStr."
          order by sct_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['sct_id'].'" '; 
      if($this->sct_id == $row['sct_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['sct_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->sct_id)){
      $condition[] = "sct_id='$this->sct_id'";
    }if(!is_null($this->sct_name)){
      $condition[] = "sct_name='$this->sct_name'";
    }if(!is_null($this->sct_code)){
      $condition[] = "sct_code='$this->sct_code'";
    }if(!is_null($this->sct_remarks)){
      $condition[] = "sct_remarks='$this->sct_remarks'";
    }if(!is_null($this->sct_status)){
      $condition[] = "sct_status='$this->sct_status'";
    }if(!is_null($this->sct_is_deleted)){
      $condition[] = "sct_is_deleted='$this->sct_is_deleted'";
    }if(!is_null($this->sct_company_id)){
      $condition[] = "sct_company_id='$this->sct_company_id'";
    }if(!is_null($this->sct_created_by)){
      $condition[] = "sct_created_by='$this->sct_created_by'";
    }if(!is_null($this->sct_created_on)){
      $condition[] = "sct_created_on='$this->sct_created_on'";
    }if(!is_null($this->sct_last_modified_by)){
      $condition[] = "sct_last_modified_by='$this->sct_last_modified_by'";
    }if(!is_null($this->sct_last_modified_on)){
      $condition[] = "sct_last_modified_on='$this->sct_last_modified_on'";
    }if(!is_null($this->sct_deleted_by)){
      $condition[] = "sct_deleted_by='$this->sct_deleted_by'";
    }if(!is_null($this->sct_deleted_on)){
      $condition[] = "sct_deleted_on='$this->sct_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sct_id, sct_name, sct_code, sct_remarks, sct_status, sct_is_deleted, sct_company_id, sct_created_by, sct_created_on, sct_last_modified_by, sct_last_modified_on, sct_deleted_by, sct_deleted_on
          from hrm_service_category
          where ".$conditionStr."
          order by sct_id asc";
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
    
    $model = new cls_hrm_service_category($this->db);
  
    $model->sct_id = $result[0]['sct_id'];
    $model->sct_name = $result[0]['sct_name'];
    $model->sct_code = $result[0]['sct_code'];
    $model->sct_remarks = $result[0]['sct_remarks'];
    $model->sct_status = $result[0]['sct_status'];
    $model->sct_is_deleted = $result[0]['sct_is_deleted'];
    $model->sct_company_id = $result[0]['sct_company_id'];
    $model->sct_created_by = $result[0]['sct_created_by'];
    $model->sct_created_on = $result[0]['sct_created_on'];
    $model->sct_last_modified_by = $result[0]['sct_last_modified_by'];
    $model->sct_last_modified_on = $result[0]['sct_last_modified_on'];
    $model->sct_deleted_by = $result[0]['sct_deleted_by'];
    $model->sct_deleted_on = $result[0]['sct_deleted_on'];
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
      $model = new cls_hrm_service_category($this->db);
  
      $model->sct_id = $row['sct_id'];
      $model->sct_name = $row['sct_name'];
      $model->sct_code = $row['sct_code'];
      $model->sct_remarks = $row['sct_remarks'];
      $model->sct_status = $row['sct_status'];
      $model->sct_is_deleted = $row['sct_is_deleted'];
      $model->sct_company_id = $row['sct_company_id'];
      $model->sct_created_by = $row['sct_created_by'];
      $model->sct_created_on = $row['sct_created_on'];
      $model->sct_last_modified_by = $row['sct_last_modified_by'];
      $model->sct_last_modified_on = $row['sct_last_modified_on'];
      $model->sct_deleted_by = $row['sct_deleted_by'];
      $model->sct_deleted_on = $row['sct_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->sct_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->sct_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->sct_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sct_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->sct_created_on))?$this->sct_created_on:date("Y-m-d H:i:s",$this->sct_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sct_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->sct_last_modified_on))?$this->sct_last_modified_on:date("Y-m-d H:i:s",$this->sct_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sct_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->sct_deleted_on))?$this->sct_deleted_on:date("Y-m-d H:i:s",$this->sct_deleted_on);
  }
}
?>

