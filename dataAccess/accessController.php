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
    header("Location: $backwardSeparator$mainPathLogin");
    ob_end_flush();
    die();    
}
$projectName = $_SESSION['PROJECT_NAME'];
include "{$backwardSeparator}dataAccess/connector.php";

//include $backwardSeparator."sessionTimeOut.php";

$projectNameLength = strlen($projectName);

//check file status /not user wise
//$xprojectPath = substr($thisFilePath,$projectNameLength+2);
$xprojectPath = substr($thisFilePath,$projectNameLength+14);
$xprojectPath;
$sql = "select * from sys_menus where sym_url = '$xprojectPath' and sym_status='1'";

$result = $db->singleQuery($sql);

$row = mysqli_fetch_array($result);
$menuId = $row['sym_id'];
$withoutPermission = ($row['sym_without_permission']=='1')?true:false;
///////////////////////////////////


if(!mysqli_num_rows($result)){
//  echo $xprojectPath;
    include "{$backwardSeparator}dataAccess/invalidFileName.php";
    exit();
}
elseif ($withoutPermission){
    $intViewx 			= 1;
    $intListx           = 1;
    $intAddx 			= 1;
    $intEditx 			= 1;
    $intDeletex 		= 1;
    $intPrintx          = 1;
    $intApprovalx 		= 1;
    $intAdminRightx 	= 1;
    echo "<script  type=\"application/javascript\">
                var intViewx		= 1;
                var intListx        = 1;
                var intAddx 		= 1;
                var intEditx 		= 1;
                var intDeletex 		= 1;
                var intPrintx 		= 1;
                var intApprovalx 	= 1;
                var intAdminRightx 	= 1;
                var intMenuId       = $menuId;
				var xprojectPath    = '$xprojectPath';
                var mainPath        = '$mainPath';
          </script>";

    include $mainPath . $xprojectPath;
}
else{
    $sql = "select * from sys_permission where syp_menu_id =  '$menuId' and syp_user_id =  '$intUser'";
    $result = $db->singleQuery($sql);
    if(!mysqli_num_rows($result)){
        include "{$backwardSeparator}dataAccess/permissionDenied.php";
        exit();
    }
    
    $row = mysqli_fetch_array($result);
    $intViewx 			= $row['syp_view'];
    $intListx           = $row['syp_list'];
    $intAddx 			= $row['syp_add'];
    $intEditx 			= $row['syp_edit'];
    $intDeletex 		= $row['syp_delete'];
    $intPrintx          = $row['syp_print'];
    $intApprovalx 		= $row['syp_approval_1'];
    $intAdminRightx 	= $row['syp_admin_right'];
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_2']==1)?'1':'0';
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_3']==1)?'1':'0';
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_4']==1)?'1':'0';
    $intApprovalx 		= ($intApprovalx==1 || $row['syp_approval_5']==1)?'1':'0';
    echo "<script  type=\"application/javascript\">
                var intViewx		= $intViewx;
                var intListx        = $intListx;
                var intAddx 		= $intAddx;
                var intEditx 		= $intEditx;
                var intDeletex 		= $intDeletex;
                var intPrintx 		= $intPrintx;
                var intApprovalx 	= $intApprovalx;
                var intAdminRightx 	= $intAdminRightx;
                var intMenuId       = $menuId;
				var xprojectPath    = '$xprojectPath';
                var mainPath        = '$mainPath';
          </script>";
    ///finally open the path
    include $mainPath . $xprojectPath;
}


?>