<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "hrm_employee_information".
 * @property integer $emi_id
* @property string $emi_no
* @property string $emi_calling_name
* @property string $emi_epf_no
* @property string $emi_finger_print_no
* @property string $emi_joined_date
* @property string $emi_permanent_date
* @property string $emi_confirm_date
* @property string $emi_resigned_date
* @property string $emi_retirement_date
* @property string $emi_image_name
* @property string $emi_remarks
* @property integer $emi_status
* @property integer $emi_is_deleted
* @property integer $emi_company_id
* @property integer $emi_created_by
* @property integer $emi_created_on
* @property integer $emi_last_modified_by
* @property integer $emi_last_modified_on
* @property integer $emi_deleted_by
* @property integer $emi_deleted_on
*/
class cls_hrm_employee_information {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employee_information';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'emi_id' => 'Id', 
            'emi_no' => 'No', 
            'emi_calling_name' => 'Calling Name', 
            'emi_epf_no' => 'Epf No', 
            'emi_finger_print_no' => 'Finger Print No', 
            'emi_joined_date' => 'Joined Date', 
            'emi_permanent_date' => 'Permanent Date', 
            'emi_confirm_date' => 'Confirm Date', 
            'emi_confirm_status' => 'Confirm Status', 
            'emi_medical_status' => 'Medical Status', 
            'emi_resigned_date' => 'Resigned Date', 
            'emi_retirement_date' => 'Retirement Date', 
            'emi_image_name' => 'Image Name', 
            'emi_remarks' => 'Remarks', 
            'emi_status' => 'Status', 
            'emi_is_deleted' => 'Is Deleted', 
            'emi_company_id' => 'Company Id', 
            'emi_created_by' => 'Created By', 
            'emi_created_on' => 'Created On', 
            'emi_last_modified_by' => 'Last Modified By', 
            'emi_last_modified_on' => 'Last Modified On', 
            'emi_deleted_by' => 'Deleted By', 
            'emi_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->emi_id)){
      $condition[] = "emi_id='$this->emi_id'";
    }if(!is_null($this->emi_no)){
      $condition[] = "emi_no='$this->emi_no'";
    }if(!is_null($this->emi_calling_name)){
      $condition[] = "emi_calling_name='$this->emi_calling_name'";
    }if(!is_null($this->emi_epf_no)){
      $condition[] = "emi_epf_no='$this->emi_epf_no'";
    }if(!is_null($this->emi_finger_print_no)){
      $condition[] = "emi_finger_print_no='$this->emi_finger_print_no'";
    }if(!is_null($this->emi_joined_date)){
      $condition[] = "emi_joined_date='$this->emi_joined_date'";
    }if(!is_null($this->emi_permanent_date)){
      $condition[] = "emi_permanent_date='$this->emi_permanent_date'";
    }if(!is_null($this->emi_confirm_date)){
      $condition[] = "emi_confirm_date='$this->emi_confirm_date'";
    }if(!is_null($this->emi_confirm_status)){
      $condition[] = "emi_confirm_status='$this->emi_confirm_status'";
    }if(!is_null($this->emi_medical_status)){
      $condition[] = "emi_medical_status='$this->emi_medical_status'";
    }if(!is_null($this->emi_resigned_date)){
      $condition[] = "emi_resigned_date='$this->emi_resigned_date'";
    }if(!is_null($this->emi_retirement_date)){
      $condition[] = "emi_retirement_date='$this->emi_retirement_date'";
    }if(!is_null($this->emi_image_name)){
      $condition[] = "emi_image_name='$this->emi_image_name'";
    }if(!is_null($this->emi_remarks)){
      $condition[] = "emi_remarks='$this->emi_remarks'";
    }if(!is_null($this->emi_status)){
      $condition[] = "emi_status='$this->emi_status'";
    }if(!is_null($this->emi_is_deleted)){
      $condition[] = "emi_is_deleted='$this->emi_is_deleted'";
    }if(!is_null($this->emi_company_id)){
      $condition[] = "emi_company_id='$this->emi_company_id'";
    }if(!is_null($this->emi_created_by)){
      $condition[] = "emi_created_by='$this->emi_created_by'";
    }if(!is_null($this->emi_created_on)){
      $condition[] = "emi_created_on='$this->emi_created_on'";
    }if(!is_null($this->emi_last_modified_by)){
      $condition[] = "emi_last_modified_by='$this->emi_last_modified_by'";
    }if(!is_null($this->emi_last_modified_on)){
      $condition[] = "emi_last_modified_on='$this->emi_last_modified_on'";
    }if(!is_null($this->emi_deleted_by)){
      $condition[] = "emi_deleted_by='$this->emi_deleted_by'";
    }if(!is_null($this->emi_deleted_on)){
      $condition[] = "emi_deleted_on='$this->emi_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emi_id, emi_no, emi_calling_name, emi_epf_no, emi_finger_print_no, emi_joined_date, emi_permanent_date, emi_confirm_date, emi_confirm_status, emi_medical_status, emi_resigned_date, emi_retirement_date, emi_image_name, emi_remarks, emi_status, emi_is_deleted, emi_company_id, emi_created_by, emi_created_on, emi_last_modified_by, emi_last_modified_on, emi_deleted_by, emi_deleted_on
          from hrm_employee_information
          where ".$conditionStr."
          order by emi_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['emi_id'].'" '; 
      if($this->emi_id == $row['emi_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->emi_id)){
      $condition[] = "emi_id='$this->emi_id'";
    }if(!is_null($this->emi_no)){
      $condition[] = "emi_no='$this->emi_no'";
    }if(!is_null($this->emi_calling_name)){
      $condition[] = "emi_calling_name='$this->emi_calling_name'";
    }if(!is_null($this->emi_epf_no)){
      $condition[] = "emi_epf_no='$this->emi_epf_no'";
    }if(!is_null($this->emi_finger_print_no)){
      $condition[] = "emi_finger_print_no='$this->emi_finger_print_no'";
    }if(!is_null($this->emi_joined_date)){
      $condition[] = "emi_joined_date='$this->emi_joined_date'";
    }if(!is_null($this->emi_permanent_date)){
      $condition[] = "emi_permanent_date='$this->emi_permanent_date'";
    }if(!is_null($this->emi_confirm_date)){
      $condition[] = "emi_confirm_date='$this->emi_confirm_date'";
    }if(!is_null($this->emi_confirm_status)){
      $condition[] = "emi_confirm_status='$this->emi_confirm_status'";
    }if(!is_null($this->emi_medical_status)){
      $condition[] = "emi_medical_status='$this->emi_medical_status'";
    }if(!is_null($this->emi_resigned_date)){
      $condition[] = "emi_resigned_date='$this->emi_resigned_date'";
    }if(!is_null($this->emi_retirement_date)){
      $condition[] = "emi_retirement_date='$this->emi_retirement_date'";
    }if(!is_null($this->emi_image_name)){
      $condition[] = "emi_image_name='$this->emi_image_name'";
    }if(!is_null($this->emi_remarks)){
      $condition[] = "emi_remarks='$this->emi_remarks'";
    }if(!is_null($this->emi_status)){
      $condition[] = "emi_status='$this->emi_status'";
    }if(!is_null($this->emi_is_deleted)){
      $condition[] = "emi_is_deleted='$this->emi_is_deleted'";
    }if(!is_null($this->emi_company_id)){
      $condition[] = "emi_company_id='$this->emi_company_id'";
    }if(!is_null($this->emi_created_by)){
      $condition[] = "emi_created_by='$this->emi_created_by'";
    }if(!is_null($this->emi_created_on)){
      $condition[] = "emi_created_on='$this->emi_created_on'";
    }if(!is_null($this->emi_last_modified_by)){
      $condition[] = "emi_last_modified_by='$this->emi_last_modified_by'";
    }if(!is_null($this->emi_last_modified_on)){
      $condition[] = "emi_last_modified_on='$this->emi_last_modified_on'";
    }if(!is_null($this->emi_deleted_by)){
      $condition[] = "emi_deleted_by='$this->emi_deleted_by'";
    }if(!is_null($this->emi_deleted_on)){
      $condition[] = "emi_deleted_on='$this->emi_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emi_id, emi_no, emi_calling_name, emi_epf_no, emi_finger_print_no, if(emi_joined_date='0000-00-00','',emi_joined_date) as `emi_joined_date`, if(emi_permanent_date='0000-00-00','',emi_permanent_date) as `emi_permanent_date`, if(emi_confirm_date='0000-00-00','',emi_confirm_date) as `emi_confirm_date`, emi_confirm_status, emi_medical_status, if(emi_resigned_date='0000-00-00','',emi_resigned_date) as `emi_resigned_date`, if(emi_retirement_date='0000-00-00','',emi_retirement_date) as `emi_retirement_date`, emi_image_name, emi_remarks, emi_status, emi_is_deleted, emi_company_id, emi_created_by, emi_created_on, emi_last_modified_by, emi_last_modified_on, emi_deleted_by, emi_deleted_on
          from hrm_employee_information
          where ".$conditionStr."
          order by emi_id asc";
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
    
    $model = new cls_hrm_employee_information($this->db);
  
    $model->emi_id = $result[0]['emi_id'];
    $model->emi_no = $result[0]['emi_no'];
    $model->emi_calling_name = $result[0]['emi_calling_name'];
    $model->emi_epf_no = $result[0]['emi_epf_no'];
    $model->emi_finger_print_no = $result[0]['emi_finger_print_no'];
    $model->emi_joined_date = $result[0]['emi_joined_date'];
    $model->emi_permanent_date = $result[0]['emi_permanent_date'];
    $model->emi_confirm_date = $result[0]['emi_confirm_date'];
    $model->emi_confirm_status = $result[0]['emi_confirm_status'];
    $model->emi_medical_status = $result[0]['emi_medical_status'];
    $model->emi_resigned_date = $result[0]['emi_resigned_date'];
    $model->emi_retirement_date = $result[0]['emi_retirement_date'];
    $model->emi_image_name = $result[0]['emi_image_name'];
    $model->emi_remarks = $result[0]['emi_remarks'];
    $model->emi_status = $result[0]['emi_status'];
    $model->emi_is_deleted = $result[0]['emi_is_deleted'];
    $model->emi_company_id = $result[0]['emi_company_id'];
    $model->emi_created_by = $result[0]['emi_created_by'];
    $model->emi_created_on = $result[0]['emi_created_on'];
    $model->emi_last_modified_by = $result[0]['emi_last_modified_by'];
    $model->emi_last_modified_on = $result[0]['emi_last_modified_on'];
    $model->emi_deleted_by = $result[0]['emi_deleted_by'];
    $model->emi_deleted_on = $result[0]['emi_deleted_on'];
    return $model;
  }
  /**
  * @return Delete Status
  */
  public function getConfirmStatus(){
    return ($this->emi_confirm_status=='1')?'Yes':'No';
  }
  /**
  * @return Delete Status
  */
  public function getMedicalStatus(){
    return ($this->emi_medical_status=='1')?'Yes':'No';
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->emi_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->emi_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->emi_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emi_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->emi_created_on))?$this->emi_created_on:date("Y-m-d H:i:s",$this->emi_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emi_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->emi_last_modified_on))?$this->emi_last_modified_on:date("Y-m-d H:i:s",$this->emi_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emi_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->emi_deleted_on))?$this->emi_deleted_on:date("Y-m-d H:i:s",$this->emi_deleted_on);
  }
}
?>

