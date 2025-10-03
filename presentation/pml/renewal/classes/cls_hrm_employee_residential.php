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
use presentation\system\masterData\classes\cls_sys_country;
use presentation\system\masterData\classes\cls_sys_province;
use presentation\system\masterData\classes\cls_sys_district;
use presentation\system\masterData\classes\cls_sys_ds_division;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/**
 * This is the model class for table "hrm_employee_residential".
 * @property integer $emr_id
* @property string $emr_permanent_address
* @property string $emr_permanent_street
* @property string $emr_permanent_city
* @property string $emr_permanent_postal_code
* @property string $emr_permanent_telephone
* @property string $emr_permanent_mobile_no
* @property string $emr_permanent_email
* @property integer $emr_permanent_country_id
* @property integer $emr_permanent_province_id
* @property integer $emr_permanent_district_id
* @property integer $emr_permanent_ds_division_id
* @property string $emr_permanent_electorate
* @property string $emr_current_address
* @property string $emr_current_street
* @property string $emr_current_city
* @property string $emr_current_postal_code
* @property string $emr_current_telephone_general_line
* @property string $emr_current_telephone_direct_line
* @property string $emr_current_mobile_no
* @property string $emr_current_fax
* @property string $emr_current_email
* @property integer $emr_current_country_id
* @property integer $emr_current_province_id
* @property integer $emr_current_district_id
* @property integer $emr_current_ds_division_id
* @property string $emr_current_electorate
* @property string $emr_remarks
* @property integer $emr_status
* @property integer $emr_company_id
* @property integer $emr_created_by
* @property integer $emr_created_on
* @property integer $emr_last_modified_by
* @property integer $emr_last_modified_on
* @property integer $emr_deleted_by
* @property integer $emr_deleted_on
*/
class cls_hrm_employee_residential {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employee_residential';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'emr_id' => 'Id', 
            'emr_permanent_address' => 'Permanent Address', 
            'emr_permanent_street' => 'Permanent Street', 
            'emr_permanent_city' => 'Permanent City', 
            'emr_permanent_postal_code' => 'Permanent Postal Code', 
            'emr_permanent_telephone' => 'Permanent Telephone', 
            'emr_permanent_mobile_no' => 'Permanent Mobile No', 
            'emr_permanent_email' => 'Permanent Email', 
            'emr_permanent_country_id' => 'Permanent Country Id', 
            'emr_permanent_province_id' => 'Permanent Province Id', 
            'emr_permanent_district_id' => 'Permanent District Id', 
            'emr_permanent_ds_division_id' => 'Permanent Ds Division Id', 
            'emr_permanent_electorate' => 'Permanent Electorate', 
            'emr_current_address' => 'Current Address', 
            'emr_current_street' => 'Current Street', 
            'emr_current_city' => 'Current City', 
            'emr_current_postal_code' => 'Current Postal Code', 
            'emr_current_telephone_general_line' => 'Current Telephone General Line', 
            'emr_current_telephone_direct_line' => 'Current Telephone Direct Line', 
            'emr_current_mobile_no' => 'Current Mobile No', 
            'emr_current_fax' => 'Current Fax', 
            'emr_current_email' => 'Current Email', 
            'emr_current_country_id' => 'Current Country Id', 
            'emr_current_province_id' => 'Current Province Id', 
            'emr_current_district_id' => 'Current District Id', 
            'emr_current_ds_division_id' => 'Current Ds Division Id', 
            'emr_current_electorate' => 'Current Electorate', 
            'emr_remarks' => 'Remarks', 
            'emr_status' => 'Status', 
            'emr_is_deleted' => 'Is Deleted', 
            'emr_company_id' => 'Company Id', 
            'emr_created_by' => 'Created By', 
            'emr_created_on' => 'Created On', 
            'emr_last_modified_by' => 'Last Modified By', 
            'emr_last_modified_on' => 'Last Modified On', 
            'emr_deleted_by' => 'Deleted By', 
            'emr_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->emr_id)){
      $condition[] = "emr_id='$this->emr_id'";
    }if(!is_null($this->emr_permanent_address)){
      $condition[] = "emr_permanent_address='$this->emr_permanent_address'";
    }if(!is_null($this->emr_permanent_street)){
      $condition[] = "emr_permanent_street='$this->emr_permanent_street'";
    }if(!is_null($this->emr_permanent_city)){
      $condition[] = "emr_permanent_city='$this->emr_permanent_city'";
    }if(!is_null($this->emr_permanent_postal_code)){
      $condition[] = "emr_permanent_postal_code='$this->emr_permanent_postal_code'";
    }if(!is_null($this->emr_permanent_telephone)){
      $condition[] = "emr_permanent_telephone='$this->emr_permanent_telephone'";
    }if(!is_null($this->emr_permanent_mobile_no)){
      $condition[] = "emr_permanent_mobile_no='$this->emr_permanent_mobile_no'";
    }if(!is_null($this->emr_permanent_email)){
      $condition[] = "emr_permanent_email='$this->emr_permanent_email'";
    }if(!is_null($this->emr_permanent_country_id)){
      $condition[] = "emr_permanent_country_id='$this->emr_permanent_country_id'";
    }if(!is_null($this->emr_permanent_province_id)){
      $condition[] = "emr_permanent_province_id='$this->emr_permanent_province_id'";
    }if(!is_null($this->emr_permanent_district_id)){
      $condition[] = "emr_permanent_district_id='$this->emr_permanent_district_id'";
    }if(!is_null($this->emr_permanent_ds_division_id)){
      $condition[] = "emr_permanent_ds_division_id='$this->emr_permanent_ds_division_id'";
    }if(!is_null($this->emr_permanent_electorate)){
      $condition[] = "emr_permanent_electorate='$this->emr_permanent_electorate'";
    }if(!is_null($this->emr_current_address)){
      $condition[] = "emr_current_address='$this->emr_current_address'";
    }if(!is_null($this->emr_current_street)){
      $condition[] = "emr_current_street='$this->emr_current_street'";
    }if(!is_null($this->emr_current_city)){
      $condition[] = "emr_current_city='$this->emr_current_city'";
    }if(!is_null($this->emr_current_postal_code)){
      $condition[] = "emr_current_postal_code='$this->emr_current_postal_code'";
    }if(!is_null($this->emr_current_telephone_general_line)){
      $condition[] = "emr_current_telephone_general_line='$this->emr_current_telephone_general_line'";
    }if(!is_null($this->emr_current_telephone_direct_line)){
      $condition[] = "emr_current_telephone_direct_line='$this->emr_current_telephone_direct_line'";
    }if(!is_null($this->emr_current_mobile_no)){
      $condition[] = "emr_current_mobile_no='$this->emr_current_mobile_no'";
    }if(!is_null($this->emr_current_fax)){
      $condition[] = "emr_current_fax='$this->emr_current_fax'";
    }if(!is_null($this->emr_current_email)){
      $condition[] = "emr_current_email='$this->emr_current_email'";
    }if(!is_null($this->emr_current_country_id)){
      $condition[] = "emr_current_country_id='$this->emr_current_country_id'";
    }if(!is_null($this->emr_current_province_id)){
      $condition[] = "emr_current_province_id='$this->emr_current_province_id'";
    }if(!is_null($this->emr_current_district_id)){
      $condition[] = "emr_current_district_id='$this->emr_current_district_id'";
    }if(!is_null($this->emr_current_ds_division_id)){
      $condition[] = "emr_current_ds_division_id='$this->emr_current_ds_division_id'";
    }if(!is_null($this->emr_current_electorate)){
      $condition[] = "emr_current_electorate='$this->emr_current_electorate'";
    }if(!is_null($this->emr_remarks)){
      $condition[] = "emr_remarks='$this->emr_remarks'";
    }if(!is_null($this->emr_status)){
      $condition[] = "emr_status='$this->emr_status'";
    }if(!is_null($this->emr_is_deleted)){
      $condition[] = "emr_is_deleted='$this->emr_is_deleted'";
    }if(!is_null($this->emr_company_id)){
      $condition[] = "emr_company_id='$this->emr_company_id'";
    }if(!is_null($this->emr_created_by)){
      $condition[] = "emr_created_by='$this->emr_created_by'";
    }if(!is_null($this->emr_created_on)){
      $condition[] = "emr_created_on='$this->emr_created_on'";
    }if(!is_null($this->emr_last_modified_by)){
      $condition[] = "emr_last_modified_by='$this->emr_last_modified_by'";
    }if(!is_null($this->emr_last_modified_on)){
      $condition[] = "emr_last_modified_on='$this->emr_last_modified_on'";
    }if(!is_null($this->emr_deleted_by)){
      $condition[] = "emr_deleted_by='$this->emr_deleted_by'";
    }if(!is_null($this->emr_deleted_on)){
      $condition[] = "emr_deleted_on='$this->emr_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emr_id, emr_permanent_address, emr_permanent_street, emr_permanent_city, emr_permanent_postal_code, emr_permanent_telephone, emr_permanent_mobile_no, emr_permanent_email, emr_permanent_country_id, emr_permanent_province_id, emr_permanent_district_id, emr_permanent_ds_division_id, emr_permanent_electorate, emr_current_address, emr_current_street, emr_current_city, emr_current_postal_code, emr_current_telephone_general_line, emr_current_telephone_direct_line, emr_current_mobile_no, emr_current_fax, emr_current_email, emr_current_country_id, emr_current_province_id, emr_current_district_id, emr_current_ds_division_id, emr_current_electorate, emr_remarks, emr_status, emr_is_deleted, emr_company_id, emr_created_by, emr_created_on, emr_last_modified_by, emr_last_modified_on, emr_deleted_by, emr_deleted_on
          from hrm_employee_residential
          where ".$conditionStr."
          order by emr_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['emr_id'].'" '; 
      if($this->emr_id == $row['emr_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emr_permanent_address'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->emr_id)){
      $condition[] = "emr_id='$this->emr_id'";
    }if(!is_null($this->emr_permanent_address)){
      $condition[] = "emr_permanent_address='$this->emr_permanent_address'";
    }if(!is_null($this->emr_permanent_street)){
      $condition[] = "emr_permanent_street='$this->emr_permanent_street'";
    }if(!is_null($this->emr_permanent_city)){
      $condition[] = "emr_permanent_city='$this->emr_permanent_city'";
    }if(!is_null($this->emr_permanent_postal_code)){
      $condition[] = "emr_permanent_postal_code='$this->emr_permanent_postal_code'";
    }if(!is_null($this->emr_permanent_telephone)){
      $condition[] = "emr_permanent_telephone='$this->emr_permanent_telephone'";
    }if(!is_null($this->emr_permanent_mobile_no)){
      $condition[] = "emr_permanent_mobile_no='$this->emr_permanent_mobile_no'";
    }if(!is_null($this->emr_permanent_email)){
      $condition[] = "emr_permanent_email='$this->emr_permanent_email'";
    }if(!is_null($this->emr_permanent_country_id)){
      $condition[] = "emr_permanent_country_id='$this->emr_permanent_country_id'";
    }if(!is_null($this->emr_permanent_province_id)){
      $condition[] = "emr_permanent_province_id='$this->emr_permanent_province_id'";
    }if(!is_null($this->emr_permanent_district_id)){
      $condition[] = "emr_permanent_district_id='$this->emr_permanent_district_id'";
    }if(!is_null($this->emr_permanent_ds_division_id)){
      $condition[] = "emr_permanent_ds_division_id='$this->emr_permanent_ds_division_id'";
    }if(!is_null($this->emr_permanent_electorate)){
      $condition[] = "emr_permanent_electorate='$this->emr_permanent_electorate'";
    }if(!is_null($this->emr_current_address)){
      $condition[] = "emr_current_address='$this->emr_current_address'";
    }if(!is_null($this->emr_current_street)){
      $condition[] = "emr_current_street='$this->emr_current_street'";
    }if(!is_null($this->emr_current_city)){
      $condition[] = "emr_current_city='$this->emr_current_city'";
    }if(!is_null($this->emr_current_postal_code)){
      $condition[] = "emr_current_postal_code='$this->emr_current_postal_code'";
    }if(!is_null($this->emr_current_telephone_general_line)){
      $condition[] = "emr_current_telephone_general_line='$this->emr_current_telephone_general_line'";
    }if(!is_null($this->emr_current_telephone_direct_line)){
      $condition[] = "emr_current_telephone_direct_line='$this->emr_current_telephone_direct_line'";
    }if(!is_null($this->emr_current_mobile_no)){
      $condition[] = "emr_current_mobile_no='$this->emr_current_mobile_no'";
    }if(!is_null($this->emr_current_fax)){
      $condition[] = "emr_current_fax='$this->emr_current_fax'";
    }if(!is_null($this->emr_current_email)){
      $condition[] = "emr_current_email='$this->emr_current_email'";
    }if(!is_null($this->emr_current_country_id)){
      $condition[] = "emr_current_country_id='$this->emr_current_country_id'";
    }if(!is_null($this->emr_current_province_id)){
      $condition[] = "emr_current_province_id='$this->emr_current_province_id'";
    }if(!is_null($this->emr_current_district_id)){
      $condition[] = "emr_current_district_id='$this->emr_current_district_id'";
    }if(!is_null($this->emr_current_ds_division_id)){
      $condition[] = "emr_current_ds_division_id='$this->emr_current_ds_division_id'";
    }if(!is_null($this->emr_current_electorate)){
      $condition[] = "emr_current_electorate='$this->emr_current_electorate'";
    }if(!is_null($this->emr_remarks)){
      $condition[] = "emr_remarks='$this->emr_remarks'";
    }if(!is_null($this->emr_status)){
      $condition[] = "emr_status='$this->emr_status'";
    }if(!is_null($this->emr_is_deleted)){
      $condition[] = "emr_is_deleted='$this->emr_is_deleted'";
    }if(!is_null($this->emr_company_id)){
      $condition[] = "emr_company_id='$this->emr_company_id'";
    }if(!is_null($this->emr_created_by)){
      $condition[] = "emr_created_by='$this->emr_created_by'";
    }if(!is_null($this->emr_created_on)){
      $condition[] = "emr_created_on='$this->emr_created_on'";
    }if(!is_null($this->emr_last_modified_by)){
      $condition[] = "emr_last_modified_by='$this->emr_last_modified_by'";
    }if(!is_null($this->emr_last_modified_on)){
      $condition[] = "emr_last_modified_on='$this->emr_last_modified_on'";
    }if(!is_null($this->emr_deleted_by)){
      $condition[] = "emr_deleted_by='$this->emr_deleted_by'";
    }if(!is_null($this->emr_deleted_on)){
      $condition[] = "emr_deleted_on='$this->emr_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select emr_id, emr_permanent_address, emr_permanent_street, emr_permanent_city, emr_permanent_postal_code, emr_permanent_telephone, emr_permanent_mobile_no, emr_permanent_email, emr_permanent_country_id, emr_permanent_province_id, emr_permanent_district_id, emr_permanent_ds_division_id, emr_permanent_electorate, emr_current_address, emr_current_street, emr_current_city, emr_current_postal_code, emr_current_telephone_general_line, emr_current_telephone_direct_line, emr_current_mobile_no, emr_current_fax, emr_current_email, emr_current_country_id, emr_current_province_id, emr_current_district_id, emr_current_ds_division_id, emr_current_electorate, emr_remarks, emr_status, emr_is_deleted, emr_company_id, emr_created_by, emr_created_on, emr_last_modified_by, emr_last_modified_on, emr_deleted_by, emr_deleted_on
          from hrm_employee_residential
          where ".$conditionStr."
          order by emr_id asc";
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
    
    $model = new cls_hrm_employee_residential($this->db);
  
    $model->emr_id = $result[0]['emr_id'];
    $model->emr_permanent_address = $result[0]['emr_permanent_address'];
    $model->emr_permanent_street = $result[0]['emr_permanent_street'];
    $model->emr_permanent_city = $result[0]['emr_permanent_city'];
    $model->emr_permanent_postal_code = $result[0]['emr_permanent_postal_code'];
    $model->emr_permanent_telephone = $result[0]['emr_permanent_telephone'];
    $model->emr_permanent_mobile_no = $result[0]['emr_permanent_mobile_no'];
    $model->emr_permanent_email = $result[0]['emr_permanent_email'];
    $model->emr_permanent_country_id = $result[0]['emr_permanent_country_id'];
    $model->emr_permanent_province_id = $result[0]['emr_permanent_province_id'];
    $model->emr_permanent_district_id = $result[0]['emr_permanent_district_id'];
    $model->emr_permanent_ds_division_id = $result[0]['emr_permanent_ds_division_id'];
    $model->emr_permanent_electorate = $result[0]['emr_permanent_electorate'];
    $model->emr_current_address = $result[0]['emr_current_address'];
    $model->emr_current_street = $result[0]['emr_current_street'];
    $model->emr_current_city = $result[0]['emr_current_city'];
    $model->emr_current_postal_code = $result[0]['emr_current_postal_code'];
    $model->emr_current_telephone_general_line = $result[0]['emr_current_telephone_general_line'];
    $model->emr_current_telephone_direct_line = $result[0]['emr_current_telephone_direct_line'];
    $model->emr_current_mobile_no = $result[0]['emr_current_mobile_no'];
    $model->emr_current_fax = $result[0]['emr_current_fax'];
    $model->emr_current_email = $result[0]['emr_current_email'];
    $model->emr_current_country_id = $result[0]['emr_current_country_id'];
    $model->emr_current_province_id = $result[0]['emr_current_province_id'];
    $model->emr_current_district_id = $result[0]['emr_current_district_id'];
    $model->emr_current_ds_division_id = $result[0]['emr_current_ds_division_id'];
    $model->emr_current_electorate = $result[0]['emr_current_electorate'];
    $model->emr_remarks = $result[0]['emr_remarks'];
    $model->emr_status = $result[0]['emr_status'];
    $model->emr_is_deleted = $result[0]['emr_is_deleted'];
    $model->emr_company_id = $result[0]['emr_company_id'];
    $model->emr_created_by = $result[0]['emr_created_by'];
    $model->emr_created_on = $result[0]['emr_created_on'];
    $model->emr_last_modified_by = $result[0]['emr_last_modified_by'];
    $model->emr_last_modified_on = $result[0]['emr_last_modified_on'];
    $model->emr_deleted_by = $result[0]['emr_deleted_by'];
    $model->emr_deleted_on = $result[0]['emr_deleted_on'];
    return $model;
  }
//              'emr_permanent_country_id' => 'Permanent Country Id', 
//            'emr_permanent_province_id' => 'Permanent Province Id', 
//            'emr_permanent_district_id' => 'Permanent District Id', 
//            'emr_permanent_ds_division_id' => 'Permanent Ds Division Id', 
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->emr_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Permanent Country
  */
  public function getPermanentCountry(){
    $model = new cls_sys_country($this->db);
    $model->syt_id = $this->emr_permanent_country_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syt_name;
  }
  /**
  * @return Permanent Province
  */
  public function getPermanentProvince(){
    $model = new cls_sys_province($this->db);
    $model->syv_id = $this->emr_permanent_province_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syv_name;
  }
  /**
  * @return Permanent District
  */
  public function getPermanentDistrict(){
    $model = new cls_sys_district($this->db);
    $model->syd_id = $this->emr_permanent_district_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syd_name;
  }
  /**
  * @return Permanent DS Division
  */
  public function getPermanentDsDivision(){
    $model = new cls_sys_ds_division($this->db);
    $model->syi_id = $this->emr_permanent_ds_division_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syi_name;
  }
  /**
  * @return Current Country
  */
  public function getCurrentCountry(){
    $model = new cls_sys_country($this->db);
    $model->syt_id = $this->emr_current_country_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syt_name;
  }
  /**
  * @return Current Province
  */
  public function getCurrentProvince(){
    $model = new cls_sys_province($this->db);
    $model->syv_id = $this->emr_current_province_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syv_name;
  }
  /**
  * @return Current District
  */
  public function getCurrentDistrict(){
    $model = new cls_sys_district($this->db);
    $model->syd_id = $this->emr_current_district_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syd_name;
  }
  /**
  * @return Current DS Division
  */
  public function getCurrentDsDivision(){
    $model = new cls_sys_ds_division($this->db);
    $model->syi_id = $this->emr_current_ds_division_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syi_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->emr_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->emr_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->emr_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emr_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->emr_created_on))?$this->emr_created_on:date("Y-m-d H:i:s",$this->emr_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emr_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->emr_last_modified_on))?$this->emr_last_modified_on:date("Y-m-d H:i:s",$this->emr_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->emr_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->emr_deleted_on))?$this->emr_deleted_on:date("Y-m-d H:i:s",$this->emr_deleted_on);
  }
}
?>

