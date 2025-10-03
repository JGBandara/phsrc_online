<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
 */
namespace presentation\system\masterData\classes ;
//use ;

/**
 * This is the model class for table "sys_menus".
 * @property integer $sym_id
* @property string $sym_code
* @property integer $sym_parent_id
* @property string $sym_name
* @property string $sym_url
* @property integer $sym_status
* @property integer $sym_order_by
* @property integer $sym_show_menu
* @property integer $sym_view
* @property integer $sym_list
* @property integer $sym_add
* @property integer $sym_edit
* @property integer $sym_delete
* @property integer $sym_approval_1
* @property integer $sym_approval_2
* @property integer $sym_approval_3
* @property integer $sym_approval_4
* @property integer $sym_approval_5
* @property integer $sym_send_to_approval
* @property integer $sym_print
* @property integer $sym_reject
* @property integer $sym_revise
* @property integer $sym_admin_right
* @property integer $sym_copy_to_clipboard
* @property integer $sym_export_to_excel
* @property integer $sym_export_to_pdf
* @property integer $sym_without_permission
* @property string $sym_behaviour
* @property string $sym_awesome_icon
* @property string $sym_module
*/
class cls_sys_menus {
  private $db;
	
  function __construct($db){
      $this->db = clone $db;
  }
  /**
   * @inheritdoc
   */
  public static function tableName(){
      return 'sys_menus';
  }
    
