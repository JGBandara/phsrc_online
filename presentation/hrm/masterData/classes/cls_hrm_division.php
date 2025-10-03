<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-11
 */
namespace presentation\hrm\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "hrm_division".
 * @property integer $div_id
* @property string $div_name
* @property string $div_code
* @property string $div_remarks
* @property integer $div_status
* @property integer $div_is_deleted
* @property integer $div_company_id
* @property integer $div_created_by
* @property integer $div_created_on
* @property integer $div_last_modified_by
* @property integer $div_last_modified_on
* @property integer $div_deleted_by
* @property integer $div_deleted_on
*/
class cls_hrm_division {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'hrm_division';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'div_id' => 'Id', 
            'div_name' => 'Name', 
            'div_code' => 'Code', 
            'div_remarks' => 'Remarks', 
            'div_status' => 'Status', 
            'div_is_deleted' => 'Is Deleted', 
            'div_company_id' => 'Company Id', 
            'div_created_by' => 'Created By', 
            'div_created_on' => 'Created On', 
            'div_last_modified_by' => 'Last Modified By', 
            'div_last_modified_on' => 'Last Modified On', 
            'div_deleted_by' => 'Deleted By', 
            'div_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->div_id)){
      $condition[] = "div_id='$this->div_id'";
    }if(!is_null($this->div_name)){
      $condition[] = "div_name='$this->div_name'";
    }if(!is_null($this->div_code)){
      $condition[] = "div_code='$this->div_code'";
    }if(!is_null($this->div_remarks)){
      $condition[] = "div_remarks='$this->div_remarks'";
    }if(!is_null($this->div_status)){
      $condition[] = "div_status='$this->div_status'";
    }if(!is_null($this->div_is_deleted)){
      $condition[] = "div_is_deleted='$this->div_is_deleted'";
    }if(!is_null($this->div_company_id)){
      $condition[] = "div_company_id='$this->div_company_id'";
    }if(!is_null($this->div_created_by)){
      $condition[] = "div_created_by='$this->div_created_by'";
    }if(!is_null($this->div_created_on)){
      $condition[] = "div_created_on='$this->div_created_on'";
    }if(!is_null($this->div_last_modified_by)){
      $condition[] = "div_last_modified_by='$this->div_last_modified_by'";
    }if(!is_null($this->div_last_modified_on)){
      $condition[] = "div_last_modified_on='$this->div_last_modified_on'";
    }if(!is_null($this->div_deleted_by)){
      $condition[] = "div_deleted_by='$this->div_deleted_by'";
    }if(!is_null($this->div_deleted_on)){
      $condition[] = "div_deleted_on='$this->div_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select div_id, div_name, div_code, div_remarks, div_status, div_is_deleted, div_company_id, div_created_by, div_created_on, div_last_modified_by, div_last_modified_on, div_deleted_by, div_deleted_on
          from hrm_division
          where ".$conditionStr."
          order by div_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['div_id'].'" '; 
      if($this->div_id == $row['div_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['div_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->div_id)){
      $condition[] = "div_id='$this->div_id'";
    }if(!is_null($this->div_name)){
      $condition[] = "div_name='$this->div_name'";
    }if(!is_null($this->div_code)){
      $condition[] = "div_code='$this->div_code'";
    }if(!is_null($this->div_remarks)){
      $condition[] = "div_remarks='$this->div_remarks'";
    }if(!is_null($this->div_status)){
      $condition[] = "div_status='$this->div_status'";
    }if(!is_null($this->div_is_deleted)){
      $condition[] = "div_is_deleted='$this->div_is_deleted'";
    }if(!is_null($this->div_company_id)){
      $condition[] = "div_company_id='$this->div_company_id'";
    }if(!is_null($this->div_created_by)){
      $condition[] = "div_created_by='$this->div_created_by'";
    }if(!is_null($this->div_created_on)){
      $condition[] = "div_created_on='$this->div_created_on'";
    }if(!is_null($this->div_last_modified_by)){
      $condition[] = "div_last_modified_by='$this->div_last_modified_by'";
    }if(!is_null($this->div_last_modified_on)){
      $condition[] = "div_last_modified_on='$this->div_last_modified_on'";
    }if(!is_null($this->div_deleted_by)){
      $condition[] = "div_deleted_by='$this->div_deleted_by'";
    }if(!is_null($this->div_deleted_on)){
      $condition[] = "div_deleted_on='$this->div_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select div_id, div_name, div_code, div_remarks, div_status, div_is_deleted, div_company_id, div_created_by, div_created_on, div_last_modified_by, div_last_modified_on, div_deleted_by, div_deleted_on
          from hrm_division
          where ".$conditionStr."
          order by div_id asc";
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
    
    $model = new cls_hrm_division($this->db);
  
    $model->div_id = $result[0]['div_id'];
    $model->div_name = $result[0]['div_name'];
    $model->div_code = $result[0]['div_code'];
    $model->div_remarks = $result[0]['div_remarks'];
    $model->div_status = $result[0]['div_status'];
    $model->div_is_deleted = $result[0]['div_is_deleted'];
    $model->div_company_id = $result[0]['div_company_id'];
    $model->div_created_by = $result[0]['div_created_by'];
    $model->div_created_on = $result[0]['div_created_on'];
    $model->div_last_modified_by = $result[0]['div_last_modified_by'];
    $model->div_last_modified_on = $result[0]['div_last_modified_on'];
    $model->div_deleted_by = $result[0]['div_deleted_by'];
    $model->div_deleted_on = $result[0]['div_deleted_on'];
    return $model;
  }
  /**
  * @inheritdoc
  */
  public function getModels(){
    $result = $this->getRecords();
    if(is_null($result)){
    return new self($this->db);
    }
    $models = [];
    foreach ($result as $row) {
      $model = new cls_hrm_division($this->db);
  
      $model->div_id = $row['div_id'];
      $model->div_name = $row['div_name'];
      $model->div_code = $row['div_code'];
      $model->div_remarks = $row['div_remarks'];
      $model->div_status = $row['div_status'];
      $model->div_is_deleted = $row['div_is_deleted'];
      $model->div_company_id = $row['div_company_id'];
      $model->div_created_by = $row['div_created_by'];
      $model->div_created_on = $row['div_created_on'];
      $model->div_last_modified_by = $row['div_last_modified_by'];
      $model->div_last_modified_on = $row['div_last_modified_on'];
      $model->div_deleted_by = $row['div_deleted_by'];
      $model->div_deleted_on = $row['div_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->div_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->div_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->div_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->div_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->div_created_on))?$this->div_created_on:date("Y-m-d H:i:s",$this->div_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->div_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->div_last_modified_on))?$this->div_last_modified_on:date("Y-m-d H:i:s",$this->div_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->div_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->div_deleted_on))?$this->div_deleted_on:date("Y-m-d H:i:s",$this->div_deleted_on);
  }
}
?>

