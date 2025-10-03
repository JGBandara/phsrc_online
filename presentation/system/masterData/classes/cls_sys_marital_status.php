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
 * This is the model class for table "sys_marital_status".
 * @property integer $sya_id
* @property string $sya_name
* @property integer $sya_status
* @property integer $sya_is_deleted
* @property integer $sya_company_id
* @property integer $sya_created_by
* @property integer $sya_created_on
* @property integer $sya_last_modified_by
* @property integer $sya_last_modified_on
* @property integer $sya_deleted_by
* @property integer $sya_deleted_on
*/
class cls_sys_marital_status {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_marital_status';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'sya_id' => 'Id', 
            'sya_name' => 'Name', 
            'sya_status' => 'Status', 
            'sya_is_deleted' => 'Is Deleted', 
            'sya_company_id' => 'Company Id', 
            'sya_created_by' => 'Created By', 
            'sya_created_on' => 'Created On', 
            'sya_last_modified_by' => 'Last Modified By', 
            'sya_last_modified_on' => 'Last Modified On', 
            'sya_deleted_by' => 'Deleted By', 
            'sya_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->sya_id)){
      $condition[] = "sya_id='$this->sya_id'";
    }if(!is_null($this->sya_name)){
      $condition[] = "sya_name='$this->sya_name'";
    }if(!is_null($this->sya_status)){
      $condition[] = "sya_status='$this->sya_status'";
    }if(!is_null($this->sya_is_deleted)){
      $condition[] = "sya_is_deleted='$this->sya_is_deleted'";
    }if(!is_null($this->sya_company_id)){
      $condition[] = "sya_company_id='$this->sya_company_id'";
    }if(!is_null($this->sya_created_by)){
      $condition[] = "sya_created_by='$this->sya_created_by'";
    }if(!is_null($this->sya_created_on)){
      $condition[] = "sya_created_on='$this->sya_created_on'";
    }if(!is_null($this->sya_last_modified_by)){
      $condition[] = "sya_last_modified_by='$this->sya_last_modified_by'";
    }if(!is_null($this->sya_last_modified_on)){
      $condition[] = "sya_last_modified_on='$this->sya_last_modified_on'";
    }if(!is_null($this->sya_deleted_by)){
      $condition[] = "sya_deleted_by='$this->sya_deleted_by'";
    }if(!is_null($this->sya_deleted_on)){
      $condition[] = "sya_deleted_on='$this->sya_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sya_id, sya_name, sya_status, sya_is_deleted, sya_company_id, sya_created_by, sya_created_on, sya_last_modified_by, sya_last_modified_on, sya_deleted_by, sya_deleted_on
          from sys_marital_status
          where ".$conditionStr."
          order by sya_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['sya_id'].'" '; 
      if($this->sya_id == $row['sya_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['sya_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->sya_id)){
      $condition[] = "sya_id='$this->sya_id'";
    }if(!is_null($this->sya_name)){
      $condition[] = "sya_name='$this->sya_name'";
    }if(!is_null($this->sya_status)){
      $condition[] = "sya_status='$this->sya_status'";
    }if(!is_null($this->sya_is_deleted)){
      $condition[] = "sya_is_deleted='$this->sya_is_deleted'";
    }if(!is_null($this->sya_company_id)){
      $condition[] = "sya_company_id='$this->sya_company_id'";
    }if(!is_null($this->sya_created_by)){
      $condition[] = "sya_created_by='$this->sya_created_by'";
    }if(!is_null($this->sya_created_on)){
      $condition[] = "sya_created_on='$this->sya_created_on'";
    }if(!is_null($this->sya_last_modified_by)){
      $condition[] = "sya_last_modified_by='$this->sya_last_modified_by'";
    }if(!is_null($this->sya_last_modified_on)){
      $condition[] = "sya_last_modified_on='$this->sya_last_modified_on'";
    }if(!is_null($this->sya_deleted_by)){
      $condition[] = "sya_deleted_by='$this->sya_deleted_by'";
    }if(!is_null($this->sya_deleted_on)){
      $condition[] = "sya_deleted_on='$this->sya_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sya_id, sya_name, sya_status, sya_is_deleted, sya_company_id, sya_created_by, sya_created_on, sya_last_modified_by, sya_last_modified_on, sya_deleted_by, sya_deleted_on
          from sys_marital_status
          where ".$conditionStr."
          order by sya_id asc";
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
    
    $model = new cls_sys_marital_status($this->db);
  
        $model->sya_id = $result[0]['sya_id'];
        $model->sya_name = $result[0]['sya_name'];
        $model->sya_status = $result[0]['sya_status'];
        $model->sya_is_deleted = $result[0]['sya_is_deleted'];
        $model->sya_company_id = $result[0]['sya_company_id'];
        $model->sya_created_by = $result[0]['sya_created_by'];
        $model->sya_created_on = $result[0]['sya_created_on'];
        $model->sya_last_modified_by = $result[0]['sya_last_modified_by'];
        $model->sya_last_modified_on = $result[0]['sya_last_modified_on'];
        $model->sya_deleted_by = $result[0]['sya_deleted_by'];
        $model->sya_deleted_on = $result[0]['sya_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->sya_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->sya_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->sya_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->sya_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->sya_created_on))?$this->sya_created_on:date("Y-m-d H:i:s",$this->sya_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->sya_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->sya_last_modified_on))?$this->sya_last_modified_on:date("Y-m-d H:i:s",$this->sya_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->sya_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->sya_deleted_on))?$this->sya_deleted_on:date("Y-m-d H:i:s",$this->sya_deleted_on);
  }
}
?>

