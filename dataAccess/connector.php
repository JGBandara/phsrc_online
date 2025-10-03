<?php

	session_start();
	$mainPath = $_SESSION['MAIN_PATH'];
	$intUser  = $_SESSION["loginId"];
	$mainPathLogin = $_SESSION['MAIN_PATH']."login.php";

    
	if(!isset($_SESSION["loginId"]))
	{
		ob_start();
        header("Location: $mainPathLogin");
        ob_end_flush();
        die();    
	}

    include "{$backwardSeparator}classes/db.php";
	$db =  new db();
    $db->setConnectionString($_SESSION["DBServer"],$_SESSION["DBUserName"],$_SESSION["DBPassword"],$_SESSION["DBDatabase"],$_SESSION['loginId']);

    function val($value)
	{
		if($value=='')
			$value = 0;
		else
			$value = (float)$value;	
		return $value;
	}
	function chk($value)
	{
		if($value=='true' || $value==true)
			return 1;
		else
			return 0;
	}
	function null($value)
	{
		return ($value?$value:'NULL');	
	}
	
	function getApproveLevel($name)
	{
		global $db;
		$sql = "SELECT
					sys_approvelevels.intApprovalLevel
				FROM sys_approvelevels
				WHERE
					sys_approvelevels.strName =  '$name'
				";
		$result = $db->singleQuery($sql);
		$row = mysqli_fetch_array($result);
		return val($row['intApprovalLevel']);	
	}
	
	function getApproveLevel2($name)
	{
		global $db;
		$sql = "SELECT
					sys_approvelevels.intApprovalLevel
				FROM sys_approvelevels
				WHERE
					sys_approvelevels.strName =  '$name'
				";
		$result = $db->batchQuery($sql);
		$row = mysqli_fetch_array($result);
		return val($row['intApprovalLevel']);	
	}
	
	function quote($value)
	{
		return str_replace("'","\'",$value);	
	}
?>