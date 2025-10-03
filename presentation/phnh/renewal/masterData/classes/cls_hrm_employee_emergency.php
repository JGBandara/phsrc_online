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
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/**
 * This is the model class for table "hrm_employee_emergency".
 * @property integer $eme_id
* @property string $eme_full_name
* @property string $eme_relationship
* @property string $eme_home_address
* @property string $eme_home_telephone
* @property string $eme_office_address
* @property string $eme_office_telephone
* @property string $eme_mobile_no
* @property string $eme_emergency_contact
* @property string $eme_remarks
* @property integer $eme_status
* @property integer $eme_is_deleted
* @property integer $eme_company_id
* @property integer $eme_created_by
* @property integer $eme_created_on
* @property integer $eme_last_modified_by
* @property integer $eme_last_modified_on
* @property integer $eme_deleted_by
* @property integer $eme_deleted_on
*/
class cls_hrm_employee_emergency {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employee_emergency';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'eme_id' => 'Id', 
            'eme_full_name' => 'Full Name', 
            'eme_relationship' => 'Relationship', 
            'eme_home_address' => 'Home Address', 
            'eme_home_telephone' => 'Home Telephone', 
            'eme_office_address' => 'Office Address', 
            'eme_office_telephone' => 'Office Telephone', 
            'eme_mobile_no' => 'Mobile No', 
            'eme_emergency_contact' => 'Emergency Contact', 
            'eme_remarks' => 'Remarks', 
            'eme_status' => 'Status', 
            'eme_is_deleted' => 'Is Deleted', 
            'eme_company_id' => 'Company', 
            'eme_created_by' => 'Created By', 
            'eme_created_on' => 'Created On', 
            'eme_last_modified_by' => 'Last Modified By', 
            'eme_last_modified_on' => 'Last Modified On', 
            'eme_deleted_by' => 'Deleted By', 
            'eme_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->eme_id)){
      $condition[] = "eme_id='$this->eme_id'";
    }if(!is_null($this->eme_full_name)){
      $condition[] = "eme_full_name='$this->eme_full_name'";
    }if(!is_null($this->eme_relationship)){
      $condition[] = "eme_relationship='$this->eme_relationship'";
    }if(!is_null($this->eme_home_address)){
      $condition[] = "eme_home_address='$this->eme_home_address'";
    }if(!is_null($this->eme_home_telephone)){
      $condition[] = "eme_home_telephone='$this->eme_home_telephone'";
    }if(!is_null($this->eme_office_address)){
      $condition[] = "eme_office_address='$this->eme_office_address'";
    }if(!is_null($this->eme_office_telephone)){
      $condition[] = "eme_office_telephone='$this->eme_office_telephone'";
    }if(!is_null($this->eme_mobile_no)){
      $condition[] = "eme_mobile_no='$this->eme_mobile_no'";
    }if(!is_null($this->eme_emergency_contact)){
      $condition[] = "eme_emergency_contact='$this->eme_emergency_contact'";
    }if(!is_null($this->eme_remarks)){
      $condition[] = "eme_remarks='$this->eme_remarks'";
    }if(!is_null($this->eme_status)){
      $condition[] = "eme_status='$this->eme_status'";
    }if(!is_null($this->eme_is_deleted)){
      $condition[] = "eme_is_deleted='$this->eme_is_deleted'";
    }if(!is_null($this->eme_company_id)){
      $condition[] = "eme_company_id='$this->eme_company_id'";
    }if(!is_null($this->eme_created_by)){
      $condition[] = "eme_created_by='$this->eme_created_by'";
    }if(!is_null($this->eme_created_on)){
      $condition[] = "eme_created_on='$this->eme_created_on'";
    }if(!is_null($this->eme_last_modified_by)){
      $condition[] = "eme_last_modified_by='$this->eme_last_modified_by'";
    }if(!is_null($this->eme_last_modified_on)){
      $condition[] = "eme_last_modified_on='$this->eme_last_modified_on'";
    }if(!is_null($this->eme_deleted_by)){
      $condition[] = "eme_deleted_by='$this->eme_deleted_by'";
    }if(!is_null($this->eme_deleted_on)){
      $condition[] = "eme_deleted_on='$this->eme_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select eme_id, eme_full_name, eme_relationship, eme_home_address, eme_home_telephone, eme_office_address, eme_office_telephone, eme_mobile_no, eme_emergency_contact, eme_remarks, eme_status, eme_is_deleted, eme_company_id, eme_created_by, eme_created_on, eme_last_modified_by, eme_last_modified_on, eme_deleted_by, eme_deleted_on
          from hrm_employee_emergency
          where ".$conditionStr."
          order by eme_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['eme_id'].'" '; 
      if($this->eme_id == $row['eme_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['eme_full_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->eme_id)){
      $condition[] = "eme_id='$this->eme_id'";
    }if(!is_null($this->eme_full_name)){
      $condition[] = "eme_full_name='$this->eme_full_name'";
    }if(!is_null($this->eme_relationship)){
      $condition[] = "eme_relationship='$this->eme_relationship'";
    }if(!is_null($this->eme_home_address)){
      $condition[] = "eme_home_address='$this->eme_home_address'";
    }if(!is_null($this->eme_home_telephone)){
      $condition[] = "eme_home_telephone='$this->eme_home_telephone'";
    }if(!is_null($this->eme_office_address)){
      $condition[] = "eme_office_address='$this->eme_office_address'";
    }if(!is_null($this->eme_office_telephone)){
      $condition[] = "eme_office_telephone='$this->eme_office_telephone'";
    }if(!is_null($this->eme_mobile_no)){
      $condition[] = "eme_mobile_no='$this->eme_mobile_no'";
    }if(!is_null($this->eme_emergency_contact)){
      $condition[] = "eme_emergency_contact='$this->eme_emergency_contact'";
    }if(!is_null($this->eme_remarks)){
      $condition[] = "eme_remarks='$this->eme_remarks'";
    }if(!is_null($this->eme_status)){
      $condition[] = "eme_status='$this->eme_status'";
    }if(!is_null($this->eme_is_deleted)){
      $condition[] = "eme_is_deleted='$this->eme_is_deleted'";
    }if(!is_null($this->eme_company_id)){
      $condition[] = "eme_company_id='$this->eme_company_id'";
    }if(!is_null($this->eme_created_by)){
      $condition[] = "eme_created_by='$this->eme_created_by'";
    }if(!is_null($this->eme_created_on)){
      $condition[] = "eme_created_on='$this->eme_created_on'";
    }if(!is_null($this->eme_last_modified_by)){
      $condition[] = "eme_last_modified_by='$this->eme_last_modified_by'";
    }if(!is_null($this->eme_last_modified_on)){
      $condition[] = "eme_last_modified_on='$this->eme_last_modified_on'";
    }if(!is_null($this->eme_deleted_by)){
      $condition[] = "eme_deleted_by='$this->eme_deleted_by'";
    }if(!is_null($this->eme_deleted_on)){
      $condition[] = "eme_deleted_on='$this->eme_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select eme_id, eme_full_name, eme_relationship, eme_home_address, eme_home_telephone, eme_office_address, eme_office_telephone, eme_mobile_no, eme_emergency_contact, eme_remarks, eme_status, eme_is_deleted, eme_company_id, eme_created_by, eme_created_on, eme_last_modified_by, eme_last_modified_on, eme_deleted_by, eme_deleted_on
          from hrm_employee_emergency
          where ".$conditionStr."
          order by eme_id asc";
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
    
    $model = new cls_hrm_employee_emergency($this->db);
  
        $model->eme_id = $result[0]['eme_id'];
        $model->eme_full_name = $result[0]['eme_full_name'];
        $model->eme_relationship = $result[0]['eme_relationship'];
        $model->eme_home_address = $result[0]['eme_home_address'];
        $model->eme_home_telephone = $result[0]['eme_home_telephone'];
        $model->eme_office_address = $result[0]['eme_office_address'];
        $model->eme_office_telephone = $result[0]['eme_office_telephone'];
        $model->eme_mobile_no = $result[0]['eme_mobile_no'];
        $model->eme_emergency_contact = $result[0]['eme_emergency_contact'];
        $model->eme_remarks = $result[0]['eme_remarks'];
        $model->eme_status = $result[0]['eme_status'];
        $model->eme_is_deleted = $result[0]['eme_is_deleted'];
        $model->eme_company_id = $result[0]['eme_company_id'];
        $model->eme_created_by = $result[0]['eme_created_by'];
        $model->eme_created_on = $result[0]['eme_created_on'];
        $model->eme_last_modified_by = $result[0]['eme_last_modified_by'];
        $model->eme_last_modified_on = $result[0]['eme_last_modified_on'];
        $model->eme_deleted_by = $result[0]['eme_deleted_by'];
        $model->eme_deleted_on = $result[0]['eme_deleted_on'];
    return $model;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->eme_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->eme_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->eme_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->eme_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eme_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->eme_created_on))?$this->eme_created_on:date("Y-m-d H:i:s",$this->eme_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eme_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->eme_last_modified_on))?$this->eme_last_modified_on:date("Y-m-d H:i:s",$this->eme_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eme_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->eme_deleted_on))?$this->eme_deleted_on:date("Y-m-d H:i:s",$this->eme_deleted_on);
  }
}
?>

