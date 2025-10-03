<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-16
 */
namespace presentation\system\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_alert_category;
use presentation\system\masterData\classes\cls_sys_alert_type;

/**
 * This is the model class for table "sys_trn_alert".
 * @property integer $sal_id
* @property string $sal_title
* @property integer $sal_type_id
* @property integer $sal_category_id
* @property integer $sal_reference_id
* @property string $sal_remarks
* @property integer $sal_status
* @property integer $sal_is_deleted
* @property integer $sal_company_id
* @property integer $sal_created_by
* @property integer $sal_created_on
* @property integer $sal_last_modified_by
* @property integer $sal_last_modified_on
* @property integer $sal_deleted_by
* @property integer $sal_deleted_on
*/
class cls_sys_trn_alert {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_trn_alert';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'sal_id' => 'Id', 
            'sal_title' => 'Title', 
            'sal_type_id' => 'Type', 
            'sal_category_id' => 'Category', 
            'sal_reference_id' => 'Reference', 
            'sal_remarks' => 'Remarks', 
            'sal_status' => 'Status', 
            'sal_is_deleted' => 'Is Deleted', 
            'sal_company_id' => 'Company', 
            'sal_created_by' => 'Created By', 
            'sal_created_on' => 'Created On', 
            'sal_last_modified_by' => 'Last Modified By', 
            'sal_last_modified_on' => 'Last Modified On', 
            'sal_deleted_by' => 'Deleted By', 
            'sal_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->sal_id)){
      $condition[] = "sal_id='$this->sal_id'";
    }if(!is_null($this->sal_title)){
      $condition[] = "sal_title='$this->sal_title'";
    }if(!is_null($this->sal_type_id)){
      $condition[] = "sal_type_id='$this->sal_type_id'";
    }if(!is_null($this->sal_category_id)){
      $condition[] = "sal_category_id='$this->sal_category_id'";
    }if(!is_null($this->sal_reference_id)){
      $condition[] = "sal_reference_id='$this->sal_reference_id'";
    }if(!is_null($this->sal_remarks)){
      $condition[] = "sal_remarks='$this->sal_remarks'";
    }if(!is_null($this->sal_status)){
      $condition[] = "sal_status='$this->sal_status'";
    }if(!is_null($this->sal_is_deleted)){
      $condition[] = "sal_is_deleted='$this->sal_is_deleted'";
    }if(!is_null($this->sal_company_id)){
      $condition[] = "sal_company_id='$this->sal_company_id'";
    }if(!is_null($this->sal_created_by)){
      $condition[] = "sal_created_by='$this->sal_created_by'";
    }if(!is_null($this->sal_created_on)){
      $condition[] = "sal_created_on='$this->sal_created_on'";
    }if(!is_null($this->sal_last_modified_by)){
      $condition[] = "sal_last_modified_by='$this->sal_last_modified_by'";
    }if(!is_null($this->sal_last_modified_on)){
      $condition[] = "sal_last_modified_on='$this->sal_last_modified_on'";
    }if(!is_null($this->sal_deleted_by)){
      $condition[] = "sal_deleted_by='$this->sal_deleted_by'";
    }if(!is_null($this->sal_deleted_on)){
      $condition[] = "sal_deleted_on='$this->sal_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sal_id, sal_title, sal_type_id, sal_category_id, sal_reference_id, sal_remarks, sal_status, sal_is_deleted, sal_company_id, sal_created_by, sal_created_on, sal_last_modified_by, sal_last_modified_on, sal_deleted_by, sal_deleted_on
          from sys_trn_alert
          where ".$conditionStr."
          order by sal_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['sal_id'].'" '; 
      if($this->sal_id == $row['sal_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['sal_title'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->sal_id)){
      $condition[] = "sal_id='$this->sal_id'";
    }if(!is_null($this->sal_title)){
      $condition[] = "sal_title='$this->sal_title'";
    }if(!is_null($this->sal_type_id)){
      $condition[] = "sal_type_id='$this->sal_type_id'";
    }if(!is_null($this->sal_category_id)){
      $condition[] = "sal_category_id='$this->sal_category_id'";
    }if(!is_null($this->sal_reference_id)){
      $condition[] = "sal_reference_id='$this->sal_reference_id'";
    }if(!is_null($this->sal_remarks)){
      $condition[] = "sal_remarks='$this->sal_remarks'";
    }if(!is_null($this->sal_status)){
      $condition[] = "sal_status='$this->sal_status'";
    }if(!is_null($this->sal_is_deleted)){
      $condition[] = "sal_is_deleted='$this->sal_is_deleted'";
    }if(!is_null($this->sal_company_id)){
      $condition[] = "sal_company_id='$this->sal_company_id'";
    }if(!is_null($this->sal_created_by)){
      $condition[] = "sal_created_by='$this->sal_created_by'";
    }if(!is_null($this->sal_created_on)){
      $condition[] = "sal_created_on='$this->sal_created_on'";
    }if(!is_null($this->sal_last_modified_by)){
      $condition[] = "sal_last_modified_by='$this->sal_last_modified_by'";
    }if(!is_null($this->sal_last_modified_on)){
      $condition[] = "sal_last_modified_on='$this->sal_last_modified_on'";
    }if(!is_null($this->sal_deleted_by)){
      $condition[] = "sal_deleted_by='$this->sal_deleted_by'";
    }if(!is_null($this->sal_deleted_on)){
      $condition[] = "sal_deleted_on='$this->sal_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sal_id, sal_title, sal_type_id, sal_category_id, sal_reference_id, sal_remarks, sal_status, sal_is_deleted, sal_company_id, sal_created_by, sal_created_on, sal_last_modified_by, sal_last_modified_on, sal_deleted_by, sal_deleted_on
          from sys_trn_alert
          where ".$conditionStr."
          order by sal_id asc";
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
    
    $model = new cls_sys_trn_alert($this->db);
  
    $model->sal_id = $result[0]['sal_id'];
    $model->sal_title = $result[0]['sal_title'];
    $model->sal_type_id = $result[0]['sal_type_id'];
    $model->sal_category_id = $result[0]['sal_category_id'];
    $model->sal_reference_id = $result[0]['sal_reference_id'];
    $model->sal_remarks = $result[0]['sal_remarks'];
    $model->sal_status = $result[0]['sal_status'];
    $model->sal_is_deleted = $result[0]['sal_is_deleted'];
    $model->sal_company_id = $result[0]['sal_company_id'];
    $model->sal_created_by = $result[0]['sal_created_by'];
    $model->sal_created_on = $result[0]['sal_created_on'];
    $model->sal_last_modified_by = $result[0]['sal_last_modified_by'];
    $model->sal_last_modified_on = $result[0]['sal_last_modified_on'];
    $model->sal_deleted_by = $result[0]['sal_deleted_by'];
    $model->sal_deleted_on = $result[0]['sal_deleted_on'];
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
      $model = new cls_sys_trn_alert($this->db);
  
      $model->sal_id = $row['sal_id'];
      $model->sal_title = $row['sal_title'];
      $model->sal_type_id = $row['sal_type_id'];
      $model->sal_category_id = $row['sal_category_id'];
      $model->sal_reference_id = $row['sal_reference_id'];
      $model->sal_remarks = $row['sal_remarks'];
      $model->sal_status = $row['sal_status'];
      $model->sal_is_deleted = $row['sal_is_deleted'];
      $model->sal_company_id = $row['sal_company_id'];
      $model->sal_created_by = $row['sal_created_by'];
      $model->sal_created_on = $row['sal_created_on'];
      $model->sal_last_modified_by = $row['sal_last_modified_by'];
      $model->sal_last_modified_on = $row['sal_last_modified_on'];
      $model->sal_deleted_by = $row['sal_deleted_by'];
      $model->sal_deleted_on = $row['sal_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Category
  */
  public function getCategory(){
    $model = new cls_sys_alert_category($this->db);
    $model->sac_id = $this->sal_category_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->sac_name;
  }
  /**
  * @return alert Type
  */
  public function getType(){
    $model = new cls_sys_alert_type($this->db);
    $model->sat_id = $this->sal_type_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->sat_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->sal_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->sal_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->sal_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sal_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->sal_created_on))?$this->sal_created_on:date("Y-m-d H:i:s",$this->sal_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sal_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->sal_last_modified_on))?$this->sal_last_modified_on:date("Y-m-d H:i:s",$this->sal_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sal_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->sal_deleted_on))?$this->sal_deleted_on:date("Y-m-d H:i:s",$this->sal_deleted_on);
  }
}
?>

