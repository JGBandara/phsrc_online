<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-21
 */
namespace presentation\dms\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;

/**
 * This is the model class for table "dms_file_permission".
 * @property integer $dfp_id
* @property integer $dfp_file_category_id
* @property integer $dfp_user_id
* @property string $dfp_remarks
* @property integer $dfp_status
* @property integer $dfp_is_deleted
* @property integer $dfp_location_id
* @property integer $dfp_company_id
* @property integer $dfp_created_by
* @property integer $dfp_created_on
* @property integer $dfp_last_modified_by
* @property integer $dfp_last_modified_on
* @property integer $dfp_deleted_by
* @property integer $dfp_deleted_on
*/
class cls_dms_file_permission {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'dms_file_permission';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dfp_id' => 'Id', 
            'dfp_file_category_id' => 'File Category', 
            'dfp_user_id' => 'User', 
            'dfp_remarks' => 'Remarks', 
            'dfp_status' => 'Status', 
            'dfp_is_deleted' => 'Is Deleted', 
            'dfp_location_id' => 'Location', 
            'dfp_company_id' => 'Company', 
            'dfp_created_by' => 'Created By', 
            'dfp_created_on' => 'Created On', 
            'dfp_last_modified_by' => 'Last Modified By', 
            'dfp_last_modified_on' => 'Last Modified On', 
            'dfp_deleted_by' => 'Deleted By', 
            'dfp_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dfp_id)){
      $condition[] = "dfp_id='$this->dfp_id'";
    }if(!is_null($this->dfp_file_category_id)){
      $condition[] = "dfp_file_category_id='$this->dfp_file_category_id'";
    }if(!is_null($this->dfp_user_id)){
      $condition[] = "dfp_user_id='$this->dfp_user_id'";
    }if(!is_null($this->dfp_remarks)){
      $condition[] = "dfp_remarks='$this->dfp_remarks'";
    }if(!is_null($this->dfp_status)){
      $condition[] = "dfp_status='$this->dfp_status'";
    }if(!is_null($this->dfp_is_deleted)){
      $condition[] = "dfp_is_deleted='$this->dfp_is_deleted'";
    }if(!is_null($this->dfp_location_id)){
      $condition[] = "dfp_location_id='$this->dfp_location_id'";
    }if(!is_null($this->dfp_company_id)){
      $condition[] = "dfp_company_id='$this->dfp_company_id'";
    }if(!is_null($this->dfp_created_by)){
      $condition[] = "dfp_created_by='$this->dfp_created_by'";
    }if(!is_null($this->dfp_created_on)){
      $condition[] = "dfp_created_on='$this->dfp_created_on'";
    }if(!is_null($this->dfp_last_modified_by)){
      $condition[] = "dfp_last_modified_by='$this->dfp_last_modified_by'";
    }if(!is_null($this->dfp_last_modified_on)){
      $condition[] = "dfp_last_modified_on='$this->dfp_last_modified_on'";
    }if(!is_null($this->dfp_deleted_by)){
      $condition[] = "dfp_deleted_by='$this->dfp_deleted_by'";
    }if(!is_null($this->dfp_deleted_on)){
      $condition[] = "dfp_deleted_on='$this->dfp_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dfp_id, dfp_file_category_id, dfp_user_id, dfp_remarks, dfp_status, dfp_is_deleted, dfp_location_id, dfp_company_id, dfp_created_by, dfp_created_on, dfp_last_modified_by, dfp_last_modified_on, dfp_deleted_by, dfp_deleted_on
          from dms_file_permission
          where ".$conditionStr."
          order by dfp_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dfp_id'].'" '; 
      if($this->dfp_id == $row['dfp_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dfp_file_category_id'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dfp_id)){
      $condition[] = "dfp_id='$this->dfp_id'";
    }if(!is_null($this->dfp_file_category_id)){
      $condition[] = "dfp_file_category_id='$this->dfp_file_category_id'";
    }if(!is_null($this->dfp_user_id)){
      $condition[] = "dfp_user_id='$this->dfp_user_id'";
    }if(!is_null($this->dfp_remarks)){
      $condition[] = "dfp_remarks='$this->dfp_remarks'";
    }if(!is_null($this->dfp_status)){
      $condition[] = "dfp_status='$this->dfp_status'";
    }if(!is_null($this->dfp_is_deleted)){
      $condition[] = "dfp_is_deleted='$this->dfp_is_deleted'";
    }if(!is_null($this->dfp_location_id)){
      $condition[] = "dfp_location_id='$this->dfp_location_id'";
    }if(!is_null($this->dfp_company_id)){
      $condition[] = "dfp_company_id='$this->dfp_company_id'";
    }if(!is_null($this->dfp_created_by)){
      $condition[] = "dfp_created_by='$this->dfp_created_by'";
    }if(!is_null($this->dfp_created_on)){
      $condition[] = "dfp_created_on='$this->dfp_created_on'";
    }if(!is_null($this->dfp_last_modified_by)){
      $condition[] = "dfp_last_modified_by='$this->dfp_last_modified_by'";
    }if(!is_null($this->dfp_last_modified_on)){
      $condition[] = "dfp_last_modified_on='$this->dfp_last_modified_on'";
    }if(!is_null($this->dfp_deleted_by)){
      $condition[] = "dfp_deleted_by='$this->dfp_deleted_by'";
    }if(!is_null($this->dfp_deleted_on)){
      $condition[] = "dfp_deleted_on='$this->dfp_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dfp_id, dfp_file_category_id, dfp_user_id, dfp_remarks, dfp_status, dfp_is_deleted, dfp_location_id, dfp_company_id, dfp_created_by, dfp_created_on, dfp_last_modified_by, dfp_last_modified_on, dfp_deleted_by, dfp_deleted_on
          from dms_file_permission
          where ".$conditionStr."
          order by dfp_id asc";
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
    
    $model = new cls_dms_file_permission($this->db);
  
    $model->dfp_id = $result[0]['dfp_id'];
    $model->dfp_file_category_id = $result[0]['dfp_file_category_id'];
    $model->dfp_user_id = $result[0]['dfp_user_id'];
    $model->dfp_remarks = $result[0]['dfp_remarks'];
    $model->dfp_status = $result[0]['dfp_status'];
    $model->dfp_is_deleted = $result[0]['dfp_is_deleted'];
    $model->dfp_location_id = $result[0]['dfp_location_id'];
    $model->dfp_company_id = $result[0]['dfp_company_id'];
    $model->dfp_created_by = $result[0]['dfp_created_by'];
    $model->dfp_created_on = $result[0]['dfp_created_on'];
    $model->dfp_last_modified_by = $result[0]['dfp_last_modified_by'];
    $model->dfp_last_modified_on = $result[0]['dfp_last_modified_on'];
    $model->dfp_deleted_by = $result[0]['dfp_deleted_by'];
    $model->dfp_deleted_on = $result[0]['dfp_deleted_on'];
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
      $model = new cls_dms_file_permission($this->db);
  
      $model->dfp_id = $row['dfp_id'];
      $model->dfp_file_category_id = $row['dfp_file_category_id'];
      $model->dfp_user_id = $row['dfp_user_id'];
      $model->dfp_remarks = $row['dfp_remarks'];
      $model->dfp_status = $row['dfp_status'];
      $model->dfp_is_deleted = $row['dfp_is_deleted'];
      $model->dfp_location_id = $row['dfp_location_id'];
      $model->dfp_company_id = $row['dfp_company_id'];
      $model->dfp_created_by = $row['dfp_created_by'];
      $model->dfp_created_on = $row['dfp_created_on'];
      $model->dfp_last_modified_by = $row['dfp_last_modified_by'];
      $model->dfp_last_modified_on = $row['dfp_last_modified_on'];
      $model->dfp_deleted_by = $row['dfp_deleted_by'];
      $model->dfp_deleted_on = $row['dfp_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->dfp_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dfp_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dfp_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dfp_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfp_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dfp_created_on))?$this->dfp_created_on:date("Y-m-d H:i:s",$this->dfp_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfp_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dfp_last_modified_on))?$this->dfp_last_modified_on:date("Y-m-d H:i:s",$this->dfp_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfp_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dfp_deleted_on))?$this->dfp_deleted_on:date("Y-m-d H:i:s",$this->dfp_deleted_on);
  }
}
?>

