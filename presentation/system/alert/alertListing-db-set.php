
<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-16
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

//include  "{$backwardSeparator}dataAccess/serverAccessController.php";
require_once $backwardSeparator.'dataAccess/connector.php';

use presentation\system\classes\cls_sys_trn_alert;

$model = new cls_sys_trn_alert($db);

$response = [];
$autoNoType = "alert";   
  
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Update
// =======================================================
if($requestType=='tookAction'){
$id  = $_REQUEST['alert_id'];
  try{
    $db->begin();  
//    if(!$intEditx){
//      throw new exception('Permission is Denied ...');
//    }
        //Update data to transaction header*******************************************
    //Get alert clear method
    $sql = "select sat_act_by_personally
            from sys_trn_alert 
                inner join sys_alert_type on sal_type_id=sat_id
            where sal_id='$id'";
    $result = $db->batchQuery($sql);
    $row = mysqli_fetch_assoc($result);
    $clearMethod = $row['sat_act_by_personally'];
    
    $condition = "";
    if($clearMethod=='1'){
      $condition = " and san_user_id='$userId'";
    }
    $sql="update `sys_trn_alert_notify`
          set
            san_read_status='0',
            san_company_id='$userCompanyId',
            san_last_modified_by='$userId',
            san_last_modified_on='". time()."'
          where san_alert_id='$id' and san_company_id='$userCompanyId' $condition";
                                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $userId;
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

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Update

echo json_encode($response);    
?>





