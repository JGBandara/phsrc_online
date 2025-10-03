<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-06
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "sys_country".
 * @property integer $syt_id
* @property string $syt_code
* @property string $syt_name
* @property integer $syt_status
* @property integer $syt_is_deleted
* @property integer $syt_company_id
* @property integer $syt_created_by
* @property integer $syt_created_on
* @property integer $syt_last_modified_by
* @property integer $syt_last_modified_on
* @property integer $syt_deleted_by
* @property integer $syt_deleted_on
*/
class cls_sys_country {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_country';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syt_id' => 'Id', 
            'syt_code' => 'Code', 
            'syt_name' => 'Name', 
            'syt_status' => 'Status', 
            'syt_is_deleted' => 'Is Deleted', 
            'syt_company_id' => 'Company Id', 
            'syt_created_by' => 'Created By', 
            'syt_created_on' => 'Created On', 
            'syt_last_modified_by' => 'Last Modified By', 
            'syt_last_modified_on' => 'Last Modified On', 
            'syt_deleted_by' => 'Deleted By', 
            'syt_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syt_id)){
      $condition[] = "syt_id='$this->syt_id'";
    }if(!is_null($this->syt_code)){
      $condition[] = "syt_code='$this->syt_code'";
    }if(!is_null($this->syt_name)){
      $condition[] = "syt_name='$this->syt_name'";
    }if(!is_null($this->syt_status)){
      $condition[] = "syt_status='$this->syt_status'";
    }if(!is_null($this->syt_is_deleted)){
      $condition[] = "syt_is_deleted='$this->syt_is_deleted'";
    }if(!is_null($this->syt_company_id)){
      $condition[] = "syt_company_id='$this->syt_company_id'";
    }if(!is_null($this->syt_created_by)){
      $condition[] = "syt_created_by='$this->syt_created_by'";
    }if(!is_null($this->syt_created_on)){
      $condition[] = "syt_created_on='$this->syt_created_on'";
    }if(!is_null($this->syt_last_modified_by)){
      $condition[] = "syt_last_modified_by='$this->syt_last_modified_by'";
    }if(!is_null($this->syt_last_modified_on)){
      $condition[] = "syt_last_modified_on='$this->syt_last_modified_on'";
    }if(!is_null($this->syt_deleted_by)){
      $condition[] = "syt_deleted_by='$this->syt_deleted_by'";
    }if(!is_null($this->syt_deleted_on)){
      $condition[] = "syt_deleted_on='$this->syt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syt_id, syt_code, syt_name, syt_status, syt_is_deleted, syt_company_id, syt_created_by, syt_created_on, syt_last_modified_by, syt_last_modified_on, syt_deleted_by, syt_deleted_on
          from sys_country
          where ".$conditionStr."
          order by syt_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syt_id'].'" '; 
      if($this->syt_id == $row['syt_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syt_name'].' - '.$row['syt_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syt_id)){
      $condition[] = "syt_id='$this->syt_id'";
    }if(!is_null($this->syt_code)){
      $condition[] = "syt_code='$this->syt_code'";
    }if(!is_null($this->syt_name)){
      $condition[] = "syt_name='$this->syt_name'";
    }if(!is_null($this->syt_status)){
      $condition[] = "syt_status='$this->syt_status'";
    }if(!is_null($this->syt_is_deleted)){
      $condition[] = "syt_is_deleted='$this->syt_is_deleted'";
    }if(!is_null($this->syt_company_id)){
      $condition[] = "syt_company_id='$this->syt_company_id'";
    }if(!is_null($this->syt_created_by)){
      $condition[] = "syt_created_by='$this->syt_created_by'";
    }if(!is_null($this->syt_created_on)){
      $condition[] = "syt_created_on='$this->syt_created_on'";
    }if(!is_null($this->syt_last_modified_by)){
      $condition[] = "syt_last_modified_by='$this->syt_last_modified_by'";
    }if(!is_null($this->syt_last_modified_on)){
      $condition[] = "syt_last_modified_on='$this->syt_last_modified_on'";
    }if(!is_null($this->syt_deleted_by)){
      $condition[] = "syt_deleted_by='$this->syt_deleted_by'";
    }if(!is_null($this->syt_deleted_on)){
      $condition[] = "syt_deleted_on='$this->syt_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syt_id, syt_code, syt_name, syt_status, syt_is_deleted, syt_company_id, syt_created_by, syt_created_on, syt_last_modified_by, syt_last_modified_on, syt_deleted_by, syt_deleted_on
          from sys_country
          where ".$conditionStr."
          order by syt_id asc";
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
    
    $model = new cls_sys_country($this->db);
  
    $model->syt_id = $result[0]['syt_id'];
    $model->syt_code = $result[0]['syt_code'];
    $model->syt_name = $result[0]['syt_name'];
    $model->syt_status = $result[0]['syt_status'];
    $model->syt_is_deleted = $result[0]['syt_is_deleted'];
    $model->syt_company_id = $result[0]['syt_company_id'];
    $model->syt_created_by = $result[0]['syt_created_by'];
    $model->syt_created_on = $result[0]['syt_created_on'];
    $model->syt_last_modified_by = $result[0]['syt_last_modified_by'];
    $model->syt_last_modified_on = $result[0]['syt_last_modified_on'];
    $model->syt_deleted_by = $result[0]['syt_deleted_by'];
    $model->syt_deleted_on = $result[0]['syt_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syt_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syt_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syt_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syt_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syt_created_on))?$this->syt_created_on:date("Y-m-d H:i:s",$this->syt_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syt_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syt_last_modified_on))?$this->syt_last_modified_on:date("Y-m-d H:i:s",$this->syt_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syt_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syt_deleted_on))?$this->syt_deleted_on:date("Y-m-d H:i:s",$this->syt_deleted_on);
  }
}
?>

