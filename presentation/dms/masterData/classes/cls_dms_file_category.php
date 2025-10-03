<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-11
 */
namespace presentation\dms\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\dms\masterData\classes\cls_dms_file_group;

/**
 * This is the model class for table "dms_file_category".
 * @property integer $dfc_id
* @property string $dfc_name
* @property string $dfc_code
* @property integer $dfc_file_group_id
* @property string $dfc_url
* @property string $dfc_prefix_format
* @property string $dfc_meta_data
* @property integer $dfc_is_related_to_system
* @property string $dfc_remarks
* @property integer $dfc_status
* @property integer $dfc_is_deleted
* @property integer $dfc_company_id
* @property integer $dfc_created_by
* @property integer $dfc_created_on
* @property integer $dfc_last_modified_by
* @property integer $dfc_last_modified_on
* @property integer $dfc_deleted_by
* @property integer $dfc_deleted_on
*/
class cls_dms_file_category {
  private $db;
  	
  function __construct($db){
      $this->db = clone $db;
      
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'dms_file_category';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
      
     return [ 
            'dfc_id' => 'Id', 
            'dfc_name' => 'Name', 
            'dfc_code' => 'Code', 
            'dfc_file_group_id' => 'File Group', 
            'dfc_url' => 'Store Url', 
            'dfc_prefix_format' => 'Prefix Format', 
            'dfc_meta_data' => 'Meta Data', 
            'dfc_is_related_to_system' => 'Is Related To System', 
            'dfc_remarks' => 'Remarks', 
            'dfc_status' => 'Status', 
            'dfc_is_deleted' => 'Is Deleted', 
            'dfc_company_id' => 'Company', 
            'dfc_created_by' => 'Created By', 
            'dfc_created_on' => 'Created On', 
            'dfc_last_modified_by' => 'Last Modified By', 
            'dfc_last_modified_on' => 'Last Modified On', 
            'dfc_deleted_by' => 'Deleted By', 
            'dfc_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
      
    $condition = [];
    if(!is_null($this->dfc_id)){
      $condition[] = "dfc_id='$this->dfc_id'";
    }if(!is_null($this->dfc_name)){
      $condition[] = "dfc_name='$this->dfc_name'";
    }if(!is_null($this->dfc_code)){
      $condition[] = "dfc_code='$this->dfc_code'";
    }if(!is_null($this->dfc_file_group_id)){
      $condition[] = "dfc_file_group_id='$this->dfc_file_group_id'";
    }if(!is_null($this->dfc_url)){
      $condition[] = "dfc_url='$this->dfc_url'";
    }if(!is_null($this->dfc_prefix_format)){
      $condition[] = "dfc_prefix_format='$this->dfc_prefix_format'";
    }if(!is_null($this->dfc_meta_data)){
      $condition[] = "dfc_meta_data='$this->dfc_meta_data'";
    }if(!is_null($this->dfc_is_related_to_system)){
      $condition[] = "dfc_is_related_to_system='$this->dfc_is_related_to_system'";
    }if(!is_null($this->dfc_remarks)){
      $condition[] = "dfc_remarks='$this->dfc_remarks'";
    }if(!is_null($this->dfc_status)){
      $condition[] = "dfc_status='$this->dfc_status'";
    }if(!is_null($this->dfc_is_deleted)){
      $condition[] = "dfc_is_deleted='$this->dfc_is_deleted'";
    }if(!is_null($this->dfc_company_id)){
      $condition[] = "dfc_company_id='$this->dfc_company_id'";
    }if(!is_null($this->dfc_created_by)){
      $condition[] = "dfc_created_by='$this->dfc_created_by'";
    }if(!is_null($this->dfc_created_on)){
      $condition[] = "dfc_created_on='$this->dfc_created_on'";
    }if(!is_null($this->dfc_last_modified_by)){
      $condition[] = "dfc_last_modified_by='$this->dfc_last_modified_by'";
    }if(!is_null($this->dfc_last_modified_on)){
      $condition[] = "dfc_last_modified_on='$this->dfc_last_modified_on'";
    }if(!is_null($this->dfc_deleted_by)){
      $condition[] = "dfc_deleted_by='$this->dfc_deleted_by'";
    }if(!is_null($this->dfc_deleted_on)){
      $condition[] = "dfc_deleted_on='$this->dfc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    
    $sql = "SELECT
dms_file_category.dfc_id,
dms_file_category.dfc_name,
dms_file_category.dfc_code,
dms_file_category.dfc_file_group_id,
dms_file_category.dfc_url,
dms_file_category.dfc_prefix_format,
dms_file_category.dfc_meta_data,
dms_file_category.dfc_is_related_to_system,
dms_file_category.dfc_remarks,
dms_file_category.dfc_status,
dms_file_category.dfc_is_deleted,
dms_file_category.dfc_company_id,
dms_file_category.dfc_created_by,
dms_file_category.dfc_created_on,
dms_file_category.dfc_last_modified_by,
dms_file_category.dfc_last_modified_on,
dms_file_category.dfc_deleted_by,
dms_file_category.dfc_deleted_on,
dms_file_group.dfg_name
FROM
dms_file_category
Inner Join dms_file_group ON dms_file_category.dfc_file_group_id = dms_file_group.dfg_id
          where ".$conditionStr."
          order by dfg_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dfc_id'].'" '; 
      if($this->dfc_id == $row['dfc_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dfg_name'].' - '.$row['dfc_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dfc_id)){
      $condition[] = "dfc_id='$this->dfc_id'";
    }if(!is_null($this->dfc_name)){
      $condition[] = "dfc_name='$this->dfc_name'";
    }if(!is_null($this->dfg_name)){
      $condition[] = "dfg_name='$this->dfg_name'";
    }if(!is_null($this->dfc_code)){
      $condition[] = "dfc_code='$this->dfc_code'";
    }if(!is_null($this->dfc_file_group_id)){
      $condition[] = "dfc_file_group_id='$this->dfc_file_group_id'";
    }if(!is_null($this->dfc_url)){
      $condition[] = "dfc_url='$this->dfc_url'";
    }if(!is_null($this->dfc_prefix_format)){
      $condition[] = "dfc_prefix_format='$this->dfc_prefix_format'";
    }if(!is_null($this->dfc_meta_data)){
      $condition[] = "dfc_meta_data='$this->dfc_meta_data'";
    }if(!is_null($this->dfc_is_related_to_system)){
      $condition[] = "dfc_is_related_to_system='$this->dfc_is_related_to_system'";
    }if(!is_null($this->dfc_remarks)){
      $condition[] = "dfc_remarks='$this->dfc_remarks'";
    }if(!is_null($this->dfc_status)){
      $condition[] = "dfc_status='$this->dfc_status'";
    }if(!is_null($this->dfc_is_deleted)){
      $condition[] = "dfc_is_deleted='$this->dfc_is_deleted'";
    }if(!is_null($this->dfc_company_id)){
      $condition[] = "dfc_company_id='$this->dfc_company_id'";
    }if(!is_null($this->dfc_created_by)){
      $condition[] = "dfc_created_by='$this->dfc_created_by'";
    }if(!is_null($this->dfc_created_on)){
      $condition[] = "dfc_created_on='$this->dfc_created_on'";
    }if(!is_null($this->dfc_last_modified_by)){
      $condition[] = "dfc_last_modified_by='$this->dfc_last_modified_by'";
    }if(!is_null($this->dfc_last_modified_on)){
      $condition[] = "dfc_last_modified_on='$this->dfc_last_modified_on'";
    }if(!is_null($this->dfc_deleted_by)){
      $condition[] = "dfc_deleted_by='$this->dfc_deleted_by'";
    }if(!is_null($this->dfc_deleted_on)){
      $condition[] = "dfc_deleted_on='$this->dfc_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "SELECT
dms_file_category.dfc_id,
dms_file_category.dfc_name,
dms_file_category.dfc_code,
dms_file_category.dfc_file_group_id,
dms_file_category.dfc_url,
dms_file_category.dfc_prefix_format,
dms_file_category.dfc_meta_data,
dms_file_category.dfc_is_related_to_system,
dms_file_category.dfc_remarks,
dms_file_category.dfc_status,
dms_file_category.dfc_is_deleted,
dms_file_category.dfc_company_id,
dms_file_category.dfc_created_by,
dms_file_category.dfc_created_on,
dms_file_category.dfc_last_modified_by,
dms_file_category.dfc_last_modified_on,
dms_file_category.dfc_deleted_by,
dms_file_category.dfc_deleted_on,
dms_file_group.dfg_name
FROM
dms_file_category
Inner Join dms_file_group ON dms_file_category.dfc_file_group_id = dms_file_group.dfg_id
          where ".$conditionStr."
          order by dfc_id asc";
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
    
    $model = new cls_dms_file_category($this->db);
  
    $model->dfc_id = $result[0]['dfc_id'];
    $model->dfc_name = $result[0]['dfc_name'];
    $model->dfc_code = $result[0]['dfc_code'];
    $model->dfc_file_group_id = $result[0]['dfc_file_group_id'];
    $model->dfc_url = $result[0]['dfc_url'];
    $model->dfc_prefix_format = $result[0]['dfc_prefix_format'];
    $model->dfc_meta_data = $result[0]['dfc_meta_data'];
    $model->dfc_is_related_to_system = $result[0]['dfc_is_related_to_system'];
    $model->dfc_remarks = $result[0]['dfc_remarks'];
    $model->dfc_status = $result[0]['dfc_status'];
    $model->dfc_is_deleted = $result[0]['dfc_is_deleted'];
    $model->dfc_company_id = $result[0]['dfc_company_id'];
    $model->dfc_created_by = $result[0]['dfc_created_by'];
    $model->dfc_created_on = $result[0]['dfc_created_on'];
    $model->dfc_last_modified_by = $result[0]['dfc_last_modified_by'];
    $model->dfc_last_modified_on = $result[0]['dfc_last_modified_on'];
    $model->dfc_deleted_by = $result[0]['dfc_deleted_by'];
    $model->dfc_deleted_on = $result[0]['dfc_deleted_on'];
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
      $model = new cls_dms_file_category($this->db);
  
      $model->dfc_id = $row['dfc_id'];
      $model->dfc_name = $row['dfc_name'];
      $model->dfc_code = $row['dfc_code'];
      $model->dfc_file_group_id = $row['dfc_file_group_id'];
      $model->dfc_url = $row['dfc_url'];
      $model->dfc_prefix_format = $row['dfc_prefix_format'];
      $model->dfc_meta_data = $row['dfc_meta_data'];
      $model->dfc_is_related_to_system = $row['dfc_is_related_to_system'];
      $model->dfc_remarks = $row['dfc_remarks'];
      $model->dfc_status = $row['dfc_status'];
      $model->dfc_is_deleted = $row['dfc_is_deleted'];
      $model->dfc_company_id = $row['dfc_company_id'];
      $model->dfc_created_by = $row['dfc_created_by'];
      $model->dfc_created_on = $row['dfc_created_on'];
      $model->dfc_last_modified_by = $row['dfc_last_modified_by'];
      $model->dfc_last_modified_on = $row['dfc_last_modified_on'];
      $model->dfc_deleted_by = $row['dfc_deleted_by'];
      $model->dfc_deleted_on = $row['dfc_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Delete Status
  */
  public function getIsRelatedToSystem(){
    return ($this->dfc_is_related_to_system=='1')?'Yes':'No';
  }
  /**
  * @return File Group
  */
  public function getFileGroup(){
    $model = new cls_dms_file_group($this->db);
    $model->dfg_id = $this->dfc_file_group_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->dfg_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dfc_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dfc_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dfc_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfc_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dfc_created_on))?$this->dfc_created_on:date("Y-m-d H:i:s",$this->dfc_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfc_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dfc_last_modified_on))?$this->dfc_last_modified_on:date("Y-m-d H:i:s",$this->dfc_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfc_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dfc_deleted_on))?$this->dfc_deleted_on:date("Y-m-d H:i:s",$this->dfc_deleted_on);
  }
}
?>

