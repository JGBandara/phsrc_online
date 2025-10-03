<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-21
 */
namespace presentation\system\masterData\classes ;

use presentation\system\masterData\classes\cls_sys_companies;
use presentation\system\masterData\classes\cls_sys_users;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_location;

/**
 * This is the model class for table "sys_permission".
 * @property integer $syp_menu_id
* @property integer $syp_user_id
* @property integer $syp_view
* @property integer $syp_list
* @property integer $syp_add
* @property integer $syp_edit
* @property integer $syp_delete
* @property integer $syp_approval_1
* @property integer $syp_approval_2
* @property integer $syp_approval_3
* @property integer $syp_approval_4
* @property integer $syp_approval_5
* @property integer $syp_send_to_approval
* @property integer $syp_print
* @property integer $syp_reject
* @property integer $syp_revise
* @property integer $syp_admin_right
* @property integer $syp_copy_to_clipboard
* @property integer $syp_export_to_excel
* @property integer $syp_export_to_pdf
* @property integer $syp_location_id
* @property integer $syp_company_id
*/
class cls_sys_permission {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_permission';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'syp_menu_id' => 'Menu Id', 
            'syp_user_id' => 'User Id', 
            'syp_view' => 'View', 
            'syp_list' => 'List', 
            'syp_add' => 'Add', 
            'syp_edit' => 'Edit', 
            'syp_delete' => 'Delete', 
            'syp_approval_1' => 'Approval 1', 
            'syp_approval_2' => 'Approval 2', 
            'syp_approval_3' => 'Approval 3', 
            'syp_approval_4' => 'Approval 4', 
            'syp_approval_5' => 'Approval 5', 
            'syp_send_to_approval' => 'Send To Approval', 
            'syp_print' => 'Print', 
            'syp_reject' => 'Reject', 
            'syp_revise' => 'Revise', 
            'syp_admin_right' => 'Admin Right', 
            'syp_copy_to_clipboard' => 'Copy To Clipboard', 
            'syp_export_to_excel' => 'Export To Excel', 
            'syp_export_to_pdf' => 'Export To Pdf', 
            'syp_location_id' => 'Location Id', 
            'syp_company_id' => 'Company Id',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->syp_menu_id)){
      $condition[] = "syp_menu_id='$this->syp_menu_id'";
    }if(!is_null($this->syp_user_id)){
      $condition[] = "syp_user_id='$this->syp_user_id'";
    }if(!is_null($this->syp_view)){
      $condition[] = "syp_view='$this->syp_view'";
    }if(!is_null($this->syp_list)){
      $condition[] = "syp_list='$this->syp_list'";
    }if(!is_null($this->syp_add)){
      $condition[] = "syp_add='$this->syp_add'";
    }if(!is_null($this->syp_edit)){
      $condition[] = "syp_edit='$this->syp_edit'";
    }if(!is_null($this->syp_delete)){
      $condition[] = "syp_delete='$this->syp_delete'";
    }if(!is_null($this->syp_approval_1)){
      $condition[] = "syp_approval_1='$this->syp_approval_1'";
    }if(!is_null($this->syp_approval_2)){
      $condition[] = "syp_approval_2='$this->syp_approval_2'";
    }if(!is_null($this->syp_approval_3)){
      $condition[] = "syp_approval_3='$this->syp_approval_3'";
    }if(!is_null($this->syp_approval_4)){
      $condition[] = "syp_approval_4='$this->syp_approval_4'";
    }if(!is_null($this->syp_approval_5)){
      $condition[] = "syp_approval_5='$this->syp_approval_5'";
    }if(!is_null($this->syp_send_to_approval)){
      $condition[] = "syp_send_to_approval='$this->syp_send_to_approval'";
    }if(!is_null($this->syp_print)){
      $condition[] = "syp_print='$this->syp_print'";
    }if(!is_null($this->syp_reject)){
      $condition[] = "syp_reject='$this->syp_reject'";
    }if(!is_null($this->syp_revise)){
      $condition[] = "syp_revise='$this->syp_revise'";
    }if(!is_null($this->syp_admin_right)){
      $condition[] = "syp_admin_right='$this->syp_admin_right'";
    }if(!is_null($this->syp_copy_to_clipboard)){
      $condition[] = "syp_copy_to_clipboard='$this->syp_copy_to_clipboard'";
    }if(!is_null($this->syp_export_to_excel)){
      $condition[] = "syp_export_to_excel='$this->syp_export_to_excel'";
    }if(!is_null($this->syp_export_to_pdf)){
      $condition[] = "syp_export_to_pdf='$this->syp_export_to_pdf'";
    }if(!is_null($this->syp_location_id)){
      $condition[] = "syp_location_id='$this->syp_location_id'";
    }if(!is_null($this->syp_company_id)){
      $condition[] = "syp_company_id='$this->syp_company_id'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syp_menu_id, syp_user_id, syp_view, syp_list, syp_add, syp_edit, syp_delete, syp_approval_1, syp_approval_2, syp_approval_3, syp_approval_4, syp_approval_5, syp_send_to_approval, syp_print, syp_reject, syp_revise, syp_admin_right, syp_copy_to_clipboard, syp_export_to_excel, syp_export_to_pdf, syp_location_id, syp_company_id
          from sys_permission
          where ".$conditionStr."
          order by syp_menu_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['syp_menu_id'].'" '; 
      if($this->syp_menu_id == $row['syp_menu_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['syp_user_id'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->syp_menu_id)){
      $condition[] = "syp_menu_id='$this->syp_menu_id'";
    }if(!is_null($this->syp_user_id)){
      $condition[] = "syp_user_id='$this->syp_user_id'";
    }if(!is_null($this->syp_view)){
      $condition[] = "syp_view='$this->syp_view'";
    }if(!is_null($this->syp_list)){
      $condition[] = "syp_list='$this->syp_list'";
    }if(!is_null($this->syp_add)){
      $condition[] = "syp_add='$this->syp_add'";
    }if(!is_null($this->syp_edit)){
      $condition[] = "syp_edit='$this->syp_edit'";
    }if(!is_null($this->syp_delete)){
      $condition[] = "syp_delete='$this->syp_delete'";
    }if(!is_null($this->syp_approval_1)){
      $condition[] = "syp_approval_1='$this->syp_approval_1'";
    }if(!is_null($this->syp_approval_2)){
      $condition[] = "syp_approval_2='$this->syp_approval_2'";
    }if(!is_null($this->syp_approval_3)){
      $condition[] = "syp_approval_3='$this->syp_approval_3'";
    }if(!is_null($this->syp_approval_4)){
      $condition[] = "syp_approval_4='$this->syp_approval_4'";
    }if(!is_null($this->syp_approval_5)){
      $condition[] = "syp_approval_5='$this->syp_approval_5'";
    }if(!is_null($this->syp_send_to_approval)){
      $condition[] = "syp_send_to_approval='$this->syp_send_to_approval'";
    }if(!is_null($this->syp_print)){
      $condition[] = "syp_print='$this->syp_print'";
    }if(!is_null($this->syp_reject)){
      $condition[] = "syp_reject='$this->syp_reject'";
    }if(!is_null($this->syp_revise)){
      $condition[] = "syp_revise='$this->syp_revise'";
    }if(!is_null($this->syp_admin_right)){
      $condition[] = "syp_admin_right='$this->syp_admin_right'";
    }if(!is_null($this->syp_copy_to_clipboard)){
      $condition[] = "syp_copy_to_clipboard='$this->syp_copy_to_clipboard'";
    }if(!is_null($this->syp_export_to_excel)){
      $condition[] = "syp_export_to_excel='$this->syp_export_to_excel'";
    }if(!is_null($this->syp_export_to_pdf)){
      $condition[] = "syp_export_to_pdf='$this->syp_export_to_pdf'";
    }if(!is_null($this->syp_location_id)){
      $condition[] = "syp_location_id='$this->syp_location_id'";
    }if(!is_null($this->syp_company_id)){
      $condition[] = "syp_company_id='$this->syp_company_id'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select syp_menu_id, syp_user_id, syp_view, syp_list, syp_add, syp_edit, syp_delete, syp_approval_1, syp_approval_2, syp_approval_3, syp_approval_4, syp_approval_5, syp_send_to_approval, syp_print, syp_reject, syp_revise, syp_admin_right, syp_copy_to_clipboard, syp_export_to_excel, syp_export_to_pdf, syp_location_id, syp_company_id
          from sys_permission
          where ".$conditionStr."
          order by syp_menu_id asc";
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
    
    $model = new cls_sys_permission($this->db);
  
    $model->syp_menu_id = $result[0]['syp_menu_id'];
    $model->syp_user_id = $result[0]['syp_user_id'];
    $model->syp_view = $result[0]['syp_view'];
    $model->syp_list = $result[0]['syp_list'];
    $model->syp_add = $result[0]['syp_add'];
    $model->syp_edit = $result[0]['syp_edit'];
    $model->syp_delete = $result[0]['syp_delete'];
    $model->syp_approval_1 = $result[0]['syp_approval_1'];
    $model->syp_approval_2 = $result[0]['syp_approval_2'];
    $model->syp_approval_3 = $result[0]['syp_approval_3'];
    $model->syp_approval_4 = $result[0]['syp_approval_4'];
    $model->syp_approval_5 = $result[0]['syp_approval_5'];
    $model->syp_send_to_approval = $result[0]['syp_send_to_approval'];
    $model->syp_print = $result[0]['syp_print'];
    $model->syp_reject = $result[0]['syp_reject'];
    $model->syp_revise = $result[0]['syp_revise'];
    $model->syp_admin_right = $result[0]['syp_admin_right'];
    $model->syp_copy_to_clipboard = $result[0]['syp_copy_to_clipboard'];
    $model->syp_export_to_excel = $result[0]['syp_export_to_excel'];
    $model->syp_export_to_pdf = $result[0]['syp_export_to_pdf'];
    $model->syp_location_id = $result[0]['syp_location_id'];
    $model->syp_company_id = $result[0]['syp_company_id'];
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
      $model = new cls_sys_permission($this->db);
  
      $model->syp_menu_id = $row['syp_menu_id'];
      $model->syp_user_id = $row['syp_user_id'];
      $model->syp_view = $row['syp_view'];
      $model->syp_list = $row['syp_list'];
      $model->syp_add = $row['syp_add'];
      $model->syp_edit = $row['syp_edit'];
      $model->syp_delete = $row['syp_delete'];
      $model->syp_approval_1 = $row['syp_approval_1'];
      $model->syp_approval_2 = $row['syp_approval_2'];
      $model->syp_approval_3 = $row['syp_approval_3'];
      $model->syp_approval_4 = $row['syp_approval_4'];
      $model->syp_approval_5 = $row['syp_approval_5'];
      $model->syp_send_to_approval = $row['syp_send_to_approval'];
      $model->syp_print = $row['syp_print'];
      $model->syp_reject = $row['syp_reject'];
      $model->syp_revise = $row['syp_revise'];
      $model->syp_admin_right = $row['syp_admin_right'];
      $model->syp_copy_to_clipboard = $row['syp_copy_to_clipboard'];
      $model->syp_export_to_excel = $row['syp_export_to_excel'];
      $model->syp_export_to_pdf = $row['syp_export_to_pdf'];
      $model->syp_location_id = $row['syp_location_id'];
      $model->syp_company_id = $row['syp_company_id'];
      $models[] = $model;
    }
    return $models;
  } 
  /**
  * @return Location
  */
  public function getLocation(){
    $model = new cls_sys_location($this->db);
    $model->syl_id = $this->syp_location_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syl_name;
  }
  /**
  * @return Company
  */
  public function getCompany(){
    $model = new cls_sys_companies($this->db);
    $model->syc_id = $this->syp_company_id;
    return (is_null($model->getRecords()))?'':$model->findModel()->syc_name;
  }
/**
  * @return Status
  */
  public function getStatus(){
    $model = new cls_sys_status($this->db);
    $model->stat_id = $this->syp_status;
    return (is_null($model->getRecords()))?'':$model->findModel()->stat_name;
  }
  /**
  * @return Delete Status
  */
  public function getIsDeleted(){
    return ($this->syp_is_deleted=='1')?'Yes':'No';
  }
  /**
  * @return Created By name
  */
  public function getCreatedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syp_created_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Created On
  */
  public function getCreatedOn(){
    return (is_null($this->syp_created_on))?$this->syp_created_on:date("Y-m-d H:i:s",$this->syp_created_on);
  }
  /**
  * @return Last Modified Name
  */
  public function getLastModifiedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syp_last_modified_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Modified On
  */
  public function getLastModifiedOn(){
    return (is_null($this->syp_last_modified_on))?$this->syp_last_modified_on:date("Y-m-d H:i:s",$this->syp_last_modified_on);
  }
  /**
  * @return Deleted name
  */
  public function getDeletedBy(){
    $model = new cls_sys_users($this->db);
    $model->syu_id = $this->syp_deleted_by;
    return (is_null($model->getRecords()))?'':$model->findModel()->syu_full_name;
  }
  /**
  * @return Deleted On
  */
  public function getDeletedOn(){
    return (is_null($this->syp_deleted_on))?$this->syp_deleted_on:date("Y-m-d H:i:s",$this->syp_deleted_on);
  }
}
?>

