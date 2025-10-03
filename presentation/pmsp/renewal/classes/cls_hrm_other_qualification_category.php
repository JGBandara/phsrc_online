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
 * This is the model class for table "hrm_other_qualification_category".
 * @property integer $oqc_id
* @property string $oqc_name
* @property string $oqc_remarks
* @property integer $oqc_status
* @property integer $oqc_is_deleted
* @property integer $oqc_company_id
* @property integer $oqc_created_by
* @property integer $oqc_created_on
* @property integer $oqc_last_modified_by
* @property integer $oqc_last_modified_on
* @property integer $oqc_deleted_by
* @property integer $oqc_deleted_on
*/
class cls_hrm_other_qualification_category {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_other_qualification_category';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'oqc_id' => 'Id', 
            'oqc_name' => 'Name', 
            'oqc_remarks' => 'Remarks', 
            'oqc_status' => 'Status', 
            'oqc_is_deleted' => 'Is Deleted', 
            'oqc_company_id' => 'Company Id', 
            'oqc_created_by' => 'Created By', 
            'oqc_created_on' => 'Created On', 
            'oqc_last_modified_by' => 'Last Modified By', 
            'oqc_last_modified_on' => 'Last Modified On', 
            'oqc_deleted_by' => 'Deleted By', 
            'oqc_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->oqc_id)){
      $condition[] = "oqc_id='$this->oqc_id'";
    }if(!is_null($this->oqc_name)){
      $condition[] = "oqc_name='$this->oqc_name'";
    }if(!is_null($this->oqc_remarks)){
      $condition[] = "oqc_remarks='$this->oqc_remarks'";
    }if(!is_null($this->oqc_status)){
      $condition[] = "oqc_status='$this->oqc_status'";
    }if(!is_null($this->oqc_is_deleted)){
      $condition[] = "oqc_is_deleted='$this->oqc_is_deleted'";
    }if(!is_null($this->oqc_company_id)){
      $condition[] = "oqc_company_id='$this->oqc_company_id'";
    }if(!is_null($this->oqc_created_by)){
      $condition[] = "oqc_created_by='$this->oqc_created_by'";
    }if(!is_null($this->oqc_created_on)){
      $condition[] = "oqc_created_on='$this->oqc_created_on'";
    }if(!is_null($this->oqc_last_modified_by)){
      $condition[] = "oqc_last_modified_by='$this->oqc_last_modified_by'";
    }if(!is_null($this->oqc_last_modified_on)){
      $condition[] = "oqc_last_modified_on='$this->oqc_last_modified_on'";
    }if(!is_null($this->oqc_deleted_by)){
      $condition[] = "oqc_deleted_by='$this->oqc_deleted_by'";
    }if(!is_null($this->oqc_deleted_on)){
      $condition[] = "oqc_deleted_on='$this->oqc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select oqc_id, oqc_name, oqc_remarks, oqc_status, oqc_is_deleted, oqc_company_id, oqc_created_by, oqc_created_on, oqc_last_modified_by, oqc_last_modified_on, oqc_deleted_by, oqc_deleted_on
          from hrm_other_qualification_category
          where ".$conditionStr."
          order by oqc_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['oqc_id'].'" '; 
      if($this->oqc_id == $row['oqc_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['oqc_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->oqc_id)){
      $condition[] = "oqc_id='$this->oqc_id'";
    }if(!is_null($this->oqc_name)){
      $condition[] = "oqc_name='$this->oqc_name'";
    }if(!is_null($this->oqc_remarks)){
      $condition[] = "oqc_remarks='$this->oqc_remarks'";
    }if(!is_null($this->oqc_status)){
      $condition[] = "oqc_status='$this->oqc_status'";
    }if(!is_null($this->oqc_is_deleted)){
      $condition[] = "oqc_is_deleted='$this->oqc_is_deleted'";
    }if(!is_null($this->oqc_company_id)){
      $condition[] = "oqc_company_id='$this->oqc_company_id'";
    }if(!is_null($this->oqc_created_by)){
      $condition[] = "oqc_created_by='$this->oqc_created_by'";
    }if(!is_null($this->oqc_created_on)){
      $condition[] = "oqc_created_on='$this->oqc_created_on'";
    }if(!is_null($this->oqc_last_modified_by)){
      $condition[] = "oqc_last_modified_by='$this->oqc_last_modified_by'";
    }if(!is_null($this->oqc_last_modified_on)){
      $condition[] = "oqc_last_modified_on='$this->oqc_last_modified_on'";
    }if(!is_null($this->oqc_deleted_by)){
      $condition[] = "oqc_deleted_by='$this->oqc_deleted_by'";
    }if(!is_null($this->oqc_deleted_on)){
      $condition[] = "oqc_deleted_on='$this->oqc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select oqc_id, oqc_name, oqc_remarks, oqc_status, oqc_is_deleted, oqc_company_id, oqc_created_by, oqc_created_on, oqc_last_modified_by, oqc_last_modified_on, oqc_deleted_by, oqc_deleted_on
          from hrm_other_qualification_category
          where ".$conditionStr."
          order by oqc_id asc";
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
    
    $model = new cls_hrm_other_qualification_category($this->db);
  
    $model->oqc_id = $result[0]['oqc_id'];
    $model->oqc_name = $result[0]['oqc_name'];
    $model->oqc_remarks = $result[0]['oqc_remarks'];
    $model->oqc_status = $result[0]['oqc_status'];
    $model->oqc_is_deleted = $result[0]['oqc_is_deleted'];
    $model->oqc_company_id = $result[0]['oqc_company_id'];
    $model->oqc_created_by = $result[0]['oqc_created_by'];
    $model->oqc_created_on = $result[0]['oqc_created_on'];
    $model->oqc_last_modified_by = $result[0]['oqc_last_modified_by'];
    $model->oqc_last_modified_on = $result[0]['oqc_last_modified_on'];
    $model->oqc_deleted_by = $result[0]['oqc_deleted_by'];
    $model->oqc_deleted_on = $result[0]['oqc_deleted_on'];
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
      $model = new cls_hrm_other_qualification_category($this->db);
  
      $model->oqc_id = $row['oqc_id'];
      $model->oqc_name = $row['oqc_name'];
      $model->oqc_remarks = $row['oqc_remarks'];
      $model->oqc_status = $row['oqc_status'];
      $model->oqc_is_deleted = $row['oqc_is_deleted'];
      $model->oqc_company_id = $row['oqc_company_id'];
      $model->oqc_created_by = $row['oqc_created_by'];
      $model->oqc_created_on = $row['oqc_created_on'];
      $model->oqc_last_modified_by = $row['oqc_last_modified_by'];
      $model->oqc_last_modified_on = $row['oqc_last_modified_on'];
      $model->oqc_deleted_by = $row['oqc_deleted_by'];
      $model->oqc_deleted_on = $row['oqc_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->oqc_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->oqc_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->oqc_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->oqc_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->oqc_created_on))?$this->oqc_created_on:date("Y-m-d H:i:s",$this->oqc_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->oqc_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->oqc_last_modified_on))?$this->oqc_last_modified_on:date("Y-m-d H:i:s",$this->oqc_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->oqc_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->oqc_deleted_on))?$this->oqc_deleted_on:date("Y-m-d H:i:s",$this->oqc_deleted_on);
  }
}
?>

