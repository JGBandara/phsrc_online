<?php
	//$con = mysql_connect('localhost','root','soft') or die('cont connect.');
	//$db  = mysql_select_db('efinancerdb',$con)or die('db not found');
	//ini_set('display_errors',1);
	//$backwardSeperator = '../../';
	//set_time_limit(0);
	include_once "{$backwardSeperator}dataAccess/LoginDBManager.php";	
	$db =  new LoginDBManager();
	include_once "mail2.php";
	
	$sql = "SELECT
				mailId,
				sys_emailpool.strFromEmail,
				sys_emailpool.strToEmail,
				sys_emailpool.strFromName,
				sys_emailpool.strMailHeader,
				sys_emailpool.strEmailBody,
				sys_users.strUserName
			FROM
				sys_emailpool
			Inner Join sys_users ON sys_users.intUserId = sys_emailpool.intEnterUserId
				where intDelivered	=	0
			ORDER BY
				sys_emailpool.mailId
			";
	$result = $db->RunQuery($sql);
	while($row=mysql_fetch_array($result))
	{
		
		if(sendMessage($row['strFromEmail'],$row['strFromName'],$row['strToEmail'],$row['strMailHeader'],$row['strEmailBody']))
		{
			echo $row['mailId'].'</br>';
			
			$sql2 = "UPDATE `sys_emailpool` SET `intDelivered`='1' WHERE (`mailId`='".$row['mailId']."') LIMIT 1";	
			$result2 =  $db->RunQuery($sql2);
			
			///// find and send copy email 
			$sql1 	= "SELECT
							sys_mail_copy_users.intMailCopyUserId,
							u2.strEmail AS copyUserEmail,
							u2.strFullName as copyUserName
						FROM
							sys_mail_copy_users
							Inner Join sys_users AS u1 ON u1.intUserId = sys_mail_copy_users.intMailMasterUserId
							Inner Join sys_users AS u2 ON u2.intUserId = sys_mail_copy_users.intMailCopyUserId
						WHERE
							u1.strEmail =  '".$row['strToEmail']."' AND
							u2.strEmail <> ''  
						";	
			$result1 = $db->RunQuery($sql1); 	
			while($row1=mysql_fetch_array($result1))
			{
				sendMessage($row['strFromEmail'],$row['strFromName'],$row1['copyUserEmail'],$row['strMailHeader'],$row['strEmailBody']);
			}
		}
		
		
	}
	
	/*//$backwardSeperator = '../../';
	include_once "{$backwardSeperator}dataAccess/LoginDBManager_en.php";	
	$db1 =  new LoginDBManager();
	//include_once "mail2.php";
	
	$sql = "SELECT
				mailId,
				sys_emailpool.strFromEmail,
				sys_emailpool.strToEmail,
				sys_emailpool.strFromName,
				sys_emailpool.strMailHeader,
				sys_emailpool.strEmailBody,
				sys_users.strUserName
			FROM
				sys_emailpool
			Inner Join sys_users ON sys_users.intUserId = sys_emailpool.intEnterUserId
				where intDelivered	=	0
			ORDER BY
				sys_emailpool.mailId
			";
	$result = $db1->RunQuery($sql);
	while($row=mysql_fetch_array($result))
	{
		
		if(sendMessage($row['strFromEmail'],$row['strFromName'],$row['strToEmail'],$row['strMailHeader'],$row['strEmailBody']))
		{
			echo $row['mailId'].'</br>';
			
			$sql2 = "UPDATE `sys_emailpool` SET `intDelivered`='1' WHERE (`mailId`='".$row['mailId']."') LIMIT 1";	
			$result2 =  $db1->RunQuery($sql2);
			
			///// find and send copy email 
			$sql1 	= "SELECT
							sys_mail_copy_users.intMailCopyUserId,
							u2.strEmail AS copyUserEmail,
							u2.strFullName as copyUserName
						FROM
							sys_mail_copy_users
							Inner Join sys_users AS u1 ON u1.intUserId = sys_mail_copy_users.intMailMasterUserId
							Inner Join sys_users AS u2 ON u2.intUserId = sys_mail_copy_users.intMailCopyUserId
						WHERE
							u1.strEmail =  '".$row['strToEmail']."' AND
							u2.strEmail <> ''  
						";	
			$result1 = $db1->RunQuery($sql1); 	
			while($row1=mysql_fetch_array($result1))
			{
				sendMessage($row['strFromEmail'],$row['strFromName'],$row1['copyUserEmail'],$row['strMailHeader'],$row['strEmailBody']);
			}
		}
		
		
	}*/
?>