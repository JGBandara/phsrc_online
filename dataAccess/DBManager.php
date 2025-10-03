<?php
################################
####  SLTS  ###########
####  Copyright 2017 ###########
####  Database Handling Module #
################################
class DBManager
{

private $server = '';
private $userName = '';
private $password = '';
private $database = '';
private $formName = '';
private $loginUserId = '';
public $errormsg = '';
public $insertId = '';
public $effectRows = '';
private $con = null;

	public function ErrorMsg()
	{
		return $this->errormsg;	
	}
	public function SetConnectionString($Server, $UserName, $Password, $Database,$loginUserId)
	{
		$this->server = $Server;
		$this->userName = $UserName;
		$this->password = $Password;
		$this->database = $Database;
		$this->loginUserId = $loginUserId;		
	}
	
	public function OpenConnection()
	{
		$this->con = mysql_connect($this->server, $this->userName, $this->password);

		if (!$this->con)
		{
		  die($password . 'Could not connect: ' . mysql_error());
		}
	}
	
	public function RunQuery2($SQL)
	{
		
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		mysql_query('SET @LOGIN_USER_ID='.$this->loginUserId);
		$result = mysql_query($SQL);
		$id =  mysql_insert_id();
		$this->insertId=$id;
		$this->effectRows = mysql_affected_rows();
		if (mysql_error())
		{
			if(mysql_errno()==1451)
				$this->errormsg ="Sorry!\nThis item has already used by one or more processes.";
			else
				$this->errormsg = 	mysql_error();
		}
		return $result;
	}
	public function RunQuery($SQL)
	{
	
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		mysql_query('SET @LOGIN_USER_ID='.$this->loginUserId);
		$result = mysql_query($SQL);
		$id =  mysql_insert_id();
		$this->insertId=$id;
		$this->effectRows = mysql_affected_rows();
		if (mysql_error())
		{
			if(mysql_errno()==1451)
				$this->errormsg ="Sorry!\nThis item has already used by one or more processes.";
			else
				$this->errormsg = 	mysql_error();
		}
		//echo mysql_error() . "<br>" . $SQL . "<br>";	
		$this->CloseConnection();		
		return $result;
	}
	public function begin()
	{
		$this->OpenConnection();
		 mysql_query('BEGIN');
	}
	public function commit()
	{
		 mysql_query('COMMIT');
		 $this->CloseConnection();		
	}
	public function rollback()
	{
		 mysql_query('ROLLBACK');
		 $this->CloseConnection();		
	}
	
	public function autoInsertNo($SQL)
	{
	
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		$result = mysql_query($SQL);
		$id =  mysql_insert_id();
		if (mysql_error())
		{
			if(mysql_errno()==1451)
				$this->errormsg ="Sorry!\nThis item has already used by one or more processes.";
			else
				$this->errormsg = 	mysql_error();
		}
		$this->CloseConnection();		
		return $id;
	}        
	
	public function QueryCount($SQL)
	{
	
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		$result = mysql_query($SQL);
		$no =  	mysql_num_rows($result);
		//if (mysql_error())
		//echo mysql_error() . "<br>" . $SQL . "<br>";	
		$this->CloseConnection();		
		return $no;
	}
	public function open($SQL)
	{
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		$result = mysql_query($SQL);
		if(!$result>0)
		{
			failQuery($SQL);
		}
		return $result;
	}
	
	public function ExecuteQuery($SQL)
	{
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		$result = mysql_query($SQL);
		if(!$result>0)
		{
			failQuery($SQL);
		}
		//if (mysql_error())
			//echo mysql_error() . "<br>" . $SQL . "<br>";
		if (mysql_error())	
			$result = false;
		$this->CloseConnection();
		return $result;
	}
	
	public function AutoIncrementExecuteQuery($SQL)
	{
		$id = -1;
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		$result = mysql_query($SQL);	
		//echo mysql_error();	
		$id =  mysql_insert_id();
		$this->CloseConnection();
		return $id;
	}
	
