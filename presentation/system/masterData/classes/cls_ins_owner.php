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
class cls_ins_owner {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'tbl_owner';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'ownership_id' => 'Id', 
            'ownership' => 'Name',
            'ownership_is_Deleted' => 'Is Deleted',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->ownership_id)){
      $condition[] = "ownership_id='$this->ownership_id'";
    }if(!is_null($this->ownership)){
      $condition[] = "ownership='$this->ownership'";
    }if(!is_null($this->ownership_is_Deleted)){
      $condition[] = "ownership_is_Deleted='$this->ownership_is_Deleted'";
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
ownership_id,
ownership,
ownership_is_Deleted
FROM
tbl_owner
          where ".$conditionStr."
          order by ownership_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['ownership_id'].'" '; 
      if($this->syd_id == $row['ownership_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['ownership'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->ownership_id)){
      $condition[] = "ownership_id='$this->ownership_id'";
    }if(!is_null($this->ownership)){
      $condition[] = "ownership='$this->ownership'";
    }if(!is_null($this->ownership_is_Deleted)){
      $condition[] = "ownership_is_Deleted='$this->ownership_is_Deleted'";
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
ownership_id,
ownership,
ownership_is_Deleted
FROM
tbl_owner
          where ".$conditionStr."
          order by ownership_id asc";
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
    
    $model = new cls_ins_owner($this->db);
  
    $model->ownership_id = $result[0]['ownership_id'];
    $model->ownership = $result[0]['ownership'];
    $model->ownership_is_Deleted = $result[0]['ownership_is_Deleted'];
    return $model;
  }
 
}
?>

