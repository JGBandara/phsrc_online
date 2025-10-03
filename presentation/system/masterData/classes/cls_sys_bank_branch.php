<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "sys_bank_branch".
 * @property integer $syf_id
* @property integer $syf_bank_id
* @property string $syf_code
* @property string $syf_name
* @property string $syf_remarks
* @property integer $syf_status
* @property integer $syf_is_deleted
* @property integer $syf_company_id
* @property integer $syf_created_by
* @property integer $syf_created_on
* @property integer $syf_last_modified_by
* @property integer $syf_last_modified_on
* @property integer $syf_deleted_by
* @property integer $syf_deleted_on
*/
class cls_sys_bank_branch {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_bank_branch';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syf_id' => 'Id', 
            'syf_bank_id' => 'Bank Id', 
            'syf_code' => 'Code', 
            'syf_name' => 'Name', 
            'syf_remarks' => 'Remarks', 
            'syf_status' => 'Status', 
            'syf_is_deleted' => 'Is Deleted', 
            'syf_company_id' => 'Company Id', 
            'syf_created_by' => 'Created By', 
            'syf_created_on' => 'Created On', 
            'syf_last_modified_by' => 'Last Modified By', 
            'syf_last_modified_on' => 'Last Modified On', 
            'syf_deleted_by' => 'Deleted By', 
            'syf_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syf_id)){
      $condition[] = "syf_id='$this->syf_id'";
    }if(!is_null($this->syf_bank_id)){
      $condition[] = "syf_bank_id='$this->syf_bank_id'";
    }if(!is_null($this->syf_code)){
      $condition[] = "syf_code='$this->syf_code'";
    }if(!is_null($this->syf_name)){
      $condition[] = "syf_name='$this->syf_name'";
    }if(!is_null($this->syf_remarks)){
      $condition[] = "syf_remarks='$this->syf_remarks'";
    }if(!is_null($this->syf_status)){
      $condition[] = "syf_status='$this->syf_status'";
    }if(!is_null($this->syf_is_deleted)){
      $condition[] = "syf_is_deleted='$this->syf_is_deleted'";
    }if(!is_null($this->syf_company_id)){
      $condition[] = "syf_company_id='$this->syf_company_id'";
    }if(!is_null($this->syf_created_by)){
      $condition[] = "syf_created_by='$this->syf_created_by'";
    }if(!is_null($this->syf_created_on)){
      $condition[] = "syf_created_on='$this->syf_created_on'";
    }if(!is_null($this->syf_last_modified_by)){
      $condition[] = "syf_last_modified_by='$this->syf_last_modified_by'";
    }if(!is_null($this->syf_last_modified_on)){
      $condition[] = "syf_last_modified_on='$this->syf_last_modified_on'";
    }if(!is_null($this->syf_deleted_by)){
      $condition[] = "syf_deleted_by='$this->syf_deleted_by'";
    }if(!is_null($this->syf_deleted_on)){
      $condition[] = "syf_deleted_on='$this->syf_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syf_id, syf_bank_id, syf_code, syf_name, syf_remarks, syf_status, syf_is_deleted, syf_company_id, syf_created_by, syf_created_on, syf_last_modified_by, syf_last_modified_on, syf_deleted_by, syf_deleted_on
          from sys_bank_branch
          where ".$conditionStr."
          order by syf_name asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syf_id'].'" '; 
      if($this->syf_id == $row['syf_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syf_name'].' - '.$row['syf_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syf_id)){
      $condition[] = "syf_id='$this->syf_id'";
    }if(!is_null($this->syf_bank_id)){
      $condition[] = "syf_bank_id='$this->syf_bank_id'";
    }if(!is_null($this->syf_code)){
      $condition[] = "syf_code='$this->syf_code'";
    }if(!is_null($this->syf_name)){
      $condition[] = "syf_name='$this->syf_name'";
    }if(!is_null($this->syf_remarks)){
      $condition[] = "syf_remarks='$this->syf_remarks'";
    }if(!is_null($this->syf_status)){
      $condition[] = "syf_status='$this->syf_status'";
    }if(!is_null($this->syf_is_deleted)){
      $condition[] = "syf_is_deleted='$this->syf_is_deleted'";
    }if(!is_null($this->syf_company_id)){
      $condition[] = "syf_company_id='$this->syf_company_id'";
    }if(!is_null($this->syf_created_by)){
      $condition[] = "syf_created_by='$this->syf_created_by'";
    }if(!is_null($this->syf_created_on)){
      $condition[] = "syf_created_on='$this->syf_created_on'";
    }if(!is_null($this->syf_last_modified_by)){
      $condition[] = "syf_last_modified_by='$this->syf_last_modified_by'";
    }if(!is_null($this->syf_last_modified_on)){
      $condition[] = "syf_last_modified_on='$this->syf_last_modified_on'";
    }if(!is_null($this->syf_deleted_by)){
      $condition[] = "syf_deleted_by='$this->syf_deleted_by'";
    }if(!is_null($this->syf_deleted_on)){
      $condition[] = "syf_deleted_on='$this->syf_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syf_id, syf_bank_id, syf_code, syf_name, syf_remarks, syf_status, syf_is_deleted, syf_company_id, syf_created_by, syf_created_on, syf_last_modified_by, syf_last_modified_on, syf_deleted_by, syf_deleted_on
          from sys_bank_branch
          where ".$conditionStr."
          order by syf_id asc";
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
    
    $model = new cls_sys_bank_branch($this->db);
  
        $model->syf_id = $result[0]['syf_id'];
        $model->syf_bank_id = $result[0]['syf_bank_id'];
        $model->syf_code = $result[0]['syf_code'];
        $model->syf_name = $result[0]['syf_name'];
        $model->syf_remarks = $result[0]['syf_remarks'];
        $model->syf_status = $result[0]['syf_status'];
        $model->syf_is_deleted = $result[0]['syf_is_deleted'];
        $model->syf_company_id = $result[0]['syf_company_id'];
        $model->syf_created_by = $result[0]['syf_created_by'];
        $model->syf_created_on = $result[0]['syf_created_on'];
        $model->syf_last_modified_by = $result[0]['syf_last_modified_by'];
        $model->syf_last_modified_on = $result[0]['syf_last_modified_on'];
        $model->syf_deleted_by = $result[0]['syf_deleted_by'];
        $model->syf_deleted_on = $result[0]['syf_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->syf_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->syf_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syf_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syf_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syf_created_on))?$this->syf_created_on:date("Y-m-d H:i:s",$this->syf_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syf_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syf_last_modified_on))?$this->syf_last_modified_on:date("Y-m-d H:i:s",$this->syf_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syf_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syf_deleted_on))?$this->syf_deleted_on:date("Y-m-d H:i:s",$this->syf_deleted_on);
  }
}
?>

