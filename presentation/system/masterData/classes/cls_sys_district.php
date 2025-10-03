<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "sys_district".
 * @property integer $syd_id
* @property string $syd_name
* @property string $syd_code
* @property integer $syd_province_id
* @property integer $syd_status
* @property integer $syd_company_id
* @property integer $syd_created_by
* @property integer $syd_created_on
* @property integer $syd_last_modified_by
* @property integer $syd_last_modified_on
* @property integer $syd_deleted_by
* @property integer $syd_deleted_on
*/
class cls_sys_district {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_district';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syd_id' => 'Id', 
            'syd_name' => 'Name', 
            'syd_code' => 'Code', 
            'syd_province_id' => 'Province Id', 
            'syd_status' => 'Status', 
            'syd_is_deleted' => 'Is Deleted', 
            'syd_company_id' => 'Company Id', 
            'syd_created_by' => 'Created By', 
            'syd_created_on' => 'Created On', 
            'syd_last_modified_by' => 'Last Modified By', 
            'syd_last_modified_on' => 'Last Modified On', 
            'syd_deleted_by' => 'Deleted By', 
            'syd_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syd_id)){
      $condition[] = "syd_id='$this->syd_id'";
    }if(!is_null($this->syd_name)){
      $condition[] = "syd_name='$this->syd_name'";
    }if(!is_null($this->syd_code)){
      $condition[] = "syd_code='$this->syd_code'";
    }if(!is_null($this->syd_province_id)){
      $condition[] = "syd_province_id='$this->syd_province_id'";
    }if(!is_null($this->syd_status)){
      $condition[] = "syd_status='$this->syd_status'";
    }if(!is_null($this->syd_is_deleted)){
      $condition[] = "syd_is_deleted='$this->syd_is_deleted'";
    }if(!is_null($this->syd_company_id)){
      $condition[] = "syd_company_id='$this->syd_company_id'";
    }if(!is_null($this->syd_created_by)){
      $condition[] = "syd_created_by='$this->syd_created_by'";
    }if(!is_null($this->syd_created_on)){
      $condition[] = "syd_created_on='$this->syd_created_on'";
    }if(!is_null($this->syd_last_modified_by)){
      $condition[] = "syd_last_modified_by='$this->syd_last_modified_by'";
    }if(!is_null($this->syd_last_modified_on)){
      $condition[] = "syd_last_modified_on='$this->syd_last_modified_on'";
    }if(!is_null($this->syd_deleted_by)){
      $condition[] = "syd_deleted_by='$this->syd_deleted_by'";
    }if(!is_null($this->syd_deleted_on)){
      $condition[] = "syd_deleted_on='$this->syd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syd_id, syd_name, syd_code, syd_province_id, syd_status, syd_is_deleted, syd_company_id, syd_created_by, syd_created_on, syd_last_modified_by, syd_last_modified_on, syd_deleted_by, syd_deleted_on
          from sys_district
          where ".$conditionStr."
          order by syd_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syd_id'].'" '; 
      if($this->syd_id == $row['syd_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syd_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syd_id)){
      $condition[] = "syd_id='$this->syd_id'";
    }if(!is_null($this->syd_name)){
      $condition[] = "syd_name='$this->syd_name'";
    }if(!is_null($this->syd_code)){
      $condition[] = "syd_code='$this->syd_code'";
    }if(!is_null($this->syd_province_id)){
      $condition[] = "syd_province_id='$this->syd_province_id'";
    }if(!is_null($this->syd_status)){
      $condition[] = "syd_status='$this->syd_status'";
    }if(!is_null($this->syd_is_deleted)){
      $condition[] = "syd_is_deleted='$this->syd_is_deleted'";
    }if(!is_null($this->syd_company_id)){
      $condition[] = "syd_company_id='$this->syd_company_id'";
    }if(!is_null($this->syd_created_by)){
      $condition[] = "syd_created_by='$this->syd_created_by'";
    }if(!is_null($this->syd_created_on)){
      $condition[] = "syd_created_on='$this->syd_created_on'";
    }if(!is_null($this->syd_last_modified_by)){
      $condition[] = "syd_last_modified_by='$this->syd_last_modified_by'";
    }if(!is_null($this->syd_last_modified_on)){
      $condition[] = "syd_last_modified_on='$this->syd_last_modified_on'";
    }if(!is_null($this->syd_deleted_by)){
      $condition[] = "syd_deleted_by='$this->syd_deleted_by'";
    }if(!is_null($this->syd_deleted_on)){
      $condition[] = "syd_deleted_on='$this->syd_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syd_id, syd_name, syd_code, syd_province_id, syd_status, syd_is_deleted, syd_company_id, syd_created_by, syd_created_on, syd_last_modified_by, syd_last_modified_on, syd_deleted_by, syd_deleted_on
          from sys_district
          where ".$conditionStr."
          order by syd_id asc";
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
    
    $model = new cls_sys_district($this->db);
  
    $model->syd_id = $result[0]['syd_id'];
    $model->syd_name = $result[0]['syd_name'];
    $model->syd_code = $result[0]['syd_code'];
    $model->syd_province_id = $result[0]['syd_province_id'];
    $model->syd_status = $result[0]['syd_status'];
    $model->syd_is_deleted = $result[0]['syd_is_deleted'];
    $model->syd_company_id = $result[0]['syd_company_id'];
    $model->syd_created_by = $result[0]['syd_created_by'];
    $model->syd_created_on = $result[0]['syd_created_on'];
    $model->syd_last_modified_by = $result[0]['syd_last_modified_by'];
    $model->syd_last_modified_on = $result[0]['syd_last_modified_on'];
    $model->syd_deleted_by = $result[0]['syd_deleted_by'];
    $model->syd_deleted_on = $result[0]['syd_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syd_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syd_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syd_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syd_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syd_created_on))?$this->syd_created_on:date("Y-m-d H:i:s",$this->syd_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syd_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syd_last_modified_on))?$this->syd_last_modified_on:date("Y-m-d H:i:s",$this->syd_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syd_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syd_deleted_on))?$this->syd_deleted_on:date("Y-m-d H:i:s",$this->syd_deleted_on);
  }
}
?>

