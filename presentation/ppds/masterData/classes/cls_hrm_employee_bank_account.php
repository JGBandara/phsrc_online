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
use presentation\system\masterData\classes\cls_sys_bank;
use presentation\system\masterData\classes\cls_sys_bank_branch;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/**
 * This is the model class for table "hrm_employee_bank_account".
 * @property integer $ema_id
* @property integer $ema_employee_id
* @property integer $ema_bank_id
* @property integer $ema_branch_id
* @property integer $ema_account_type
* @property string $ema_account_no
* @property string $ema_account_holder
* @property string $ema_amount
* @property string $ema_remarks
* @property integer $ema_status
* @property integer $ema_is_deleted
* @property integer $ema_company_id
* @property integer $ema_created_by
* @property integer $ema_created_on
* @property integer $ema_last_modified_by
* @property integer $ema_last_modified_on
* @property integer $ema_deleted_by
* @property integer $ema_deleted_on
*/
class cls_hrm_employee_bank_account {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_employee_bank_account';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'ema_id' => 'Id', 
            'ema_employee_id' => 'Employee', 
            'ema_bank_id' => 'Bank', 
            'ema_branch_id' => 'Branch', 
            'ema_account_type' => 'Account Type', 
            'ema_account_no' => 'Account No', 
            'ema_account_holder' => 'Account Holder', 
            'ema_amount' => 'Amount', 
            'ema_remarks' => 'Remarks', 
            'ema_status' => 'Status', 
            'ema_is_deleted' => 'Is Deleted', 
            'ema_company_id' => 'Company', 
            'ema_created_by' => 'Created By', 
            'ema_created_on' => 'Created On', 
            'ema_last_modified_by' => 'Last Modified By', 
            'ema_last_modified_on' => 'Last Modified On', 
            'ema_deleted_by' => 'Deleted By', 
            'ema_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->ema_id)){
      $condition[] = "ema_id='$this->ema_id'";
    }if(!is_null($this->ema_employee_id)){
      $condition[] = "ema_employee_id='$this->ema_employee_id'";
    }if(!is_null($this->ema_bank_id)){
      $condition[] = "ema_bank_id='$this->ema_bank_id'";
    }if(!is_null($this->ema_branch_id)){
      $condition[] = "ema_branch_id='$this->ema_branch_id'";
    }if(!is_null($this->ema_account_type)){
      $condition[] = "ema_account_type='$this->ema_account_type'";
    }if(!is_null($this->ema_account_no)){
      $condition[] = "ema_account_no='$this->ema_account_no'";
    }if(!is_null($this->ema_account_holder)){
      $condition[] = "ema_account_holder='$this->ema_account_holder'";
    }if(!is_null($this->ema_amount)){
      $condition[] = "ema_amount='$this->ema_amount'";
    }if(!is_null($this->ema_remarks)){
      $condition[] = "ema_remarks='$this->ema_remarks'";
    }if(!is_null($this->ema_status)){
      $condition[] = "ema_status='$this->ema_status'";
    }if(!is_null($this->ema_is_deleted)){
      $condition[] = "ema_is_deleted='$this->ema_is_deleted'";
    }if(!is_null($this->ema_company_id)){
      $condition[] = "ema_company_id='$this->ema_company_id'";
    }if(!is_null($this->ema_created_by)){
      $condition[] = "ema_created_by='$this->ema_created_by'";
    }if(!is_null($this->ema_created_on)){
      $condition[] = "ema_created_on='$this->ema_created_on'";
    }if(!is_null($this->ema_last_modified_by)){
      $condition[] = "ema_last_modified_by='$this->ema_last_modified_by'";
    }if(!is_null($this->ema_last_modified_on)){
      $condition[] = "ema_last_modified_on='$this->ema_last_modified_on'";
    }if(!is_null($this->ema_deleted_by)){
      $condition[] = "ema_deleted_by='$this->ema_deleted_by'";
    }if(!is_null($this->ema_deleted_on)){
      $condition[] = "ema_deleted_on='$this->ema_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ema_id, emi_no, emi_calling_name, ema_employee_id, ema_bank_id, sye_name, ema_branch_id, syf_name, ema_account_type, ema_account_no, ema_account_holder, ema_amount, ema_remarks, ema_status, ema_is_deleted, ema_company_id, ema_created_by, ema_created_on, ema_last_modified_by, ema_last_modified_on, ema_deleted_by, ema_deleted_on
          from hrm_employee_bank_account
              inner join hrm_employee_information on emi_id=ema_employee_id
              inner join sys_bank on sye_id=ema_bank_id
              inner join sys_bank_branch on syf_id=ema_branch_id
          where ".$conditionStr."
          order by ema_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['ema_id'].'" '; 
      if($this->ema_id == $row['ema_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['sye_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->ema_id)){
      $condition[] = "ema_id='$this->ema_id'";
    }if(!is_null($this->ema_employee_id)){
      $condition[] = "ema_employee_id='$this->ema_employee_id'";
    }if(!is_null($this->ema_bank_id)){
      $condition[] = "ema_bank_id='$this->ema_bank_id'";
    }if(!is_null($this->ema_branch_id)){
      $condition[] = "ema_branch_id='$this->ema_branch_id'";
    }if(!is_null($this->ema_account_type)){
      $condition[] = "ema_account_type='$this->ema_account_type'";
    }if(!is_null($this->ema_account_no)){
      $condition[] = "ema_account_no='$this->ema_account_no'";
    }if(!is_null($this->ema_account_holder)){
      $condition[] = "ema_account_holder='$this->ema_account_holder'";
    }if(!is_null($this->ema_amount)){
      $condition[] = "ema_amount='$this->ema_amount'";
    }if(!is_null($this->ema_remarks)){
      $condition[] = "ema_remarks='$this->ema_remarks'";
    }if(!is_null($this->ema_status)){
      $condition[] = "ema_status='$this->ema_status'";
    }if(!is_null($this->ema_is_deleted)){
      $condition[] = "ema_is_deleted='$this->ema_is_deleted'";
    }if(!is_null($this->ema_company_id)){
      $condition[] = "ema_company_id='$this->ema_company_id'";
    }if(!is_null($this->ema_created_by)){
      $condition[] = "ema_created_by='$this->ema_created_by'";
    }if(!is_null($this->ema_created_on)){
      $condition[] = "ema_created_on='$this->ema_created_on'";
    }if(!is_null($this->ema_last_modified_by)){
      $condition[] = "ema_last_modified_by='$this->ema_last_modified_by'";
    }if(!is_null($this->ema_last_modified_on)){
      $condition[] = "ema_last_modified_on='$this->ema_last_modified_on'";
    }if(!is_null($this->ema_deleted_by)){
      $condition[] = "ema_deleted_by='$this->ema_deleted_by'";
    }if(!is_null($this->ema_deleted_on)){
      $condition[] = "ema_deleted_on='$this->ema_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select ema_id, ema_employee_id, ema_bank_id, ema_branch_id, ema_account_type, ema_account_no, ema_account_holder, ema_amount, ema_remarks, ema_status, ema_is_deleted, ema_company_id, ema_created_by, ema_created_on, ema_last_modified_by, ema_last_modified_on, ema_deleted_by, ema_deleted_on
          from hrm_employee_bank_account
          where ".$conditionStr."
          order by ema_id asc";
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
    
    $model = new cls_hrm_employee_bank_account($this->db);
  
        $model->ema_id = $result[0]['ema_id'];
        $model->ema_employee_id = $result[0]['ema_employee_id'];
        $model->ema_bank_id = $result[0]['ema_bank_id'];
        $model->ema_branch_id = $result[0]['ema_branch_id'];
        $model->ema_account_type = $result[0]['ema_account_type'];
        $model->ema_account_no = $result[0]['ema_account_no'];
        $model->ema_account_holder = $result[0]['ema_account_holder'];
        $model->ema_amount = $result[0]['ema_amount'];
        $model->ema_remarks = $result[0]['ema_remarks'];
        $model->ema_status = $result[0]['ema_status'];
        $model->ema_is_deleted = $result[0]['ema_is_deleted'];
        $model->ema_company_id = $result[0]['ema_company_id'];
        $model->ema_created_by = $result[0]['ema_created_by'];
        $model->ema_created_on = $result[0]['ema_created_on'];
        $model->ema_last_modified_by = $result[0]['ema_last_modified_by'];
        $model->ema_last_modified_on = $result[0]['ema_last_modified_on'];
        $model->ema_deleted_by = $result[0]['ema_deleted_by'];
        $model->ema_deleted_on = $result[0]['ema_deleted_on'];
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
      $model = new cls_hrm_employee_bank_account($this->db);
  
      $model->ema_id = $row['ema_id'];
      $model->ema_employee_id = $row['ema_employee_id'];
      $model->ema_bank_id = $row['ema_bank_id'];
      $model->ema_branch_id = $row['ema_branch_id'];
      $model->ema_account_type = $row['ema_account_type'];
      $model->ema_account_no = $row['ema_account_no'];
      $model->ema_account_holder = $row['ema_account_holder'];
      $model->ema_amount = $row['ema_amount'];
      $model->ema_remarks = $row['ema_remarks'];
      $model->ema_status = $row['ema_status'];
      $model->ema_is_deleted = $row['ema_is_deleted'];
      $model->ema_company_id = $row['ema_company_id'];
      $model->ema_created_by = $row['ema_created_by'];
      $model->ema_created_on = $row['ema_created_on'];
      $model->ema_last_modified_by = $row['ema_last_modified_by'];
      $model->ema_last_modified_on = $row['ema_last_modified_on'];
      $model->ema_deleted_by = $row['ema_deleted_by'];
      $model->ema_deleted_on = $row['ema_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->ema_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Account Type
  */
  public function getAccountType(){
    return ($this->ema_account_type=='1')?'Current':'Saving';
  }
  /**
  * @return Bank
  */
  public function getBank(){
    $model = new cls_sys_bank($this->db);
    $model->sye_id = $this->ema_bank_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->sye_name;
  }
  /**
  * @return Branch
  */
  public function getBranch(){
    $model = new cls_sys_bank_branch($this->db);
    $model->syf_id = $this->ema_branch_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syf_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->ema_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->ema_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->ema_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ema_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->ema_created_on))?$this->ema_created_on:date("Y-m-d H:i:s",$this->ema_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ema_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->ema_last_modified_on))?$this->ema_last_modified_on:date("Y-m-d H:i:s",$this->ema_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->ema_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->ema_deleted_on))?$this->ema_deleted_on:date("Y-m-d H:i:s",$this->ema_deleted_on);
  }
}
?>

