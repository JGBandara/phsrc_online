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
 * This is the model class for table "sys_currency".
 * @property integer $syy_id
* @property string $syy_code
* @property string $syy_symbol
* @property string $syy_remarks
* @property integer $syy_status
* @property integer $syy_is_deleted
* @property integer $syy_company_id
* @property integer $syy_created_by
* @property integer $syy_created_on
* @property integer $syy_last_modified_by
* @property integer $syy_last_modified_on
* @property integer $syy_deleted_by
* @property integer $syy_deleted_on
*/
class cls_sys_currency {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_currency';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syy_id' => 'Id', 
            'syy_code' => 'Code', 
            'syy_symbol' => 'Symbol', 
            'syy_remarks' => 'Remarks', 
            'syy_status' => 'Status', 
            'syy_is_deleted' => 'Is Deleted', 
            'syy_company_id' => 'Company Id', 
            'syy_created_by' => 'Created By', 
            'syy_created_on' => 'Created On', 
            'syy_last_modified_by' => 'Last Modified By', 
            'syy_last_modified_on' => 'Last Modified On', 
            'syy_deleted_by' => 'Deleted By', 
            'syy_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syy_id)){
      $condition[] = "syy_id='$this->syy_id'";
    }if(!is_null($this->syy_code)){
      $condition[] = "syy_code='$this->syy_code'";
    }if(!is_null($this->syy_symbol)){
      $condition[] = "syy_symbol='$this->syy_symbol'";
    }if(!is_null($this->syy_remarks)){
      $condition[] = "syy_remarks='$this->syy_remarks'";
    }if(!is_null($this->syy_status)){
      $condition[] = "syy_status='$this->syy_status'";
    }if(!is_null($this->syy_is_deleted)){
      $condition[] = "syy_is_deleted='$this->syy_is_deleted'";
    }if(!is_null($this->syy_company_id)){
      $condition[] = "syy_company_id='$this->syy_company_id'";
    }if(!is_null($this->syy_created_by)){
      $condition[] = "syy_created_by='$this->syy_created_by'";
    }if(!is_null($this->syy_created_on)){
      $condition[] = "syy_created_on='$this->syy_created_on'";
    }if(!is_null($this->syy_last_modified_by)){
      $condition[] = "syy_last_modified_by='$this->syy_last_modified_by'";
    }if(!is_null($this->syy_last_modified_on)){
      $condition[] = "syy_last_modified_on='$this->syy_last_modified_on'";
    }if(!is_null($this->syy_deleted_by)){
      $condition[] = "syy_deleted_by='$this->syy_deleted_by'";
    }if(!is_null($this->syy_deleted_on)){
      $condition[] = "syy_deleted_on='$this->syy_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syy_id, syy_code, syy_symbol, syy_remarks, syy_status, syy_is_deleted, syy_company_id, syy_created_by, syy_created_on, syy_last_modified_by, syy_last_modified_on, syy_deleted_by, syy_deleted_on
          from sys_currency
          where ".$conditionStr."
          order by syy_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syy_id'].'" '; 
      if($this->syy_id == $row['syy_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syy_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syy_id)){
      $condition[] = "syy_id='$this->syy_id'";
    }if(!is_null($this->syy_code)){
      $condition[] = "syy_code='$this->syy_code'";
    }if(!is_null($this->syy_symbol)){
      $condition[] = "syy_symbol='$this->syy_symbol'";
    }if(!is_null($this->syy_remarks)){
      $condition[] = "syy_remarks='$this->syy_remarks'";
    }if(!is_null($this->syy_status)){
      $condition[] = "syy_status='$this->syy_status'";
    }if(!is_null($this->syy_is_deleted)){
      $condition[] = "syy_is_deleted='$this->syy_is_deleted'";
    }if(!is_null($this->syy_company_id)){
      $condition[] = "syy_company_id='$this->syy_company_id'";
    }if(!is_null($this->syy_created_by)){
      $condition[] = "syy_created_by='$this->syy_created_by'";
    }if(!is_null($this->syy_created_on)){
      $condition[] = "syy_created_on='$this->syy_created_on'";
    }if(!is_null($this->syy_last_modified_by)){
      $condition[] = "syy_last_modified_by='$this->syy_last_modified_by'";
    }if(!is_null($this->syy_last_modified_on)){
      $condition[] = "syy_last_modified_on='$this->syy_last_modified_on'";
    }if(!is_null($this->syy_deleted_by)){
      $condition[] = "syy_deleted_by='$this->syy_deleted_by'";
    }if(!is_null($this->syy_deleted_on)){
      $condition[] = "syy_deleted_on='$this->syy_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syy_id, syy_code, syy_symbol, syy_remarks, syy_status, syy_is_deleted, syy_company_id, syy_created_by, syy_created_on, syy_last_modified_by, syy_last_modified_on, syy_deleted_by, syy_deleted_on
          from sys_currency
          where ".$conditionStr."
          order by syy_id asc";
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
    
    $model = new cls_sys_currency($this->db);
  
    $model->syy_id = $result[0]['syy_id'];
    $model->syy_code = $result[0]['syy_code'];
    $model->syy_symbol = $result[0]['syy_symbol'];
    $model->syy_remarks = $result[0]['syy_remarks'];
    $model->syy_status = $result[0]['syy_status'];
    $model->syy_is_deleted = $result[0]['syy_is_deleted'];
    $model->syy_company_id = $result[0]['syy_company_id'];
    $model->syy_created_by = $result[0]['syy_created_by'];
    $model->syy_created_on = $result[0]['syy_created_on'];
    $model->syy_last_modified_by = $result[0]['syy_last_modified_by'];
    $model->syy_last_modified_on = $result[0]['syy_last_modified_on'];
    $model->syy_deleted_by = $result[0]['syy_deleted_by'];
    $model->syy_deleted_on = $result[0]['syy_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->syy_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->syy_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syy_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syy_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syy_created_on))?$this->syy_created_on:date("Y-m-d H:i:s",$this->syy_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syy_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syy_last_modified_on))?$this->syy_last_modified_on:date("Y-m-d H:i:s",$this->syy_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->syy_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syy_deleted_on))?$this->syy_deleted_on:date("Y-m-d H:i:s",$this->syy_deleted_on);
  }
}
?>

