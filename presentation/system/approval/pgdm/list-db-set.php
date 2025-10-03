<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';



$response = array('type'=>'', 'msg'=>'');

  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];

//--------------------------------------------


$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

if($requestType=='approve'){
	$id=$_REQUEST['id'];
  try{
    $db->begin();      
    
    
    $sql="update `pgdm_new_registration`
          set
            pgdm_pd_approval = '1',
            pgdm_pd_approved_on =now(),
            pgdm_pd_approved_by = '$userId'
          where pgdm_application_id='$id' ";
                
    $finalResult = $db->singleQuery($sql);
              
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
   echo json_encode($response);         
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage();
    $response['q'] 		= $sql;                
  }
   
} else if($requestType=='reject'){
	$id=$_REQUEST['id'];
  try{
    $db->begin();      
    
    
    $sql="update `pgdm_new_registration`
          set
            pgdm_pd_approval = '2',
            pgdm_pd_approved_on =now(),
            pgdm_pd_approved_by = '$userId'
          where pgdm_application_id='$id' ";
                
    $finalResult = $db->singleQuery($sql);
              
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
   echo json_encode($response);         
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage();
    $response['q'] 		= $sql;                
  }
   
} 

  

?>





