<?php
	
	$backwardseperator = "../../../../../";
	/*$mainPath 	= $_SESSION['mainPath'];
	$userId 	= $_SESSION['userId'];*/
	$requestType 	= $_REQUEST['requestType'];
	$requstTypeSub = $_REQUEST['requstTypeSub'];
	include "{$backwardseperator}dataAccess/misconnector.php";
	

	///////////load part /////////////////////
 if($requestType=='loadSearchCombo')
	{
		$id  = $_REQUEST['id'];
		
		//-------------------------------------------------------------
		 $sql = "SELECT
reg_ins_comm.reg_no,
reg_ins_comm.institute_id
FROM
reg_ins_comm WHERE
				institute_id ='$id' ";
	$result =mysqli_query($conn,$sql);
		while($row=mysqli_fetch_array($result))
		{	
		$html .= "<option value=\"".$row['institute_id']."\">".$row['reg_no']."</option>";
		}
	echo $html;	

		//echo json_encode($response);
	}


?>