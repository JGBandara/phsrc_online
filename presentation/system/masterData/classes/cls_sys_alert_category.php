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

/**
 * This is the model class for table "sys_alert_category".
 * @property integer $sac_id
* @property string $sac_name
* @property string $sac_css_color
* @property string $sac_css_bg_color
* @property string $sac_remarks
* @property integer $sac_status
* @property integer $sac_is_deleted
* @property integer $sac_company_id
* @property integer $sac_created_by
* @property integer $sac_created_on
* @property integer $sac_last_modified_by
* @property integer $sac_last_modified_on
* @property integer $sac_deleted_by
* @property integer $sac_deleted_on
*/
class cls_sys_alert_category {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_alert_category';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'sac_id' => 'Id', 
            'sac_name' => 'Name', 
            'sac_css_color' => 'CSS Color', 
            'sac_css_bg_color' => 'CSS BG Color', 
            'sac_remarks' => 'Remarks', 
            'sac_status' => 'Status', 
            'sac_is_deleted' => 'Is Deleted', 
            'sac_company_id' => 'Company', 
            'sac_created_by' => 'Created By', 
            'sac_created_on' => 'Created On', 
            'sac_last_modified_by' => 'Last Modified By', 
            'sac_last_modified_on' => 'Last Modified On', 
            'sac_deleted_by' => 'Deleted By', 
            'sac_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->sac_id)){
      $condition[] = "sac_id='$this->sac_id'";
    }if(!is_null($this->sac_name)){
      $condition[] = "sac_name='$this->sac_name'";
    }if(!is_null($this->sac_css_color)){
      $condition[] = "sac_css_color='$this->sac_css_color'";
    }if(!is_null($this->sac_css_bg_color)){
      $condition[] = "sac_css_bg_color='$this->sac_css_bg_color'";
    }if(!is_null($this->sac_remarks)){
      $condition[] = "sac_remarks='$this->sac_remarks'";
    }if(!is_null($this->sac_status)){
      $condition[] = "sac_status='$this->sac_status'";
    }if(!is_null($this->sac_is_deleted)){
      $condition[] = "sac_is_deleted='$this->sac_is_deleted'";
    }if(!is_null($this->sac_company_id)){
      $condition[] = "sac_company_id='$this->sac_company_id'";
    }if(!is_null($this->sac_created_by)){
      $condition[] = "sac_created_by='$this->sac_created_by'";
    }if(!is_null($this->sac_created_on)){
      $condition[] = "sac_created_on='$this->sac_created_on'";
    }if(!is_null($this->sac_last_modified_by)){
      $condition[] = "sac_last_modified_by='$this->sac_last_modified_by'";
    }if(!is_null($this->sac_last_modified_on)){
      $condition[] = "sac_last_modified_on='$this->sac_last_modified_on'";
    }if(!is_null($this->sac_deleted_by)){
      $condition[] = "sac_deleted_by='$this->sac_deleted_by'";
    }if(!is_null($this->sac_deleted_on)){
      $condition[] = "sac_deleted_on='$this->sac_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sac_id, sac_name, sac_css_color, sac_css_bg_color, sac_remarks, sac_status, sac_is_deleted, sac_company_id, sac_created_by, sac_created_on, sac_last_modified_by, sac_last_modified_on, sac_deleted_by, sac_deleted_on
          from sys_alert_category
          where ".$conditionStr."
          order by sac_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['sac_id'].'" '; 
      if($this->sac_id == $row['sac_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['sac_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->sac_id)){
      $condition[] = "sac_id='$this->sac_id'";
    }if(!is_null($this->sac_name)){
      $condition[] = "sac_name='$this->sac_name'";
    }if(!is_null($this->sac_css_color)){
      $condition[] = "sac_css_color='$this->sac_css_color'";
    }if(!is_null($this->sac_css_bg_color)){
      $condition[] = "sac_css_bg_color='$this->sac_css_bg_color'";
    }if(!is_null($this->sac_remarks)){
      $condition[] = "sac_remarks='$this->sac_remarks'";
    }if(!is_null($this->sac_status)){
      $condition[] = "sac_status='$this->sac_status'";
    }if(!is_null($this->sac_is_deleted)){
      $condition[] = "sac_is_deleted='$this->sac_is_deleted'";
    }if(!is_null($this->sac_company_id)){
      $condition[] = "sac_company_id='$this->sac_company_id'";
    }if(!is_null($this->sac_created_by)){
      $condition[] = "sac_created_by='$this->sac_created_by'";
    }if(!is_null($this->sac_created_on)){
      $condition[] = "sac_created_on='$this->sac_created_on'";
    }if(!is_null($this->sac_last_modified_by)){
      $condition[] = "sac_last_modified_by='$this->sac_last_modified_by'";
    }if(!is_null($this->sac_last_modified_on)){
      $condition[] = "sac_last_modified_on='$this->sac_last_modified_on'";
    }if(!is_null($this->sac_deleted_by)){
      $condition[] = "sac_deleted_by='$this->sac_deleted_by'";
    }if(!is_null($this->sac_deleted_on)){
      $condition[] = "sac_deleted_on='$this->sac_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sac_id, sac_name, sac_css_color, sac_css_bg_color, sac_remarks, sac_status, sac_is_deleted, sac_company_id, sac_created_by, sac_created_on, sac_last_modified_by, sac_last_modified_on, sac_deleted_by, sac_deleted_on
          from sys_alert_category
          where ".$conditionStr."
          order by sac_id asc";
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
    
    $model = new cls_sys_alert_category($this->db);
  
    $model->sac_id = $result[0]['sac_id'];
    $model->sac_name = $result[0]['sac_name'];
    $model->sac_css_color = $result[0]['sac_css_color'];
    $model->sac_css_bg_color = $result[0]['sac_css_bg_color'];
    $model->sac_remarks = $result[0]['sac_remarks'];
    $model->sac_status = $result[0]['sac_status'];
    $model->sac_is_deleted = $result[0]['sac_is_deleted'];
    $model->sac_company_id = $result[0]['sac_company_id'];
    $model->sac_created_by = $result[0]['sac_created_by'];
    $model->sac_created_on = $result[0]['sac_created_on'];
    $model->sac_last_modified_by = $result[0]['sac_last_modified_by'];
    $model->sac_last_modified_on = $result[0]['sac_last_modified_on'];
    $model->sac_deleted_by = $result[0]['sac_deleted_by'];
    $model->sac_deleted_on = $result[0]['sac_deleted_on'];
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
      $model = new cls_sys_alert_category($this->db);
  
      $model->sac_id = $row['sac_id'];
      $model->sac_name = $row['sac_name'];
      $model->sac_css_color = $row['sac_css_color'];
      $model->sac_css_bg_color = $row['sac_css_bg_color'];
      $model->sac_remarks = $row['sac_remarks'];
      $model->sac_status = $row['sac_status'];
      $model->sac_is_deleted = $row['sac_is_deleted'];
      $model->sac_company_id = $row['sac_company_id'];
      $model->sac_created_by = $row['sac_created_by'];
      $model->sac_created_on = $row['sac_created_on'];
      $model->sac_last_modified_by = $row['sac_last_modified_by'];
      $model->sac_last_modified_on = $row['sac_last_modified_on'];
      $model->sac_deleted_by = $row['sac_deleted_by'];
      $model->sac_deleted_on = $row['sac_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->sac_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->sac_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->sac_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sac_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->sac_created_on))?$this->sac_created_on:date("Y-m-d H:i:s",$this->sac_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sac_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->sac_last_modified_on))?$this->sac_last_modified_on:date("Y-m-d H:i:s",$this->sac_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->sac_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->sac_deleted_on))?$this->sac_deleted_on:date("Y-m-d H:i:s",$this->sac_deleted_on);
  }
}
?>