  /**
  * @inheritdoc
  */
  public function attributeLabels(){
     return [ 
            'sym_id' => 'Id', 
            'sym_code' => 'Code', 
            'sym_parent_id' => 'Parent Id', 
            'sym_name' => 'Name', 
            'sym_url' => 'Url', 
            'sym_status' => 'Status', 
            'sym_order_by' => 'Order By', 
            'sym_show_menu' => 'Show Menu', 
            'sym_view' => 'View', 
            'sym_list' => 'List', 
            'sym_add' => 'Add', 
            'sym_edit' => 'Edit', 
            'sym_delete' => 'Delete', 
            'sym_approval_1' => 'Approval 1', 
            'sym_approval_2' => 'Approval 2', 
            'sym_approval_3' => 'Approval 3', 
            'sym_approval_4' => 'Approval 4', 
            'sym_approval_5' => 'Approval 5', 
            'sym_send_to_approval' => 'Send To Approval', 
            'sym_print' => 'Print', 
            'sym_reject' => 'Reject', 
            'sym_revise' => 'Revise', 
            'sym_admin_right' => 'Admin Right', 
            'sym_copy_to_clipboard' => 'Copy To Clipboard', 
            'sym_export_to_excel' => 'Export To Excel', 
            'sym_export_to_pdf' => 'Export To Pdf', 
            'sym_without_permission' => 'Without Permission', 
            'sym_behaviour' => 'Behaviour', 
            'sym_awesome_icon' => 'Awesome Icon', 
            'sym_module' => 'Module',
              ];
              
  }
  /**
  * @inheritdoc
  */
  public function combo($emptyRow){
    $condition = [];
    if(!is_null($this->sym_id)){
      $condition[] = "sym_id='$this->sym_id'";
    }if(!is_null($this->sym_code)){
      $condition[] = "sym_code='$this->sym_code'";
    }if(!is_null($this->sym_parent_id)){
      $condition[] = "sym_parent_id='$this->sym_parent_id'";
    }if(!is_null($this->sym_name)){
      $condition[] = "sym_name='$this->sym_name'";
    }if(!is_null($this->sym_url)){
      $condition[] = "sym_url='$this->sym_url'";
    }if(!is_null($this->sym_status)){
      $condition[] = "sym_status='$this->sym_status'";
    }if(!is_null($this->sym_order_by)){
      $condition[] = "sym_order_by='$this->sym_order_by'";
    }if(!is_null($this->sym_show_menu)){
      $condition[] = "sym_show_menu='$this->sym_show_menu'";
    }if(!is_null($this->sym_view)){
      $condition[] = "sym_view='$this->sym_view'";
    }if(!is_null($this->sym_list)){
      $condition[] = "sym_list='$this->sym_list'";
    }if(!is_null($this->sym_add)){
      $condition[] = "sym_add='$this->sym_add'";
    }if(!is_null($this->sym_edit)){
      $condition[] = "sym_edit='$this->sym_edit'";
    }if(!is_null($this->sym_delete)){
      $condition[] = "sym_delete='$this->sym_delete'";
    }if(!is_null($this->sym_approval_1)){
      $condition[] = "sym_approval_1='$this->sym_approval_1'";
    }if(!is_null($this->sym_approval_2)){
      $condition[] = "sym_approval_2='$this->sym_approval_2'";
    }if(!is_null($this->sym_approval_3)){
      $condition[] = "sym_approval_3='$this->sym_approval_3'";
    }if(!is_null($this->sym_approval_4)){
      $condition[] = "sym_approval_4='$this->sym_approval_4'";
    }if(!is_null($this->sym_approval_5)){
      $condition[] = "sym_approval_5='$this->sym_approval_5'";
    }if(!is_null($this->sym_send_to_approval)){
      $condition[] = "sym_send_to_approval='$this->sym_send_to_approval'";
    }if(!is_null($this->sym_print)){
      $condition[] = "sym_print='$this->sym_print'";
    }if(!is_null($this->sym_reject)){
      $condition[] = "sym_reject='$this->sym_reject'";
    }if(!is_null($this->sym_revise)){
      $condition[] = "sym_revise='$this->sym_revise'";
    }if(!is_null($this->sym_admin_right)){
      $condition[] = "sym_admin_right='$this->sym_admin_right'";
    }if(!is_null($this->sym_copy_to_clipboard)){
      $condition[] = "sym_copy_to_clipboard='$this->sym_copy_to_clipboard'";
    }if(!is_null($this->sym_export_to_excel)){
      $condition[] = "sym_export_to_excel='$this->sym_export_to_excel'";
    }if(!is_null($this->sym_export_to_pdf)){
      $condition[] = "sym_export_to_pdf='$this->sym_export_to_pdf'";
    }if(!is_null($this->sym_without_permission)){
      $condition[] = "sym_without_permission='$this->sym_without_permission'";
    }if(!is_null($this->sym_behaviour)){
      $condition[] = "sym_behaviour='$this->sym_behaviour'";
    }if(!is_null($this->sym_awesome_icon)){
      $condition[] = "sym_awesome_icon='$this->sym_awesome_icon'";
    }if(!is_null($this->sym_module)){
      $condition[] = "sym_module='$this->sym_module'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sym_id, sym_code, sym_parent_id, sym_name, sym_url, sym_status, sym_order_by, sym_show_menu, sym_view, sym_list, sym_add, sym_edit, sym_delete, sym_approval_1, sym_approval_2, sym_approval_3, sym_approval_4, sym_approval_5, sym_send_to_approval, sym_print, sym_reject, sym_revise, sym_admin_right, sym_copy_to_clipboard, sym_export_to_excel, sym_export_to_pdf, sym_without_permission, sym_behaviour, sym_awesome_icon, sym_module
          from sys_menus
          where ".$conditionStr."
          order by sym_id asc";
    $result = $this->db->singleQuery($sql);
    $optionStr = "";
    if($emptyRow==true){
      $optionStr = '<option value=""></option>';
    }
    while($row= mysqli_fetch_array($result)){
      $optionStr .= '<option value="'.$row['sym_id'].'" '; 
      if($this->sym_id == $row['sym_id']){
        $optionStr .= 'selected="selected"';
      }
      $optionStr .= '>'.$row['sym_code'].'</option>';
    }
    return $optionStr;
  }
  /**
  * @inheritdoc
  */
  public function getRecords(){
    $condition = [];
    if(!is_null($this->sym_id)){
      $condition[] = "sym_id='$this->sym_id'";
    }if(!is_null($this->sym_code)){
      $condition[] = "sym_code='$this->sym_code'";
    }if(!is_null($this->sym_parent_id)){
      $condition[] = "sym_parent_id='$this->sym_parent_id'";
    }if(!is_null($this->sym_name)){
      $condition[] = "sym_name='$this->sym_name'";
    }if(!is_null($this->sym_url)){
      $condition[] = "sym_url='$this->sym_url'";
    }if(!is_null($this->sym_status)){
      $condition[] = "sym_status='$this->sym_status'";
    }if(!is_null($this->sym_order_by)){
      $condition[] = "sym_order_by='$this->sym_order_by'";
    }if(!is_null($this->sym_show_menu)){
      $condition[] = "sym_show_menu='$this->sym_show_menu'";
    }if(!is_null($this->sym_view)){
      $condition[] = "sym_view='$this->sym_view'";
    }if(!is_null($this->sym_list)){
      $condition[] = "sym_list='$this->sym_list'";
    }if(!is_null($this->sym_add)){
      $condition[] = "sym_add='$this->sym_add'";
    }if(!is_null($this->sym_edit)){
      $condition[] = "sym_edit='$this->sym_edit'";
    }if(!is_null($this->sym_delete)){
      $condition[] = "sym_delete='$this->sym_delete'";
    }if(!is_null($this->sym_approval_1)){
      $condition[] = "sym_approval_1='$this->sym_approval_1'";
    }if(!is_null($this->sym_approval_2)){
      $condition[] = "sym_approval_2='$this->sym_approval_2'";
    }if(!is_null($this->sym_approval_3)){
      $condition[] = "sym_approval_3='$this->sym_approval_3'";
    }if(!is_null($this->sym_approval_4)){
      $condition[] = "sym_approval_4='$this->sym_approval_4'";
    }if(!is_null($this->sym_approval_5)){
      $condition[] = "sym_approval_5='$this->sym_approval_5'";
    }if(!is_null($this->sym_send_to_approval)){
      $condition[] = "sym_send_to_approval='$this->sym_send_to_approval'";
    }if(!is_null($this->sym_print)){
      $condition[] = "sym_print='$this->sym_print'";
    }if(!is_null($this->sym_reject)){
      $condition[] = "sym_reject='$this->sym_reject'";
    }if(!is_null($this->sym_revise)){
      $condition[] = "sym_revise='$this->sym_revise'";
    }if(!is_null($this->sym_admin_right)){
      $condition[] = "sym_admin_right='$this->sym_admin_right'";
    }if(!is_null($this->sym_copy_to_clipboard)){
      $condition[] = "sym_copy_to_clipboard='$this->sym_copy_to_clipboard'";
    }if(!is_null($this->sym_export_to_excel)){
      $condition[] = "sym_export_to_excel='$this->sym_export_to_excel'";
    }if(!is_null($this->sym_export_to_pdf)){
      $condition[] = "sym_export_to_pdf='$this->sym_export_to_pdf'";
    }if(!is_null($this->sym_without_permission)){
      $condition[] = "sym_without_permission='$this->sym_without_permission'";
    }if(!is_null($this->sym_behaviour)){
      $condition[] = "sym_behaviour='$this->sym_behaviour'";
    }if(!is_null($this->sym_awesome_icon)){
      $condition[] = "sym_awesome_icon='$this->sym_awesome_icon'";
    }if(!is_null($this->sym_module)){
      $condition[] = "sym_module='$this->sym_module'";
    }
    // Query Filter Condition
    $conditionStr = "1=1";
    if(count($condition)==0){
      return null;
    }
    foreach($condition as $cond){


      $conditionStr .= " and ".$cond;
    }
    $sql = "select sym_id, sym_code, sym_parent_id, sym_name, sym_url, sym_status, sym_order_by, sym_show_menu, sym_view, sym_list, sym_add, sym_edit, sym_delete, sym_approval_1, sym_approval_2, sym_approval_3, sym_approval_4, sym_approval_5, sym_send_to_approval, sym_print, sym_reject, sym_revise, sym_admin_right, sym_copy_to_clipboard, sym_export_to_excel, sym_export_to_pdf, sym_without_permission, sym_behaviour, sym_awesome_icon, sym_module
          from sys_menus
          where ".$conditionStr."
          order by sym_id asc";
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
}
?>

