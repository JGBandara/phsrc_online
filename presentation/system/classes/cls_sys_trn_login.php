<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-17
 */
namespace presentation\system\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_location;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "sys_trn_login".
 * @property integer $tlg_id
* @property integer $tlg_user_id
* @property integer $tlg_company_id
* @property integer $tlg_location_id
* @property string $tlg_ip_address
* @property string $tlg_login_datetime
* @property string $tlg_login_out_datetime
* @property string $tlg_remarks
*/
class cls_sys_trn_login {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_trn_login';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'tlg_id' => 'Id', 
            'tlg_user_id' => 'User Id', 
            'tlg_company_id' => 'Company Id', 
            'tlg_location_id' => 'Location Id', 
            'tlg_ip_address' => 'Ip Address', 
            'tlg_login_datetime' => 'Login Datetime', 
            'tlg_login_out_datetime' => 'Login Out Datetime', 
            'tlg_remarks' => 'Remarks',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->tlg_id)){
      $condition[] = "tlg_id='$this->tlg_id'";
    }if(!is_null($this->tlg_user_id)){
      $condition[] = "tlg_user_id='$this->tlg_user_id'";
    }if(!is_null($this->tlg_company_id)){
      $condition[] = "tlg_company_id='$this->tlg_company_id'";
    }if(!is_null($this->tlg_location_id)){
      $condition[] = "tlg_location_id='$this->tlg_location_id'";
    }if(!is_null($this->tlg_ip_address)){
      $condition[] = "tlg_ip_address='$this->tlg_ip_address'";
    }if(!is_null($this->tlg_login_datetime)){
      $condition[] = "tlg_login_datetime='$this->tlg_login_datetime'";
    }if(!is_null($this->tlg_login_out_datetime)){
      $condition[] = "tlg_login_out_datetime='$this->tlg_login_out_datetime'";
    }if(!is_null($this->tlg_remarks)){
      $condition[] = "tlg_remarks='$this->tlg_remarks'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select tlg_id, tlg_user_id, tlg_company_id, tlg_location_id, tlg_ip_address, tlg_login_datetime, tlg_login_out_datetime, tlg_remarks
          from sys_trn_login
          where ".$conditionStr."
          order by tlg_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['tlg_id'].'" '; 
      if($this->tlg_id == $row['tlg_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['tlg_user_id'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->tlg_id)){
      $condition[] = "tlg_id='$this->tlg_id'";
    }if(!is_null($this->tlg_user_id)){
      $condition[] = "tlg_user_id='$this->tlg_user_id'";
    }if(!is_null($this->tlg_company_id)){
      $condition[] = "tlg_company_id='$this->tlg_company_id'";
    }if(!is_null($this->tlg_location_id)){
      $condition[] = "tlg_location_id='$this->tlg_location_id'";
    }if(!is_null($this->tlg_ip_address)){
      $condition[] = "tlg_ip_address='$this->tlg_ip_address'";
    }if(!is_null($this->tlg_login_datetime)){
      $condition[] = "tlg_login_datetime='$this->tlg_login_datetime'";
    }if(!is_null($this->tlg_login_out_datetime)){
      $condition[] = "tlg_login_out_datetime='$this->tlg_login_out_datetime'";
    }if(!is_null($this->tlg_remarks)){
      $condition[] = "tlg_remarks='$this->tlg_remarks'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select tlg_id, tlg_user_id, tlg_company_id, tlg_location_id, tlg_ip_address, if(tlg_login_datetime='0000-00-00 00:00:00','',tlg_login_datetime) as `tlg_login_datetime`, if(tlg_login_out_datetime='0000-00-00 00:00:00','',tlg_login_out_datetime) as `tlg_login_out_datetime`, tlg_remarks
          from sys_trn_login
          where ".$conditionStr."
          order by tlg_id asc";
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
    
    $model = new cls_sys_trn_login($this->db);
  
    $model->tlg_id = $result[0]['tlg_id'];
    $model->tlg_user_id = $result[0]['tlg_user_id'];
    $model->tlg_company_id = $result[0]['tlg_company_id'];
    $model->tlg_location_id = $result[0]['tlg_location_id'];
    $model->tlg_ip_address = $result[0]['tlg_ip_address'];
    $model->tlg_login_datetime = ($result[0]['tlg_login_datetime']=='0000-00-00 00:00:00')?'':$result[0]['tlg_login_datetime'];
    $model->tlg_login_out_datetime = ($result[0]['tlg_login_out_datetime']=='0000-00-00 00:00:00')?'':$result[0]['tlg_login_out_datetime'];
    $model->tlg_remarks = $result[0]['tlg_remarks'];
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
      $model = new cls_sys_trn_login($this->db);
  
      $model->tlg_id = $row['tlg_id'];
      $model->tlg_user_id = $row['tlg_user_id'];
      $model->tlg_company_id = $row['tlg_company_id'];
      $model->tlg_location_id = $row['tlg_location_id'];
      $model->tlg_ip_address = $row['tlg_ip_address'];
      $model->tlg_login_datetime = ($row['tlg_login_datetime']=='0000-00-00 00:00:00')?'':$row['tlg_login_datetime'];
      $model->tlg_login_out_datetime = ($row['tlg_login_out_datetime']=='0000-00-00 00:00:00')?'':$row['tlg_login_out_datetime'];
      $model->tlg_remarks = $row['tlg_remarks'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Company
  */
  public function getUser(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tlg_user_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Company
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->tlg_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->tlg_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->tlg_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->tlg_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tlg_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->tlg_created_on))?$this->tlg_created_on:date("Y-m-d H:i:s",$this->tlg_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tlg_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->tlg_last_modified_on))?$this->tlg_last_modified_on:date("Y-m-d H:i:s",$this->tlg_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->tlg_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->tlg_deleted_on))?$this->tlg_deleted_on:date("Y-m-d H:i:s",$this->tlg_deleted_on);
  }
}
?>

