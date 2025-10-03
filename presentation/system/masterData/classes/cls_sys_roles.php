<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "sys_roles".
 * @property integer $syr_id
* @property string $syr_name
* @property string $syr_remarks
* @property integer $syr_status
* @property integer $syr_is_deleted
* @property integer $syr_company_id
* @property integer $syr_created_by
* @property integer $syr_created_on
* @property integer $syr_last_modified_by
* @property integer $syr_last_modified_on
* @property integer $syr_deleted_by
* @property integer $syr_deleted_on
*/
class cls_sys_roles {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_roles';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syr_id' => 'Id', 
            'syr_name' => 'Name', 
            'syr_remarks' => 'Remarks', 
            'syr_status' => 'Status', 
            'syr_is_deleted' => 'Is Deleted', 
            'syr_company_id' => 'Company Id', 
            'syr_created_by' => 'Created By', 
            'syr_created_on' => 'Created On', 
            'syr_last_modified_by' => 'Last Modified By', 
            'syr_last_modified_on' => 'Last Modified On', 
            'syr_deleted_by' => 'Deleted By', 
            'syr_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syr_id)){
      $condition[] = "syr_id='$this->syr_id'";
    }if(!is_null($this->syr_name)){
      $condition[] = "syr_name='$this->syr_name'";
    }if(!is_null($this->syr_remarks)){
      $condition[] = "syr_remarks='$this->syr_remarks'";
    }if(!is_null($this->syr_status)){
      $condition[] = "syr_status='$this->syr_status'";
    }if(!is_null($this->syr_is_deleted)){
      $condition[] = "syr_is_deleted='$this->syr_is_deleted'";
    }if(!is_null($this->syr_company_id)){
      $condition[] = "syr_company_id='$this->syr_company_id'";
    }if(!is_null($this->syr_created_by)){
      $condition[] = "syr_created_by='$this->syr_created_by'";
    }if(!is_null($this->syr_created_on)){
      $condition[] = "syr_created_on='$this->syr_created_on'";
    }if(!is_null($this->syr_last_modified_by)){
      $condition[] = "syr_last_modified_by='$this->syr_last_modified_by'";
    }if(!is_null($this->syr_last_modified_on)){
      $condition[] = "syr_last_modified_on='$this->syr_last_modified_on'";
    }if(!is_null($this->syr_deleted_by)){
      $condition[] = "syr_deleted_by='$this->syr_deleted_by'";
    }if(!is_null($this->syr_deleted_on)){
      $condition[] = "syr_deleted_on='$this->syr_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syr_id, syr_name, syr_remarks, syr_status, syr_is_deleted, syr_company_id, syr_created_by, syr_created_on, syr_last_modified_by, syr_last_modified_on, syr_deleted_by, syr_deleted_on
          from sys_roles
          where ".$conditionStr."
          order by syr_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syr_id'].'" '; 
      if($this->syr_id == $row['syr_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syr_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syr_id)){
      $condition[] = "syr_id='$this->syr_id'";
    }if(!is_null($this->syr_name)){
      $condition[] = "syr_name='$this->syr_name'";
    }if(!is_null($this->syr_remarks)){
      $condition[] = "syr_remarks='$this->syr_remarks'";
    }if(!is_null($this->syr_status)){
      $condition[] = "syr_status='$this->syr_status'";
    }if(!is_null($this->syr_is_deleted)){
      $condition[] = "syr_is_deleted='$this->syr_is_deleted'";
    }if(!is_null($this->syr_company_id)){
      $condition[] = "syr_company_id='$this->syr_company_id'";
    }if(!is_null($this->syr_created_by)){
      $condition[] = "syr_created_by='$this->syr_created_by'";
    }if(!is_null($this->syr_created_on)){
      $condition[] = "syr_created_on='$this->syr_created_on'";
    }if(!is_null($this->syr_last_modified_by)){
      $condition[] = "syr_last_modified_by='$this->syr_last_modified_by'";
    }if(!is_null($this->syr_last_modified_on)){
      $condition[] = "syr_last_modified_on='$this->syr_last_modified_on'";
    }if(!is_null($this->syr_deleted_by)){
      $condition[] = "syr_deleted_by='$this->syr_deleted_by'";
    }if(!is_null($this->syr_deleted_on)){
      $condition[] = "syr_deleted_on='$this->syr_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syr_id, syr_name, syr_remarks, syr_status, syr_is_deleted, syr_company_id, syr_created_by, syr_created_on, syr_last_modified_by, syr_last_modified_on, syr_deleted_by, syr_deleted_on
          from sys_roles
          where ".$conditionStr."
          order by syr_id asc";
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
    
    $model = new cls_sys_roles($this->db);
  
    $model->syr_id = $result[0]['syr_id'];
    $model->syr_name = $result[0]['syr_name'];
    $model->syr_remarks = $result[0]['syr_remarks'];
    $model->syr_status = $result[0]['syr_status'];
    $model->syr_is_deleted = $result[0]['syr_is_deleted'];
    $model->syr_company_id = $result[0]['syr_company_id'];
    $model->syr_created_by = $result[0]['syr_created_by'];
    $model->syr_created_on = $result[0]['syr_created_on'];
    $model->syr_last_modified_by = $result[0]['syr_last_modified_by'];
    $model->syr_last_modified_on = $result[0]['syr_last_modified_on'];
    $model->syr_deleted_by = $result[0]['syr_deleted_by'];
    $model->syr_deleted_on = $result[0]['syr_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syr_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syr_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syr_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syr_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syr_created_on))?$this->syr_created_on:date("Y-m-d H:i:s",$this->syr_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syr_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syr_last_modified_on))?$this->syr_last_modified_on:date("Y-m-d H:i:s",$this->syr_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syr_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syr_deleted_on))?$this->syr_deleted_on:date("Y-m-d H:i:s",$this->syr_deleted_on);
  }
}
?>

