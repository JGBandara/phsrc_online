
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

include  "{$backwardSeparator}dataAccess/serverAccessController.php";

require_once '../class/cls_sys_menus.php';
//require_once $backwardSeparator.'dataAccess/connector.php';
//require_once $backwardSeparator.'class/cls_auto_number.php';
//require_once $backwardSeparator.'class/cls_approval.php';

$model = new cls_sys_menus($db);

$response = [];
$autoNoType = "menu";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$code           = isset($_REQUEST['txtCode'])?trim($_REQUEST['txtCode']):null;
$parentId           = isset($_REQUEST['cboParentId'])?trim($_REQUEST['cboParentId']):null;
$name           = isset($_REQUEST['txtName'])?trim($_REQUEST['txtName']):null;
$url           = isset($_REQUEST['txtUrl'])?trim($_REQUEST['txtUrl']):null;
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$orderBy           = isset($_REQUEST['cboOrderBy'])?trim($_REQUEST['cboOrderBy']):null;
$showMenu           = isset($_REQUEST['optShowMenu'])?trim($_REQUEST['optShowMenu']):null;
$view           = isset($_REQUEST['cboView'])?trim($_REQUEST['cboView']):null;
$list           = isset($_REQUEST['cboList'])?trim($_REQUEST['cboList']):null;
$add           = isset($_REQUEST['cboAdd'])?trim($_REQUEST['cboAdd']):null;
$edit           = isset($_REQUEST['cboEdit'])?trim($_REQUEST['cboEdit']):null;
$delete           = isset($_REQUEST['cboDelete'])?trim($_REQUEST['cboDelete']):null;
$approval1           = isset($_REQUEST['cboApproval1'])?trim($_REQUEST['cboApproval1']):null;
$approval2           = isset($_REQUEST['cboApproval2'])?trim($_REQUEST['cboApproval2']):null;
$approval3           = isset($_REQUEST['cboApproval3'])?trim($_REQUEST['cboApproval3']):null;
$approval4           = isset($_REQUEST['cboApproval4'])?trim($_REQUEST['cboApproval4']):null;
$approval5           = isset($_REQUEST['cboApproval5'])?trim($_REQUEST['cboApproval5']):null;
$sendToApproval           = isset($_REQUEST['cboSendToApproval'])?trim($_REQUEST['cboSendToApproval']):null;
$print           = isset($_REQUEST['cboPrint'])?trim($_REQUEST['cboPrint']):null;
$reject           = isset($_REQUEST['cboReject'])?trim($_REQUEST['cboReject']):null;
$revise           = isset($_REQUEST['cboRevise'])?trim($_REQUEST['cboRevise']):null;
$adminRight           = isset($_REQUEST['cboAdminRight'])?trim($_REQUEST['cboAdminRight']):null;
$copyToClipboard           = isset($_REQUEST['cboCopyToClipboard'])?trim($_REQUEST['cboCopyToClipboard']):null;
$exportToExcel           = isset($_REQUEST['cboExportToExcel'])?trim($_REQUEST['cboExportToExcel']):null;
$exportToPdf           = isset($_REQUEST['cboExportToPdf'])?trim($_REQUEST['cboExportToPdf']):null;
$withoutPermission           = isset($_REQUEST['cboWithoutPermission'])?trim($_REQUEST['cboWithoutPermission']):null;
$behaviour           = isset($_REQUEST['txtBehaviour'])?trim($_REQUEST['txtBehaviour']):null;
$awesomeIcon           = isset($_REQUEST['txtAwesomeIcon'])?trim($_REQUEST['txtAwesomeIcon']):null;
$module           = isset($_REQUEST['txtModule'])?trim($_REQUEST['txtModule']):null;
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Insert
// =======================================================
if($requestType=='add'){
  try{
    $db->begin();      
    if(!$intAddx){
      throw new exception('Permission is Denied ...');
    }
    // Number Generation *******************************************
    if($anStatus == "Auto"){
//      $clsAutoNo = new cls_auto_number($db, $userCompanyId, $userLocationId);
//      $autoNo = $clsAutoNo->getAutoNo($autoNoType);
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Me");
    }
    elseif($amStatus == "Manual"){
      $noReference	= $no;
    }
        //Add data to transaction header*******************************************
    $sql="insert into `sys_menus`
            (sym_code, sym_parent_id, sym_name, sym_url, sym_status, sym_order_by, sym_show_menu, sym_view, sym_list, sym_add, sym_edit, sym_delete, sym_approval_1, sym_approval_2, sym_approval_3, sym_approval_4, sym_approval_5, sym_send_to_approval, sym_print, sym_reject, sym_revise, sym_admin_right, sym_copy_to_clipboard, sym_export_to_excel, sym_export_to_pdf, sym_without_permission, sym_behaviour, sym_awesome_icon, sym_module)
              values 
                ('$code', '$parentId', '$name', '$url', '$status', '$orderBy', '$showMenu', '$view', '$list', '$add', '$edit', '$delete', '$approval1', '$approval2', '$approval3', '$approval4', '$approval5', '$sendToApproval', '$print', '$reject', '$revise', '$adminRight', '$copyToClipboard', '$exportToExcel', '$exportToPdf', '$withoutPermission', '$behaviour', '$awesomeIcon', '$module')";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;           
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
        // commit auto number
//        $clsAutoNo->setAutoNoCommit($autoNoType, $autoNo);
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
        // rollback auto number
//        $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback
    // rollback auto number
//    $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Insert
// =======================================================
//         Update
// =======================================================
if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
        //Update data to transaction header*******************************************
    $sql="update `sys_menus`
          set
            sym_code='$code',
            sym_parent_id='$parentId',
            sym_name='$name',
            sym_url='$url',
            sym_status='$status',
            sym_order_by='$orderBy',
            sym_show_menu='$showMenu',
            sym_view='$view',
            sym_list='$list',
            sym_add='$add',
            sym_edit='$edit',
            sym_delete='$delete',
            sym_approval_1='$approval1',
            sym_approval_2='$approval2',
            sym_approval_3='$approval3',
            sym_approval_4='$approval4',
            sym_approval_5='$approval5',
            sym_send_to_approval='$sendToApproval',
            sym_print='$print',
            sym_reject='$reject',
            sym_revise='$revise',
            sym_admin_right='$adminRight',
            sym_copy_to_clipboard='$copyToClipboard',
            sym_export_to_excel='$exportToExcel',
            sym_export_to_pdf='$exportToPdf',
            sym_without_permission='$withoutPermission',
            sym_behaviour='$behaviour',
            sym_awesome_icon='$awesomeIcon',
            sym_module='$module'
          where sym_id='$id' and sym_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
        // commit auto number
//        $clsAutoNo->setAutoNoCommit($autoNoType, $autoNo);
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
        // rollback auto number
//        $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback
    // rollback auto number
//    $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Update
// =======================================================
//         Delete
// =======================================================
if($requestType=='delete'){
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `sys_menus`
          set
            sym_is_deleted = '1',
            sym_deleted_on = now(),
            sym_deleted_by = '$userId'
          where sym_id='$id' and sym_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['id'] 	= $entryId;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} // End If - Delete

echo json_encode($response);    
?>





