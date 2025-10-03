<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-11
 */
namespace presentation\dms\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "dms_file_group".
 * @property integer $dfg_id
* @property string $dfg_name
* @property string $dfg_remarks
* @property integer $dfg_status
* @property integer $dfg_is_deleted
* @property integer $dfg_company_id
* @property integer $dfg_created_by
* @property integer $dfg_created_on
* @property integer $dfg_last_modified_by
* @property integer $dfg_last_modified_on
* @property integer $dfg_deleted_by
* @property integer $dfg_deleted_on
*/
class cls_dms_file_group {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'dms_file_group';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dfg_id' => 'Id', 
            'dfg_name' => 'Name', 
            'dfg_remarks' => 'Remarks', 
            'dfg_status' => 'Status', 
            'dfg_is_deleted' => 'Is Deleted', 
            'dfg_company_id' => 'Company', 
            'dfg_created_by' => 'Created By', 
            'dfg_created_on' => 'Created On', 
            'dfg_last_modified_by' => 'Last Modified By', 
            'dfg_last_modified_on' => 'Last Modified On', 
            'dfg_deleted_by' => 'Deleted By', 
            'dfg_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dfg_id)){
      $condition[] = "dfg_id='$this->dfg_id'";
    }if(!is_null($this->dfg_name)){
      $condition[] = "dfg_name='$this->dfg_name'";
    }if(!is_null($this->dfg_remarks)){
      $condition[] = "dfg_remarks='$this->dfg_remarks'";
    }if(!is_null($this->dfg_status)){
      $condition[] = "dfg_status='$this->dfg_status'";
    }if(!is_null($this->dfg_is_deleted)){
      $condition[] = "dfg_is_deleted='$this->dfg_is_deleted'";
    }if(!is_null($this->dfg_company_id)){
      $condition[] = "dfg_company_id='$this->dfg_company_id'";
    }if(!is_null($this->dfg_created_by)){
      $condition[] = "dfg_created_by='$this->dfg_created_by'";
    }if(!is_null($this->dfg_created_on)){
      $condition[] = "dfg_created_on='$this->dfg_created_on'";
    }if(!is_null($this->dfg_last_modified_by)){
      $condition[] = "dfg_last_modified_by='$this->dfg_last_modified_by'";
    }if(!is_null($this->dfg_last_modified_on)){
      $condition[] = "dfg_last_modified_on='$this->dfg_last_modified_on'";
    }if(!is_null($this->dfg_deleted_by)){
      $condition[] = "dfg_deleted_by='$this->dfg_deleted_by'";
    }if(!is_null($this->dfg_deleted_on)){
      $condition[] = "dfg_deleted_on='$this->dfg_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dfg_id, dfg_name, dfg_remarks, dfg_status, dfg_is_deleted, dfg_company_id, dfg_created_by, dfg_created_on, dfg_last_modified_by, dfg_last_modified_on, dfg_deleted_by, dfg_deleted_on
          from dms_file_group
          where ".$conditionStr."
          order by dfg_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dfg_id'].'" '; 
      if($this->dfg_id == $row['dfg_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dfg_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dfg_id)){
      $condition[] = "dfg_id='$this->dfg_id'";
    }if(!is_null($this->dfg_name)){
      $condition[] = "dfg_name='$this->dfg_name'";
    }if(!is_null($this->dfg_remarks)){
      $condition[] = "dfg_remarks='$this->dfg_remarks'";
    }if(!is_null($this->dfg_status)){
      $condition[] = "dfg_status='$this->dfg_status'";
    }if(!is_null($this->dfg_is_deleted)){
      $condition[] = "dfg_is_deleted='$this->dfg_is_deleted'";
    }if(!is_null($this->dfg_company_id)){
      $condition[] = "dfg_company_id='$this->dfg_company_id'";
    }if(!is_null($this->dfg_created_by)){
      $condition[] = "dfg_created_by='$this->dfg_created_by'";
    }if(!is_null($this->dfg_created_on)){
      $condition[] = "dfg_created_on='$this->dfg_created_on'";
    }if(!is_null($this->dfg_last_modified_by)){
      $condition[] = "dfg_last_modified_by='$this->dfg_last_modified_by'";
    }if(!is_null($this->dfg_last_modified_on)){
      $condition[] = "dfg_last_modified_on='$this->dfg_last_modified_on'";
    }if(!is_null($this->dfg_deleted_by)){
      $condition[] = "dfg_deleted_by='$this->dfg_deleted_by'";
    }if(!is_null($this->dfg_deleted_on)){
      $condition[] = "dfg_deleted_on='$this->dfg_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dfg_id, dfg_name, dfg_remarks, dfg_status, dfg_is_deleted, dfg_company_id, dfg_created_by, dfg_created_on, dfg_last_modified_by, dfg_last_modified_on, dfg_deleted_by, dfg_deleted_on
          from dms_file_group
          where ".$conditionStr."
          order by dfg_id asc";
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
    
    $model = new cls_dms_file_group($this->db);
  
    $model->dfg_id = $result[0]['dfg_id'];
    $model->dfg_name = $result[0]['dfg_name'];
    $model->dfg_remarks = $result[0]['dfg_remarks'];
    $model->dfg_status = $result[0]['dfg_status'];
    $model->dfg_is_deleted = $result[0]['dfg_is_deleted'];
    $model->dfg_company_id = $result[0]['dfg_company_id'];
    $model->dfg_created_by = $result[0]['dfg_created_by'];
    $model->dfg_created_on = $result[0]['dfg_created_on'];
    $model->dfg_last_modified_by = $result[0]['dfg_last_modified_by'];
    $model->dfg_last_modified_on = $result[0]['dfg_last_modified_on'];
    $model->dfg_deleted_by = $result[0]['dfg_deleted_by'];
    $model->dfg_deleted_on = $result[0]['dfg_deleted_on'];
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
      $model = new cls_dms_file_group($this->db);
  
      $model->dfg_id = $row['dfg_id'];
      $model->dfg_name = $row['dfg_name'];
      $model->dfg_remarks = $row['dfg_remarks'];
      $model->dfg_status = $row['dfg_status'];
      $model->dfg_is_deleted = $row['dfg_is_deleted'];
      $model->dfg_company_id = $row['dfg_company_id'];
      $model->dfg_created_by = $row['dfg_created_by'];
      $model->dfg_created_on = $row['dfg_created_on'];
      $model->dfg_last_modified_by = $row['dfg_last_modified_by'];
      $model->dfg_last_modified_on = $row['dfg_last_modified_on'];
      $model->dfg_deleted_by = $row['dfg_deleted_by'];
      $model->dfg_deleted_on = $row['dfg_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dfg_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dfg_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dfg_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfg_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dfg_created_on))?$this->dfg_created_on:date("Y-m-d H:i:s",$this->dfg_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfg_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dfg_last_modified_on))?$this->dfg_last_modified_on:date("Y-m-d H:i:s",$this->dfg_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfg_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dfg_deleted_on))?$this->dfg_deleted_on:date("Y-m-d H:i:s",$this->dfg_deleted_on);
  }
}
?>

