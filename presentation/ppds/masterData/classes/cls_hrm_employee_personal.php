<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_marital_status;
use presentation\system\masterData\classes\cls_sys_passport_type;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/**
 * This is the model class for table "hrm_employee_personal".
 * @property integer $emp_id
* @property string $emp_initials
* @property string $emp_middle_name
* @property string $emp_surname
* @property string $emp_name_denoted_by_initials
* @property string $emp_full_name
* @property string $emp_other_name
* @property string $emp_nic_no
* @property string $emp_nic_issue_date
* @property string $emp_nationality
* @property string $emp_race
* @property string $emp_religion
* @property integer $emp_gender
* @property string $emp_date_of_birth
* @property string $emp_blood_group
* @property integer $emp_maritial_status_id
* @property string $emp_married_date
* @property string $emp_passport_no
* @property integer $emp_passport_type
* @property string $emp_passport_issue_date
* @property string $emp_passport_issue_place
* @property string $emp_passport_expiry_date
* @property string $emp_passport_countries
* @property string $emp_driving_license_no
* @property string $emp_driving_license_issue_date
* @property string $emp_driving_license_expiry_date
* @property string $emp_driving_license_vehicle_class
* @property string $emp_remarks
* @property integer $emp_status
* @property integer $emp_is_deleted
* @property integer $emp_company_id
* @property integer $emp_created_by
* @property integer $emp_created_on
* @property integer $emp_last_modified_by
* @property integer $emp_last_modified_on
* @property integer $emp_deleted_by
* @property integer $emp_deleted_on
*/
class cls_hrm_employee_personal {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employee_personal';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'emp_id' => 'Id', 
            'emp_initials' => 'Initials', 
            'emp_middle_name' => 'Middle Name', 
            'emp_surname' => 'Surname', 
            'emp_name_denoted_by_initials' => 'Name Denoted By Initials', 
            'emp_full_name' => 'Full Name', 
            'emp_other_name' => 'Other Name', 
            'emp_nic_no' => 'Nic No', 
            'emp_nic_issue_date' => 'Nic Issue Date', 
            'emp_nationality' => 'Nationality', 
            'emp_race' => 'Race', 
            'emp_religion' => 'Religion', 
            'emp_gender' => 'Gender', 
            'emp_date_of_birth' => 'Date Of Birth', 
            'emp_blood_group' => 'Blood Group', 
            'emp_maritial_status_id' => 'Marital Status Id', 
            'emp_married_date' => 'Married Date', 
            'emp_passport_no' => 'Passport No', 
            'emp_passport_type' => 'Passport Type', 
            'emp_passport_issue_date' => 'Passport Issue Date', 
            'emp_passport_issue_place' => 'Passport Issue Place', 
            'emp_passport_expiry_date' => 'Passport Expiry Date', 
            'emp_passport_countries' => 'Passport Countries', 
            'emp_driving_license_no' => 'Driving License No', 
            'emp_driving_license_issue_date' => 'Driving License Issue Date', 
            'emp_driving_license_expiry_date' => 'Driving License Expiry Date', 
            'emp_driving_license_vehicle_class' => 'Driving License Vehicle Class', 
            'emp_remarks' => 'Remarks', 
            'emp_status' => 'Status', 
            'emp_is_deleted' => 'Is Deleted', 
            'emp_company_id' => 'Company Id', 
            'emp_created_by' => 'Created By', 
            'emp_created_on' => 'Created On', 
            'emp_last_modified_by' => 'Last Modified By', 
            'emp_last_modified_on' => 'Last Modified On', 
            'emp_deleted_by' => 'Deleted By', 
            'emp_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->emp_id)){
      $condition[] = "emp_id='$this->emp_id'";
    }if(!is_null($this->emp_initials)){
      $condition[] = "emp_initials='$this->emp_initials'";
    }if(!is_null($this->emp_middle_name)){
      $condition[] = "emp_middle_name='$this->emp_middle_name'";
    }if(!is_null($this->emp_surname)){
      $condition[] = "emp_surname='$this->emp_surname'";
    }if(!is_null($this->emp_name_denoted_by_initials)){
      $condition[] = "emp_name_denoted_by_initials='$this->emp_name_denoted_by_initials'";
    }if(!is_null($this->emp_full_name)){
      $condition[] = "emp_full_name='$this->emp_full_name'";
    }if(!is_null($this->emp_other_name)){
      $condition[] = "emp_other_name='$this->emp_other_name'";
    }if(!is_null($this->emp_nic_no)){
      $condition[] = "emp_nic_no='$this->emp_nic_no'";
    }if(!is_null($this->emp_nic_issue_date)){
      $condition[] = "emp_nic_issue_date='$this->emp_nic_issue_date'";
    }if(!is_null($this->emp_nationality)){
      $condition[] = "emp_nationality='$this->emp_nationality'";
    }if(!is_null($this->emp_race)){
      $condition[] = "emp_race='$this->emp_race'";
    }if(!is_null($this->emp_religion)){
      $condition[] = "emp_religion='$this->emp_religion'";
    }if(!is_null($this->emp_gender)){
      $condition[] = "emp_gender='$this->emp_gender'";
    }if(!is_null($this->emp_date_of_birth)){
      $condition[] = "emp_date_of_birth='$this->emp_date_of_birth'";
    }if(!is_null($this->emp_blood_group)){
      $condition[] = "emp_blood_group='$this->emp_blood_group'";
    }if(!is_null($this->emp_maritial_status_id)){
      $condition[] = "emp_maritial_status_id='$this->emp_maritial_status_id'";
    }if(!is_null($this->emp_married_date)){
      $condition[] = "emp_married_date='$this->emp_married_date'";
    }if(!is_null($this->emp_passport_no)){
      $condition[] = "emp_passport_no='$this->emp_passport_no'";
    }if(!is_null($this->emp_passport_type)){
      $condition[] = "emp_passport_type='$this->emp_passport_type'";
    }if(!is_null($this->emp_passport_issue_date)){
      $condition[] = "emp_passport_issue_date='$this->emp_passport_issue_date'";
    }if(!is_null($this->emp_passport_issue_place)){
      $condition[] = "emp_passport_issue_place='$this->emp_passport_issue_place'";
    }if(!is_null($this->emp_passport_expiry_date)){
      $condition[] = "emp_passport_expiry_date='$this->emp_passport_expiry_date'";
    }if(!is_null($this->emp_passport_countries)){
      $condition[] = "emp_passport_countries='$this->emp_passport_countries'";
    }if(!is_null($this->emp_driving_license_no)){
      $condition[] = "emp_driving_license_no='$this->emp_driving_license_no'";
    }if(!is_null($this->emp_driving_license_issue_date)){
      $condition[] = "emp_driving_license_issue_date='$this->emp_driving_license_issue_date'";
    }if(!is_null($this->emp_driving_license_expiry_date)){
      $condition[] = "emp_driving_license_expiry_date='$this->emp_driving_license_expiry_date'";
    }if(!is_null($this->emp_driving_license_vehicle_class)){
      $condition[] = "emp_driving_license_vehicle_class='$this->emp_driving_license_vehicle_class'";
    }if(!is_null($this->emp_remarks)){
      $condition[] = "emp_remarks='$this->emp_remarks'";
    }if(!is_null($this->emp_status)){
      $condition[] = "emp_status='$this->emp_status'";
    }if(!is_null($this->emp_is_deleted)){
      $condition[] = "emp_is_deleted='$this->emp_is_deleted'";
    }if(!is_null($this->emp_company_id)){
      $condition[] = "emp_company_id='$this->emp_company_id'";
    }if(!is_null($this->emp_created_by)){
      $condition[] = "emp_created_by='$this->emp_created_by'";
    }if(!is_null($this->emp_created_on)){
      $condition[] = "emp_created_on='$this->emp_created_on'";
    }if(!is_null($this->emp_last_modified_by)){
      $condition[] = "emp_last_modified_by='$this->emp_last_modified_by'";
    }if(!is_null($this->emp_last_modified_on)){
      $condition[] = "emp_last_modified_on='$this->emp_last_modified_on'";
    }if(!is_null($this->emp_deleted_by)){
      $condition[] = "emp_deleted_by='$this->emp_deleted_by'";
    }if(!is_null($this->emp_deleted_on)){
      $condition[] = "emp_deleted_on='$this->emp_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emp_id, emp_initials, emp_middle_name, emp_surname, emp_name_denoted_by_initials, emp_full_name, emp_other_name, emp_nic_no, emp_nic_issue_date, emp_nationality, emp_race, emp_religion, emp_gender, emp_date_of_birth, emp_blood_group, emp_maritial_status_id, emp_married_date, emp_passport_no, emp_passport_type, emp_passport_issue_date, emp_passport_issue_place, emp_passport_expiry_date, emp_passport_countries, emp_driving_license_no, emp_driving_license_issue_date, emp_driving_license_expiry_date, emp_driving_license_vehicle_class, emp_remarks, emp_status, emp_is_deleted, emp_company_id, emp_created_by, emp_created_on, emp_last_modified_by, emp_last_modified_on, emp_deleted_by, emp_deleted_on
          from hrm_employee_personal
          where ".$conditionStr."
          order by emp_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['emp_id'].'" '; 
      if($this->emp_id == $row['emp_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emp_initials'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->emp_id)){
      $condition[] = "emp_id='$this->emp_id'";
    }if(!is_null($this->emp_initials)){
      $condition[] = "emp_initials='$this->emp_initials'";
    }if(!is_null($this->emp_middle_name)){
      $condition[] = "emp_middle_name='$this->emp_middle_name'";
    }if(!is_null($this->emp_surname)){
      $condition[] = "emp_surname='$this->emp_surname'";
    }if(!is_null($this->emp_name_denoted_by_initials)){
      $condition[] = "emp_name_denoted_by_initials='$this->emp_name_denoted_by_initials'";
    }if(!is_null($this->emp_full_name)){
      $condition[] = "emp_full_name='$this->emp_full_name'";
    }if(!is_null($this->emp_other_name)){
      $condition[] = "emp_other_name='$this->emp_other_name'";
    }if(!is_null($this->emp_nic_no)){
      $condition[] = "emp_nic_no='$this->emp_nic_no'";
    }if(!is_null($this->emp_nic_issue_date)){
      $condition[] = "emp_nic_issue_date='$this->emp_nic_issue_date'";
    }if(!is_null($this->emp_nationality)){
      $condition[] = "emp_nationality='$this->emp_nationality'";
    }if(!is_null($this->emp_race)){
      $condition[] = "emp_race='$this->emp_race'";
    }if(!is_null($this->emp_religion)){
      $condition[] = "emp_religion='$this->emp_religion'";
    }if(!is_null($this->emp_gender)){
      $condition[] = "emp_gender='$this->emp_gender'";
    }if(!is_null($this->emp_date_of_birth)){
      $condition[] = "emp_date_of_birth='$this->emp_date_of_birth'";
    }if(!is_null($this->emp_blood_group)){
      $condition[] = "emp_blood_group='$this->emp_blood_group'";
    }if(!is_null($this->emp_maritial_status_id)){
      $condition[] = "emp_maritial_status_id='$this->emp_maritial_status_id'";
    }if(!is_null($this->emp_married_date)){
      $condition[] = "emp_married_date='$this->emp_married_date'";
    }if(!is_null($this->emp_passport_no)){
      $condition[] = "emp_passport_no='$this->emp_passport_no'";
    }if(!is_null($this->emp_passport_type)){
      $condition[] = "emp_passport_type='$this->emp_passport_type'";
    }if(!is_null($this->emp_passport_issue_date)){
      $condition[] = "emp_passport_issue_date='$this->emp_passport_issue_date'";
    }if(!is_null($this->emp_passport_issue_place)){
      $condition[] = "emp_passport_issue_place='$this->emp_passport_issue_place'";
    }if(!is_null($this->emp_passport_expiry_date)){
      $condition[] = "emp_passport_expiry_date='$this->emp_passport_expiry_date'";
    }if(!is_null($this->emp_passport_countries)){
      $condition[] = "emp_passport_countries='$this->emp_passport_countries'";
    }if(!is_null($this->emp_driving_license_no)){
      $condition[] = "emp_driving_license_no='$this->emp_driving_license_no'";
    }if(!is_null($this->emp_driving_license_issue_date)){
      $condition[] = "emp_driving_license_issue_date='$this->emp_driving_license_issue_date'";
    }if(!is_null($this->emp_driving_license_expiry_date)){
      $condition[] = "emp_driving_license_expiry_date='$this->emp_driving_license_expiry_date'";
    }if(!is_null($this->emp_driving_license_vehicle_class)){
      $condition[] = "emp_driving_license_vehicle_class='$this->emp_driving_license_vehicle_class'";
    }if(!is_null($this->emp_remarks)){
      $condition[] = "emp_remarks='$this->emp_remarks'";
    }if(!is_null($this->emp_status)){
      $condition[] = "emp_status='$this->emp_status'";
    }if(!is_null($this->emp_is_deleted)){
      $condition[] = "emp_is_deleted='$this->emp_is_deleted'";
    }if(!is_null($this->emp_company_id)){
      $condition[] = "emp_company_id='$this->emp_company_id'";
    }if(!is_null($this->emp_created_by)){
      $condition[] = "emp_created_by='$this->emp_created_by'";
    }if(!is_null($this->emp_created_on)){
      $condition[] = "emp_created_on='$this->emp_created_on'";
    }if(!is_null($this->emp_last_modified_by)){
      $condition[] = "emp_last_modified_by='$this->emp_last_modified_by'";
    }if(!is_null($this->emp_last_modified_on)){
      $condition[] = "emp_last_modified_on='$this->emp_last_modified_on'";
    }if(!is_null($this->emp_deleted_by)){
      $condition[] = "emp_deleted_by='$this->emp_deleted_by'";
    }if(!is_null($this->emp_deleted_on)){
      $condition[] = "emp_deleted_on='$this->emp_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emp_id, emp_initials, emp_middle_name, emp_surname, emp_name_denoted_by_initials, emp_full_name, emp_other_name, emp_nic_no, if(emp_nic_issue_date='0000-00-00','',emp_nic_issue_date) as `emp_nic_issue_date`, emp_nationality, emp_race, emp_religion, emp_gender, if(emp_date_of_birth='0000-00-00','',emp_date_of_birth) as `emp_date_of_birth`, emp_blood_group, emp_maritial_status_id, if(emp_married_date='0000-00-00','',emp_married_date) as `emp_married_date`, emp_passport_no, emp_passport_type, if(emp_passport_issue_date='0000-00-00','',emp_passport_issue_date) as `emp_passport_issue_date`, emp_passport_issue_place, if(emp_passport_expiry_date='0000-00-00','',emp_passport_expiry_date) as `emp_passport_expiry_date`, emp_passport_countries, emp_driving_license_no, if(emp_driving_license_issue_date='0000-00-00','',emp_driving_license_issue_date) as `emp_driving_license_issue_date`, if(emp_driving_license_expiry_date='0000-00-00','',emp_driving_license_expiry_date) as `emp_driving_license_expiry_date`, emp_driving_license_vehicle_class, emp_remarks, emp_status, emp_is_deleted, emp_company_id, emp_created_by, emp_created_on, emp_last_modified_by, emp_last_modified_on, emp_deleted_by, emp_deleted_on
          from hrm_employee_personal
          where ".$conditionStr."
          order by emp_id asc";
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
    
    $model = new cls_hrm_employee_personal($this->db);
  
        $model->emp_id = $result[0]['emp_id'];
        $model->emp_initials = $result[0]['emp_initials'];
        $model->emp_middle_name = $result[0]['emp_middle_name'];
        $model->emp_surname = $result[0]['emp_surname'];
        $model->emp_name_denoted_by_initials = $result[0]['emp_name_denoted_by_initials'];
        $model->emp_full_name = $result[0]['emp_full_name'];
        $model->emp_other_name = $result[0]['emp_other_name'];
        $model->emp_nic_no = $result[0]['emp_nic_no'];
        $model->emp_nic_issue_date = ($result[0]['emp_nic_issue_date']=='0000-00-00')?'':$result[0]['emp_nic_issue_date'];
        $model->emp_nationality = $result[0]['emp_nationality'];
        $model->emp_race = $result[0]['emp_race'];
        $model->emp_religion = $result[0]['emp_religion'];
        $model->emp_gender = $result[0]['emp_gender'];
        $model->emp_date_of_birth = ($result[0]['emp_date_of_birth']=='0000-00-00')?'':$result[0]['emp_date_of_birth'];
        $model->emp_blood_group = $result[0]['emp_blood_group'];
        $model->emp_maritial_status_id = $result[0]['emp_maritial_status_id'];
        $model->emp_married_date = ($result[0]['emp_married_date']=='0000-00-00')?'':$result[0]['emp_married_date'];
        $model->emp_passport_no = $result[0]['emp_passport_no'];
        $model->emp_passport_type = $result[0]['emp_passport_type'];
        $model->emp_passport_issue_date = ($result[0]['emp_passport_issue_date']=='0000-00-00')?'':$result[0]['emp_passport_issue_date'];
        $model->emp_passport_issue_place = $result[0]['emp_passport_issue_place'];
        $model->emp_passport_expiry_date = ($result[0]['emp_passport_expiry_date']=='0000-00-00')?'':$result[0]['emp_passport_expiry_date'];
        $model->emp_passport_countries = $result[0]['emp_passport_countries'];
        $model->emp_driving_license_no = $result[0]['emp_driving_license_no'];
        $model->emp_driving_license_issue_date = ($result[0]['emp_driving_license_issue_date']=='0000-00-00')?'':$result[0]['emp_driving_license_issue_date'];
        $model->emp_driving_license_expiry_date = ($result[0]['emp_driving_license_expiry_date']=='0000-00-00')?'':$result[0]['emp_driving_license_expiry_date'];
        $model->emp_driving_license_vehicle_class = $result[0]['emp_driving_license_vehicle_class'];
        $model->emp_remarks = $result[0]['emp_remarks'];
        $model->emp_status = $result[0]['emp_status'];
        $model->emp_is_deleted = $result[0]['emp_is_deleted'];
        $model->emp_company_id = $result[0]['emp_company_id'];
        $model->emp_created_by = $result[0]['emp_created_by'];
        $model->emp_created_on = $result[0]['emp_created_on'];
        $model->emp_last_modified_by = $result[0]['emp_last_modified_by'];
        $model->emp_last_modified_on = $result[0]['emp_last_modified_on'];
        $model->emp_deleted_by = $result[0]['emp_deleted_by'];
        $model->emp_deleted_on = $result[0]['emp_deleted_on'];
    return $model;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->emp_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Marital Status
  */
  public function getMaritalStatus(){
    $model = new cls_sys_marital_status($this->db);
    $model->sya_id = $this->emp_maritial_status_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->sya_name;
  }
  /**
  * @return Passport Type
  */
  public function getPassportType(){
    $model = new cls_sys_passport_type($this->db);
    $model->syc_id = $this->emp_passport_type;
    return (is_null($model->getRecords()))?'':$model->findModel()->syb_name;
  }
  /**
  * @return Gender
  */
  public function getGender(){
    return ($this->emp_gender=='1')?'Male':'Female';
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->emp_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->emp_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->emp_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emp_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->emp_created_on))?$this->emp_created_on:date("Y-m-d H:i:s",$this->emp_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emp_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->emp_last_modified_on))?$this->emp_last_modified_on:date("Y-m-d H:i:s",$this->emp_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emp_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->emp_deleted_on))?$this->emp_deleted_on:date("Y-m-d H:i:s",$this->emp_deleted_on);
  }
}
?>

