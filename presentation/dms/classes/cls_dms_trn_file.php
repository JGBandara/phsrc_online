<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */
namespace presentation\dms\classes;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\dms\masterData\classes\cls_dms_file_category;
use presentation\dms\masterData\classes\cls_dms_file_group;

/**
 * This is the model class for table "dms_trn_file".
 * @property integer $dfi_id
* @property string $dfi_file_name
* @property string $dfi_file_extension
* @property string $dfi_store_location
* @property string $dfi_url
* @property string $dfi_reference_no
* @property integer $dfi_reference_id
* @property integer $dfi_file_category_id
* @property string $dfi_file_version
* @property string $dfi_meta_data
* @property string $dfi_remarks
* @property integer $dfi_status
* @property integer $dfi_is_deleted
* @property integer $dfi_company_id
* @property integer $dfi_created_by
* @property integer $dfi_created_on
* @property integer $dfi_last_modified_by
* @property integer $dfi_last_modified_on
* @property integer $dfi_deleted_by
* @property integer $dfi_deleted_on
*/
class cls_dms_trn_file {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'dms_trn_file';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'dfi_id' => 'Id', 
            'dfi_file_name' => 'File Name', 
            'dfi_file_extension' => 'File Extension', 
            'dfi_store_location' => 'Store Location', 
            'dfi_url' => 'Url', 
            'dfi_reference_no' => 'Reference No', 
            'dfi_reference_id' => 'Reference', 
            'dfi_file_category_id' => 'File Category', 
            'dfi_file_version' => 'File Version', 
            'dfi_meta_data' => 'Meta Data', 
            'dfi_remarks' => 'Remarks', 
            'dfi_status' => 'Status', 
            'dfi_is_deleted' => 'Is Deleted', 
            'dfi_company_id' => 'Company', 
            'dfi_created_by' => 'Created By', 
            'dfi_created_on' => 'Created On', 
            'dfi_last_modified_by' => 'Last Modified By', 
            'dfi_last_modified_on' => 'Last Modified On', 
            'dfi_deleted_by' => 'Deleted By', 
            'dfi_deleted_on' => 'Deleted On',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->dfi_id)){
      $condition[] = "dfi_id='$this->dfi_id'";
    }if(!is_null($this->dfi_file_name)){
      $condition[] = "dfi_file_name='$this->dfi_file_name'";
    }if(!is_null($this->dfi_file_extension)){
      $condition[] = "dfi_file_extension='$this->dfi_file_extension'";
    }if(!is_null($this->dfi_store_location)){
      $condition[] = "dfi_store_location='$this->dfi_store_location'";
    }if(!is_null($this->dfi_url)){
      $condition[] = "dfi_url='$this->dfi_url'";
    }if(!is_null($this->dfi_reference_no)){
      $condition[] = "dfi_reference_no='$this->dfi_reference_no'";
    }if(!is_null($this->dfi_reference_id)){
      $condition[] = "dfi_reference_id='$this->dfi_reference_id'";
    }if(!is_null($this->dfi_file_category_id)){
      $condition[] = "dfi_file_category_id='$this->dfi_file_category_id'";
    }if(!is_null($this->dfi_file_version)){
      $condition[] = "dfi_file_version='$this->dfi_file_version'";
    }if(!is_null($this->dfi_meta_data)){
      $condition[] = "dfi_meta_data='$this->dfi_meta_data'";
    }if(!is_null($this->dfi_remarks)){
      $condition[] = "dfi_remarks='$this->dfi_remarks'";
    }if(!is_null($this->dfi_status)){
      $condition[] = "dfi_status='$this->dfi_status'";
    }if(!is_null($this->dfi_is_deleted)){
      $condition[] = "dfi_is_deleted='$this->dfi_is_deleted'";
    }if(!is_null($this->dfi_company_id)){
      $condition[] = "dfi_company_id='$this->dfi_company_id'";
    }if(!is_null($this->dfi_created_by)){
      $condition[] = "dfi_created_by='$this->dfi_created_by'";
    }if(!is_null($this->dfi_created_on)){
      $condition[] = "dfi_created_on='$this->dfi_created_on'";
    }if(!is_null($this->dfi_last_modified_by)){
      $condition[] = "dfi_last_modified_by='$this->dfi_last_modified_by'";
    }if(!is_null($this->dfi_last_modified_on)){
      $condition[] = "dfi_last_modified_on='$this->dfi_last_modified_on'";
    }if(!is_null($this->dfi_deleted_by)){
      $condition[] = "dfi_deleted_by='$this->dfi_deleted_by'";
    }if(!is_null($this->dfi_deleted_on)){
      $condition[] = "dfi_deleted_on='$this->dfi_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1 and dfc_is_related_to_system='0' ";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    
   $sql = "select dfi_id, dfi_file_name, dfi_file_extension, dfi_store_location, dfi_url, dfi_reference_no, dfi_reference_id, dfi_file_category_id, dfi_file_version, dfi_meta_data, dfi_remarks, dfi_status, dfi_is_deleted, dfi_company_id, dfi_created_by, dfi_created_on, dfi_last_modified_by, dfi_last_modified_on, dfi_deleted_by, dfi_deleted_on
          from dms_trn_file
            inner join dms_file_category on dfi_file_category_id=dfc_id
          where ".$conditionStr."
          order by dfi_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['dfi_id'].'" '; 
      if($this->dfi_id == $row['dfi_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['dfi_file_name'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->dfi_id)){
      $condition[] = "dfi_id='$this->dfi_id'";
    }if(!is_null($this->dfi_file_name)){
      $condition[] = "dfi_file_name='$this->dfi_file_name'";
    }if(!is_null($this->dfi_file_extension)){
      $condition[] = "dfi_file_extension='$this->dfi_file_extension'";
    }if(!is_null($this->dfi_store_location)){
      $condition[] = "dfi_store_location='$this->dfi_store_location'";
    }if(!is_null($this->dfi_url)){
      $condition[] = "dfi_url='$this->dfi_url'";
    }if(!is_null($this->dfi_reference_no)){
      $condition[] = "dfi_reference_no='$this->dfi_reference_no'";
    }if(!is_null($this->dfi_reference_id)){
      $condition[] = "dfi_reference_id='$this->dfi_reference_id'";
    }if(!is_null($this->dfi_file_category_id)){
      $condition[] = "dfi_file_category_id='$this->dfi_file_category_id'";
    }if(!is_null($this->dfi_file_version)){
      $condition[] = "dfi_file_version='$this->dfi_file_version'";
    }if(!is_null($this->dfi_meta_data)){
      $condition[] = "dfi_meta_data='$this->dfi_meta_data'";
    }if(!is_null($this->dfi_remarks)){
      $condition[] = "dfi_remarks='$this->dfi_remarks'";
    }if(!is_null($this->dfi_status)){
      $condition[] = "dfi_status='$this->dfi_status'";
    }if(!is_null($this->dfi_is_deleted)){
      $condition[] = "dfi_is_deleted='$this->dfi_is_deleted'";
    }if(!is_null($this->dfi_company_id)){
      $condition[] = "dfi_company_id='$this->dfi_company_id'";
    }if(!is_null($this->dfi_created_by)){
      $condition[] = "dfi_created_by='$this->dfi_created_by'";
    }if(!is_null($this->dfi_created_on)){
      $condition[] = "dfi_created_on='$this->dfi_created_on'";
    }if(!is_null($this->dfi_last_modified_by)){
      $condition[] = "dfi_last_modified_by='$this->dfi_last_modified_by'";
    }if(!is_null($this->dfi_last_modified_on)){
      $condition[] = "dfi_last_modified_on='$this->dfi_last_modified_on'";
    }if(!is_null($this->dfi_deleted_by)){
      $condition[] = "dfi_deleted_by='$this->dfi_deleted_by'";
    }if(!is_null($this->dfi_deleted_on)){
      $condition[] = "dfi_deleted_on='$this->dfi_deleted_on'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select dfi_id, dfi_file_name, dfi_file_extension, dfi_store_location, dfi_url, dfi_reference_no, dfi_reference_id, dfi_file_category_id, dfi_file_version, dfi_meta_data, dfi_remarks, dfi_status, dfi_is_deleted, dfi_company_id, dfi_created_by, dfi_created_on, dfi_last_modified_by, dfi_last_modified_on, dfi_deleted_by, dfi_deleted_on
          from dms_trn_file
          where ".$conditionStr."
          order by dfi_id asc";
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
    
    $model = new cls_dms_trn_file($this->db);
  
    $model->dfi_id = $result[0]['dfi_id'];
    $model->dfi_file_name = $result[0]['dfi_file_name'];
    $model->dfi_file_extension = $result[0]['dfi_file_extension'];
    $model->dfi_store_location = $result[0]['dfi_store_location'];
    $model->dfi_url = $result[0]['dfi_url'];
    $model->dfi_reference_no = $result[0]['dfi_reference_no'];
    $model->dfi_reference_id = $result[0]['dfi_reference_id'];
    $model->dfi_file_category_id = $result[0]['dfi_file_category_id'];
    $model->dfi_file_version = $result[0]['dfi_file_version'];
    $model->dfi_meta_data = $result[0]['dfi_meta_data'];
    $model->dfi_remarks = $result[0]['dfi_remarks'];
    $model->dfi_status = $result[0]['dfi_status'];
    $model->dfi_is_deleted = $result[0]['dfi_is_deleted'];
    $model->dfi_company_id = $result[0]['dfi_company_id'];
    $model->dfi_created_by = $result[0]['dfi_created_by'];
    $model->dfi_created_on = $result[0]['dfi_created_on'];
    $model->dfi_last_modified_by = $result[0]['dfi_last_modified_by'];
    $model->dfi_last_modified_on = $result[0]['dfi_last_modified_on'];
    $model->dfi_deleted_by = $result[0]['dfi_deleted_by'];
    $model->dfi_deleted_on = $result[0]['dfi_deleted_on'];
    return $model;
  }
  /**
  * @inheritdoc
  */
  public function getVersionNo(){
    if($this->dfi_reference_id=="0"){
      $sql = "select dfi_file_version+0.01 as 'version'
              from dms_trn_file 
              where dfi_reference_no='$this->dfi_reference_no' and dfi_file_category_id='$this->dfi_file_category_id' and dfi_company_id='$this->dfi_company_id'
              order by dfi_file_version desc 
              limit 1";
    }
    else{
      $sql = "select dfi_file_version+0.01 as 'version'
              from dms_trn_file 
              where dfi_reference_id='$this->dfi_reference_id' and dfi_file_category_id='$this->dfi_file_category_id' and dfi_company_id='$this->dfi_company_id'
              order by dfi_file_version desc 
              limit 1";
    }
    $result = $this->db->singleQuery($sql);
    $version = '1.00';
    if($row = mysqli_fetch_array($result)){
      $version = $row['version'];
    }
    return $version;
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
      $model = new cls_dms_trn_file($this->db);
  
      $model->dfi_id = $row['dfi_id'];
      $model->dfi_file_name = $row['dfi_file_name'];
      $model->dfi_file_extension = $row['dfi_file_extension'];
      $model->dfi_store_location = $row['dfi_store_location'];
      $model->dfi_url = $row['dfi_url'];
      $model->dfi_reference_no = $row['dfi_reference_no'];
      $model->dfi_reference_id = $row['dfi_reference_id'];
      $model->dfi_file_category_id = $row['dfi_file_category_id'];
      $model->dfi_file_version = $row['dfi_file_version'];
      $model->dfi_meta_data = $row['dfi_meta_data'];
      $model->dfi_remarks = $row['dfi_remarks'];
      $model->dfi_status = $row['dfi_status'];
      $model->dfi_is_deleted = $row['dfi_is_deleted'];
      $model->dfi_company_id = $row['dfi_company_id'];
      $model->dfi_created_by = $row['dfi_created_by'];
      $model->dfi_created_on = $row['dfi_created_on'];
      $model->dfi_last_modified_by = $row['dfi_last_modified_by'];
      $model->dfi_last_modified_on = $row['dfi_last_modified_on'];
      $model->dfi_deleted_by = $row['dfi_deleted_by'];
      $model->dfi_deleted_on = $row['dfi_deleted_on'];
      $models[] = $model;
    }
    return $models;
  }
  /**
  * @return Group
  */
  public function getGroup(){
    $modelCat = new cls_dms_file_category($this->db);
    $modelCat->dfc_id = $this->dfi_file_category_id;
    
    $model = new cls_dms_file_group($this->db);
    $model->dfg_id = $modelCat->findModel()->dfc_file_group_id;;
    return (is_null($model->getRecords()))?'':$model->findModel()->dfg_name;
  }
  /**
  * @return Category
  */
  public function getCategory(){
    $modelCat = new cls_dms_file_category($this->db);
    $modelCat->dfc_id = $this->dfi_file_category_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->dfc_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->dfi_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->dfi_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->dfi_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfi_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->dfi_created_on))?$this->dfi_created_on:date("Y-m-d H:i:s",$this->dfi_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfi_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->dfi_last_modified_on))?$this->dfi_last_modified_on:date("Y-m-d H:i:s",$this->dfi_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->dfi_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->dfi_deleted_on))?$this->dfi_deleted_on:date("Y-m-d H:i:s",$this->dfi_deleted_on);
  }
}
?>

