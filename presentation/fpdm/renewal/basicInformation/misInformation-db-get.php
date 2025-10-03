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
reg_ins_comm.telephone,
reg_ins_comm.fax,
reg_ins_comm.email,
reg_ins_comm.web,
reg_ins_comm.Start_date,
reg_ins_comm.discription,
reg_ins_comm.is_slmc_mem,
reg_ins_comm.slmc_no,
reg_ins_comm.is_display_web,
reg_ins_comm.is_close,
reg_ins_comm.is_board_issued,
reg_ins_comm.is_bio_reg,
reg_ins_comm.bis_registration,
reg_ins_comm.hours_of_prctices,
reg_ins_comm.province_id,
reg_ins_comm.district_id,
reg_ins_comm.ownership_type,
reg_ins_comm.record_keeping,
reg_ins_comm.price_cat_id,
reg_ins_comm.annual_fee,
tbl_province.pro_name,
tbl_district.dis_name,
tbl_record_keep.record_type,
tbl_owner.ownership,
reg_ins_comm.institute_id
FROM
reg_ins_comm
left Join tbl_province ON reg_ins_comm.province_id = tbl_province.pro_id
left Join tbl_district ON reg_ins_comm.district_id = tbl_district.dis_id
left Join tbl_record_keep ON reg_ins_comm.record_keeping = tbl_record_keep.record_keep_id
left Join tbl_owner ON reg_ins_comm.ownership_type = tbl_owner.ownership_id
				WHERE
				TRIM(reg_ins_comm.reg_no) ='$id' and reg_ins_comm.mainCat_id='6'
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
			$response['fax'] 			= $row['fax'];	
			$response['email'] 			= $row['email'];
			$response['web'] 			= $row['web'];
			$response['Start_date'] 	= $row['Start_date'];
			$response['discription'] 	= $row['discription'];
			$response['is_slmc_mem'] 	= $row['is_slmc_mem'];
			$response['slmc_no'] 		= $row['slmc_no'];
			$response['is_display_web'] 		= $row['is_display_web'];
			$response['is_close'] 		= $row['is_close'];
			$response['is_board_issued'] 	= $row['is_board_issued'];
			$response['is_bio_reg'] 		= $row['is_bio_reg'];
			$response['bis_registration'] 	= $row['bis_registration'];
			$response['hours_of_prctices'] 	= $row['hours_of_prctices'];
			$response['province_id'] = $row['province_id'];
			$response['province_name'] = $row['pro_name'];
			$response['district_id'] 		= $row['district_id'];
			$response['district_name'] 		= $row['dis_name'];
			$response['ownership_type'] 	= $row['ownership'];
			$response['record_keeping']	    = $row['record_type'];
			$response['price_cat_id']       = $row['price_cat_id'];
			$response['annual_fee']         =$row['annual_fee'];
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