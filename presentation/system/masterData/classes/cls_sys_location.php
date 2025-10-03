<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-21
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;

/**
 * This is the model class for table "sys_location".
 * @property integer $syl_id
* @property string $syl_code
* @property string $syl_name
* @property string $syl_address
* @property string $syl_street
* @property string $syl_city
* @property string $syl_phone_no
* @property string $syl_fax_no
* @property string $syl_email
* @property string $syl_attendance_format
* @property string $syl_zip_code
* @property string $syl_remarks
* @property integer $syl_status
* @property integer $syl_is_deleted
* @property integer $syl_company_id
* @property integer $syl_created_by
* @property integer $syl_created_on
* @property integer $syl_last_modified_by
* @property integer $syl_last_modified_on
* @property integer $syl_deleted_by
* @property integer $syl_deleted_on
*/
class cls_sys_location {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_location';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syl_id' => 'Id', 
            'syl_code' => 'Code', 
            'syl_name' => 'Name', 
            'syl_address' => 'Address', 
            'syl_street' => 'Street', 
            'syl_city' => 'City', 
            'syl_phone_no' => 'Phone No', 
            'syl_fax_no' => 'Fax No', 
            'syl_email' => 'Email', 
            'syl_attendance_format' => 'Attendance Format', 
            'syl_zip_code' => 'Zip Code', 
            'syl_remarks' => 'Remarks', 
            'syl_status' => 'Status', 
            'syl_is_deleted' => 'Is Deleted', 
            'syl_company_id' => 'Company', 
            'syl_created_by' => 'Created By', 
            'syl_created_on' => 'Created On', 
            'syl_last_modified_by' => 'Last Modified By', 
            'syl_last_modified_on' => 'Last Modified On', 
            'syl_deleted_by' => 'Deleted By', 
            'syl_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syl_id)){
      $condition[] = "syl_id='$this->syl_id'";
    }if(!is_null($this->syl_code)){
      $condition[] = "syl_code='$this->syl_code'";
    }if(!is_null($this->syl_name)){
      $condition[] = "syl_name='$this->syl_name'";
    }if(!is_null($this->syl_address)){
      $condition[] = "syl_address='$this->syl_address'";
    }if(!is_null($this->syl_street)){
      $condition[] = "syl_street='$this->syl_street'";
    }if(!is_null($this->syl_city)){
      $condition[] = "syl_city='$this->syl_city'";
    }if(!is_null($this->syl_phone_no)){
      $condition[] = "syl_phone_no='$this->syl_phone_no'";
    }if(!is_null($this->syl_fax_no)){
      $condition[] = "syl_fax_no='$this->syl_fax_no'";
    }if(!is_null($this->syl_email)){
      $condition[] = "syl_email='$this->syl_email'";
    }if(!is_null($this->syl_attendance_format)){
      $condition[] = "syl_attendance_format='$this->syl_attendance_format'";
    }if(!is_null($this->syl_zip_code)){
      $condition[] = "syl_zip_code='$this->syl_zip_code'";
    }if(!is_null($this->syl_remarks)){
      $condition[] = "syl_remarks='$this->syl_remarks'";
    }if(!is_null($this->syl_status)){
      $condition[] = "syl_status='$this->syl_status'";
    }if(!is_null($this->syl_is_deleted)){
      $condition[] = "syl_is_deleted='$this->syl_is_deleted'";
    }if(!is_null($this->syl_company_id)){
      $condition[] = "syl_company_id='$this->syl_company_id'";
    }if(!is_null($this->syl_created_by)){
      $condition[] = "syl_created_by='$this->syl_created_by'";
    }if(!is_null($this->syl_created_on)){
      $condition[] = "syl_created_on='$this->syl_created_on'";
    }if(!is_null($this->syl_last_modified_by)){
      $condition[] = "syl_last_modified_by='$this->syl_last_modified_by'";
    }if(!is_null($this->syl_last_modified_on)){
      $condition[] = "syl_last_modified_on='$this->syl_last_modified_on'";
    }if(!is_null($this->syl_deleted_by)){
      $condition[] = "syl_deleted_by='$this->syl_deleted_by'";
    }if(!is_null($this->syl_deleted_on)){
      $condition[] = "syl_deleted_on='$this->syl_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syl_id, syl_code, syl_name, syl_address, syl_street, syl_city, syl_phone_no, syl_fax_no, syl_email, syl_attendance_format, syl_zip_code, syl_remarks, syl_status, syl_is_deleted, syl_company_id, syl_created_by, syl_created_on, syl_last_modified_by, syl_last_modified_on, syl_deleted_by, syl_deleted_on
          from sys_location
          where ".$conditionStr."
          order by syl_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syl_id'].'" '; 
      if($this->syl_id == $row['syl_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syl_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syl_id)){
      $condition[] = "syl_id='$this->syl_id'";
    }if(!is_null($this->syl_code)){
      $condition[] = "syl_code='$this->syl_code'";
    }if(!is_null($this->syl_name)){
      $condition[] = "syl_name='$this->syl_name'";
    }if(!is_null($this->syl_address)){
      $condition[] = "syl_address='$this->syl_address'";
    }if(!is_null($this->syl_street)){
      $condition[] = "syl_street='$this->syl_street'";
    }if(!is_null($this->syl_city)){
      $condition[] = "syl_city='$this->syl_city'";
    }if(!is_null($this->syl_phone_no)){
      $condition[] = "syl_phone_no='$this->syl_phone_no'";
    }if(!is_null($this->syl_fax_no)){
      $condition[] = "syl_fax_no='$this->syl_fax_no'";
    }if(!is_null($this->syl_email)){
      $condition[] = "syl_email='$this->syl_email'";
    }if(!is_null($this->syl_attendance_format)){
      $condition[] = "syl_attendance_format='$this->syl_attendance_format'";
    }if(!is_null($this->syl_zip_code)){
      $condition[] = "syl_zip_code='$this->syl_zip_code'";
    }if(!is_null($this->syl_remarks)){
      $condition[] = "syl_remarks='$this->syl_remarks'";
    }if(!is_null($this->syl_status)){
      $condition[] = "syl_status='$this->syl_status'";
    }if(!is_null($this->syl_is_deleted)){
      $condition[] = "syl_is_deleted='$this->syl_is_deleted'";
    }if(!is_null($this->syl_company_id)){
      $condition[] = "syl_company_id='$this->syl_company_id'";
    }if(!is_null($this->syl_created_by)){
      $condition[] = "syl_created_by='$this->syl_created_by'";
    }if(!is_null($this->syl_created_on)){
      $condition[] = "syl_created_on='$this->syl_created_on'";
    }if(!is_null($this->syl_last_modified_by)){
      $condition[] = "syl_last_modified_by='$this->syl_last_modified_by'";
    }if(!is_null($this->syl_last_modified_on)){
      $condition[] = "syl_last_modified_on='$this->syl_last_modified_on'";
    }if(!is_null($this->syl_deleted_by)){
      $condition[] = "syl_deleted_by='$this->syl_deleted_by'";
    }if(!is_null($this->syl_deleted_on)){
      $condition[] = "syl_deleted_on='$this->syl_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syl_id, syl_code, syl_name, syl_address, syl_street, syl_city, syl_phone_no, syl_fax_no, syl_email, syl_attendance_format, syl_zip_code, syl_remarks, syl_status, syl_is_deleted, syl_company_id, syl_created_by, syl_created_on, syl_last_modified_by, syl_last_modified_on, syl_deleted_by, syl_deleted_on
          from sys_location
          where ".$conditionStr."
          order by syl_id asc";
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
    
    $model = new cls_sys_location($this->db);
  
    $model->syl_id = $result[0]['syl_id'];
    $model->syl_code = $result[0]['syl_code'];
    $model->syl_name = $result[0]['syl_name'];
    $model->syl_address = $result[0]['syl_address'];
    $model->syl_street = $result[0]['syl_street'];
    $model->syl_city = $result[0]['syl_city'];
    $model->syl_phone_no = $result[0]['syl_phone_no'];
    $model->syl_fax_no = $result[0]['syl_fax_no'];
    $model->syl_email = $result[0]['syl_email'];
    $model->syl_attendance_format = $result[0]['syl_attendance_format'];
    $model->syl_zip_code = $result[0]['syl_zip_code'];
    $model->syl_remarks = $result[0]['syl_remarks'];
    $model->syl_status = $result[0]['syl_status'];
    $model->syl_is_deleted = $result[0]['syl_is_deleted'];
    $model->syl_company_id = $result[0]['syl_company_id'];
    $model->syl_created_by = $result[0]['syl_created_by'];
    $model->syl_created_on = $result[0]['syl_created_on'];
    $model->syl_last_modified_by = $result[0]['syl_last_modified_by'];
    $model->syl_last_modified_on = $result[0]['syl_last_modified_on'];
    $model->syl_deleted_by = $result[0]['syl_deleted_by'];
    $model->syl_deleted_on = $result[0]['syl_deleted_on'];
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
      $model = new cls_sys_location($this->db);
  
      $model->syl_id = $row['syl_id'];
      $model->syl_code = $row['syl_code'];
      $model->syl_name = $row['syl_name'];
      $model->syl_address = $row['syl_address'];
      $model->syl_street = $row['syl_street'];
      $model->syl_city = $row['syl_city'];
      $model->syl_phone_no = $row['syl_phone_no'];
      $model->syl_fax_no = $row['syl_fax_no'];
      $model->syl_email = $row['syl_email'];
      $model->syl_attendance_format = $row['syl_attendance_format'];
      $model->syl_zip_code = $row['syl_zip_code'];
      $model->syl_remarks = $row['syl_remarks'];
      $model->syl_status = $row['syl_status'];
      $model->syl_is_deleted = $row['syl_is_deleted'];
      $model->syl_company_id = $row['syl_company_id'];
      $model->syl_created_by = $row['syl_created_by'];
      $model->syl_created_on = $row['syl_created_on'];
      $model->syl_last_modified_by = $row['syl_last_modified_by'];
      $model->syl_last_modified_on = $row['syl_last_modified_on'];
      $model->syl_deleted_by = $row['syl_deleted_by'];
      $model->syl_deleted_on = $row['syl_deleted_on'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->syl_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->syl_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syl_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syl_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syl_created_on))?$this->syl_created_on:date("Y-m-d H:i:s",$this->syl_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syl_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syl_last_modified_on))?$this->syl_last_modified_on:date("Y-m-d H:i:s",$this->syl_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syl_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syl_deleted_on))?$this->syl_deleted_on:date("Y-m-d H:i:s",$this->syl_deleted_on);
  }
}
?>

