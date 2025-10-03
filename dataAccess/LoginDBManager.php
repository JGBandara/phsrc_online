<?php
################################
####  SLTS  ###########
####  Copyright 2017 ###########
####  Database Handling Module #
################################

class LoginDBManager
{

//private $server = 'localhost';
//private $userName = 'root';
//private $password = '';
//private $database = 'phsrc_app';
    
    private $server = 'localhost';
private $userName = 'root';
private $password = 'C0w&G@teBa6y';
private $database = 'phsrc_app';

private $con = null;

	public function getServer()
	{
		return $this->server;
	}
	
	public function getUser()
	{
		return $this->userName;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getDatabase()
	{
		return $this->database;
	}
	
	public function OpenConnection()
	{
		
		$this->con = mysql_connect($this->server, $this->userName, $this->password);
		if (!$this->con)
		{
		  die($password . 'Could not connect: ' . mysql_error());
		}
	}
	
	function RunQuery($SQL)
	{
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		$result = mysql_query($SQL);
		$this->CloseConnection();	
			
		return $result;
	}
	
	function ExecuteQuery($SQL)
	{
		$this->OpenConnection();
		mysql_select_db($this->database,  $this->con);
		$result = mysql_query($SQL);
		$this->CloseConnection();
	}
	
	
	function CheckRecordAvailability($SQL)
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
	
	function CloseConnection()
	{
		mysql_close($this->con);		
	}
	
	
}



?>
