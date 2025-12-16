
<?php

session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";
require "{$backwardSeparator}classes/cls_reject.php";
include  "{$backwardSeparator}dataAccess/serverAccessController.php";
//require_once $backwardSeparator.'dataAccess/connector.php';


$response = [];
$autoNoType = "";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
$instituteId             = $_REQUEST['cboSearch'];
//--------------------------------------------

$cboGovOfficer           = isset($_REQUEST['cboGovOfficer'])?trim($_REQUEST['cboGovOfficer']):null;
$txtGovInstitute           = isset($_REQUEST['txtGovInstitute'])?trim($_REQUEST['txtGovInstitute']):null;



//---------------------------------------------
$status           = isset($_REQUEST['cboStatus'])?trim($_REQUEST['cboStatus']):null;
$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);


$staffDetail = json_decode($_REQUEST['staffDetail'], true);
$manaDetail = json_decode($_REQUEST['manaDetail'], true);

// =======================================================
//         Insert
// =======================================================
if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
    $sql = "select ins_application_id from institute_registration where institute_reg_id='$id' ";
    $result = $db->batchQuery($sql);
    while($row=  mysqli_fetch_array($result)){
        $id=$row['ins_application_id'];
        $referenceId=$row['ins_application_id'];
    }
    $sql = "select * from institute_staff_information where st_info_institute_id='$id' ";
    $result = $db->batchQuery($sql);
    if($row = mysqli_fetch_row($result)){
      //Update data to transaction header*******************************************
      $sql="update `institute_staff_information`
            set
					st_info_is_gov_officer        			  ='$cboGovOfficer',
					st_info_gov_ins_name     ='$txtGovInstitute'
          		    where st_info_institute_id='$id' ";

    }
    else{
      //Add data to transaction header*******************************************
      $sql="insert into `institute_staff_information`
            ( st_info_institute_id,st_info_is_gov_officer,st_info_gov_ins_name,st_info_status, st_info_company_id, st_info_created_by, st_info_created_on)
              values 
                ('$id','$cboGovOfficer','$txtGovInstitute','1', '$companyId', '$createdBy', now())";

    }
    
    $finalResult = $db->batchQuery($sql);
	$entryId = $id; 
	
if(count($staffDetail)&&$entryId&&$finalResult )		
			{
				 $sqlDel="delete from institute_staff_information_stf_detail where institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
		
				foreach($staffDetail as $detail)
				{
					$Name		= $detail['Name'];
					$Qulifications 			= $detail['Qulifications'];
					$Institute	= $detail['Institute'];
					$Country		= $detail['Country'];
					$PostGraduate 			= $detail['PostGraduate'];
					$Speciality	= $detail['Speciality'];
					$Registerd	= $detail['Registerd'];
					
					$sql = "INSERT INTO institute_staff_information_stf_detail (institute_id,Name,Qulification,institute,country,post_gradu,speciality,Register_id,created_by,created_date) 
				VALUES ('$entryId' ,'$Name','$Qulifications','$Institute','$Country','$PostGraduate','$Speciality','$Registerd',$userId,now())";
				
					$finalResult =$db->batchQuery($sql);
				}
			}
			
			
		//problem-----------
			
			if(count($manaDetail)&&$entryId&&$finalResult)		
			{
				 $sqlDel="delete from institute_staff_information_managment_detail where institute_id=$entryId";
		$delResult=$db->batchQuery($sqlDel);
				
				foreach($manaDetail as $detail)
				{
					$Position		= $detail['Position'];
					$Name 			= $detail['Name'];
					$Contact	= $detail['Contact'];
					$Information	= $detail['Information'];
					
					$sql = "INSERT INTO institute_staff_information_managment_detail (institute_id,position_id,name,contact_detail,info,created_by,created_date) 
				VALUES ('$entryId',$Position,'$Name','$Contact','$Information',$userId,now())";
				
					$finalResult =$db->batchQuery($sql);
				}
			}
    
    // $classApprove = new cls_reject($db, $userCompanyId, $userLocationId, $userId);
    // $classApprove->reject($referenceId);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Staff Information saved successfully! Proceed to Institution Information...';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $instituteId;
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
// =======================================================
//         Delete
// =======================================================
elseif($requestType=='delete'){
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `hrm_employee_residential`
          set
            emr_is_deleted = '1',
            emr_deleted_on = '". time()."',
            emr_deleted_by = '$userId'
          where emr_id='$id' and emr_company_id='$userCompanyId'";
                
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





