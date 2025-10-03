<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
namespace presentation\hrm\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_transport_mode;
use presentation\hrm\masterData\classes\cls_hrm_transport_vehicle_type;
use presentation\hrm\masterData\classes\cls_hrm_dwelling_mode;  

/**
 * This is the model class for table "hrm_trn_transport_details".
 * @property integer $etd_id
* @property integer $etd_employee_id
* @property integer $etd_transport_mode_id
* @property integer $etd_transport_vehicle_type_id
* @property string $etd_route
* @property string $etd_travelling_time
* @property string $etd_distance
* @property integer $etd_dwelling_mode_id
* @property string $etd_duration
* @property string $etd_remarks
* @property integer $etd_status
* @property integer $etd_is_deleted
* @property integer $etd_location_id
* @property integer $etd_company_id
* @property integer $etd_created_by
* @property integer $etd_created_on
* @property integer $etd_last_modified_by
* @property integer $etd_last_modified_on
* @property integer $etd_deleted_by
* @property integer $etd_deleted_on
*/
class cls_hrm_trn_transport_details {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_transport_details';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'etd_id' => 'Id', 
            'etd_employee_id' => 'Employee', 
            'etd_transport_mode_id' => 'Mode of Transport', 
            'etd_transport_vehicle_type_id' => 'Provided Item', 
            'etd_route' => 'Route', 
            'etd_travelling_time' => 'Travel Time to Work', 
            'etd_distance' => 'Distance', 
            'etd_dwelling_mode_id' => 'Dwelling Mode', 
            'etd_duration' => 'Duration', 
            'etd_remarks' => 'Remarks', 
            'etd_status' => 'Status', 
            'etd_is_deleted' => 'Is Deleted', 
            'etd_location_id' => 'Location', 
            'etd_company_id' => 'Company', 
            'etd_created_by' => 'Created By', 
            'etd_created_on' => 'Created On', 
            'etd_last_modified_by' => 'Last Modified By', 
            'etd_last_modified_on' => 'Last Modified On', 
            'etd_deleted_by' => 'Deleted By', 
            'etd_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->etd_id)){
      $condition[] = "etd_id='$this->etd_id'";
    }if(!is_null($this->etd_employee_id)){
      $condition[] = "etd_employee_id='$this->etd_employee_id'";
    }if(!is_null($this->etd_transport_mode_id)){
      $condition[] = "etd_transport_mode_id='$this->etd_transport_mode_id'";
    }if(!is_null($this->etd_transport_vehicle_type_id)){
      $condition[] = "etd_transport_vehicle_type_id='$this->etd_transport_vehicle_type_id'";
    }if(!is_null($this->etd_route)){
      $condition[] = "etd_route='$this->etd_route'";
    }if(!is_null($this->etd_travelling_time)){
      $condition[] = "etd_travelling_time='$this->etd_travelling_time'";
    }if(!is_null($this->etd_distance)){
      $condition[] = "etd_distance='$this->etd_distance'";
    }if(!is_null($this->etd_dwelling_mode_id)){
      $condition[] = "etd_dwelling_mode_id='$this->etd_dwelling_mode_id'";
    }if(!is_null($this->etd_duration)){
      $condition[] = "etd_duration='$this->etd_duration'";
    }if(!is_null($this->etd_remarks)){
      $condition[] = "etd_remarks='$this->etd_remarks'";
    }if(!is_null($this->etd_status)){
      $condition[] = "etd_status='$this->etd_status'";
    }if(!is_null($this->etd_is_deleted)){
      $condition[] = "etd_is_deleted='$this->etd_is_deleted'";
    }if(!is_null($this->etd_location_id)){
      $condition[] = "etd_location_id='$this->etd_location_id'";
    }if(!is_null($this->etd_company_id)){
      $condition[] = "etd_company_id='$this->etd_company_id'";
    }if(!is_null($this->etd_created_by)){
      $condition[] = "etd_created_by='$this->etd_created_by'";
    }if(!is_null($this->etd_created_on)){
      $condition[] = "etd_created_on='$this->etd_created_on'";
    }if(!is_null($this->etd_last_modified_by)){
      $condition[] = "etd_last_modified_by='$this->etd_last_modified_by'";
    }if(!is_null($this->etd_last_modified_on)){
      $condition[] = "etd_last_modified_on='$this->etd_last_modified_on'";
    }if(!is_null($this->etd_deleted_by)){
      $condition[] = "etd_deleted_by='$this->etd_deleted_by'";
    }if(!is_null($this->etd_deleted_on)){
      $condition[] = "etd_deleted_on='$this->etd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select etd_id, etd_employee_id, etd_transport_mode_id, etd_transport_vehicle_type_id, etd_route, etd_travelling_time, etd_distance, etd_dwelling_mode_id, etd_duration, etd_remarks, etd_status, etd_is_deleted, etd_location_id, etd_company_id, etd_created_by, etd_created_on, etd_last_modified_by, etd_last_modified_on, etd_deleted_by, etd_deleted_on, tmd_name, emi_calling_name, emi_no 
          from hrm_trn_transport_details
              inner join hrm_employee_information on emi_id=etd_employee_id
              inner join hrm_transport_mode on tmd_id=etd_transport_mode_id
          where ".$conditionStr."
          order by etd_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['etd_id'].'" '; 
      if($this->etd_id == $row['etd_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['tmd_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->etd_id)){
      $condition[] = "etd_id='$this->etd_id'";
    }if(!is_null($this->etd_employee_id)){
      $condition[] = "etd_employee_id='$this->etd_employee_id'";
    }if(!is_null($this->etd_transport_mode_id)){
      $condition[] = "etd_transport_mode_id='$this->etd_transport_mode_id'";
    }if(!is_null($this->etd_transport_vehicle_type_id)){
      $condition[] = "etd_transport_vehicle_type_id='$this->etd_transport_vehicle_type_id'";
    }if(!is_null($this->etd_route)){
      $condition[] = "etd_route='$this->etd_route'";
    }if(!is_null($this->etd_travelling_time)){
      $condition[] = "etd_travelling_time='$this->etd_travelling_time'";
    }if(!is_null($this->etd_distance)){
      $condition[] = "etd_distance='$this->etd_distance'";
    }if(!is_null($this->etd_dwelling_mode_id)){
      $condition[] = "etd_dwelling_mode_id='$this->etd_dwelling_mode_id'";
    }if(!is_null($this->etd_duration)){
      $condition[] = "etd_duration='$this->etd_duration'";
    }if(!is_null($this->etd_remarks)){
      $condition[] = "etd_remarks='$this->etd_remarks'";
    }if(!is_null($this->etd_status)){
      $condition[] = "etd_status='$this->etd_status'";
    }if(!is_null($this->etd_is_deleted)){
      $condition[] = "etd_is_deleted='$this->etd_is_deleted'";
    }if(!is_null($this->etd_location_id)){
      $condition[] = "etd_location_id='$this->etd_location_id'";
    }if(!is_null($this->etd_company_id)){
      $condition[] = "etd_company_id='$this->etd_company_id'";
    }if(!is_null($this->etd_created_by)){
      $condition[] = "etd_created_by='$this->etd_created_by'";
    }if(!is_null($this->etd_created_on)){
      $condition[] = "etd_created_on='$this->etd_created_on'";
    }if(!is_null($this->etd_last_modified_by)){
      $condition[] = "etd_last_modified_by='$this->etd_last_modified_by'";
    }if(!is_null($this->etd_last_modified_on)){
      $condition[] = "etd_last_modified_on='$this->etd_last_modified_on'";
    }if(!is_null($this->etd_deleted_by)){
      $condition[] = "etd_deleted_by='$this->etd_deleted_by'";
    }if(!is_null($this->etd_deleted_on)){
      $condition[] = "etd_deleted_on='$this->etd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select etd_id, etd_employee_id, etd_transport_mode_id, etd_transport_vehicle_type_id, etd_route, etd_travelling_time, etd_distance, etd_dwelling_mode_id, etd_duration, etd_remarks, etd_status, etd_is_deleted, etd_location_id, etd_company_id, etd_created_by, etd_created_on, etd_last_modified_by, etd_last_modified_on, etd_deleted_by, etd_deleted_on
          from hrm_trn_transport_details
          where ".$conditionStr."
          order by etd_id asc";
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
    
    $model = new cls_hrm_trn_transport_details($this->db);
  
    $model->etd_id = $result[0]['etd_id'];
    $model->etd_employee_id = $result[0]['etd_employee_id'];
    $model->etd_transport_mode_id = $result[0]['etd_transport_mode_id'];
    $model->etd_transport_vehicle_type_id = $result[0]['etd_transport_vehicle_type_id'];
    $model->etd_route = $result[0]['etd_route'];
    $model->etd_travelling_time = $result[0]['etd_travelling_time'];
    $model->etd_distance = $result[0]['etd_distance'];
    $model->etd_dwelling_mode_id = $result[0]['etd_dwelling_mode_id'];
    $model->etd_duration = $result[0]['etd_duration'];
    $model->etd_remarks = $result[0]['etd_remarks'];
    $model->etd_status = $result[0]['etd_status'];
    $model->etd_is_deleted = $result[0]['etd_is_deleted'];
    $model->etd_location_id = $result[0]['etd_location_id'];
    $model->etd_company_id = $result[0]['etd_company_id'];
    $model->etd_created_by = $result[0]['etd_created_by'];
    $model->etd_created_on = $result[0]['etd_created_on'];
    $model->etd_last_modified_by = $result[0]['etd_last_modified_by'];
    $model->etd_last_modified_on = $result[0]['etd_last_modified_on'];
    $model->etd_deleted_by = $result[0]['etd_deleted_by'];
    $model->etd_deleted_on = $result[0]['etd_deleted_on'];
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
      $model = new cls_hrm_trn_transport_details($this->db);
  
      $model->etd_id = $row['etd_id'];
      $model->etd_employee_id = $row['etd_employee_id'];
      $model->etd_transport_mode_id = $row['etd_transport_mode_id'];
      $model->etd_transport_vehicle_type_id = $row['etd_transport_vehicle_type_id'];
      $model->etd_route = $row['etd_route'];
      $model->etd_travelling_time = $row['etd_travelling_time'];
      $model->etd_distance = $row['etd_distance'];
      $model->etd_dwelling_mode_id = $row['etd_dwelling_mode_id'];
      $model->etd_duration = $row['etd_duration'];
      $model->etd_remarks = $row['etd_remarks'];
      $model->etd_status = $row['etd_status'];
      $model->etd_is_deleted = $row['etd_is_deleted'];
      $model->etd_location_id = $row['etd_location_id'];
      $model->etd_company_id = $row['etd_company_id'];
      $model->etd_created_by = $row['etd_created_by'];
      $model->etd_created_on = $row['etd_created_on'];
      $model->etd_last_modified_by = $row['etd_last_modified_by'];
      $model->etd_last_modified_on = $row['etd_last_modified_on'];
      $model->etd_deleted_by = $row['etd_deleted_by'];
      $model->etd_deleted_on = $row['etd_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->etd_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Transport Mode
  */
  public function getTransportMode(){
    $model = new cls_hrm_transport_mode($this->db);
    $model->tmd_id = $this->etd_transport_mode_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->tmd_name;
  } 
  /**
  * @return Location
  */
  public function getVehicleType(){
    $model = new cls_hrm_transport_vehicle_type($this->db);
    $model->tvt_id = $this->etd_transport_vehicle_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->tvt_name;
  } 
  /**
  * @return Location
  */
  public function getDwellingMode(){
    $model = new cls_hrm_dwelling_mode($this->db);
    $model->dwm_id = $this->etd_dwelling_mode_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->dwm_name;
  } 
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->etd_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->etd_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->etd_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->etd_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->etd_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->etd_created_on))?$this->etd_created_on:date("Y-m-d H:i:s",$this->etd_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->etd_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->etd_last_modified_on))?$this->etd_last_modified_on:date("Y-m-d H:i:s",$this->etd_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->etd_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->etd_deleted_on))?$this->etd_deleted_on:date("Y-m-d H:i:s",$this->etd_deleted_on);
  }
}
?>

