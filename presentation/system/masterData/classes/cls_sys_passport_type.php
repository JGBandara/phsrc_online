<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "sys_passport_type".
 * @property integer $syb_id
* @property string $syb_name
* @property string $syb_remarks
* @property integer $syb_status
* @property integer $syb_company_id
* @property integer $syb_created_by
* @property integer $syb_created_on
* @property integer $syb_last_modified_by
* @property integer $syb_last_modified_on
* @property integer $syb_deleted_by
* @property integer $syb_deleted_on
*/
class cls_sys_passport_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_passport_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syb_id' => 'Id', 
            'syb_name' => 'Name', 
            'syb_remarks' => 'Remarks', 
            'syb_status' => 'Status', 
            'syb_is_deleted' => 'Is Deleted', 
            'syb_company_id' => 'Company Id', 
            'syb_created_by' => 'Created By', 
            'syb_created_on' => 'Created On', 
            'syb_last_modified_by' => 'Last Modified By', 
            'syb_last_modified_on' => 'Last Modified On', 
            'syb_deleted_by' => 'Deleted By', 
            'syb_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syb_id)){
      $condition[] = "syb_id='$this->syb_id'";
    }if(!is_null($this->syb_name)){
      $condition[] = "syb_name='$this->syb_name'";
    }if(!is_null($this->syb_remarks)){
      $condition[] = "syb_remarks='$this->syb_remarks'";
    }if(!is_null($this->syb_status)){
      $condition[] = "syb_status='$this->syb_status'";
    }if(!is_null($this->syb_is_deleted)){
      $condition[] = "syb_is_deleted='$this->syb_is_deleted'";
    }if(!is_null($this->syb_company_id)){
      $condition[] = "syb_company_id='$this->syb_company_id'";
    }if(!is_null($this->syb_created_by)){
      $condition[] = "syb_created_by='$this->syb_created_by'";
    }if(!is_null($this->syb_created_on)){
      $condition[] = "syb_created_on='$this->syb_created_on'";
    }if(!is_null($this->syb_last_modified_by)){
      $condition[] = "syb_last_modified_by='$this->syb_last_modified_by'";
    }if(!is_null($this->syb_last_modified_on)){
      $condition[] = "syb_last_modified_on='$this->syb_last_modified_on'";
    }if(!is_null($this->syb_deleted_by)){
      $condition[] = "syb_deleted_by='$this->syb_deleted_by'";
    }if(!is_null($this->syb_deleted_on)){
      $condition[] = "syb_deleted_on='$this->syb_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syb_id, syb_name, syb_remarks, syb_status, syb_is_deleted, syb_company_id, syb_created_by, syb_created_on, syb_last_modified_by, syb_last_modified_on, syb_deleted_by, syb_deleted_on
          from sys_passport_type
          where ".$conditionStr."
          order by syb_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syb_id'].'" '; 
      if($this->syb_id == $row['syb_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syb_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syb_id)){
      $condition[] = "syb_id='$this->syb_id'";
    }if(!is_null($this->syb_name)){
      $condition[] = "syb_name='$this->syb_name'";
    }if(!is_null($this->syb_remarks)){
      $condition[] = "syb_remarks='$this->syb_remarks'";
    }if(!is_null($this->syb_status)){
      $condition[] = "syb_status='$this->syb_status'";
    }if(!is_null($this->syb_is_deleted)){
      $condition[] = "syb_is_deleted='$this->syb_is_deleted'";
    }if(!is_null($this->syb_company_id)){
      $condition[] = "syb_company_id='$this->syb_company_id'";
    }if(!is_null($this->syb_created_by)){
      $condition[] = "syb_created_by='$this->syb_created_by'";
    }if(!is_null($this->syb_created_on)){
      $condition[] = "syb_created_on='$this->syb_created_on'";
    }if(!is_null($this->syb_last_modified_by)){
      $condition[] = "syb_last_modified_by='$this->syb_last_modified_by'";
    }if(!is_null($this->syb_last_modified_on)){
      $condition[] = "syb_last_modified_on='$this->syb_last_modified_on'";
    }if(!is_null($this->syb_deleted_by)){
      $condition[] = "syb_deleted_by='$this->syb_deleted_by'";
    }if(!is_null($this->syb_deleted_on)){
      $condition[] = "syb_deleted_on='$this->syb_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syb_id, syb_name, syb_remarks, syb_status, syb_is_deleted, syb_company_id, syb_created_by, syb_created_on, syb_last_modified_by, syb_last_modified_on, syb_deleted_by, syb_deleted_on
          from sys_passport_type
          where ".$conditionStr."
          order by syb_id asc";
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
    
    $model = new cls_sys_passport_type($this->db);
  
    $model->syb_id = $result[0]['syb_id'];
    $model->syb_name = $result[0]['syb_name'];
    $model->syb_remarks = $result[0]['syb_remarks'];
    $model->syb_status = $result[0]['syb_status'];
    $model->syb_is_deleted = $result[0]['syb_is_deleted'];
    $model->syb_company_id = $result[0]['syb_company_id'];
    $model->syb_created_by = $result[0]['syb_created_by'];
    $model->syb_created_on = $result[0]['syb_created_on'];
    $model->syb_last_modified_by = $result[0]['syb_last_modified_by'];
    $model->syb_last_modified_on = $result[0]['syb_last_modified_on'];
    $model->syb_deleted_by = $result[0]['syb_deleted_by'];
    $model->syb_deleted_on = $result[0]['syb_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syb_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syb_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syb_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syb_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syb_created_on))?$this->syb_created_on:date("Y-m-d H:i:s",$this->syb_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syb_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syb_last_modified_on))?$this->syb_last_modified_on:date("Y-m-d H:i:s",$this->syb_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syb_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syb_deleted_on))?$this->syb_deleted_on:date("Y-m-d H:i:s",$this->syb_deleted_on);
  }
}
?>

