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
 * This is the model class for table "sys_district".
 * @property integer $syd_id
* @property string $syd_name
* @property string $syd_code
* @property integer $syd_province_id
* @property integer $syd_status
* @property integer $syd_company_id
* @property integer $syd_created_by
* @property integer $syd_created_on
* @property integer $syd_last_modified_by
* @property integer $syd_last_modified_on
* @property integer $syd_deleted_by
* @property integer $syd_deleted_on
*/
class cls_sys_record_keeping {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'tbl_record_keep';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'record_keep_id' => 'Id', 
            'record_type' => 'Type',
            'record_is_Deleted' => 'Is Deleted',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->record_is_Deleted)){
      $condition[] = "record_is_Deleted='$this->record_is_Deleted'";
    }if(!is_null($this->record_type)){
      $condition[] = "record_type='$this->record_type'";
    }if(!is_null($this->record_is_Deleted)){
      $condition[] = "record_is_Deleted='$this->record_is_Deleted'";
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
record_keep_id,
record_type,
record_is_Deleted
FROM
tbl_record_keep
          where ".$conditionStr."
          order by record_keep_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['record_keep_id'].'" '; 
      if($this->syd_id == $row['record_keep_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['record_type'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->record_keep_id)){
      $condition[] = "record_keep_id='$this->record_keep_id'";
    }if(!is_null($this->record_type)){
      $condition[] = "record_type='$this->record_type'";
    }if(!is_null($this->syd_is_deleted)){
      $condition[] = "record_is_Deleted='$this->record_is_Deleted'";
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
record_keep_id,
record_type,
record_is_Deleted
FROM
tbl_record_keep
          where ".$conditionStr."
          order by record_keep_id asc";
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
    
    $model = new cls_sys_record_keeping($this->db);
  
    $model->record_keep_id = $result[0]['record_keep_id'];
    $model->record_type = $result[0]['record_type'];
    $model->record_is_Deleted = $result[0]['record_is_Deleted'];
    return $model;
  }
 
}
?>

