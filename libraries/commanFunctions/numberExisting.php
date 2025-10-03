<?php
	session_start();
	$backwardSeperator = "../../";
	include "{$backwardSeperator}dataAccess/Connector.php";
	$mainPath 	= $_SESSION['mainPath'];
	$userId 	= $_SESSION['userId'];
    $userCompanyId = $_SESSION['CompanyID'];
    $userLocationId = $_SESSION['LocationID'];
	$requestType = $_REQUEST['requestType'];
	if($requestType=='getAvailability')
	{
		$number = $_REQUEST['docNo'];
		$type 	= $_REQUEST['docType'];	
		$sql	= "SELECT
				COUNT(fin_transactions.documentNo)  AS no
				FROM
				fin_transactions
				WHERE
				fin_transactions.strProgramType = '$type' AND
				fin_transactions.documentNo = '$number'";
		$result = $db->RunQuery($sql);
		$row= mysql_fetch_array($result);
		echo $row['no'];
	}
	if($requestType=='getTransactionDate')
	{
		$today = date("Y-m-d");
		$selectedDate	= $_REQUEST['backDate'];
		$type 			= $_REQUEST['docType'];
		$sql			= "SELECT
						fin_preferences_datecontroller.intIsBackDate,
						fin_preferences_datecontroller.dtmBackDate,
						fin_preferences_datecontroller.intIsFutureDate,
						fin_preferences_datecontroller.strTransactionType,
						fin_preferences_datecontroller.intBackStatus,
						fin_preferences_datecontroller.intNoOfDate
						FROM
						fin_preferences_datecontroller
						WHERE
						fin_preferences_datecontroller.strTransactionType = '$type'";
		$result = $db->RunQuery($sql);
		$row= mysql_fetch_array($result);
		
		$isBackStatus 	= $row['intBackStatus'];
		$isBackDate 	= $row['intIsBackDate'];
		$backDate 		= $row['dtmBackDate'];
		$noOfDate 		= $row['intNoOfDate'];
		$isFutureDate	= $row['intIsFutureDate'];

		if((strtotime($selectedDate) > strtotime($today)) && $isFutureDate == '1')
		{
			echo "fOK";
		}
		else if((strtotime($selectedDate) > strtotime($today)) && $isFutureDate == '0')
		{
			echo "fNO";
		}
		else
		{
			if($isBackStatus == '1') // Fixed Date
			{
				if((strtotime($selectedDate) > strtotime($backDate)) && $isBackDate == '1')
				{
					echo "bOK";
				}
				else if((strtotime($selectedDate) > strtotime($backDate)) && $isBackDate == '0')
				{
					echo "bOK";
				}
				else if((strtotime($selectedDate) < strtotime($backDate)) && $isBackDate == '1')
				{
					echo "bNO";
				}
				else if((strtotime($selectedDate) < strtotime($backDate)) && $isBackDate == '0')
				{
					echo "bOK";
				}
				else if((strtotime($today) == strtotime($backDate)) && $isBackDate == '1')
				{
					echo "todayNO";
				}
				else
				{
					echo "OK";
				}
			}
			else if($isBackStatus == '0') // No. Of Date
			{
				if($isBackDate == '1')
				{
					if((strtotime($selectedDate) == strtotime($today)))
					{
						echo "bfOK";
					}
					else
					{
						$ts1 = strtotime($today);
						$ts2 = strtotime($selectedDate);
						$date = ($ts1 - $ts2) / (60 * 60 * 24);
						if($noOfDate >= $date)
						{
							echo "bOK";
						}
						else
						{
							echo "bNO";
						}
					}
				}
				else if($isBackDate == '0')
				{
					if((strtotime($selectedDate) == strtotime($today)))
					{
						echo "bfOK";
					}
					else
					{
						echo "bNO";
					}
				}
			}
			else
			{
				echo "bfOK";
			}
		}
	}
?>