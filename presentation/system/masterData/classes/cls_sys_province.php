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
 * This is the model class for table "sys_province".
 * @property integer $syv_id
* @property string $syv_name
* @property integer $syv_country_id
* @property integer $syv_status
* @property integer $syv_company_id
* @property integer $syv_created_by
* @property integer $syv_created_on
* @property integer $syv_last_modified_by
* @property integer $syv_last_modified_on
* @property integer $syv_deleted_by
* @property integer $syv_deleted_on
*/
class cls_sys_province {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_province';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syv_id' => 'Id', 
            'syv_name' => 'Name', 
            'syv_country_id' => 'Country Id', 
            'syv_status' => 'Status', 
            'syv_is_deleted' => 'Is Deleted', 
            'syv_company_id' => 'Company Id', 
            'syv_created_by' => 'Created By', 
            'syv_created_on' => 'Created On', 
            'syv_last_modified_by' => 'Last Modified By', 
            'syv_last_modified_on' => 'Last Modified On', 
            'syv_deleted_by' => 'Deleted By', 
            'syv_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syv_id)){
      $condition[] = "syv_id='$this->syv_id'";
    }if(!is_null($this->syv_name)){
      $condition[] = "syv_name='$this->syv_name'";
    }if(!is_null($this->syv_country_id)){
      $condition[] = "syv_country_id='$this->syv_country_id'";
    }if(!is_null($this->syv_status)){
      $condition[] = "syv_status='$this->syv_status'";
    }if(!is_null($this->syv_is_deleted)){
      $condition[] = "syv_is_deleted='$this->syv_is_deleted'";
    }if(!is_null($this->syv_company_id)){
      $condition[] = "syv_company_id='$this->syv_company_id'";
    }if(!is_null($this->syv_created_by)){
      $condition[] = "syv_created_by='$this->syv_created_by'";
    }if(!is_null($this->syv_created_on)){
      $condition[] = "syv_created_on='$this->syv_created_on'";
    }if(!is_null($this->syv_last_modified_by)){
      $condition[] = "syv_last_modified_by='$this->syv_last_modified_by'";
    }if(!is_null($this->syv_last_modified_on)){
      $condition[] = "syv_last_modified_on='$this->syv_last_modified_on'";
    }if(!is_null($this->syv_deleted_by)){
      $condition[] = "syv_deleted_by='$this->syv_deleted_by'";
    }if(!is_null($this->syv_deleted_on)){
      $condition[] = "syv_deleted_on='$this->syv_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syv_id, syv_name, syv_country_id, syv_status, syv_is_deleted, syv_company_id, syv_created_by, syv_created_on, syv_last_modified_by, syv_last_modified_on, syv_deleted_by, syv_deleted_on
          from sys_province
          where ".$conditionStr."
          order by syv_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syv_id'].'" '; 
      if($this->syv_id == $row['syv_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syv_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syv_id)){
      $condition[] = "syv_id='$this->syv_id'";
    }if(!is_null($this->syv_name)){
      $condition[] = "syv_name='$this->syv_name'";
    }if(!is_null($this->syv_country_id)){
      $condition[] = "syv_country_id='$this->syv_country_id'";
    }if(!is_null($this->syv_status)){
      $condition[] = "syv_status='$this->syv_status'";
    }if(!is_null($this->syv_is_deleted)){
      $condition[] = "syv_is_deleted='$this->syv_is_deleted'";
    }if(!is_null($this->syv_company_id)){
      $condition[] = "syv_company_id='$this->syv_company_id'";
    }if(!is_null($this->syv_created_by)){
      $condition[] = "syv_created_by='$this->syv_created_by'";
    }if(!is_null($this->syv_created_on)){
      $condition[] = "syv_created_on='$this->syv_created_on'";
    }if(!is_null($this->syv_last_modified_by)){
      $condition[] = "syv_last_modified_by='$this->syv_last_modified_by'";
    }if(!is_null($this->syv_last_modified_on)){
      $condition[] = "syv_last_modified_on='$this->syv_last_modified_on'";
    }if(!is_null($this->syv_deleted_by)){
      $condition[] = "syv_deleted_by='$this->syv_deleted_by'";
    }if(!is_null($this->syv_deleted_on)){
      $condition[] = "syv_deleted_on='$this->syv_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syv_id, syv_name, syv_country_id, syv_status, syv_is_deleted, syv_company_id, syv_created_by, syv_created_on, syv_last_modified_by, syv_last_modified_on, syv_deleted_by, syv_deleted_on
          from sys_province
          where ".$conditionStr."
          order by syv_id asc";
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
    
    $model = new cls_sys_province($this->db);
  
    $model->syv_id = $result[0]['syv_id'];
    $model->syv_name = $result[0]['syv_name'];
    $model->syv_country_id = $result[0]['syv_country_id'];
    $model->syv_status = $result[0]['syv_status'];
    $model->syv_is_deleted = $result[0]['syv_is_deleted'];
    $model->syv_company_id = $result[0]['syv_company_id'];
    $model->syv_created_by = $result[0]['syv_created_by'];
    $model->syv_created_on = $result[0]['syv_created_on'];
    $model->syv_last_modified_by = $result[0]['syv_last_modified_by'];
    $model->syv_last_modified_on = $result[0]['syv_last_modified_on'];
    $model->syv_deleted_by = $result[0]['syv_deleted_by'];
    $model->syv_deleted_on = $result[0]['syv_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syv_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syv_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syv_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syv_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syv_created_on))?$this->syv_created_on:date("Y-m-d H:i:s",$this->syv_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syv_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syv_last_modified_on))?$this->syv_last_modified_on:date("Y-m-d H:i:s",$this->syv_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syv_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syv_deleted_on))?$this->syv_deleted_on:date("Y-m-d H:i:s",$this->syv_deleted_on);
  }
}
?>

