<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "hrm_employee_information".
 * @property integer $emi_id
* @property string $emi_no
* @property string $emi_calling_name
* @property string $emi_epf_no
* @property string $emi_finger_print_no
* @property string $emi_joined_date
* @property string $emi_permanent_date
* @property string $emi_confirm_date
* @property string $emi_resigned_date
* @property string $emi_retirement_date
* @property string $emi_image_name
* @property string $emi_remarks
* @property integer $emi_status
* @property integer $emi_is_deleted
* @property integer $emi_company_id
* @property integer $emi_created_by
* @property integer $emi_created_on
* @property integer $emi_last_modified_by
* @property integer $emi_last_modified_on
* @property integer $emi_deleted_by
* @property integer $emi_deleted_on
*/
class cls_institute_information{
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'fpds_new_registration';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'fpds_application_id' => 'fpds_application_id', 
            'fpds_owner_name' => 'fpds_owner_name', 
            'fpds_owner_relationship' => 'fpds_owner_relationship', 
            'fpds_owner_address' => 'fpds_owner_address', 
            'fpds_institute_name' => 'fpds_institute_name', 
            'fpds_institute_address' => 'fpds_institute_address', 
            'fpds_province_id' => 'fpds_province_id',
			'fpds_district_id' => 'fpds_district_id',
			'fpds_is_deleted'=> 'fpds_is_deleted'
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->fpds_application_id)){
      $condition[] = "fpds_application_id='$this->fpds_application_id'";
    }if(!is_null($this->fpds_owner_name)){
      $condition[] = "fpds_owner_name='$this->fpds_owner_name'";
    }if(!is_null($this->fpds_owner_relationship)){
      $condition[] = "fpds_owner_relationship='$this->fpds_owner_relationship'";
    }if(!is_null($this->fpds_owner_address)){
      $condition[] = "fpds_owner_address='$this->fpds_owner_address'";
    }if(!is_null($this->fpds_institute_name)){
      $condition[] = "fpds_institute_name='$this->fpds_institute_name'";
    }if(!is_null($this->fpds_institute_address)){
      $condition[] = "fpds_institute_address='$this->fpds_institute_address'";
    }if(!is_null($this->fpds_province_id)){
      $condition[] = "fpds_province_id='$this->fpds_province_id'";
    }if(!is_null($this->fpds_district_id)){
      $condition[] = "fpds_district_id='$this->fpds_district_id'";
	}if(!is_null($this->fpds_is_deleted)){
      $condition[] = "fpds_is_deleted='$this->fpds_is_deleted'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "SELECT
fpds_new_registration.fpds_application_id,
fpds_new_registration.fpds_owner_name,
fpds_new_registration.fpds_owner_relationship,
fpds_new_registration.fpds_owner_address,
fpds_new_registration.fpds_institute_name,
fpds_new_registration.fpds_institute_address,
fpds_new_registration.fpds_province_id,
fpds_new_registration.fpds_district_id,
fpds_new_registration.fpds_is_deleted
FROM
fpds_new_registration
          order by fpds_new_registration.fpds_application_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['fpds_application_id'].'" '; 
      if($this->fpds_application_id == $row['fpds_application_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['fpds_application_id'].' - '.$row['fpds_institute_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
   if(!is_null($this->fpds_application_id)){
      $condition[] = "fpds_application_id='$this->fpds_application_id'";
    }if(!is_null($this->fpds_owner_name)){
      $condition[] = "fpds_owner_name='$this->fpds_owner_name'";
    }if(!is_null($this->fpds_owner_relationship)){
      $condition[] = "fpds_owner_relationship='$this->fpds_owner_relationship'";
    }if(!is_null($this->fpds_owner_address)){
      $condition[] = "fpds_owner_address='$this->fpds_owner_address'";
    }if(!is_null($this->fpds_institute_name)){
      $condition[] = "fpds_institute_name='$this->fpds_institute_name'";
    }if(!is_null($this->fpds_institute_address)){
      $condition[] = "fpds_institute_address='$this->fpds_institute_address'";
    }if(!is_null($this->fpds_province_id)){
      $condition[] = "fpds_province_id='$this->fpds_province_id'";
    }if(!is_null($this->fpds_district_id)){
      $condition[] = "fpds_district_id='$this->fpds_district_id'";
	}if(!is_null($this->fpds_is_deleted)){
      $condition[] = "fpds_is_deleted='$this->fpds_is_deleted'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "SELECT
fpds_new_registration.fpds_application_id,
fpds_new_registration.fpds_owner_name,
fpds_new_registration.fpds_owner_relationship,
fpds_new_registration.fpds_owner_address,
fpds_new_registration.fpds_institute_name,
fpds_new_registration.fpds_institute_address,
fpds_new_registration.fpds_province_id,
fpds_new_registration.fpds_district_id,
fpds_new_registration.fpds_is_deleted
FROM
fpds_new_registration
          order by fpds_application_id asc";
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
    
    $model = new cls_institute_information($this->db);
  
    $model->fpds_application_id = $result[0]['fpds_application_id'];
    $model->fpds_owner_name = $result[0]['fpds_owner_name'];
    $model->fpds_owner_relationship = $result[0]['fpds_owner_relationship'];
    $model->fpds_owner_address = $result[0]['fpds_owner_address'];
    $model->fpds_institute_name = $result[0]['fpds_institute_name'];
    $model->fpds_institute_address = $result[0]['fpds_institute_address'];
    $model->fpds_province_id = $result[0]['fpds_province_id'];
    $model->fpds_district_id = $result[0]['fpds_district_id'];
	$model->fpds_is_deleted=$result[0]['fpds_is_deleted'];
    return $model;
  }
  /**
  * @return Delete Status
  */
 
}
?>

