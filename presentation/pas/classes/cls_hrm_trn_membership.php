<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
namespace presentation\hrm\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/**
 * This is the model class for table "hrm_trn_membership".
 * @property integer $mem_id
* @property integer $mem_employee_id
* @property string $mem_name
* @property string $mem_type
* @property string $mem_category
* @property string $mem_date_of_commencement
* @property string $mem_renewal_date
* @property string $mem_remarks
* @property integer $mem_status
* @property integer $mem_is_deleted
* @property integer $mem_company_id
* @property integer $mem_created_by
* @property integer $mem_created_on
* @property integer $mem_last_modified_by
* @property integer $mem_last_modified_on
* @property integer $mem_deleted_by
* @property integer $mem_deleted_on
*/
class cls_hrm_trn_membership {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_membership';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'mem_id' => 'Id', 
            'mem_employee_id' => 'Employee', 
            'mem_name' => 'Name', 
            'mem_type' => 'Type', 
            'mem_category' => 'Category', 
            'mem_date_of_commencement' => 'Date Of Commencement', 
            'mem_renewal_date' => 'Renewal Date', 
            'mem_remarks' => 'Remarks', 
            'mem_status' => 'Status', 
            'mem_is_deleted' => 'Is Deleted', 
            'mem_company_id' => 'Company', 
            'mem_created_by' => 'Created By', 
            'mem_created_on' => 'Created On', 
            'mem_last_modified_by' => 'Last Modified By', 
            'mem_last_modified_on' => 'Last Modified On', 
            'mem_deleted_by' => 'Deleted By', 
            'mem_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->mem_id)){
      $condition[] = "mem_id='$this->mem_id'";
    }if(!is_null($this->mem_employee_id)){
      $condition[] = "mem_employee_id='$this->mem_employee_id'";
    }if(!is_null($this->mem_name)){
      $condition[] = "mem_name='$this->mem_name'";
    }if(!is_null($this->mem_type)){
      $condition[] = "mem_type='$this->mem_type'";
    }if(!is_null($this->mem_category)){
      $condition[] = "mem_category='$this->mem_category'";
    }if(!is_null($this->mem_date_of_commencement)){
      $condition[] = "mem_date_of_commencement='$this->mem_date_of_commencement'";
    }if(!is_null($this->mem_renewal_date)){
      $condition[] = "mem_renewal_date='$this->mem_renewal_date'";
    }if(!is_null($this->mem_remarks)){
      $condition[] = "mem_remarks='$this->mem_remarks'";
    }if(!is_null($this->mem_status)){
      $condition[] = "mem_status='$this->mem_status'";
    }if(!is_null($this->mem_is_deleted)){
      $condition[] = "mem_is_deleted='$this->mem_is_deleted'";
    }if(!is_null($this->mem_company_id)){
      $condition[] = "mem_company_id='$this->mem_company_id'";
    }if(!is_null($this->mem_created_by)){
      $condition[] = "mem_created_by='$this->mem_created_by'";
    }if(!is_null($this->mem_created_on)){
      $condition[] = "mem_created_on='$this->mem_created_on'";
    }if(!is_null($this->mem_last_modified_by)){
      $condition[] = "mem_last_modified_by='$this->mem_last_modified_by'";
    }if(!is_null($this->mem_last_modified_on)){
      $condition[] = "mem_last_modified_on='$this->mem_last_modified_on'";
    }if(!is_null($this->mem_deleted_by)){
      $condition[] = "mem_deleted_by='$this->mem_deleted_by'";
    }if(!is_null($this->mem_deleted_on)){
      $condition[] = "mem_deleted_on='$this->mem_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select mem_id, mem_employee_id, mem_name, mem_type, mem_category, mem_date_of_commencement, mem_renewal_date, mem_remarks, mem_status, mem_is_deleted, mem_company_id, mem_created_by, mem_created_on, mem_last_modified_by, mem_last_modified_on, mem_deleted_by, mem_deleted_on, emi_calling_name, emi_no
          from hrm_trn_membership
              inner join hrm_employee_information on emi_id=mem_employee_id
          where ".$conditionStr."
          order by mem_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['mem_id'].'" '; 
      if($this->mem_id == $row['mem_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['mem_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->mem_id)){
      $condition[] = "mem_id='$this->mem_id'";
    }if(!is_null($this->mem_employee_id)){
      $condition[] = "mem_employee_id='$this->mem_employee_id'";
    }if(!is_null($this->mem_name)){
      $condition[] = "mem_name='$this->mem_name'";
    }if(!is_null($this->mem_type)){
      $condition[] = "mem_type='$this->mem_type'";
    }if(!is_null($this->mem_category)){
      $condition[] = "mem_category='$this->mem_category'";
    }if(!is_null($this->mem_date_of_commencement)){
      $condition[] = "mem_date_of_commencement='$this->mem_date_of_commencement'";
    }if(!is_null($this->mem_renewal_date)){
      $condition[] = "mem_renewal_date='$this->mem_renewal_date'";
    }if(!is_null($this->mem_remarks)){
      $condition[] = "mem_remarks='$this->mem_remarks'";
    }if(!is_null($this->mem_status)){
      $condition[] = "mem_status='$this->mem_status'";
    }if(!is_null($this->mem_is_deleted)){
      $condition[] = "mem_is_deleted='$this->mem_is_deleted'";
    }if(!is_null($this->mem_company_id)){
      $condition[] = "mem_company_id='$this->mem_company_id'";
    }if(!is_null($this->mem_created_by)){
      $condition[] = "mem_created_by='$this->mem_created_by'";
    }if(!is_null($this->mem_created_on)){
      $condition[] = "mem_created_on='$this->mem_created_on'";
    }if(!is_null($this->mem_last_modified_by)){
      $condition[] = "mem_last_modified_by='$this->mem_last_modified_by'";
    }if(!is_null($this->mem_last_modified_on)){
      $condition[] = "mem_last_modified_on='$this->mem_last_modified_on'";
    }if(!is_null($this->mem_deleted_by)){
      $condition[] = "mem_deleted_by='$this->mem_deleted_by'";
    }if(!is_null($this->mem_deleted_on)){
      $condition[] = "mem_deleted_on='$this->mem_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select mem_id, mem_employee_id, mem_name, mem_type, mem_category, if(mem_date_of_commencement='0000-00-00','',mem_date_of_commencement) as `mem_date_of_commencement`, if(mem_renewal_date='0000-00-00','',mem_renewal_date) as `mem_renewal_date`, mem_remarks, mem_status, mem_is_deleted, mem_company_id, mem_created_by, mem_created_on, mem_last_modified_by, mem_last_modified_on, mem_deleted_by, mem_deleted_on
          from hrm_trn_membership
          where ".$conditionStr."
          order by mem_id asc";
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
    
    $model = new cls_hrm_trn_membership($this->db);
  
    $model->mem_id = $result[0]['mem_id'];
    $model->mem_employee_id = $result[0]['mem_employee_id'];
    $model->mem_name = $result[0]['mem_name'];
    $model->mem_type = $result[0]['mem_type'];
    $model->mem_category = $result[0]['mem_category'];
    $model->mem_date_of_commencement = ($result[0]['mem_date_of_commencement']=='0000-00-00')?'':$result[0]['mem_date_of_commencement'];
    $model->mem_renewal_date = ($result[0]['mem_renewal_date']=='0000-00-00')?'':$result[0]['mem_renewal_date'];
    $model->mem_remarks = $result[0]['mem_remarks'];
    $model->mem_status = $result[0]['mem_status'];
    $model->mem_is_deleted = $result[0]['mem_is_deleted'];
    $model->mem_company_id = $result[0]['mem_company_id'];
    $model->mem_created_by = $result[0]['mem_created_by'];
    $model->mem_created_on = $result[0]['mem_created_on'];
    $model->mem_last_modified_by = $result[0]['mem_last_modified_by'];
    $model->mem_last_modified_on = $result[0]['mem_last_modified_on'];
    $model->mem_deleted_by = $result[0]['mem_deleted_by'];
    $model->mem_deleted_on = $result[0]['mem_deleted_on'];
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
      $model = new cls_hrm_trn_membership($this->db);
  
      $model->mem_id = $row['mem_id'];
      $model->mem_employee_id = $row['mem_employee_id'];
      $model->mem_name = $row['mem_name'];
      $model->mem_type = $row['mem_type'];
      $model->mem_category = $row['mem_category'];
      $model->mem_date_of_commencement = ($row['mem_date_of_commencement']=='0000-00-00')?'':$row['mem_date_of_commencement'];
      $model->mem_renewal_date = ($row['mem_renewal_date']=='0000-00-00')?'':$row['mem_renewal_date'];
      $model->mem_remarks = $row['mem_remarks'];
      $model->mem_status = $row['mem_status'];
      $model->mem_is_deleted = $row['mem_is_deleted'];
      $model->mem_company_id = $row['mem_company_id'];
      $model->mem_created_by = $row['mem_created_by'];
      $model->mem_created_on = $row['mem_created_on'];
      $model->mem_last_modified_by = $row['mem_last_modified_by'];
      $model->mem_last_modified_on = $row['mem_last_modified_on'];
      $model->mem_deleted_by = $row['mem_deleted_by'];
      $model->mem_deleted_on = $row['mem_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->mem_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->mem_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->mem_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->mem_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->mem_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->mem_created_on))?$this->mem_created_on:date("Y-m-d H:i:s",$this->mem_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->mem_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->mem_last_modified_on))?$this->mem_last_modified_on:date("Y-m-d H:i:s",$this->mem_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->mem_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->mem_deleted_on))?$this->mem_deleted_on:date("Y-m-d H:i:s",$this->mem_deleted_on);
  }
}
?>

