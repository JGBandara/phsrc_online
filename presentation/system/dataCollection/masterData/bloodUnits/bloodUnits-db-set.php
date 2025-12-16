
<?php

session_start();
$backwabuSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwabuSeparator}autoLoad.php";

include  "{$backwabuSeparator}dataAccess/serverAccessController.php";




$response = [];

$requestType 	= $_REQUEST['requestType'];
$id             = $_REQUEST['cboSearch'];
//--------------------------------------------
$code           = isset($_REQUEST['txtCode'])?trim($_REQUEST['txtCode']):null;
$name           = isset($_REQUEST['txtName'])?trim($_REQUEST['txtName']):null;
$description           = isset($_REQUEST['txtDescription'])?trim($_REQUEST['txtDescription']):null;
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;


if($requestType=='add'){
  try{
    $db->begin();      
    if(!$intAddx){
      throw new exception('Permission is Denied ...');
    }
  $sql="insert into `bu_mst_blood_units`
            (bu_code, bu_name, bu_description, bu_status, bu_company_id, bu_created_by, bu_created_on)
              values 
                ('$code', '$name', '$description', '$status', '$companyId', '$createdBy', now())";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;           
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
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} 

elseif($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
  $sql="update `bu_mst_blood_units`
          set
            bu_code='$code',
            bu_name='$name',
            bu_description='$description',
            bu_status='$status',
            bu_company_id='$companyId',
            bu_last_modified_by='$lastModifiedBy',
            bu_last_modified_on= now()
          where bu_id='$id' and bu_company_id='$userCompanyId'";
                
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
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} 
elseif($requestType=='delete'){
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `bu_mst_blood_units`
          set
            bu_is_deleted = '1',
            bu_deleted_on = now(),
            bu_deleted_by = '$userId'
          where bu_id='$id' and bu_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Deleted Successfully.';
        $response['id'] 	= $entryId;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();
    }
            
  }catch(Exception $e){

    $db->rollback();

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} 

echo json_encode($response);    
?>





