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
 * This is the model class for table "sys_bank".
 * @property integer $sye_id
* @property string $sye_code
* @property string $sye_name
* @property string $sye_remarks
* @property integer $sye_status
* @property integer $sye_is_deleted
* @property integer $sye_company_id
* @property integer $sye_created_by
* @property integer $sye_created_on
* @property integer $sye_last_modified_by
* @property integer $sye_last_modified_on
* @property integer $sye_deleted_by
* @property integer $sye_deleted_on
*/
class cls_sys_bank {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_bank';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'sye_id' => 'Id', 
            'sye_code' => 'Code', 
            'sye_name' => 'Name', 
            'sye_remarks' => 'Remarks', 
            'sye_status' => 'Status', 
            'sye_is_deleted' => 'Is Deleted', 
            'sye_company_id' => 'Company Id', 
            'sye_created_by' => 'Created By', 
            'sye_created_on' => 'Created On', 
            'sye_last_modified_by' => 'Last Modified By', 
            'sye_last_modified_on' => 'Last Modified On', 
            'sye_deleted_by' => 'Deleted By', 
            'sye_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->sye_id)){
      $condition[] = "sye_id='$this->sye_id'";
    }if(!is_null($this->sye_code)){
      $condition[] = "sye_code='$this->sye_code'";
    }if(!is_null($this->sye_name)){
      $condition[] = "sye_name='$this->sye_name'";
    }if(!is_null($this->sye_remarks)){
      $condition[] = "sye_remarks='$this->sye_remarks'";
    }if(!is_null($this->sye_status)){
      $condition[] = "sye_status='$this->sye_status'";
    }if(!is_null($this->sye_is_deleted)){
      $condition[] = "sye_is_deleted='$this->sye_is_deleted'";
    }if(!is_null($this->sye_company_id)){
      $condition[] = "sye_company_id='$this->sye_company_id'";
    }if(!is_null($this->sye_created_by)){
      $condition[] = "sye_created_by='$this->sye_created_by'";
    }if(!is_null($this->sye_created_on)){
      $condition[] = "sye_created_on='$this->sye_created_on'";
    }if(!is_null($this->sye_last_modified_by)){
      $condition[] = "sye_last_modified_by='$this->sye_last_modified_by'";
    }if(!is_null($this->sye_last_modified_on)){
      $condition[] = "sye_last_modified_on='$this->sye_last_modified_on'";
    }if(!is_null($this->sye_deleted_by)){
      $condition[] = "sye_deleted_by='$this->sye_deleted_by'";
    }if(!is_null($this->sye_deleted_on)){
      $condition[] = "sye_deleted_on='$this->sye_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sye_id, sye_code, sye_name, sye_remarks, sye_status, sye_is_deleted, sye_company_id, sye_created_by, sye_created_on, sye_last_modified_by, sye_last_modified_on, sye_deleted_by, sye_deleted_on
          from sys_bank
          where ".$conditionStr."
          order by sye_name asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['sye_id'].'" '; 
      if($this->sye_id == $row['sye_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['sye_name'].' - '.$row['sye_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->sye_id)){
      $condition[] = "sye_id='$this->sye_id'";
    }if(!is_null($this->sye_code)){
      $condition[] = "sye_code='$this->sye_code'";
    }if(!is_null($this->sye_name)){
      $condition[] = "sye_name='$this->sye_name'";
    }if(!is_null($this->sye_remarks)){
      $condition[] = "sye_remarks='$this->sye_remarks'";
    }if(!is_null($this->sye_status)){
      $condition[] = "sye_status='$this->sye_status'";
    }if(!is_null($this->sye_is_deleted)){
      $condition[] = "sye_is_deleted='$this->sye_is_deleted'";
    }if(!is_null($this->sye_company_id)){
      $condition[] = "sye_company_id='$this->sye_company_id'";
    }if(!is_null($this->sye_created_by)){
      $condition[] = "sye_created_by='$this->sye_created_by'";
    }if(!is_null($this->sye_created_on)){
      $condition[] = "sye_created_on='$this->sye_created_on'";
    }if(!is_null($this->sye_last_modified_by)){
      $condition[] = "sye_last_modified_by='$this->sye_last_modified_by'";
    }if(!is_null($this->sye_last_modified_on)){
      $condition[] = "sye_last_modified_on='$this->sye_last_modified_on'";
    }if(!is_null($this->sye_deleted_by)){
      $condition[] = "sye_deleted_by='$this->sye_deleted_by'";
    }if(!is_null($this->sye_deleted_on)){
      $condition[] = "sye_deleted_on='$this->sye_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sye_id, sye_code, sye_name, sye_remarks, sye_status, sye_is_deleted, sye_company_id, sye_created_by, sye_created_on, sye_last_modified_by, sye_last_modified_on, sye_deleted_by, sye_deleted_on
          from sys_bank
          where ".$conditionStr."
          order by sye_id asc";
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
    
    $model = new cls_sys_bank($this->db);
  
        $model->sye_id = $result[0]['sye_id'];
        $model->sye_code = $result[0]['sye_code'];
        $model->sye_name = $result[0]['sye_name'];
        $model->sye_remarks = $result[0]['sye_remarks'];
        $model->sye_status = $result[0]['sye_status'];
        $model->sye_is_deleted = $result[0]['sye_is_deleted'];
        $model->sye_company_id = $result[0]['sye_company_id'];
        $model->sye_created_by = $result[0]['sye_created_by'];
        $model->sye_created_on = $result[0]['sye_created_on'];
        $model->sye_last_modified_by = $result[0]['sye_last_modified_by'];
        $model->sye_last_modified_on = $result[0]['sye_last_modified_on'];
        $model->sye_deleted_by = $result[0]['sye_deleted_by'];
        $model->sye_deleted_on = $result[0]['sye_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->sye_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->sye_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->sye_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sye_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->sye_created_on))?$this->sye_created_on:date("Y-m-d H:i:s",$this->sye_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sye_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->sye_last_modified_on))?$this->sye_last_modified_on:date("Y-m-d H:i:s",$this->sye_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sye_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->sye_deleted_on))?$this->sye_deleted_on:date("Y-m-d H:i:s",$this->sye_deleted_on);
  }
}
?>

