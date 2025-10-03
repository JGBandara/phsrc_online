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
 * This is the model class for table "sys_ds_division".
 * @property integer $syi_id
* @property string $syi_name
* @property string $syi_code
* @property integer $syi_district_id
* @property integer $syi_status
* @property integer $syi_company_id
* @property integer $syi_created_by
* @property integer $syi_created_on
* @property integer $syi_last_modified_by
* @property integer $syi_last_modified_on
* @property integer $syi_deleted_by
* @property integer $syi_deleted_on
*/
class cls_sys_ds_division {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_ds_division';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syi_id' => 'Id', 
            'syi_name' => 'Name', 
            'syi_code' => 'Code', 
            'syi_district_id' => 'District Id', 
            'syi_status' => 'Status', 
            'syi_is_deleted' => 'Is Deleted', 
            'syi_company_id' => 'Company Id', 
            'syi_created_by' => 'Created By', 
            'syi_created_on' => 'Created On', 
            'syi_last_modified_by' => 'Last Modified By', 
            'syi_last_modified_on' => 'Last Modified On', 
            'syi_deleted_by' => 'Deleted By', 
            'syi_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syi_id)){
      $condition[] = "syi_id='$this->syi_id'";
    }if(!is_null($this->syi_name)){
      $condition[] = "syi_name='$this->syi_name'";
    }if(!is_null($this->syi_code)){
      $condition[] = "syi_code='$this->syi_code'";
    }if(!is_null($this->syi_district_id)){
      $condition[] = "syi_district_id='$this->syi_district_id'";
    }if(!is_null($this->syi_status)){
      $condition[] = "syi_status='$this->syi_status'";
    }if(!is_null($this->syi_is_deleted)){
      $condition[] = "syi_is_deleted='$this->syi_is_deleted'";
    }if(!is_null($this->syi_company_id)){
      $condition[] = "syi_company_id='$this->syi_company_id'";
    }if(!is_null($this->syi_created_by)){
      $condition[] = "syi_created_by='$this->syi_created_by'";
    }if(!is_null($this->syi_created_on)){
      $condition[] = "syi_created_on='$this->syi_created_on'";
    }if(!is_null($this->syi_last_modified_by)){
      $condition[] = "syi_last_modified_by='$this->syi_last_modified_by'";
    }if(!is_null($this->syi_last_modified_on)){
      $condition[] = "syi_last_modified_on='$this->syi_last_modified_on'";
    }if(!is_null($this->syi_deleted_by)){
      $condition[] = "syi_deleted_by='$this->syi_deleted_by'";
    }if(!is_null($this->syi_deleted_on)){
      $condition[] = "syi_deleted_on='$this->syi_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syi_id, syi_name, syi_code, syi_district_id, syi_status, syi_is_deleted, syi_company_id, syi_created_by, syi_created_on, syi_last_modified_by, syi_last_modified_on, syi_deleted_by, syi_deleted_on
          from sys_ds_division
          where ".$conditionStr."
          order by syi_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syi_id'].'" '; 
      if($this->syi_id == $row['syi_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syi_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syi_id)){
      $condition[] = "syi_id='$this->syi_id'";
    }if(!is_null($this->syi_name)){
      $condition[] = "syi_name='$this->syi_name'";
    }if(!is_null($this->syi_code)){
      $condition[] = "syi_code='$this->syi_code'";
    }if(!is_null($this->syi_district_id)){
      $condition[] = "syi_district_id='$this->syi_district_id'";
    }if(!is_null($this->syi_status)){
      $condition[] = "syi_status='$this->syi_status'";
    }if(!is_null($this->syi_is_deleted)){
      $condition[] = "syi_is_deleted='$this->syi_is_deleted'";
    }if(!is_null($this->syi_company_id)){
      $condition[] = "syi_company_id='$this->syi_company_id'";
    }if(!is_null($this->syi_created_by)){
      $condition[] = "syi_created_by='$this->syi_created_by'";
    }if(!is_null($this->syi_created_on)){
      $condition[] = "syi_created_on='$this->syi_created_on'";
    }if(!is_null($this->syi_last_modified_by)){
      $condition[] = "syi_last_modified_by='$this->syi_last_modified_by'";
    }if(!is_null($this->syi_last_modified_on)){
      $condition[] = "syi_last_modified_on='$this->syi_last_modified_on'";
    }if(!is_null($this->syi_deleted_by)){
      $condition[] = "syi_deleted_by='$this->syi_deleted_by'";
    }if(!is_null($this->syi_deleted_on)){
      $condition[] = "syi_deleted_on='$this->syi_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syi_id, syi_name, syi_code, syi_district_id, syi_status, syi_is_deleted, syi_company_id, syi_created_by, syi_created_on, syi_last_modified_by, syi_last_modified_on, syi_deleted_by, syi_deleted_on
          from sys_ds_division
          where ".$conditionStr."
          order by syi_id asc";
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
    
    $model = new cls_sys_ds_division($this->db);
  
    $model->syi_id = $result[0]['syi_id'];
    $model->syi_name = $result[0]['syi_name'];
    $model->syi_code = $result[0]['syi_code'];
    $model->syi_district_id = $result[0]['syi_district_id'];
    $model->syi_status = $result[0]['syi_status'];
    $model->syi_is_deleted = $result[0]['syi_is_deleted'];
    $model->syi_company_id = $result[0]['syi_company_id'];
    $model->syi_created_by = $result[0]['syi_created_by'];
    $model->syi_created_on = $result[0]['syi_created_on'];
    $model->syi_last_modified_by = $result[0]['syi_last_modified_by'];
    $model->syi_last_modified_on = $result[0]['syi_last_modified_on'];
    $model->syi_deleted_by = $result[0]['syi_deleted_by'];
    $model->syi_deleted_on = $result[0]['syi_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syi_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syi_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syi_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syi_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syi_created_on))?$this->syi_created_on:date("Y-m-d H:i:s",$this->syi_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syi_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syi_last_modified_on))?$this->syi_last_modified_on:date("Y-m-d H:i:s",$this->syi_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syi_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syi_deleted_on))?$this->syi_deleted_on:date("Y-m-d H:i:s",$this->syi_deleted_on);
  }
}
?>

