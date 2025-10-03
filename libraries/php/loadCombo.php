<?php
	session_start();
	$mainPath 	= $_SESSION['mainPath'];
	$userId 	= $_SESSION['userId'];
	include "../../dataAccess/Connector.php";
	
	$type = $_REQUEST['type'];
	
	if($type=='brand'){
		$intCustomerId = trim($_REQUEST['customerId']);
		if(isset($_REQUEST['customerId']))
			$sql = "SELECT
						mst_brand.intId,
						mst_brand.strName
					FROM
						mst_customer_brand
						Inner Join mst_brand ON mst_brand.intId = mst_customer_brand.intBrandId
					WHERE
						mst_customer_brand.intCustomerId =  '$intCustomerId' AND
						mst_brand.intStatus =  '1'
					ORDER BY
						mst_brand.strName ASC
					";
		else
			$sql = "SELECT
						mst_brand.intId,
						mst_brand.strName
					FROM
						mst_brand
					WHERE
						mst_brand.intStatus =  '1'
					ORDER BY
						mst_brand.strName ASC
					";
			
			loadCombo($sql);
	}
	else if($type=='brands'){
		
	}	
	
	function loadCombo($sql){
		global $db;	
		$result = $db->RunQuery($sql);
		echo "<option value=\"\"></option>";
		while($row=mysql_fetch_array($result)){
			echo "<option value=\"".$row[0]."\">".$row[1]."</option>";
		}
	}
?>