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
use presentation\hrm\masterData\classes\cls_hrm_other_qualification_category;
use presentation\hrm\masterData\classes\cls_hrm_other_qualification_type;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

/**
 * This is the model class for table "hrm_trn_other_qualification".
 * @property integer $eoq_id
* @property integer $eoq_employee_id
* @property integer $eoq_qualification_category_id
* @property integer $eoq_qualification_type_id
* @property string $eoq_name
* @property string $eoq_stream
* @property string $eoq_institute
* @property string $eoq_qualification_status
* @property string $eoq_year
* @property string $eoq_remarks
* @property integer $eoq_status
* @property integer $eoq_is_deleted
* @property integer $eoq_company_id
* @property integer $eoq_created_by
* @property integer $eoq_created_on
* @property integer $eoq_last_modified_by
* @property integer $eoq_last_modified_on
* @property integer $eoq_deleted_by
* @property integer $eoq_deleted_on
*/
class cls_hrm_trn_other_qualification {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_other_qualification';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'eoq_id' => 'Id', 
            'eoq_employee_id' => 'Employee', 
            'eoq_qualification_category_id' => 'Qualification Category', 
            'eoq_qualification_type_id' => 'Qualification Type', 
            'eoq_name' => 'Name', 
            'eoq_stream' => 'Stream', 
            'eoq_institute' => 'Institute', 
            'eoq_qualification_status' => 'Qualification Status', 
            'eoq_year' => 'Year', 
            'eoq_remarks' => 'Remarks', 
            'eoq_status' => 'Status', 
            'eoq_is_deleted' => 'Is Deleted', 
            'eoq_company_id' => 'Company', 
            'eoq_created_by' => 'Created By', 
            'eoq_created_on' => 'Created On', 
            'eoq_last_modified_by' => 'Last Modified By', 
            'eoq_last_modified_on' => 'Last Modified On', 
            'eoq_deleted_by' => 'Deleted By', 
            'eoq_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->eoq_id)){
      $condition[] = "eoq_id='$this->eoq_id'";
    }if(!is_null($this->eoq_employee_id)){
      $condition[] = "eoq_employee_id='$this->eoq_employee_id'";
    }if(!is_null($this->eoq_qualification_category_id)){
      $condition[] = "eoq_qualification_category_id='$this->eoq_qualification_category_id'";
    }if(!is_null($this->eoq_qualification_type_id)){
      $condition[] = "eoq_qualification_type_id='$this->eoq_qualification_type_id'";
    }if(!is_null($this->eoq_name)){
      $condition[] = "eoq_name='$this->eoq_name'";
    }if(!is_null($this->eoq_stream)){
      $condition[] = "eoq_stream='$this->eoq_stream'";
    }if(!is_null($this->eoq_institute)){
      $condition[] = "eoq_institute='$this->eoq_institute'";
    }if(!is_null($this->eoq_qualification_status)){
      $condition[] = "eoq_qualification_status='$this->eoq_qualification_status'";
    }if(!is_null($this->eoq_year)){
      $condition[] = "eoq_year='$this->eoq_year'";
    }if(!is_null($this->eoq_remarks)){
      $condition[] = "eoq_remarks='$this->eoq_remarks'";
    }if(!is_null($this->eoq_status)){
      $condition[] = "eoq_status='$this->eoq_status'";
    }if(!is_null($this->eoq_is_deleted)){
      $condition[] = "eoq_is_deleted='$this->eoq_is_deleted'";
    }if(!is_null($this->eoq_company_id)){
      $condition[] = "eoq_company_id='$this->eoq_company_id'";
    }if(!is_null($this->eoq_created_by)){
      $condition[] = "eoq_created_by='$this->eoq_created_by'";
    }if(!is_null($this->eoq_created_on)){
      $condition[] = "eoq_created_on='$this->eoq_created_on'";
    }if(!is_null($this->eoq_last_modified_by)){
      $condition[] = "eoq_last_modified_by='$this->eoq_last_modified_by'";
    }if(!is_null($this->eoq_last_modified_on)){
      $condition[] = "eoq_last_modified_on='$this->eoq_last_modified_on'";
    }if(!is_null($this->eoq_deleted_by)){
      $condition[] = "eoq_deleted_by='$this->eoq_deleted_by'";
    }if(!is_null($this->eoq_deleted_on)){
      $condition[] = "eoq_deleted_on='$this->eoq_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eoq_id, eoq_employee_id, eoq_qualification_category_id, eoq_qualification_type_id, eoq_name, eoq_stream, eoq_institute, eoq_qualification_status, eoq_year, eoq_remarks, eoq_status, eoq_is_deleted, eoq_company_id, eoq_created_by, eoq_created_on, eoq_last_modified_by, eoq_last_modified_on, eoq_deleted_by, eoq_deleted_on, emi_calling_name, emi_no, oqt_name, oqc_name
          from hrm_trn_other_qualification
              inner join hrm_employee_information on emi_id=eoq_employee_id
              inner join hrm_other_qualification_category on oqc_id=eoq_qualification_category_id
              inner join hrm_other_qualification_type on oqt_id=eoq_qualification_type_id
          where ".$conditionStr."
          order by eoq_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['eoq_id'].'" '; 
      if($this->eoq_id == $row['eoq_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['oqc_name'].' - '. $row['eoq_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->eoq_id)){
      $condition[] = "eoq_id='$this->eoq_id'";
    }if(!is_null($this->eoq_employee_id)){
      $condition[] = "eoq_employee_id='$this->eoq_employee_id'";
    }if(!is_null($this->eoq_qualification_category_id)){
      $condition[] = "eoq_qualification_category_id='$this->eoq_qualification_category_id'";
    }if(!is_null($this->eoq_qualification_type_id)){
      $condition[] = "eoq_qualification_type_id='$this->eoq_qualification_type_id'";
    }if(!is_null($this->eoq_name)){
      $condition[] = "eoq_name='$this->eoq_name'";
    }if(!is_null($this->eoq_stream)){
      $condition[] = "eoq_stream='$this->eoq_stream'";
    }if(!is_null($this->eoq_institute)){
      $condition[] = "eoq_institute='$this->eoq_institute'";
    }if(!is_null($this->eoq_qualification_status)){
      $condition[] = "eoq_qualification_status='$this->eoq_qualification_status'";
    }if(!is_null($this->eoq_year)){
      $condition[] = "eoq_year='$this->eoq_year'";
    }if(!is_null($this->eoq_remarks)){
      $condition[] = "eoq_remarks='$this->eoq_remarks'";
    }if(!is_null($this->eoq_status)){
      $condition[] = "eoq_status='$this->eoq_status'";
    }if(!is_null($this->eoq_is_deleted)){
      $condition[] = "eoq_is_deleted='$this->eoq_is_deleted'";
    }if(!is_null($this->eoq_company_id)){
      $condition[] = "eoq_company_id='$this->eoq_company_id'";
    }if(!is_null($this->eoq_created_by)){
      $condition[] = "eoq_created_by='$this->eoq_created_by'";
    }if(!is_null($this->eoq_created_on)){
      $condition[] = "eoq_created_on='$this->eoq_created_on'";
    }if(!is_null($this->eoq_last_modified_by)){
      $condition[] = "eoq_last_modified_by='$this->eoq_last_modified_by'";
    }if(!is_null($this->eoq_last_modified_on)){
      $condition[] = "eoq_last_modified_on='$this->eoq_last_modified_on'";
    }if(!is_null($this->eoq_deleted_by)){
      $condition[] = "eoq_deleted_by='$this->eoq_deleted_by'";
    }if(!is_null($this->eoq_deleted_on)){
      $condition[] = "eoq_deleted_on='$this->eoq_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eoq_id, eoq_employee_id, eoq_qualification_category_id, eoq_qualification_type_id, eoq_name, eoq_stream, eoq_institute, eoq_qualification_status, eoq_year, eoq_remarks, eoq_status, eoq_is_deleted, eoq_company_id, eoq_created_by, eoq_created_on, eoq_last_modified_by, eoq_last_modified_on, eoq_deleted_by, eoq_deleted_on
          from hrm_trn_other_qualification
          where ".$conditionStr."
          order by eoq_id asc";
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
    
    $model = new cls_hrm_trn_other_qualification($this->db);
  
    $model->eoq_id = $result[0]['eoq_id'];
    $model->eoq_employee_id = $result[0]['eoq_employee_id'];
    $model->eoq_qualification_category_id = $result[0]['eoq_qualification_category_id'];
    $model->eoq_qualification_type_id = $result[0]['eoq_qualification_type_id'];
    $model->eoq_name = $result[0]['eoq_name'];
    $model->eoq_stream = $result[0]['eoq_stream'];
    $model->eoq_institute = $result[0]['eoq_institute'];
    $model->eoq_qualification_status = $result[0]['eoq_qualification_status'];
    $model->eoq_year = $result[0]['eoq_year'];
    $model->eoq_remarks = $result[0]['eoq_remarks'];
    $model->eoq_status = $result[0]['eoq_status'];
    $model->eoq_is_deleted = $result[0]['eoq_is_deleted'];
    $model->eoq_company_id = $result[0]['eoq_company_id'];
    $model->eoq_created_by = $result[0]['eoq_created_by'];
    $model->eoq_created_on = $result[0]['eoq_created_on'];
    $model->eoq_last_modified_by = $result[0]['eoq_last_modified_by'];
    $model->eoq_last_modified_on = $result[0]['eoq_last_modified_on'];
    $model->eoq_deleted_by = $result[0]['eoq_deleted_by'];
    $model->eoq_deleted_on = $result[0]['eoq_deleted_on'];
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
      $model = new cls_hrm_trn_other_qualification($this->db);
  
      $model->eoq_id = $row['eoq_id'];
      $model->eoq_employee_id = $row['eoq_employee_id'];
      $model->eoq_qualification_category_id = $row['eoq_qualification_category_id'];
      $model->eoq_qualification_type_id = $row['eoq_qualification_type_id'];
      $model->eoq_name = $row['eoq_name'];
      $model->eoq_stream = $row['eoq_stream'];
      $model->eoq_institute = $row['eoq_institute'];
      $model->eoq_qualification_status = $row['eoq_qualification_status'];
      $model->eoq_year = $row['eoq_year'];
      $model->eoq_remarks = $row['eoq_remarks'];
      $model->eoq_status = $row['eoq_status'];
      $model->eoq_is_deleted = $row['eoq_is_deleted'];
      $model->eoq_company_id = $row['eoq_company_id'];
      $model->eoq_created_by = $row['eoq_created_by'];
      $model->eoq_created_on = $row['eoq_created_on'];
      $model->eoq_last_modified_by = $row['eoq_last_modified_by'];
      $model->eoq_last_modified_on = $row['eoq_last_modified_on'];
      $model->eoq_deleted_by = $row['eoq_deleted_by'];
      $model->eoq_deleted_on = $row['eoq_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Other Qualification Category
  */
  public function getCategory(){
    $model = new cls_hrm_other_qualification_category($this->db);
    $model->oqc_id = $this->eoq_qualification_category_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->oqc_name;
  }
  /**
  * @return Other Qualification Type
  */
  public function getType(){
    $model = new cls_hrm_other_qualification_type($this->db);
    $model->oqt_id = $this->eoq_qualification_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->oqt_name;
  }
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->eoq_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->eoq_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
  /**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->eoq_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->eoq_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eoq_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->eoq_created_on))?$this->eoq_created_on:date("Y-m-d H:i:s",$this->eoq_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eoq_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->eoq_last_modified_on))?$this->eoq_last_modified_on:date("Y-m-d H:i:s",$this->eoq_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eoq_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->eoq_deleted_on))?$this->eoq_deleted_on:date("Y-m-d H:i:s",$this->eoq_deleted_on);
  }
}
?>

