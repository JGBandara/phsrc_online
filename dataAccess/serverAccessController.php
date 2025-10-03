<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05
 */
session_start();
$mainPath = $_SESSION['MAIN_PATH'];
$intUser  = $_SESSION["loginId"];
$mainPathLogin = $_SESSION['MAIN_PATH']."login.php";

if(!isset($_SESSION["loginId"])){
    ob_start();
    header("Location: $mainPathLogin");
    ob_end_flush();
    die();    
}
$projectName = $_SESSION['PROJECT_NAME'];
include "{$backwardSeparator}dataAccess/connector.php";

//include $backwardSeparator."sessionTimeOut.php";

$projectNameLength = strlen($projectName);

//check file status /not user wise
$xprojectPath = substr($thisFilePath,$projectNameLength+14);
// build correct file path
$tempPaths = explode('/', $xprojectPath);
array_pop($tempPaths);
explode('-',end($tempPaths))[0].".php";
$xprojectPath = "";
foreach ($tempPaths as $value) {
  $xprojectPath .= $value."/";
}
$xprojectPath .= explode('-',end($tempPaths))[0].".php";
//echo $xprojectPath;

$sql = "select * from sys_menus where sym_url = '$xprojectPath' and sym_status= '1'";

$result = $db->singleQuery($sql);

$row = mysqli_fetch_array($result);
$menuId = $row['sym_id'];
$withoutPermission = ($row['sym_without_permission']=='1')?true:false;
///////////////////////////////////


if(!mysqli_num_rows($result)){
    $response = [];
    $response['type'] 		= 'fail';
    $response['msg'] 		= 'File Not Found ...';
    $response['q'] 			= $sql;  
    echo json_encode($response); 
    exit();
}
elseif ($withoutPermission){
    $intViewx 			= true;
    $intListx           = true;
    $intAddx 			= true;
    $intEditx 			= true;
    $intDeletex 		= true;
    $intPrintx          = true;
    $intAdminRightx 	= true;
    $intApprovalx 		= true;
}
else{
    $sql = "select * from sys_permission where syp_menu_id =  '$menuId' and syp_user_id =  '$intUser'";
    $result = $db->singleQuery($sql);
    if(!mysqli_num_rows($result)){
        $response = [];
        $response['type'] 		= 'fail';
        $response['msg'] 		= 'Permission is Denied ...';
        $response['q'] 			= $sql;  
        echo json_encode($response); 
        exit();
    }
    
    $row = mysqli_fetch_array($result);
    $intViewx 			= ($row['syp_view']==1)?true:false;
    $intListx           = ($row['syp_list']==1)?true:false;
    $intAddx 			= ($row['syp_add']==1)?true:false;
    $intEditx 			= ($row['syp_edit']==1)?true:false;
    $intDeletex 		= ($row['syp_delete']==1)?true:false;
    $intPrintx          = ($row['syp_print']==1)?true:false;
    $intAdminRightx 	= ($row['syp_admin_right']==1)?true:false;
    $intApprovalx 		= $row['syp_approval_1'];
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_2']==1)?'1':'0';
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_3']==1)?'1':'0';
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_4']==1)?'1':'0';
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_5']==1)?'1':'0';
    $intApprovalx 		= ($intApprovalx==1)?true:false;  
}


?>