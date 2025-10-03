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
 * This is the model class for table "hrm_transport_vehicle_type".
 * @property integer $tvt_id
* @property string $tvt_name
* @property string $tvt_remarks
* @property integer $tvt_status
* @property integer $tvt_is_deleted
* @property integer $tvt_company_id
* @property integer $tvt_created_by
* @property integer $tvt_created_on
* @property integer $tvt_last_modified_by
* @property integer $tvt_last_modified_on
* @property integer $tvt_deleted_by
* @property integer $tvt_deleted_on
*/
class cls_hrm_transport_vehicle_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_transport_vehicle_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'tvt_id' => 'Id', 
            'tvt_name' => 'Name', 
            'tvt_remarks' => 'Remarks', 
            'tvt_status' => 'Status', 
            'tvt_is_deleted' => 'Is Deleted', 
            'tvt_company_id' => 'Company Id', 
            'tvt_created_by' => 'Created By', 
            'tvt_created_on' => 'Created On', 
            'tvt_last_modified_by' => 'Last Modified By', 
            'tvt_last_modified_on' => 'Last Modified On', 
            'tvt_deleted_by' => 'Deleted By', 
            'tvt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->tvt_id)){
      $condition[] = "tvt_id='$this->tvt_id'";
    }if(!is_null($this->tvt_name)){
      $condition[] = "tvt_name='$this->tvt_name'";
    }if(!is_null($this->tvt_remarks)){
      $condition[] = "tvt_remarks='$this->tvt_remarks'";
    }if(!is_null($this->tvt_status)){
      $condition[] = "tvt_status='$this->tvt_status'";
    }if(!is_null($this->tvt_is_deleted)){
      $condition[] = "tvt_is_deleted='$this->tvt_is_deleted'";
    }if(!is_null($this->tvt_company_id)){
      $condition[] = "tvt_company_id='$this->tvt_company_id'";
    }if(!is_null($this->tvt_created_by)){
      $condition[] = "tvt_created_by='$this->tvt_created_by'";
    }if(!is_null($this->tvt_created_on)){
      $condition[] = "tvt_created_on='$this->tvt_created_on'";
    }if(!is_null($this->tvt_last_modified_by)){
      $condition[] = "tvt_last_modified_by='$this->tvt_last_modified_by'";
    }if(!is_null($this->tvt_last_modified_on)){
      $condition[] = "tvt_last_modified_on='$this->tvt_last_modified_on'";
    }if(!is_null($this->tvt_deleted_by)){
      $condition[] = "tvt_deleted_by='$this->tvt_deleted_by'";
    }if(!is_null($this->tvt_deleted_on)){
      $condition[] = "tvt_deleted_on='$this->tvt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select tvt_id, tvt_name, tvt_remarks, tvt_status, tvt_is_deleted, tvt_company_id, tvt_created_by, tvt_created_on, tvt_last_modified_by, tvt_last_modified_on, tvt_deleted_by, tvt_deleted_on
          from hrm_transport_vehicle_type
          where ".$conditionStr."
          order by tvt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['tvt_id'].'" '; 
      if($this->tvt_id == $row['tvt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['tvt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->tvt_id)){
      $condition[] = "tvt_id='$this->tvt_id'";
    }if(!is_null($this->tvt_name)){
      $condition[] = "tvt_name='$this->tvt_name'";
    }if(!is_null($this->tvt_remarks)){
      $condition[] = "tvt_remarks='$this->tvt_remarks'";
    }if(!is_null($this->tvt_status)){
      $condition[] = "tvt_status='$this->tvt_status'";
    }if(!is_null($this->tvt_is_deleted)){
      $condition[] = "tvt_is_deleted='$this->tvt_is_deleted'";
    }if(!is_null($this->tvt_company_id)){
      $condition[] = "tvt_company_id='$this->tvt_company_id'";
    }if(!is_null($this->tvt_created_by)){
      $condition[] = "tvt_created_by='$this->tvt_created_by'";
    }if(!is_null($this->tvt_created_on)){
      $condition[] = "tvt_created_on='$this->tvt_created_on'";
    }if(!is_null($this->tvt_last_modified_by)){
      $condition[] = "tvt_last_modified_by='$this->tvt_last_modified_by'";
    }if(!is_null($this->tvt_last_modified_on)){
      $condition[] = "tvt_last_modified_on='$this->tvt_last_modified_on'";
    }if(!is_null($this->tvt_deleted_by)){
      $condition[] = "tvt_deleted_by='$this->tvt_deleted_by'";
    }if(!is_null($this->tvt_deleted_on)){
      $condition[] = "tvt_deleted_on='$this->tvt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select tvt_id, tvt_name, tvt_remarks, tvt_status, tvt_is_deleted, tvt_company_id, tvt_created_by, tvt_created_on, tvt_last_modified_by, tvt_last_modified_on, tvt_deleted_by, tvt_deleted_on
          from hrm_transport_vehicle_type
          where ".$conditionStr."
          order by tvt_id asc";
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
    
    $model = new cls_hrm_transport_vehicle_type($this->db);
  
    $model->tvt_id = $result[0]['tvt_id'];
    $model->tvt_name = $result[0]['tvt_name'];
    $model->tvt_remarks = $result[0]['tvt_remarks'];
    $model->tvt_status = $result[0]['tvt_status'];
    $model->tvt_is_deleted = $result[0]['tvt_is_deleted'];
    $model->tvt_company_id = $result[0]['tvt_company_id'];
    $model->tvt_created_by = $result[0]['tvt_created_by'];
    $model->tvt_created_on = $result[0]['tvt_created_on'];
    $model->tvt_last_modified_by = $result[0]['tvt_last_modified_by'];
    $model->tvt_last_modified_on = $result[0]['tvt_last_modified_on'];
    $model->tvt_deleted_by = $result[0]['tvt_deleted_by'];
    $model->tvt_deleted_on = $result[0]['tvt_deleted_on'];
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
      $model = new cls_hrm_transport_vehicle_type($this->db);
  
      $model->tvt_id = $row['tvt_id'];
      $model->tvt_name = $row['tvt_name'];
      $model->tvt_remarks = $row['tvt_remarks'];
      $model->tvt_status = $row['tvt_status'];
      $model->tvt_is_deleted = $row['tvt_is_deleted'];
      $model->tvt_company_id = $row['tvt_company_id'];
      $model->tvt_created_by = $row['tvt_created_by'];
      $model->tvt_created_on = $row['tvt_created_on'];
      $model->tvt_last_modified_by = $row['tvt_last_modified_by'];
      $model->tvt_last_modified_on = $row['tvt_last_modified_on'];
      $model->tvt_deleted_by = $row['tvt_deleted_by'];
      $model->tvt_deleted_on = $row['tvt_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->tvt_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->tvt_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->tvt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tvt_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->tvt_created_on))?$this->tvt_created_on:date("Y-m-d H:i:s",$this->tvt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tvt_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->tvt_last_modified_on))?$this->tvt_last_modified_on:date("Y-m-d H:i:s",$this->tvt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tvt_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->tvt_deleted_on))?$this->tvt_deleted_on:date("Y-m-d H:i:s",$this->tvt_deleted_on);
  }
}
?>

