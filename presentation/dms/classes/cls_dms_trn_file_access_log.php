<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */
namespace presentation\dms\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "dms_trn_file_access_log".
 * @property integer $dfa_id
* @property integer $dfa_file_id
* @property integer $dfa_user_id
* @property string $dfa_access_time
* @property string $dfa_remarks
* @property integer $dfa_status
* @property integer $dfa_is_deleted
* @property integer $dfa_company_id
* @property integer $dfa_created_by
* @property integer $dfa_created_on
* @property integer $dfa_last_modified_by
* @property integer $dfa_last_modified_on
* @property integer $dfa_deleted_by
* @property integer $dfa_deleted_on
*/
class cls_dms_trn_file_access_log {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'dms_trn_file_access_log';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dfa_id' => 'Id', 
            'dfa_file_id' => 'File Id', 
            'dfa_user_id' => 'User Id', 
            'dfa_access_time' => 'Access Time', 
            'dfa_remarks' => 'Remarks', 
            'dfa_status' => 'Status', 
            'dfa_is_deleted' => 'Is Deleted', 
            'dfa_company_id' => 'Company Id', 
            'dfa_created_by' => 'Created By', 
            'dfa_created_on' => 'Created On', 
            'dfa_last_modified_by' => 'Last Modified By', 
            'dfa_last_modified_on' => 'Last Modified On', 
            'dfa_deleted_by' => 'Deleted By', 
            'dfa_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dfa_id)){
      $condition[] = "dfa_id='$this->dfa_id'";
    }if(!is_null($this->dfa_file_id)){
      $condition[] = "dfa_file_id='$this->dfa_file_id'";
    }if(!is_null($this->dfa_user_id)){
      $condition[] = "dfa_user_id='$this->dfa_user_id'";
    }if(!is_null($this->dfa_access_time)){
      $condition[] = "dfa_access_time='$this->dfa_access_time'";
    }if(!is_null($this->dfa_remarks)){
      $condition[] = "dfa_remarks='$this->dfa_remarks'";
    }if(!is_null($this->dfa_status)){
      $condition[] = "dfa_status='$this->dfa_status'";
    }if(!is_null($this->dfa_is_deleted)){
      $condition[] = "dfa_is_deleted='$this->dfa_is_deleted'";
    }if(!is_null($this->dfa_company_id)){
      $condition[] = "dfa_company_id='$this->dfa_company_id'";
    }if(!is_null($this->dfa_created_by)){
      $condition[] = "dfa_created_by='$this->dfa_created_by'";
    }if(!is_null($this->dfa_created_on)){
      $condition[] = "dfa_created_on='$this->dfa_created_on'";
    }if(!is_null($this->dfa_last_modified_by)){
      $condition[] = "dfa_last_modified_by='$this->dfa_last_modified_by'";
    }if(!is_null($this->dfa_last_modified_on)){
      $condition[] = "dfa_last_modified_on='$this->dfa_last_modified_on'";
    }if(!is_null($this->dfa_deleted_by)){
      $condition[] = "dfa_deleted_by='$this->dfa_deleted_by'";
    }if(!is_null($this->dfa_deleted_on)){
      $condition[] = "dfa_deleted_on='$this->dfa_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dfa_id, dfa_file_id, dfa_user_id, dfa_access_time, dfa_remarks, dfa_status, dfa_is_deleted, dfa_company_id, dfa_created_by, dfa_created_on, dfa_last_modified_by, dfa_last_modified_on, dfa_deleted_by, dfa_deleted_on
          from dms_trn_file_access_log
          where ".$conditionStr."
          order by dfa_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dfa_id'].'" '; 
      if($this->dfa_id == $row['dfa_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dfa_file_id'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dfa_id)){
      $condition[] = "dfa_id='$this->dfa_id'";
    }if(!is_null($this->dfa_file_id)){
      $condition[] = "dfa_file_id='$this->dfa_file_id'";
    }if(!is_null($this->dfa_user_id)){
      $condition[] = "dfa_user_id='$this->dfa_user_id'";
    }if(!is_null($this->dfa_access_time)){
      $condition[] = "dfa_access_time='$this->dfa_access_time'";
    }if(!is_null($this->dfa_remarks)){
      $condition[] = "dfa_remarks='$this->dfa_remarks'";
    }if(!is_null($this->dfa_status)){
      $condition[] = "dfa_status='$this->dfa_status'";
    }if(!is_null($this->dfa_is_deleted)){
      $condition[] = "dfa_is_deleted='$this->dfa_is_deleted'";
    }if(!is_null($this->dfa_company_id)){
      $condition[] = "dfa_company_id='$this->dfa_company_id'";
    }if(!is_null($this->dfa_created_by)){
      $condition[] = "dfa_created_by='$this->dfa_created_by'";
    }if(!is_null($this->dfa_created_on)){
      $condition[] = "dfa_created_on='$this->dfa_created_on'";
    }if(!is_null($this->dfa_last_modified_by)){
      $condition[] = "dfa_last_modified_by='$this->dfa_last_modified_by'";
    }if(!is_null($this->dfa_last_modified_on)){
      $condition[] = "dfa_last_modified_on='$this->dfa_last_modified_on'";
    }if(!is_null($this->dfa_deleted_by)){
      $condition[] = "dfa_deleted_by='$this->dfa_deleted_by'";
    }if(!is_null($this->dfa_deleted_on)){
      $condition[] = "dfa_deleted_on='$this->dfa_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dfa_id, dfa_file_id, dfa_user_id, if(dfa_access_time='0000-00-00 00:00:00','',dfa_access_time) as `dfa_access_time`, dfa_remarks, dfa_status, dfa_is_deleted, dfa_company_id, dfa_created_by, dfa_created_on, dfa_last_modified_by, dfa_last_modified_on, dfa_deleted_by, dfa_deleted_on
          from dms_trn_file_access_log
          where ".$conditionStr."
          order by dfa_id asc";
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
    
    $model = new cls_dms_trn_file_access_log($this->db);
  
    $model->dfa_id = $result[0]['dfa_id'];
    $model->dfa_file_id = $result[0]['dfa_file_id'];
    $model->dfa_user_id = $result[0]['dfa_user_id'];
    $model->dfa_access_time = ($result[0]['dfa_access_time']=='0000-00-00 00:00:00')?'':$result[0]['dfa_access_time'];
    $model->dfa_remarks = $result[0]['dfa_remarks'];
    $model->dfa_status = $result[0]['dfa_status'];
    $model->dfa_is_deleted = $result[0]['dfa_is_deleted'];
    $model->dfa_company_id = $result[0]['dfa_company_id'];
    $model->dfa_created_by = $result[0]['dfa_created_by'];
    $model->dfa_created_on = $result[0]['dfa_created_on'];
    $model->dfa_last_modified_by = $result[0]['dfa_last_modified_by'];
    $model->dfa_last_modified_on = $result[0]['dfa_last_modified_on'];
    $model->dfa_deleted_by = $result[0]['dfa_deleted_by'];
    $model->dfa_deleted_on = $result[0]['dfa_deleted_on'];
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
      $model = new cls_dms_trn_file_access_log($this->db);
  
      $model->dfa_id = $row['dfa_id'];
      $model->dfa_file_id = $row['dfa_file_id'];
      $model->dfa_user_id = $row['dfa_user_id'];
      $model->dfa_access_time = ($row['dfa_access_time']=='0000-00-00 00:00:00')?'':$row['dfa_access_time'];
      $model->dfa_remarks = $row['dfa_remarks'];
      $model->dfa_status = $row['dfa_status'];
      $model->dfa_is_deleted = $row['dfa_is_deleted'];
      $model->dfa_company_id = $row['dfa_company_id'];
      $model->dfa_created_by = $row['dfa_created_by'];
      $model->dfa_created_on = $row['dfa_created_on'];
      $model->dfa_last_modified_by = $row['dfa_last_modified_by'];
      $model->dfa_last_modified_on = $row['dfa_last_modified_on'];
      $model->dfa_deleted_by = $row['dfa_deleted_by'];
      $model->dfa_deleted_on = $row['dfa_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dfa_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dfa_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dfa_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfa_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dfa_created_on))?$this->dfa_created_on:date("Y-m-d H:i:s",$this->dfa_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfa_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dfa_last_modified_on))?$this->dfa_last_modified_on:date("Y-m-d H:i:s",$this->dfa_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfa_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dfa_deleted_on))?$this->dfa_deleted_on:date("Y-m-d H:i:s",$this->dfa_deleted_on);
  }
}
?>

