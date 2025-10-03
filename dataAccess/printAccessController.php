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
$xprojectPath .= explode('Print',end($tempPaths))[0].".php";
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
    $sql = "select * from sys_permission where syp_print=1 and syp_menu_id = '$menuId' and syp_user_id =  '$intUser'";
    $result = $db->singleQuery($sql);
    if(!mysqli_num_rows($result)){
        include "{$backwardSeparator}dataAccess/permissionDenied.php";
        exit();
    }
    
    $row = mysqli_fetch_array($result);    
}


?>