	public function AffectedExecuteQuery($SQL)
	{
		$id = 0;
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		createQueryString($SQL,$this->formName);
		$result = mysql_query($SQL);	
		//echo mysql_error();	
		$id =  mysql_affected_rows();
		$this->CloseConnection();
		return $id;
	}
	
	
	public function CheckRecordAvailability($SQL)
	{
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		$result = mysql_query($SQL);
		$this->CloseConnection();
		while($row = mysql_fetch_array($result))
  		{
  			return true;
  		}
  		return false;		
	}
	
	public function CloseConnection()
	{
		mysql_close($this->con);		
	}
	
}

function createQueryString($SQL,$formName)
{
	$query = strtoupper("#".$SQL);
	$query2 = "#".$SQL;
	$intPos = stripos($query,"INSERT INTO");
	if($intPos>0)
	{
		$strTable = trim(substr($query2,$intPos+11,strpos($query,"(")-($intPos+11)));
		saveQueries($strTable,1,$SQL,$formName);
	}
	else
	{
		$intPos = stripos($query,"UPDATE");
		if($intPos>0)
		{
				$strTable = trim(substr($query2,$intPos+6,strpos($query,"SET")-($intPos+6)));
				saveQueries($strTable,2,$SQL,$formName);
		}
		else
		{
				$intPos = stripos($query,"DELETE FROM");
				if($intPos>0)
				{
					$strTable = trim(substr($query2,$intPos+11,strpos($query,"WHERE")-($intPos+11)));
					saveQueries($strTable,3,$SQL,$formName);
				}
		}
	}
}

function failQuery($SQL)
{
	$query = strtoupper("#".$SQL);
	$query2 = "#".$SQL;
	$intPos = stripos($query,"INSERT INTO");
	if($intPos>0)
	{
		$strTable = trim(substr($query2,$intPos+11,strpos($query,"(")-($intPos+11)));
		saveFailQueries($strTable,1,$SQL);
	}
	else
	{
		$intPos = stripos($query,"UPDATE");
		if($intPos>0)
		{
				$strTable = trim(substr($query2,$intPos+6,strpos($query,"SET")-($intPos+6)));
				saveFailQueries($strTable,2,$SQL);
		}
		else
		{
				$intPos = stripos($query,"DELETE FROM");
				if($intPos>0)
				{
					$strTable = trim(substr($query2,$intPos+11,strpos($query,"WHERE")-($intPos+11)));
					saveFailQueries($strTable,3,$SQL);
				}
		}
	}
}

function saveFailQueries($tableName,$operation,$query)
{
	global $_SESSION;
	global $_SERVER;
	
	
	
	$ip = "";
	 if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
	if ($_SERVER['HTTP_X_FORWARD_FOR']) 
	{
		$ip = $_SERVER['HTTP_X_FORWARD_FOR'];
	} 
	else 
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	//$ip = $REMOTE_ADDR;
	$userCode =  $_SESSION["userId"];

	
	$sql="INSERT INTO queries_fail(tableName,operation,sqlStatement,userID, IP) VALUES(\"".$tableName."\",".$operation.",\"".$query."\",\"".$userCode."\",\"".$ip."\");";

	mysql_query($sql);
}

function saveQueries($tableName,$operation,$query,$formName)
{
	global $_SESSION;
	global $_SERVER;
	
	//echo $formName;
	
	$ip = "";
	 if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
	if ($_SERVER['HTTP_X_FORWARD_FOR']) 
	{
		$ip = $_SERVER['HTTP_X_FORWARD_FOR'];
	} 
	else 
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	//$ip = $REMOTE_ADDR;
	$userCode =  $_SESSION["userId"];

	//$fname = $this->getFormName();	
	$query = str_replace("'","\'",$query);
	$query = str_replace('"','\"',$query);
	
	$sql="INSERT INTO queries(tableName,program,form,operation,sqlStatement,userID, IP) VALUES(\"".$tableName."\",\"".$_SERVER['PHP_SELF']."\",\"".$formName."\",".$operation.",\"".$query."\",\"".$userCode."\",\"".$ip."\");";
	//echo $sql;
	mysql_query($sql);
}

function getformname($val)
{
	switch ($val)
	{
		case 'branch':
			return 'Branch';
		case 'bank';
			return 'Bank';
		default:
			return $val;
	}
		
}

?>