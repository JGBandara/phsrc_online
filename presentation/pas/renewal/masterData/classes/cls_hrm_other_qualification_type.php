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
 * This is the model class for table "hrm_other_qualification_type".
 * @property integer $oqt_id
* @property string $oqt_name
* @property string $oqt_remarks
* @property integer $oqt_status
* @property integer $oqt_is_deleted
* @property integer $oqt_company_id
* @property integer $oqt_created_by
* @property integer $oqt_created_on
* @property integer $oqt_last_modified_by
* @property integer $oqt_last_modified_on
* @property integer $oqt_deleted_by
* @property integer $oqt_deleted_on
*/
class cls_hrm_other_qualification_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_other_qualification_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'oqt_id' => 'Id', 
            'oqt_name' => 'Name', 
            'oqt_remarks' => 'Remarks', 
            'oqt_status' => 'Status', 
            'oqt_is_deleted' => 'Is Deleted', 
            'oqt_company_id' => 'Company Id', 
            'oqt_created_by' => 'Created By', 
            'oqt_created_on' => 'Created On', 
            'oqt_last_modified_by' => 'Last Modified By', 
            'oqt_last_modified_on' => 'Last Modified On', 
            'oqt_deleted_by' => 'Deleted By', 
            'oqt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->oqt_id)){
      $condition[] = "oqt_id='$this->oqt_id'";
    }if(!is_null($this->oqt_name)){
      $condition[] = "oqt_name='$this->oqt_name'";
    }if(!is_null($this->oqt_remarks)){
      $condition[] = "oqt_remarks='$this->oqt_remarks'";
    }if(!is_null($this->oqt_status)){
      $condition[] = "oqt_status='$this->oqt_status'";
    }if(!is_null($this->oqt_is_deleted)){
      $condition[] = "oqt_is_deleted='$this->oqt_is_deleted'";
    }if(!is_null($this->oqt_company_id)){
      $condition[] = "oqt_company_id='$this->oqt_company_id'";
    }if(!is_null($this->oqt_created_by)){
      $condition[] = "oqt_created_by='$this->oqt_created_by'";
    }if(!is_null($this->oqt_created_on)){
      $condition[] = "oqt_created_on='$this->oqt_created_on'";
    }if(!is_null($this->oqt_last_modified_by)){
      $condition[] = "oqt_last_modified_by='$this->oqt_last_modified_by'";
    }if(!is_null($this->oqt_last_modified_on)){
      $condition[] = "oqt_last_modified_on='$this->oqt_last_modified_on'";
    }if(!is_null($this->oqt_deleted_by)){
      $condition[] = "oqt_deleted_by='$this->oqt_deleted_by'";
    }if(!is_null($this->oqt_deleted_on)){
      $condition[] = "oqt_deleted_on='$this->oqt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select oqt_id, oqt_name, oqt_remarks, oqt_status, oqt_is_deleted, oqt_company_id, oqt_created_by, oqt_created_on, oqt_last_modified_by, oqt_last_modified_on, oqt_deleted_by, oqt_deleted_on
          from hrm_other_qualification_type
          where ".$conditionStr."
          order by oqt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['oqt_id'].'" '; 
      if($this->oqt_id == $row['oqt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['oqt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->oqt_id)){
      $condition[] = "oqt_id='$this->oqt_id'";
    }if(!is_null($this->oqt_name)){
      $condition[] = "oqt_name='$this->oqt_name'";
    }if(!is_null($this->oqt_remarks)){
      $condition[] = "oqt_remarks='$this->oqt_remarks'";
    }if(!is_null($this->oqt_status)){
      $condition[] = "oqt_status='$this->oqt_status'";
    }if(!is_null($this->oqt_is_deleted)){
      $condition[] = "oqt_is_deleted='$this->oqt_is_deleted'";
    }if(!is_null($this->oqt_company_id)){
      $condition[] = "oqt_company_id='$this->oqt_company_id'";
    }if(!is_null($this->oqt_created_by)){
      $condition[] = "oqt_created_by='$this->oqt_created_by'";
    }if(!is_null($this->oqt_created_on)){
      $condition[] = "oqt_created_on='$this->oqt_created_on'";
    }if(!is_null($this->oqt_last_modified_by)){
      $condition[] = "oqt_last_modified_by='$this->oqt_last_modified_by'";
    }if(!is_null($this->oqt_last_modified_on)){
      $condition[] = "oqt_last_modified_on='$this->oqt_last_modified_on'";
    }if(!is_null($this->oqt_deleted_by)){
      $condition[] = "oqt_deleted_by='$this->oqt_deleted_by'";
    }if(!is_null($this->oqt_deleted_on)){
      $condition[] = "oqt_deleted_on='$this->oqt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select oqt_id, oqt_name, oqt_remarks, oqt_status, oqt_is_deleted, oqt_company_id, oqt_created_by, oqt_created_on, oqt_last_modified_by, oqt_last_modified_on, oqt_deleted_by, oqt_deleted_on
          from hrm_other_qualification_type
          where ".$conditionStr."
          order by oqt_id asc";
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
    
    $model = new cls_hrm_other_qualification_type($this->db);
  
    $model->oqt_id = $result[0]['oqt_id'];
    $model->oqt_name = $result[0]['oqt_name'];
    $model->oqt_remarks = $result[0]['oqt_remarks'];
    $model->oqt_status = $result[0]['oqt_status'];
    $model->oqt_is_deleted = $result[0]['oqt_is_deleted'];
    $model->oqt_company_id = $result[0]['oqt_company_id'];
    $model->oqt_created_by = $result[0]['oqt_created_by'];
    $model->oqt_created_on = $result[0]['oqt_created_on'];
    $model->oqt_last_modified_by = $result[0]['oqt_last_modified_by'];
    $model->oqt_last_modified_on = $result[0]['oqt_last_modified_on'];
    $model->oqt_deleted_by = $result[0]['oqt_deleted_by'];
    $model->oqt_deleted_on = $result[0]['oqt_deleted_on'];
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
      $model = new cls_hrm_other_qualification_type($this->db);
  
      $model->oqt_id = $row['oqt_id'];
      $model->oqt_name = $row['oqt_name'];
      $model->oqt_remarks = $row['oqt_remarks'];
      $model->oqt_status = $row['oqt_status'];
      $model->oqt_is_deleted = $row['oqt_is_deleted'];
      $model->oqt_company_id = $row['oqt_company_id'];
      $model->oqt_created_by = $row['oqt_created_by'];
      $model->oqt_created_on = $row['oqt_created_on'];
      $model->oqt_last_modified_by = $row['oqt_last_modified_by'];
      $model->oqt_last_modified_on = $row['oqt_last_modified_on'];
      $model->oqt_deleted_by = $row['oqt_deleted_by'];
      $model->oqt_deleted_on = $row['oqt_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->oqt_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->oqt_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->oqt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->oqt_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->oqt_created_on))?$this->oqt_created_on:date("Y-m-d H:i:s",$this->oqt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->oqt_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->oqt_last_modified_on))?$this->oqt_last_modified_on:date("Y-m-d H:i:s",$this->oqt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->oqt_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->oqt_deleted_on))?$this->oqt_deleted_on:date("Y-m-d H:i:s",$this->oqt_deleted_on);
  }
}
?>

