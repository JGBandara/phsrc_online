<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-05
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;

/**
 * This is the model class for table "sys_status".
 * @property integer $stat_id
* @property string $stat_name
* @property string $stat_css_class
* @property string $stat_css_color
* @property integer $stat_status
* @property integer $stat_is_deleted
* @property integer $stat_company_id
* @property integer $stat_created_by
* @property integer $stat_created_on
* @property integer $stat_last_modified_by
* @property integer $stat_last_modified_on
* @property integer $stat_deleted_by
* @property integer $stat_deleted_on
*/
class cls_sys_status {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_status';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'stat_id' => 'Id', 
            'stat_name' => 'Name', 
            'stat_css_class' => 'Css Class', 
            'stat_css_color' => 'Css Color', 
            'stat_status' => 'Status', 
            'stat_is_deleted' => 'Is Deleted', 
            'stat_company_id' => 'Company Id', 
            'stat_created_by' => 'Created By', 
            'stat_created_on' => 'Created On', 
            'stat_last_modified_by' => 'Last Modified By', 
            'stat_last_modified_on' => 'Last Modified On', 
            'stat_deleted_by' => 'Deleted By', 
            'stat_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->stat_id)){
      if(is_array($this->stat_id)){
        $idStr = implode(',', $this->stat_id);
        $condition[] = "stat_id in (".$idStr.")";
      }
      else{
        $condition[] = "stat_id='$this->stat_id'";
      }
    }if(!is_null($this->stat_name)){
      $condition[] = "stat_name='$this->stat_name'";
    }if(!is_null($this->stat_css_class)){
      $condition[] = "stat_css_class='$this->stat_css_class'";
    }if(!is_null($this->stat_css_color)){
      $condition[] = "stat_css_color='$this->stat_css_color'";
    }if(!is_null($this->stat_status)){
      $condition[] = "stat_status='$this->stat_status'";
    }if(!is_null($this->stat_is_deleted)){
      $condition[] = "stat_is_deleted='$this->stat_is_deleted'";
    }if(!is_null($this->stat_company_id)){
      $condition[] = "stat_company_id='$this->stat_company_id'";
    }if(!is_null($this->stat_created_by)){
      $condition[] = "stat_created_by='$this->stat_created_by'";
    }if(!is_null($this->stat_created_on)){
      $condition[] = "stat_created_on='$this->stat_created_on'";
    }if(!is_null($this->stat_last_modified_by)){
      $condition[] = "stat_last_modified_by='$this->stat_last_modified_by'";
    }if(!is_null($this->stat_last_modified_on)){
      $condition[] = "stat_last_modified_on='$this->stat_last_modified_on'";
    }if(!is_null($this->stat_deleted_by)){
      $condition[] = "stat_deleted_by='$this->stat_deleted_by'";
    }if(!is_null($this->stat_deleted_on)){
      $condition[] = "stat_deleted_on='$this->stat_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select stat_id, stat_name, stat_css_class, stat_css_color, stat_status, stat_is_deleted, stat_company_id, stat_created_by, stat_created_on, stat_last_modified_by, stat_last_modified_on, stat_deleted_by, stat_deleted_on
          from sys_status
          where ".$conditionStr."
          order by stat_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['stat_id'].'" '; 
      if($this->stat_id == $row['stat_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['stat_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->stat_id)){
      $condition[] = "stat_id='$this->stat_id'";
    }if(!is_null($this->stat_name)){
      $condition[] = "stat_name='$this->stat_name'";
    }if(!is_null($this->stat_css_class)){
      $condition[] = "stat_css_class='$this->stat_css_class'";
    }if(!is_null($this->stat_css_color)){
      $condition[] = "stat_css_color='$this->stat_css_color'";
    }if(!is_null($this->stat_status)){
      $condition[] = "stat_status='$this->stat_status'";
    }if(!is_null($this->stat_is_deleted)){
      $condition[] = "stat_is_deleted='$this->stat_is_deleted'";
    }if(!is_null($this->stat_company_id)){
      $condition[] = "stat_company_id='$this->stat_company_id'";
    }if(!is_null($this->stat_created_by)){
      $condition[] = "stat_created_by='$this->stat_created_by'";
    }if(!is_null($this->stat_created_on)){
      $condition[] = "stat_created_on='$this->stat_created_on'";
    }if(!is_null($this->stat_last_modified_by)){
      $condition[] = "stat_last_modified_by='$this->stat_last_modified_by'";
    }if(!is_null($this->stat_last_modified_on)){
      $condition[] = "stat_last_modified_on='$this->stat_last_modified_on'";
    }if(!is_null($this->stat_deleted_by)){
      $condition[] = "stat_deleted_by='$this->stat_deleted_by'";
    }if(!is_null($this->stat_deleted_on)){
      $condition[] = "stat_deleted_on='$this->stat_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select stat_id, stat_name, stat_css_class, stat_css_color, stat_status, stat_is_deleted, stat_company_id, stat_created_by, stat_created_on, stat_last_modified_by, stat_last_modified_on, stat_deleted_by, stat_deleted_on
          from sys_status
          where ".$conditionStr."
          order by stat_id asc";
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
    
    $model = new cls_sys_status($this->db);
  
    $model->stat_id = $result[0]['stat_id'];
    $model->stat_name = $result[0]['stat_name'];
    $model->stat_css_class = $result[0]['stat_css_class'];
    $model->stat_css_color = $result[0]['stat_css_color'];
    $model->stat_status = $result[0]['stat_status'];
    $model->stat_is_deleted = $result[0]['stat_is_deleted'];
    $model->stat_company_id = $result[0]['stat_company_id'];
    $model->stat_created_by = $result[0]['stat_created_by'];
    $model->stat_created_on = $result[0]['stat_created_on'];
    $model->stat_last_modified_by = $result[0]['stat_last_modified_by'];
    $model->stat_last_modified_on = $result[0]['stat_last_modified_on'];
    $model->stat_deleted_by = $result[0]['stat_deleted_by'];
    $model->stat_deleted_on = $result[0]['stat_deleted_on'];
    return $model;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $modelCompany = new cls_sys_companies($this->db);
    $modelCompany->syc_id = $this->stat_company_id;
    return (is_null($modelCompany->getRecords()))?'':$modelCompany->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $modelStatus = new cls_sys_status($this->db);
    $modelStatus->stat_id = $this->stat_status;
    return (is_null($modelStatus->getRecords()))?'':$modelStatus->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->stat_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->stat_created_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->stat_created_on))?$this->stat_created_on:date("Y-m-d H:i:s",$this->stat_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->stat_last_modified_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->stat_last_modified_on))?$this->stat_last_modified_on:date("Y-m-d H:i:s",$this->stat_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $modelUser = new cls_sys_users($this->db);
    $modelUser->syu_id = $this->stat_deleted_by;
    return (is_null($modelUser->getRecords()))?'':$modelUser->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->stat_deleted_on))?$this->stat_deleted_on:date("Y-m-d H:i:s",$this->stat_deleted_on);
  }
}
?>

