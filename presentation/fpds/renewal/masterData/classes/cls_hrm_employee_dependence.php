<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_marital_status;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_dependence_work_type;

/**
 * This is the model class for table "hrm_employee_dependence".
 * @property integer $emd_id
* @property integer $emd_employee_id
* @property string $emd_full_name
* @property string $emd_date_of_birth
* @property string $emd_nic_no
* @property string $emd_telephone
* @property integer $emd_entitled_death_donation
* @property integer $emd_entitled_medical_benifits
* @property integer $emd_provident_fund_nominee
* @property integer $emd_living
* @property integer $emd_work_type
* @property string $emd_working_address
* @property string $emd_working_telephone
* @property string $emd_permanent_address
* @property string $emd_mobile
* @property integer $emd_same_office
* @property integer $emd_marital_status_id
* @property string $emd_remarks
* @property integer $emd_status
* @property integer $emd_is_deleted
* @property integer $emd_company_id
* @property integer $emd_created_by
* @property integer $emd_created_on
* @property integer $emd_last_modified_by
* @property integer $emd_last_modified_on
* @property integer $emd_deleted_by
* @property integer $emd_deleted_on
*/
class cls_hrm_employee_dependence {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employee_dependence';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'emd_id' => 'Id', 
            'emd_employee_id' => 'Employee Id', 
            'emd_full_name' => 'Full Name', 
            'emd_date_of_birth' => 'Date Of Birth', 
            'emd_nic_no' => 'Nic No', 
            'emd_telephone' => 'Telephone', 
            'emd_entitled_death_donation' => 'Entitled Death Donation', 
            'emd_entitled_medical_benifits' => 'Entitled Medical Benifits', 
            'emd_provident_fund_nominee' => 'Provident Fund Nominee', 
            'emd_living' => 'Living', 
            'emd_work_type' => 'Work Type', 
            'emd_working_address' => 'Working Address', 
            'emd_working_telephone' => 'Working Telephone', 
            'emd_permanent_address' => 'Permanent Address', 
            'emd_mobile' => 'Mobile', 
            'emd_same_office' => 'Same Office', 
            'emd_marital_status_id' => 'Marital Status Id', 
            'emd_remarks' => 'Remarks', 
            'emd_status' => 'Status', 
            'emd_is_deleted' => 'Is Deleted', 
            'emd_company_id' => 'Company Id', 
            'emd_created_by' => 'Created By', 
            'emd_created_on' => 'Created On', 
            'emd_last_modified_by' => 'Last Modified By', 
            'emd_last_modified_on' => 'Last Modified On', 
            'emd_deleted_by' => 'Deleted By', 
            'emd_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->emd_id)){
      $condition[] = "emd_id='$this->emd_id'";
    }if(!is_null($this->emd_employee_id)){
      $condition[] = "emd_employee_id='$this->emd_employee_id'";
    }if(!is_null($this->emd_full_name)){
      $condition[] = "emd_full_name='$this->emd_full_name'";
    }if(!is_null($this->emd_date_of_birth)){
      $condition[] = "emd_date_of_birth='$this->emd_date_of_birth'";
    }if(!is_null($this->emd_nic_no)){
      $condition[] = "emd_nic_no='$this->emd_nic_no'";
    }if(!is_null($this->emd_telephone)){
      $condition[] = "emd_telephone='$this->emd_telephone'";
    }if(!is_null($this->emd_entitled_death_donation)){
      $condition[] = "emd_entitled_death_donation='$this->emd_entitled_death_donation'";
    }if(!is_null($this->emd_entitled_medical_benifits)){
      $condition[] = "emd_entitled_medical_benifits='$this->emd_entitled_medical_benifits'";
    }if(!is_null($this->emd_provident_fund_nominee)){
      $condition[] = "emd_provident_fund_nominee='$this->emd_provident_fund_nominee'";
    }if(!is_null($this->emd_living)){
      $condition[] = "emd_living='$this->emd_living'";
    }if(!is_null($this->emd_work_type)){
      $condition[] = "emd_work_type='$this->emd_work_type'";
    }if(!is_null($this->emd_working_address)){
      $condition[] = "emd_working_address='$this->emd_working_address'";
    }if(!is_null($this->emd_working_telephone)){
      $condition[] = "emd_working_telephone='$this->emd_working_telephone'";
    }if(!is_null($this->emd_permanent_address)){
      $condition[] = "emd_permanent_address='$this->emd_permanent_address'";
    }if(!is_null($this->emd_mobile)){
      $condition[] = "emd_mobile='$this->emd_mobile'";
    }if(!is_null($this->emd_same_office)){
      $condition[] = "emd_same_office='$this->emd_same_office'";
    }if(!is_null($this->emd_marital_status_id)){
      $condition[] = "emd_marital_status_id='$this->emd_marital_status_id'";
    }if(!is_null($this->emd_remarks)){
      $condition[] = "emd_remarks='$this->emd_remarks'";
    }if(!is_null($this->emd_status)){
      $condition[] = "emd_status='$this->emd_status'";
    }if(!is_null($this->emd_is_deleted)){
      $condition[] = "emd_is_deleted='$this->emd_is_deleted'";
    }if(!is_null($this->emd_company_id)){
      $condition[] = "emd_company_id='$this->emd_company_id'";
    }if(!is_null($this->emd_created_by)){
      $condition[] = "emd_created_by='$this->emd_created_by'";
    }if(!is_null($this->emd_created_on)){
      $condition[] = "emd_created_on='$this->emd_created_on'";
    }if(!is_null($this->emd_last_modified_by)){
      $condition[] = "emd_last_modified_by='$this->emd_last_modified_by'";
    }if(!is_null($this->emd_last_modified_on)){
      $condition[] = "emd_last_modified_on='$this->emd_last_modified_on'";
    }if(!is_null($this->emd_deleted_by)){
      $condition[] = "emd_deleted_by='$this->emd_deleted_by'";
    }if(!is_null($this->emd_deleted_on)){
      $condition[] = "emd_deleted_on='$this->emd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emd_id, emd_employee_id, emd_full_name, emd_date_of_birth, emd_nic_no, emd_telephone, emd_entitled_death_donation, emd_entitled_medical_benifits, emd_provident_fund_nominee, emd_living, emd_work_type, emd_working_address, emd_working_telephone, emd_permanent_address, emd_mobile, emd_same_office, emd_marital_status_id, emd_remarks, emd_status, emd_is_deleted, emd_company_id, emd_created_by, emd_created_on, emd_last_modified_by, emd_last_modified_on, emd_deleted_by, emd_deleted_on
          from hrm_employee_dependence
          where ".$conditionStr."
          order by emd_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['emd_id'].'" '; 
      if($this->emd_id == $row['emd_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emd_employee_id'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->emd_id)){
      $condition[] = "emd_id='$this->emd_id'";
    }if(!is_null($this->emd_employee_id)){
      $condition[] = "emd_employee_id='$this->emd_employee_id'";
    }if(!is_null($this->emd_full_name)){
      $condition[] = "emd_full_name='$this->emd_full_name'";
    }if(!is_null($this->emd_date_of_birth)){
      $condition[] = "emd_date_of_birth='$this->emd_date_of_birth'";
    }if(!is_null($this->emd_nic_no)){
      $condition[] = "emd_nic_no='$this->emd_nic_no'";
    }if(!is_null($this->emd_telephone)){
      $condition[] = "emd_telephone='$this->emd_telephone'";
    }if(!is_null($this->emd_entitled_death_donation)){
      $condition[] = "emd_entitled_death_donation='$this->emd_entitled_death_donation'";
    }if(!is_null($this->emd_entitled_medical_benifits)){
      $condition[] = "emd_entitled_medical_benifits='$this->emd_entitled_medical_benifits'";
    }if(!is_null($this->emd_provident_fund_nominee)){
      $condition[] = "emd_provident_fund_nominee='$this->emd_provident_fund_nominee'";
    }if(!is_null($this->emd_living)){
      $condition[] = "emd_living='$this->emd_living'";
    }if(!is_null($this->emd_work_type)){
      $condition[] = "emd_work_type='$this->emd_work_type'";
    }if(!is_null($this->emd_working_address)){
      $condition[] = "emd_working_address='$this->emd_working_address'";
    }if(!is_null($this->emd_working_telephone)){
      $condition[] = "emd_working_telephone='$this->emd_working_telephone'";
    }if(!is_null($this->emd_permanent_address)){
      $condition[] = "emd_permanent_address='$this->emd_permanent_address'";
    }if(!is_null($this->emd_mobile)){
      $condition[] = "emd_mobile='$this->emd_mobile'";
    }if(!is_null($this->emd_same_office)){
      $condition[] = "emd_same_office='$this->emd_same_office'";
    }if(!is_null($this->emd_marital_status_id)){
      $condition[] = "emd_marital_status_id='$this->emd_marital_status_id'";
    }if(!is_null($this->emd_remarks)){
      $condition[] = "emd_remarks='$this->emd_remarks'";
    }if(!is_null($this->emd_status)){
      $condition[] = "emd_status='$this->emd_status'";
    }if(!is_null($this->emd_is_deleted)){
      $condition[] = "emd_is_deleted='$this->emd_is_deleted'";
    }if(!is_null($this->emd_company_id)){
      $condition[] = "emd_company_id='$this->emd_company_id'";
    }if(!is_null($this->emd_created_by)){
      $condition[] = "emd_created_by='$this->emd_created_by'";
    }if(!is_null($this->emd_created_on)){
      $condition[] = "emd_created_on='$this->emd_created_on'";
    }if(!is_null($this->emd_last_modified_by)){
      $condition[] = "emd_last_modified_by='$this->emd_last_modified_by'";
    }if(!is_null($this->emd_last_modified_on)){
      $condition[] = "emd_last_modified_on='$this->emd_last_modified_on'";
    }if(!is_null($this->emd_deleted_by)){
      $condition[] = "emd_deleted_by='$this->emd_deleted_by'";
    }if(!is_null($this->emd_deleted_on)){
      $condition[] = "emd_deleted_on='$this->emd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emd_id, emd_employee_id, emd_full_name, if(emd_date_of_birth='0000-00-00','',emd_date_of_birth) as `emd_date_of_birth`, emd_nic_no, emd_telephone, emd_entitled_death_donation, emd_entitled_medical_benifits, emd_provident_fund_nominee, emd_living, emd_work_type, emd_working_address, emd_working_telephone, emd_permanent_address, emd_mobile, emd_same_office, emd_marital_status_id, emd_remarks, emd_status, emd_is_deleted, emd_company_id, emd_created_by, emd_created_on, emd_last_modified_by, emd_last_modified_on, emd_deleted_by, emd_deleted_on
          from hrm_employee_dependence
          where ".$conditionStr."
          order by emd_id asc";
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
    
    $model = new cls_hrm_employee_dependence($this->db);
  
    $model->emd_id = $result[0]['emd_id'];
    $model->emd_employee_id = $result[0]['emd_employee_id'];
    $model->emd_full_name = $result[0]['emd_full_name'];
    $model->emd_date_of_birth = ($result[0]['emd_date_of_birth']=='0000-00-00')?'':$result[0]['emd_date_of_birth'];
    $model->emd_nic_no = $result[0]['emd_nic_no'];
    $model->emd_telephone = $result[0]['emd_telephone'];
    $model->emd_entitled_death_donation = $result[0]['emd_entitled_death_donation'];
    $model->emd_entitled_medical_benifits = $result[0]['emd_entitled_medical_benifits'];
    $model->emd_provident_fund_nominee = $result[0]['emd_provident_fund_nominee'];
    $model->emd_living = $result[0]['emd_living'];
    $model->emd_work_type = $result[0]['emd_work_type'];
    $model->emd_working_address = $result[0]['emd_working_address'];
    $model->emd_working_telephone = $result[0]['emd_working_telephone'];
    $model->emd_permanent_address = $result[0]['emd_permanent_address'];
    $model->emd_mobile = $result[0]['emd_mobile'];
    $model->emd_same_office = $result[0]['emd_same_office'];
    $model->emd_marital_status_id = $result[0]['emd_marital_status_id'];
    $model->emd_remarks = $result[0]['emd_remarks'];
    $model->emd_status = $result[0]['emd_status'];
    $model->emd_is_deleted = $result[0]['emd_is_deleted'];
    $model->emd_company_id = $result[0]['emd_company_id'];
    $model->emd_created_by = $result[0]['emd_created_by'];
    $model->emd_created_on = $result[0]['emd_created_on'];
    $model->emd_last_modified_by = $result[0]['emd_last_modified_by'];
    $model->emd_last_modified_on = $result[0]['emd_last_modified_on'];
    $model->emd_deleted_by = $result[0]['emd_deleted_by'];
    $model->emd_deleted_on = $result[0]['emd_deleted_on'];
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
      $model = new cls_hrm_employee_dependence($this->db);
  
      $model->emd_id = $row['emd_id'];
      $model->emd_employee_id = $row['emd_employee_id'];
      $model->emd_full_name = $row['emd_full_name'];
      $model->emd_date_of_birth = ($row['emd_date_of_birth']=='0000-00-00')?'':$row['emd_date_of_birth'];
      $model->emd_nic_no = $row['emd_nic_no'];
      $model->emd_telephone = $row['emd_telephone'];
      $model->emd_entitled_death_donation = $row['emd_entitled_death_donation'];
      $model->emd_entitled_medical_benifits = $row['emd_entitled_medical_benifits'];
      $model->emd_provident_fund_nominee = $row['emd_provident_fund_nominee'];
      $model->emd_living = $row['emd_living'];
      $model->emd_work_type = $row['emd_work_type'];
      $model->emd_working_address = $row['emd_working_address'];
      $model->emd_working_telephone = $row['emd_working_telephone'];
      $model->emd_permanent_address = $row['emd_permanent_address'];
      $model->emd_mobile = $row['emd_mobile'];
      $model->emd_same_office = $row['emd_same_office'];
      $model->emd_marital_status_id = $row['emd_marital_status_id'];
      $model->emd_remarks = $row['emd_remarks'];
      $model->emd_status = $row['emd_status'];
      $model->emd_is_deleted = $row['emd_is_deleted'];
      $model->emd_company_id = $row['emd_company_id'];
      $model->emd_created_by = $row['emd_created_by'];
      $model->emd_created_on = $row['emd_created_on'];
      $model->emd_last_modified_by = $row['emd_last_modified_by'];
      $model->emd_last_modified_on = $row['emd_last_modified_on'];
      $model->emd_deleted_by = $row['emd_deleted_by'];
      $model->emd_deleted_on = $row['emd_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->emd_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Marital Status
  */
  public function getWorkType(){
    $model = new cls_hrm_dependence_work_type($this->db);
    $model->emw_id = $this->emd_work_type;
    return (is_null($model->getRecords()))?'':$model->findModel()->emw_name;
  }
  /**
  * @return Marital Status
  */
  public function getMaritalStatus(){
    $model = new cls_sys_marital_status($this->db);
    $model->sya_id = $this->emd_marital_status_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->sya_name;
  }
  /**
  * @return Same Office
  */
  public function getSameOffice(){
    return ($this->emd_same_office=='1')?'Yes':'No';
  }
  /**
  * @return Living
  */
  public function getLiving(){
    return ($this->emd_living=='1')?'Living':'Not Not Living';
  }
  /**
  * @return Death Donation
  */
  public function getEntitledDeathDonation(){
    return ($this->emd_entitled_death_donation=='1')?'Entitled':'Not Entitled';
  }
  /**
  * @return Medical Benefits
  */
  public function getEntitledMedicalBenefits(){
    return ($this->emd_entitled_medical_benifits=='1')?'Entitled':'Not Entitled';
  }
  /**
  * @return Provident Fund Nominee
  */
  public function getProvidentFundNominee(){
    return ($this->emd_provident_fund_nominee=='1')?'Nominated':'Not Named';
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->emd_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->emd_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->emd_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emd_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->emd_created_on))?$this->emd_created_on:date("Y-m-d H:i:s",$this->emd_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emd_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->emd_last_modified_on))?$this->emd_last_modified_on:date("Y-m-d H:i:s",$this->emd_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->emd_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->emd_deleted_on))?$this->emd_deleted_on:date("Y-m-d H:i:s",$this->emd_deleted_on);
  }
}
?>

