<?php
session_start();
$backwardSeparator = "../../../../";
$backwardseperator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php';

$response = array('type'=>'', 'msg'=>'');

  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$txtRemark      =$_REQUEST['txtRemark'];

//--------------------------------------------


$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

if($requestType=='approve'){
	$id=$_REQUEST['id'];
  $db->begin();       
    
 $sql="update `institute_payment_detail`
          set payment_is_approval = '10',
			payment_check_remark='$txtRemark'
          where payment_detail_institute_id='$id'";

    $finalResult = $db->singleQuery($sql);
   
    if($finalResult){ 
	      $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
      
	}
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
    }
   echo json_encode($response);         
  
   
} else if($requestType=='reject'){
	$id=$_REQUEST['id'];

    $sql="SELECT
institute_registration.ins_application_id,
institute_registration.ins_mobile
FROM
institute_registration
where institute_registration.ins_application_id=$id";
$result=$db->singleQuery($sql);
while($row=mysqli_fetch_array($result)){
	$newMobile=$row['ins_mobile'];
}
	
$msg="Your application Rejected by PDHS.
	 
More information please contact PDHS office.";

	 require_once $backwardSeparator.'classes/ESMSWS.php';
$session=createSession('','esmsusr_1f7m','3esotc9','');
sendMessages($session,'PHSRC',$msg,array($newMobile),1); // 1 for promotional messages, 0 for normal message 
closeSession($session);

    $db->begin();      
    $sql="update `institute_payment_detail`
          set
            payment_is_approval = '9',
			reject_remark='$txtRemark'
          where payment_detail_institute_id='$id'";
                
    $finalResult = $db->singleQuery($sql);
              
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
    }
   echo json_encode($response);         
 
   
} 

  

?>





