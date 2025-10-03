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
use presentation\hrm\masterData\classes\cls_hrm_designation;
use presentation\hrm\masterData\classes\cls_hrm_division;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/** 
 * This is the model class for table "sys_users".
 * @property integer $syu_id
* @property string $syu_user_name
* @property string $syu_password
* @property string $syu_full_name
* @property integer $syu_division_id
* @property string $syu_contact_no
* @property integer $syu_designation_id
* @property string $syu_gender
* @property string $syu_email
* @property string $syu_reset_password_time
* @property integer $syu_employee_id
* @property string $syu_remarks
* @property integer $syu_status
* @property integer $syu_company_id
* @property integer $syu_created_by
* @property integer $syu_created_on
* @property integer $syu_last_modified_by
* @property integer $syu_last_modified_on
* @property integer $syu_deleted_by
* @property integer $syu_deleted_on
*/
class cls_sys_users {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_users';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syu_id' => 'Id', 
            'syu_user_name' => 'User Name', 
            'syu_password' => 'Password', 
            'syu_full_name' => 'Full Name', 
            'syu_division_id' => 'Division Id', 
            'syu_contact_no' => 'Contact No', 
            'syu_designation_id' => 'Designation Id', 
            'syu_gender' => 'Gender', 
            'syu_email' => 'Email', 
            'syu_reset_password_time' => 'Reset Password Time', 
            'syu_employee_id' => 'Employee Id', 
            'syu_remarks' => 'Remarks', 
            'syu_status' => 'Status', 
            'syu_company_id' => 'Company Id', 
            'syu_created_by' => 'Created By', 
            'syu_created_on' => 'Created On', 
            'syu_last_modified_by' => 'Last Modified By', 
            'syu_last_modified_on' => 'Last Modified On', 
            'syu_deleted_by' => 'Deleted By', 
            'syu_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syu_id)){
      $condition[] = "syu_id='$this->syu_id'";
    }if(!is_null($this->syu_user_name)){
      $condition[] = "syu_user_name='$this->syu_user_name'";
    }if(!is_null($this->syu_password)){
      $condition[] = "syu_password='$this->syu_password'";
    }if(!is_null($this->syu_full_name)){
      $condition[] = "syu_full_name='$this->syu_full_name'";
    }if(!is_null($this->syu_division_id)){
      $condition[] = "syu_division_id='$this->syu_division_id'";
    }if(!is_null($this->syu_contact_no)){
      $condition[] = "syu_contact_no='$this->syu_contact_no'";
    }if(!is_null($this->syu_designation_id)){
      $condition[] = "syu_designation_id='$this->syu_designation_id'";
    }if(!is_null($this->syu_gender)){
      $condition[] = "syu_gender='$this->syu_gender'";
    }if(!is_null($this->syu_email)){
      $condition[] = "syu_email='$this->syu_email'";
    }if(!is_null($this->syu_reset_password_time)){
      $condition[] = "syu_reset_password_time='$this->syu_reset_password_time'";
    }if(!is_null($this->syu_employee_id)){
      $condition[] = "syu_employee_id='$this->syu_employee_id'";
    }if(!is_null($this->syu_remarks)){
      $condition[] = "syu_remarks='$this->syu_remarks'";
    }if(!is_null($this->syu_status)){
      $condition[] = "syu_status='$this->syu_status'";
    }if(!is_null($this->syu_company_id)){
      $condition[] = "syu_company_id='$this->syu_company_id'";
    }if(!is_null($this->syu_created_by)){
      $condition[] = "syu_created_by='$this->syu_created_by'";
    }if(!is_null($this->syu_created_on)){
      $condition[] = "syu_created_on='$this->syu_created_on'";
    }if(!is_null($this->syu_last_modified_by)){
      $condition[] = "syu_last_modified_by='$this->syu_last_modified_by'";
    }if(!is_null($this->syu_last_modified_on)){
      $condition[] = "syu_last_modified_on='$this->syu_last_modified_on'";
    }if(!is_null($this->syu_deleted_by)){
      $condition[] = "syu_deleted_by='$this->syu_deleted_by'";
    }if(!is_null($this->syu_deleted_on)){
      $condition[] = "syu_deleted_on='$this->syu_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syu_id, syu_user_name, syu_password, syu_full_name, syu_division_id, syu_contact_no, syu_designation_id, syu_gender, syu_email, syu_reset_password_time, syu_employee_id, syu_remarks, syu_status, syu_company_id, syu_created_by, syu_created_on, syu_last_modified_by, syu_last_modified_on, syu_deleted_by, syu_deleted_on
          from sys_users
          where ".$conditionStr."
          order by syu_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syu_id'].'" '; 
      if($this->syu_id == $row['syu_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syu_user_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syu_id)){
      $condition[] = "syu_id='$this->syu_id'";
    }if(!is_null($this->syu_user_name)){
      $condition[] = "syu_user_name='$this->syu_user_name'";
    }if(!is_null($this->syu_password)){
      $condition[] = "syu_password='$this->syu_password'";
    }if(!is_null($this->syu_full_name)){
      $condition[] = "syu_full_name='$this->syu_full_name'";
    }if(!is_null($this->syu_division_id)){
      $condition[] = "syu_division_id='$this->syu_division_id'";
    }if(!is_null($this->syu_contact_no)){
      $condition[] = "syu_contact_no='$this->syu_contact_no'";
    }if(!is_null($this->syu_designation_id)){
      $condition[] = "syu_designation_id='$this->syu_designation_id'";
    }if(!is_null($this->syu_gender)){
      $condition[] = "syu_gender='$this->syu_gender'";
    }if(!is_null($this->syu_email)){
      $condition[] = "syu_email='$this->syu_email'";
    }if(!is_null($this->syu_reset_password_time)){
      $condition[] = "syu_reset_password_time='$this->syu_reset_password_time'";
    }if(!is_null($this->syu_employee_id)){
      $condition[] = "syu_employee_id='$this->syu_employee_id'";
    }if(!is_null($this->syu_remarks)){
      $condition[] = "syu_remarks='$this->syu_remarks'";
    }if(!is_null($this->syu_status)){
      $condition[] = "syu_status='$this->syu_status'";
    }if(!is_null($this->syu_company_id)){
      $condition[] = "syu_company_id='$this->syu_company_id'";
    }if(!is_null($this->syu_created_by)){
      $condition[] = "syu_created_by='$this->syu_created_by'";
    }if(!is_null($this->syu_created_on)){
      $condition[] = "syu_created_on='$this->syu_created_on'";
    }if(!is_null($this->syu_last_modified_by)){
      $condition[] = "syu_last_modified_by='$this->syu_last_modified_by'";
    }if(!is_null($this->syu_last_modified_on)){
      $condition[] = "syu_last_modified_on='$this->syu_last_modified_on'";
    }if(!is_null($this->syu_deleted_by)){
      $condition[] = "syu_deleted_by='$this->syu_deleted_by'";
    }if(!is_null($this->syu_deleted_on)){
      $condition[] = "syu_deleted_on='$this->syu_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syu_id, syu_user_name, syu_password, syu_full_name, syu_division_id, syu_contact_no, syu_designation_id, syu_gender, syu_email, syu_reset_password_time, syu_employee_id, syu_remarks, syu_status, syu_company_id, syu_created_by, syu_created_on, syu_last_modified_by, syu_last_modified_on, syu_deleted_by, syu_deleted_on
          from sys_users
          where ".$conditionStr."
          order by syu_id asc";
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
    
    $model = new cls_sys_users($this->db);
  
    $model->syu_id = $result[0]['syu_id'];
    $model->syu_user_name = $result[0]['syu_user_name'];
    $model->syu_password = $result[0]['syu_password'];
    $model->syu_full_name = $result[0]['syu_full_name'];
    $model->syu_division_id = $result[0]['syu_division_id'];
    $model->syu_contact_no = $result[0]['syu_contact_no'];
    $model->syu_designation_id = $result[0]['syu_designation_id'];
    $model->syu_gender = $result[0]['syu_gender'];
    $model->syu_email = $result[0]['syu_email'];
    $model->syu_reset_password_time = $result[0]['syu_reset_password_time'];
    $model->syu_employee_id = $result[0]['syu_employee_id'];
    $model->syu_remarks = $result[0]['syu_remarks'];
    $model->syu_status = $result[0]['syu_status'];
    $model->syu_company_id = $result[0]['syu_company_id'];
    $model->syu_created_by = $result[0]['syu_created_by'];
    $model->syu_created_on = $result[0]['syu_created_on'];
    $model->syu_last_modified_by = $result[0]['syu_last_modified_by'];
    $model->syu_last_modified_on = $result[0]['syu_last_modified_on'];
    $model->syu_deleted_by = $result[0]['syu_deleted_by'];
    $model->syu_deleted_on = $result[0]['syu_deleted_on'];
    return $model;
  }
  /**
  * @return Division
  */
  public function getDesignation(){
    $model = new cls_hrm_designation($this->db);
    $model->dsg_id = $this->syu_designation_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->dsg_name;
  }
  /**
  * @return Division
  */
  public function getDivision(){
    $model = new cls_hrm_division($this->db);
    $model->div_id = $this->syu_division_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->div_name;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->syu_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syu_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syu_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syu_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syu_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syu_created_on))?$this->syu_created_on:date("Y-m-d H:i:s",$this->syu_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syu_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syu_last_modified_on))?$this->syu_last_modified_on:date("Y-m-d H:i:s",$this->syu_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syu_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syu_deleted_on))?$this->syu_deleted_on:date("Y-m-d H:i:s",$this->syu_deleted_on);
  }
}
?>

