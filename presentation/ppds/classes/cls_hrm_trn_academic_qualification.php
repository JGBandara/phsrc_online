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
use presentation\hrm\classes\cls_hrm_trn_academic_qualification_details;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_academic_qualification_stream;
use presentation\hrm\masterData\classes\cls_hrm_academic_qualification_type;


/**
 * This is the model class for table "hrm_trn_academic_qualification".
 * @property integer $eaq_id
* @property integer $eaq_employee_id
* @property integer $eaq_type_id
* @property integer $eaq_stream_id
* @property string $eaq_institute
* @property string $eaq_year
* @property string $eaq_index_no
* @property string $eaq_remarks
* @property integer $eaq_status
* @property integer $eaq_is_deleted
* @property integer $eaq_location_id
* @property integer $eaq_company_id
* @property integer $eaq_created_by
* @property integer $eaq_created_on
* @property integer $eaq_last_modified_by
* @property integer $eaq_last_modified_on
* @property integer $eaq_deleted_by
* @property integer $eaq_deleted_on
*/
class cls_hrm_trn_academic_qualification {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_trn_academic_qualification';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'eaq_id' => 'Id', 
            'eaq_employee_id' => 'Employee', 
            'eaq_type_id' => 'Type', 
            'eaq_stream_id' => 'Stream', 
            'eaq_institute' => 'Institute', 
            'eaq_year' => 'Year', 
            'eaq_index_no' => 'Index No', 
            'eaq_remarks' => 'Remarks', 
            'eaq_status' => 'Status', 
            'eaq_is_deleted' => 'Is Deleted', 
            'eaq_location_id' => 'Location', 
            'eaq_company_id' => 'Company', 
            'eaq_created_by' => 'Created By', 
            'eaq_created_on' => 'Created On', 
            'eaq_last_modified_by' => 'Last Modified By', 
            'eaq_last_modified_on' => 'Last Modified On', 
            'eaq_deleted_by' => 'Deleted By', 
            'eaq_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->eaq_id)){
      $condition[] = "eaq_id='$this->eaq_id'";
    }if(!is_null($this->eaq_employee_id)){
      $condition[] = "eaq_employee_id='$this->eaq_employee_id'";
    }if(!is_null($this->eaq_type_id)){
      $condition[] = "eaq_type_id='$this->eaq_type_id'";
    }if(!is_null($this->eaq_stream_id)){
      $condition[] = "eaq_stream_id='$this->eaq_stream_id'";
    }if(!is_null($this->eaq_institute)){
      $condition[] = "eaq_institute='$this->eaq_institute'";
    }if(!is_null($this->eaq_year)){
      $condition[] = "eaq_year='$this->eaq_year'";
    }if(!is_null($this->eaq_index_no)){
      $condition[] = "eaq_index_no='$this->eaq_index_no'";
    }if(!is_null($this->eaq_remarks)){
      $condition[] = "eaq_remarks='$this->eaq_remarks'";
    }if(!is_null($this->eaq_status)){
      $condition[] = "eaq_status='$this->eaq_status'";
    }if(!is_null($this->eaq_is_deleted)){
      $condition[] = "eaq_is_deleted='$this->eaq_is_deleted'";
    }if(!is_null($this->eaq_location_id)){
      $condition[] = "eaq_location_id='$this->eaq_location_id'";
    }if(!is_null($this->eaq_company_id)){
      $condition[] = "eaq_company_id='$this->eaq_company_id'";
    }if(!is_null($this->eaq_created_by)){
      $condition[] = "eaq_created_by='$this->eaq_created_by'";
    }if(!is_null($this->eaq_created_on)){
      $condition[] = "eaq_created_on='$this->eaq_created_on'";
    }if(!is_null($this->eaq_last_modified_by)){
      $condition[] = "eaq_last_modified_by='$this->eaq_last_modified_by'";
    }if(!is_null($this->eaq_last_modified_on)){
      $condition[] = "eaq_last_modified_on='$this->eaq_last_modified_on'";
    }if(!is_null($this->eaq_deleted_by)){
      $condition[] = "eaq_deleted_by='$this->eaq_deleted_by'";
    }if(!is_null($this->eaq_deleted_on)){
      $condition[] = "eaq_deleted_on='$this->eaq_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eaq_id, eaq_employee_id, eaq_type_id, eaq_stream_id, eaq_institute, eaq_year, eaq_index_no, eaq_remarks, eaq_status, eaq_is_deleted, eaq_location_id, eaq_company_id, eaq_created_by, eaq_created_on, eaq_last_modified_by, eaq_last_modified_on, eaq_deleted_by, eaq_deleted_on, emi_calling_name, emi_no, aqt_name, ifnull(aqs_name,'') as 'aqs_name' 
          from hrm_trn_academic_qualification
              inner join hrm_employee_information on emi_id=eaq_employee_id
              inner join hrm_academic_qualification_type on eaq_type_id=aqt_id
              left join hrm_academic_qualification_stream on eaq_stream_id=aqs_id
          where ".$conditionStr."
          order by eaq_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['eaq_id'].'" '; 
      if($this->eaq_id == $row['eaq_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['emi_no'].' - '.$row['emi_calling_name'].' - '. $row['aqt_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->eaq_id)){
      $condition[] = "eaq_id='$this->eaq_id'";
    }if(!is_null($this->eaq_employee_id)){
      $condition[] = "eaq_employee_id='$this->eaq_employee_id'";
    }if(!is_null($this->eaq_type_id)){
      $condition[] = "eaq_type_id='$this->eaq_type_id'";
    }if(!is_null($this->eaq_stream_id)){
      $condition[] = "eaq_stream_id='$this->eaq_stream_id'";
    }if(!is_null($this->eaq_institute)){
      $condition[] = "eaq_institute='$this->eaq_institute'";
    }if(!is_null($this->eaq_year)){
      $condition[] = "eaq_year='$this->eaq_year'";
    }if(!is_null($this->eaq_index_no)){
      $condition[] = "eaq_index_no='$this->eaq_index_no'";
    }if(!is_null($this->eaq_remarks)){
      $condition[] = "eaq_remarks='$this->eaq_remarks'";
    }if(!is_null($this->eaq_status)){
      $condition[] = "eaq_status='$this->eaq_status'";
    }if(!is_null($this->eaq_is_deleted)){
      $condition[] = "eaq_is_deleted='$this->eaq_is_deleted'";
    }if(!is_null($this->eaq_location_id)){
      $condition[] = "eaq_location_id='$this->eaq_location_id'";
    }if(!is_null($this->eaq_company_id)){
      $condition[] = "eaq_company_id='$this->eaq_company_id'";
    }if(!is_null($this->eaq_created_by)){
      $condition[] = "eaq_created_by='$this->eaq_created_by'";
    }if(!is_null($this->eaq_created_on)){
      $condition[] = "eaq_created_on='$this->eaq_created_on'";
    }if(!is_null($this->eaq_last_modified_by)){
      $condition[] = "eaq_last_modified_by='$this->eaq_last_modified_by'";
    }if(!is_null($this->eaq_last_modified_on)){
      $condition[] = "eaq_last_modified_on='$this->eaq_last_modified_on'";
    }if(!is_null($this->eaq_deleted_by)){
      $condition[] = "eaq_deleted_by='$this->eaq_deleted_by'";
    }if(!is_null($this->eaq_deleted_on)){
      $condition[] = "eaq_deleted_on='$this->eaq_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){
      $conditionStr .= " and ".$cond;
    }
    $sql = "select eaq_id, eaq_employee_id, eaq_type_id, eaq_stream_id, eaq_institute, eaq_year, eaq_index_no, eaq_remarks, eaq_status, eaq_is_deleted, eaq_location_id, eaq_company_id, eaq_created_by, eaq_created_on, eaq_last_modified_by, eaq_last_modified_on, eaq_deleted_by, eaq_deleted_on
          from hrm_trn_academic_qualification
          where ".$conditionStr."
          order by eaq_id asc";
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
    
    $model = new cls_hrm_trn_academic_qualification($this->db);
  
    $model->eaq_id = $result[0]['eaq_id'];
    $model->eaq_employee_id = $result[0]['eaq_employee_id'];
    $model->eaq_type_id = $result[0]['eaq_type_id'];
    $model->eaq_stream_id = $result[0]['eaq_stream_id'];
    $model->eaq_institute = $result[0]['eaq_institute'];
    $model->eaq_year = $result[0]['eaq_year'];
    $model->eaq_index_no = $result[0]['eaq_index_no'];
    $model->eaq_remarks = $result[0]['eaq_remarks'];
    $model->eaq_status = $result[0]['eaq_status'];
    $model->eaq_is_deleted = $result[0]['eaq_is_deleted'];
    $model->eaq_location_id = $result[0]['eaq_location_id'];
    $model->eaq_company_id = $result[0]['eaq_company_id'];
    $model->eaq_created_by = $result[0]['eaq_created_by'];
    $model->eaq_created_on = $result[0]['eaq_created_on'];
    $model->eaq_last_modified_by = $result[0]['eaq_last_modified_by'];
    $model->eaq_last_modified_on = $result[0]['eaq_last_modified_on'];
    $model->eaq_deleted_by = $result[0]['eaq_deleted_by'];
    $model->eaq_deleted_on = $result[0]['eaq_deleted_on'];
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
      $model = new cls_hrm_trn_academic_qualification($this->db);
  
      $model->eaq_id = $row['eaq_id'];
      $model->eaq_employee_id = $row['eaq_employee_id'];
      $model->eaq_type_id = $row['eaq_type_id'];
      $model->eaq_stream_id = $row['eaq_stream_id'];
      $model->eaq_institute = $row['eaq_institute'];
      $model->eaq_year = $row['eaq_year'];
      $model->eaq_index_no = $row['eaq_index_no'];
      $model->eaq_remarks = $row['eaq_remarks'];
      $model->eaq_status = $row['eaq_status'];
      $model->eaq_is_deleted = $row['eaq_is_deleted'];
      $model->eaq_location_id = $row['eaq_location_id'];
      $model->eaq_company_id = $row['eaq_company_id'];
      $model->eaq_created_by = $row['eaq_created_by'];
      $model->eaq_created_on = $row['eaq_created_on'];
      $model->eaq_last_modified_by = $row['eaq_last_modified_by'];
      $model->eaq_last_modified_on = $row['eaq_last_modified_on'];
      $model->eaq_deleted_by = $row['eaq_deleted_by'];
      $model->eaq_deleted_on = $row['eaq_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Stream
  */
  public function getStream(){
    $model = new cls_hrm_academic_qualification_stream($this->db);
    $model->aqs_id = $this->eaq_stream_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->aqs_name;
  } 
  /**
  * @return Type
  */
  public function getType(){
    $model = new cls_hrm_academic_qualification_type($this->db);
    $model->aqt_id = $this->eaq_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->aqt_name;
  } 
  /**
  * @return Employee Information
  */
  public function getEmployeeInformation(){
    $model = new cls_hrm_employee_information($this->db);
    $model->emi_id = $this->eaq_employee_id;
    return (is_null($model->getRecords()))? $model :$model->findModel();
  }
  /**
  * @return academicQualificationDetailRecords 
  */
  public function getDetailRecordsAcademicQualification(){
    $model = new cls_hrm_trn_academic_qualification_details($this->db);
    $model->eaqd_qualification_id = $this->eaq_id;
    $model->eaqd_company_id = $this->eaq_company_id;
    $model->eaqd_is_deleted = 0;
    return $model->getRecords();
  }
  /**
  * @return academicQualificationDetailModels 
  */
  public function getDetailModelsAcademicQualification(){
    $model = new cls_hrm_trn_academic_qualification_details($this->db);
    $model->eaqd_qualification_id = $this->eaq_id;
    $model->eaqd_company_id = $this->eaq_company_id;
    $model->eaqd_is_deleted = 0;
    return $model->getModels();
  }
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->eaq_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->eaq_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->eaq_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->eaq_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eaq_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->eaq_created_on))?$this->eaq_created_on:date("Y-m-d H:i:s",$this->eaq_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eaq_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->eaq_last_modified_on))?$this->eaq_last_modified_on:date("Y-m-d H:i:s",$this->eaq_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->eaq_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->eaq_deleted_on))?$this->eaq_deleted_on:date("Y-m-d H:i:s",$this->eaq_deleted_on);
  }
}
?>

