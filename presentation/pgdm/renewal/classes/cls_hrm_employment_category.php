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
 * This is the model class for table "hrm_employment_category".
 * @property integer $emc_id
* @property string $emc_name
* @property string $emc_remarks
* @property integer $emc_status
* @property integer $emc_is_deleted
* @property integer $emc_company_id
* @property integer $emc_created_by
* @property integer $emc_created_on
* @property integer $emc_last_modified_by
* @property integer $emc_last_modified_on
* @property integer $emc_deleted_by
* @property integer $emc_deleted_on
*/
class cls_hrm_employment_category {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employment_category';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'emc_id' => 'Id', 
            'emc_name' => 'Name', 
            'emc_remarks' => 'Remarks', 
            'emc_status' => 'Status', 
            'emc_is_deleted' => 'Is Deleted', 
            'emc_company_id' => 'Company Id', 
            'emc_created_by' => 'Created By', 
            'emc_created_on' => 'Created On', 
            'emc_last_modified_by' => 'Last Modified By', 
            'emc_last_modified_on' => 'Last Modified On', 
            'emc_deleted_by' => 'Deleted By', 
            'emc_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->emc_id)){
      $condition[] = "emc_id='$this->emc_id'";
    }if(!is_null($this->emc_name)){
      $condition[] = "emc_name='$this->emc_name'";
    }if(!is_null($this->emc_remarks)){
      $condition[] = "emc_remarks='$this->emc_remarks'";
    }if(!is_null($this->emc_status)){
      $condition[] = "emc_status='$this->emc_status'";
    }if(!is_null($this->emc_is_deleted)){
      $condition[] = "emc_is_deleted='$this->emc_is_deleted'";
    }if(!is_null($this->emc_company_id)){
      $condition[] = "emc_company_id='$this->emc_company_id'";
    }if(!is_null($this->emc_created_by)){
      $condition[] = "emc_created_by='$this->emc_created_by'";
    }if(!is_null($this->emc_created_on)){
      $condition[] = "emc_created_on='$this->emc_created_on'";
    }if(!is_null($this->emc_last_modified_by)){
      $condition[] = "emc_last_modified_by='$this->emc_last_modified_by'";
    }if(!is_null($this->emc_last_modified_on)){
      $condition[] = "emc_last_modified_on='$this->emc_last_modified_on'";
    }if(!is_null($this->emc_deleted_by)){
      $condition[] = "emc_deleted_by='$this->emc_deleted_by'";
    }if(!is_null($this->emc_deleted_on)){
      $condition[] = "emc_deleted_on='$this->emc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emc_id, emc_name, emc_remarks, emc_status, emc_is_deleted, emc_company_id, emc_created_by, emc_created_on, emc_last_modified_by, emc_last_modified_on, emc_deleted_by, emc_deleted_on
          from hrm_employment_category
          where ".$conditionStr."
          order by emc_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['emc_id'].'" '; 
      if($this->emc_id == $row['emc_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emc_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->emc_id)){
      $condition[] = "emc_id='$this->emc_id'";
    }if(!is_null($this->emc_name)){
      $condition[] = "emc_name='$this->emc_name'";
    }if(!is_null($this->emc_remarks)){
      $condition[] = "emc_remarks='$this->emc_remarks'";
    }if(!is_null($this->emc_status)){
      $condition[] = "emc_status='$this->emc_status'";
    }if(!is_null($this->emc_is_deleted)){
      $condition[] = "emc_is_deleted='$this->emc_is_deleted'";
    }if(!is_null($this->emc_company_id)){
      $condition[] = "emc_company_id='$this->emc_company_id'";
    }if(!is_null($this->emc_created_by)){
      $condition[] = "emc_created_by='$this->emc_created_by'";
    }if(!is_null($this->emc_created_on)){
      $condition[] = "emc_created_on='$this->emc_created_on'";
    }if(!is_null($this->emc_last_modified_by)){
      $condition[] = "emc_last_modified_by='$this->emc_last_modified_by'";
    }if(!is_null($this->emc_last_modified_on)){
      $condition[] = "emc_last_modified_on='$this->emc_last_modified_on'";
    }if(!is_null($this->emc_deleted_by)){
      $condition[] = "emc_deleted_by='$this->emc_deleted_by'";
    }if(!is_null($this->emc_deleted_on)){
      $condition[] = "emc_deleted_on='$this->emc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emc_id, emc_name, emc_remarks, emc_status, emc_is_deleted, emc_company_id, emc_created_by, emc_created_on, emc_last_modified_by, emc_last_modified_on, emc_deleted_by, emc_deleted_on
          from hrm_employment_category
          where ".$conditionStr."
          order by emc_id asc";
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
    
    $model = new cls_hrm_employment_category($this->db);
  
    $model->emc_id = $result[0]['emc_id'];
    $model->emc_name = $result[0]['emc_name'];
    $model->emc_remarks = $result[0]['emc_remarks'];
    $model->emc_status = $result[0]['emc_status'];
    $model->emc_is_deleted = $result[0]['emc_is_deleted'];
    $model->emc_company_id = $result[0]['emc_company_id'];
    $model->emc_created_by = $result[0]['emc_created_by'];
    $model->emc_created_on = $result[0]['emc_created_on'];
    $model->emc_last_modified_by = $result[0]['emc_last_modified_by'];
    $model->emc_last_modified_on = $result[0]['emc_last_modified_on'];
    $model->emc_deleted_by = $result[0]['emc_deleted_by'];
    $model->emc_deleted_on = $result[0]['emc_deleted_on'];
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
      $model = new cls_hrm_employment_category($this->db);
  
      $model->emc_id = $row['emc_id'];
      $model->emc_name = $row['emc_name'];
      $model->emc_remarks = $row['emc_remarks'];
      $model->emc_status = $row['emc_status'];
      $model->emc_is_deleted = $row['emc_is_deleted'];
      $model->emc_company_id = $row['emc_company_id'];
      $model->emc_created_by = $row['emc_created_by'];
      $model->emc_created_on = $row['emc_created_on'];
      $model->emc_last_modified_by = $row['emc_last_modified_by'];
      $model->emc_last_modified_on = $row['emc_last_modified_on'];
      $model->emc_deleted_by = $row['emc_deleted_by'];
      $model->emc_deleted_on = $row['emc_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->emc_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->emc_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->emc_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emc_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->emc_created_on))?$this->emc_created_on:date("Y-m-d H:i:s",$this->emc_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emc_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->emc_last_modified_on))?$this->emc_last_modified_on:date("Y-m-d H:i:s",$this->emc_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emc_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->emc_deleted_on))?$this->emc_deleted_on:date("Y-m-d H:i:s",$this->emc_deleted_on);
  }
}
?>

