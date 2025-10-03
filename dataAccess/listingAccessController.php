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
$xprojectPath .= explode('Listing',end($tempPaths))[0].".php";
 $xprojectPath;

$sql = "select * from sys_menus where sym_url = '$xprojectPath' and sym_status= '1'";

$result = $db->singleQuery($sql);

$row = mysqli_fetch_array($result);
$menuId = $row['sym_id'];
$withoutPermission = ($row['sym_without_permission']=='1')?true:false;
///////////////////////////////////


if(!mysqli_num_rows($result)){
    include "{$backwardSeparator}dataAccess/invalidFileName.php";
    exit();
}
elseif (!$withoutPermission){
    $sql = "select * from sys_permission where syp_list=1 and syp_menu_id = '$menuId' and syp_user_id =  '$intUser'";
    $result = $db->singleQuery($sql);
    if(!mysqli_num_rows($result)){
        include "{$backwardSeparator}dataAccess/permissionDenied.php";
        exit();
    }
    
    $row = mysqli_fetch_array($result);
    $intViewx 		= $row['syp_view'];
    $intEditx 		= $row['syp_edit'];
    $intDeletex 	= $row['syp_delete'];
    $intPrintx         = $row['syp_print'];
    $intExcelx 		= ($row['syp_export_to_excel']==1)?1:0;
    $intPdfx 		= ($row['syp_export_to_pdf']==1)?1:0;
    $intCopyx 		= ($row['syp_copy_to_clipboard']==1)?1:0;
    echo "<script  type=\"application/javascript\">
                var intViewx		= $intViewx;
                var intEditx 		= $intEditx;
                var intDeletex 		= $intDeletex;
                var intPrintx 		= $intPrintx;
                var intExcelx		= $intExcelx;
                var intPdfx         = $intPdfx;
                var intCopyx        = $intCopyx;
                var intMenuId       = $menuId;
          </script>";   
}
elseif ($withoutPermission){
    $intViewx 		= 1;
    $intEditx 		= 1;
    $intDeletex 	= 1;
    $intPrintx      = 1;
    $intExcelx 		= 1;
    $intPdfx 		= 1;
    $intCopyx 		= 1;
    echo "<script  type=\"application/javascript\">
                var intViewx		= 1;
                var intEditx 		= 1;
                var intDeletex 		= 1;
                var intPrintx 		= 1;
                var intExcelx		= 1;
                var intPdfx         = 1;
                var intCopyx        = 1;
                var intMenuId       = $menuId;
          </script>";   
  
}


?>