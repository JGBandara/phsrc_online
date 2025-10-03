<?php
	
	$backwardseperator = "../../../../";
	/*$mainPath 	= $_SESSION['mainPath'];
	$userId 	= $_SESSION['userId'];*/
	$requestType 	= $_REQUEST['requestType'];
	$requstTypeSub = $_REQUEST['requstTypeSub'];
	include "{$backwardseperator}dataAccess/misconnector.php";
	

	///////////load part /////////////////////
 if($requestType=='loadDetails')
	{
		$id  = $_REQUEST['id'];
		
		//-------------------------------------------------------------
		 $sql = "SELECT
reg_ins_comm.mainCat_id,
reg_ins_comm.subCat_id,
reg_ins_comm.ins_name,
reg_ins_comm.reg_no,
reg_ins_comm.address,
reg_ins_comm.mob_no,
reg_ins_comm.institute_id
FROM
reg_ins_comm
left Join tbl_province ON reg_ins_comm.province_id = tbl_province.pro_id
left Join tbl_district ON reg_ins_comm.district_id = tbl_district.dis_id
left Join tbl_record_keep ON reg_ins_comm.record_keeping = tbl_record_keep.record_keep_id
left Join tbl_owner ON reg_ins_comm.ownership_type = tbl_owner.ownership_id
				WHERE
				TRIM(reg_ins_comm.reg_no) ='$id' and reg_ins_comm.mainCat_id='7'
				";
		//$result = $db->RunQuery($sql)
		$result =mysqli_query($conn,$sql);
		while($row=mysqli_fetch_array($result))
		{
			$response['mainCat_id'] 	= $row['mainCat_id'];
			$response['subCat_id'] 		= $row['subCat_id'];
			$response['ins_name'] 		= $row['ins_name'];
			$response['reg_no'] 		= $row['reg_no'];
			$response['address'] 		= $row['address'];
			$response['mob_no'] 		= $row['mob_no'];
			$response['insId']         =$row['institute_id'];
			
		}
		//echo json_encode($response);
		
		echo json_encode($response);
	}
        
        
         if($requestType=='loadconf')
	{
		$id  = $_REQUEST['id'];
                $insId = $_REQUEST['insId'];
                
                $sql="SELECT
reg_ins_comm.institute_id,
reg_ins_comm.ins_name,
reg_ins_comm.reg_no,
reg_ins_comm.code
FROM
reg_ins_comm where reg_ins_comm.institute_id=$insId and reg_ins_comm.code='$id'";
                $result =mysqli_query($conn,$sql);
		while($row=mysqli_fetch_array($result))
		{
                    $response['institute_id']=$row['institute_id'];
                }
             echo json_encode($response);   
        }


?>