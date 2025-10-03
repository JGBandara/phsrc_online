<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-15
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_alert_category;

/**
 * This is the model class for table "sys_alert_type".
 * @property integer $sat_id
* @property string $sat_name
* @property integer $sat_category_id
* @property string $sat_view_url
* @property string $sat_detail_url
* @property string $sat_detail_query
* @property string $sat_remarks
* @property integer $sat_status
* @property integer $sat_is_deleted
* @property integer $sat_company_id
* @property integer $sat_created_by
* @property integer $sat_created_on
* @property integer $sat_last_modified_by
* @property integer $sat_last_modified_on
* @property integer $sat_deleted_by
* @property integer $sat_deleted_on
*/
class cls_sys_alert_type {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_alert_type';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'sat_id' => 'Id', 
            'sat_name' => 'Name', 
            'sat_category_id' => 'Category', 
            'sat_view_url' => 'View Url', 
            'sat_detail_url' => 'Detail Url', 
            'sat_detail_query' => 'Detail Query', 
            'sat_remarks' => 'Remarks', 
            'sat_status' => 'Status', 
            'sat_is_deleted' => 'Is Deleted', 
            'sat_company_id' => 'Company', 
            'sat_created_by' => 'Created By', 
            'sat_created_on' => 'Created On', 
            'sat_last_modified_by' => 'Last Modified By', 
            'sat_last_modified_on' => 'Last Modified On', 
            'sat_deleted_by' => 'Deleted By', 
            'sat_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->sat_id)){
      $condition[] = "sat_id='$this->sat_id'";
    }if(!is_null($this->sat_name)){
      $condition[] = "sat_name='$this->sat_name'";
    }if(!is_null($this->sat_category_id)){
      $condition[] = "sat_category_id='$this->sat_category_id'";
    }if(!is_null($this->sat_view_url)){
      $condition[] = "sat_view_url='$this->sat_view_url'";
    }if(!is_null($this->sat_detail_url)){
      $condition[] = "sat_detail_url='$this->sat_detail_url'";
    }if(!is_null($this->sat_detail_query)){
      $condition[] = "sat_detail_query='$this->sat_detail_query'";
    }if(!is_null($this->sat_remarks)){
      $condition[] = "sat_remarks='$this->sat_remarks'";
    }if(!is_null($this->sat_status)){
      $condition[] = "sat_status='$this->sat_status'";
    }if(!is_null($this->sat_is_deleted)){
      $condition[] = "sat_is_deleted='$this->sat_is_deleted'";
    }if(!is_null($this->sat_company_id)){
      $condition[] = "sat_company_id='$this->sat_company_id'";
    }if(!is_null($this->sat_created_by)){
      $condition[] = "sat_created_by='$this->sat_created_by'";
    }if(!is_null($this->sat_created_on)){
      $condition[] = "sat_created_on='$this->sat_created_on'";
    }if(!is_null($this->sat_last_modified_by)){
      $condition[] = "sat_last_modified_by='$this->sat_last_modified_by'";
    }if(!is_null($this->sat_last_modified_on)){
      $condition[] = "sat_last_modified_on='$this->sat_last_modified_on'";
    }if(!is_null($this->sat_deleted_by)){
      $condition[] = "sat_deleted_by='$this->sat_deleted_by'";
    }if(!is_null($this->sat_deleted_on)){
      $condition[] = "sat_deleted_on='$this->sat_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sat_id, sat_name, sat_category_id, sat_view_url, sat_detail_url, sat_detail_query, sat_remarks, sat_status, sat_is_deleted, sat_company_id, sat_created_by, sat_created_on, sat_last_modified_by, sat_last_modified_on, sat_deleted_by, sat_deleted_on
          from sys_alert_type
          where ".$conditionStr."
          order by sat_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['sat_id'].'" '; 
      if($this->sat_id == $row['sat_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['sat_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->sat_id)){
      $condition[] = "sat_id='$this->sat_id'";
    }if(!is_null($this->sat_name)){
      $condition[] = "sat_name='$this->sat_name'";
    }if(!is_null($this->sat_category_id)){
      $condition[] = "sat_category_id='$this->sat_category_id'";
    }if(!is_null($this->sat_view_url)){
      $condition[] = "sat_view_url='$this->sat_view_url'";
    }if(!is_null($this->sat_detail_url)){
      $condition[] = "sat_detail_url='$this->sat_detail_url'";
    }if(!is_null($this->sat_detail_query)){
      $condition[] = "sat_detail_query='$this->sat_detail_query'";
    }if(!is_null($this->sat_remarks)){
      $condition[] = "sat_remarks='$this->sat_remarks'";
    }if(!is_null($this->sat_status)){
      $condition[] = "sat_status='$this->sat_status'";
    }if(!is_null($this->sat_is_deleted)){
      $condition[] = "sat_is_deleted='$this->sat_is_deleted'";
    }if(!is_null($this->sat_company_id)){
      $condition[] = "sat_company_id='$this->sat_company_id'";
    }if(!is_null($this->sat_created_by)){
      $condition[] = "sat_created_by='$this->sat_created_by'";
    }if(!is_null($this->sat_created_on)){
      $condition[] = "sat_created_on='$this->sat_created_on'";
    }if(!is_null($this->sat_last_modified_by)){
      $condition[] = "sat_last_modified_by='$this->sat_last_modified_by'";
    }if(!is_null($this->sat_last_modified_on)){
      $condition[] = "sat_last_modified_on='$this->sat_last_modified_on'";
    }if(!is_null($this->sat_deleted_by)){
      $condition[] = "sat_deleted_by='$this->sat_deleted_by'";
    }if(!is_null($this->sat_deleted_on)){
      $condition[] = "sat_deleted_on='$this->sat_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sat_id, sat_name, sat_category_id, sat_view_url, sat_detail_url, sat_detail_query, sat_remarks, sat_status, sat_is_deleted, sat_company_id, sat_created_by, sat_created_on, sat_last_modified_by, sat_last_modified_on, sat_deleted_by, sat_deleted_on
          from sys_alert_type
          where ".$conditionStr."
          order by sat_id asc";
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
    
    $model = new cls_sys_alert_type($this->db);
  
    $model->sat_id = $result[0]['sat_id'];
    $model->sat_name = $result[0]['sat_name'];
    $model->sat_category_id = $result[0]['sat_category_id'];
    $model->sat_view_url = $result[0]['sat_view_url'];
    $model->sat_detail_url = $result[0]['sat_detail_url'];
    $model->sat_detail_query = $result[0]['sat_detail_query'];
    $model->sat_remarks = $result[0]['sat_remarks'];
    $model->sat_status = $result[0]['sat_status'];
    $model->sat_is_deleted = $result[0]['sat_is_deleted'];
    $model->sat_company_id = $result[0]['sat_company_id'];
    $model->sat_created_by = $result[0]['sat_created_by'];
    $model->sat_created_on = $result[0]['sat_created_on'];
    $model->sat_last_modified_by = $result[0]['sat_last_modified_by'];
    $model->sat_last_modified_on = $result[0]['sat_last_modified_on'];
    $model->sat_deleted_by = $result[0]['sat_deleted_by'];
    $model->sat_deleted_on = $result[0]['sat_deleted_on'];
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
      $model = new cls_sys_alert_type($this->db);
  
      $model->sat_id = $row['sat_id'];
      $model->sat_name = $row['sat_name'];
      $model->sat_category_id = $row['sat_category_id'];
      $model->sat_view_url = $row['sat_view_url'];
      $model->sat_detail_url = $row['sat_detail_url'];
      $model->sat_detail_query = $row['sat_detail_query'];
      $model->sat_remarks = $row['sat_remarks'];
      $model->sat_status = $row['sat_status'];
      $model->sat_is_deleted = $row['sat_is_deleted'];
      $model->sat_company_id = $row['sat_company_id'];
      $model->sat_created_by = $row['sat_created_by'];
      $model->sat_created_on = $row['sat_created_on'];
      $model->sat_last_modified_by = $row['sat_last_modified_by'];
      $model->sat_last_modified_on = $row['sat_last_modified_on'];
      $model->sat_deleted_by = $row['sat_deleted_by'];
      $model->sat_deleted_on = $row['sat_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Category
  */
  public function getCategory(){
    $model = new cls_sys_alert_category($this->db);
    $model->sac_id = $this->sat_category_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->sac_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->sat_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->sat_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->sat_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sat_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->sat_created_on))?$this->sat_created_on:date("Y-m-d H:i:s",$this->sat_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sat_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->sat_last_modified_on))?$this->sat_last_modified_on:date("Y-m-d H:i:s",$this->sat_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sat_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->sat_deleted_on))?$this->sat_deleted_on:date("Y-m-d H:i:s",$this->sat_deleted_on);
  }
}
?>

