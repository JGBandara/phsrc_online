<?php
class db{

  private $server = '';
  private $userName = '';
  private $password = '';
  private $database = '';
  private $formName = '';
  private $loginUserId = '';
  public $errormsg = 'test';
  public $insertId = '';
  public $effectRows = '';
  private $con = null;

  public function errorMsg(){
      return $this->errormsg;	
  }
  
  public function setConnectionString($Server, $UserName, $Password, $Database,$loginUserId){
      $this->server = $Server;
      $this->userName = $UserName;
      $this->password = $Password;
      $this->database = $Database;
      $this->loginUserId = $loginUserId;		
  }
	
  public function openConnection(){
      $this->con = mysqli_connect($this->server, $this->userName, $this->password);

      if (!$this->con){
        throw new Exception('DB Connection Failed');
      }
  }

  public function batchQuery($sql){

      mysqli_select_db($this->con, $this->database);
//		createQueryString($sql,$this->formName);
      mysqli_query($this->con, 'SET @LOGIN_USER_ID='.$this->loginUserId);
      $result = mysqli_query($this->con, $sql);
      $id =  mysqli_insert_id($this->con);
      $this->insertId=$id;
      $this->effectRows = mysqli_affected_rows($this->con);
      if (mysqli_error($this->con)){
          if(mysqli_errno($this->con)==1451)
              throw new Exception("Sorry!\nThis item has already used by one or more processes.");
          else
              throw new Exception(mysqli_error($this->con));
      }
      return $result;
  }
  public function singleQuery($sql){

      $this->openConnection();
      mysqli_select_db($this->con,  $this->database);
//		createQueryString($sql,$this->formName);
      mysqli_query($this->con, 'SET @LOGIN_USER_ID='.$this->loginUserId);
      $result = mysqli_query($this->con, $sql);
      $id = mysqli_insert_id($this->con);
      $this->insertId=$id;
      $this->effectRows = mysqli_affected_rows($this->con);
      if (mysqli_error($this->con)){
          if(mysqli_errno($this->con)==1451)
              throw new Exception("Sorry!\nThis item has already used by one or more processes.");
          else
              throw new Exception(mysqli_error($this->con));
      }
      //echo mysql_error() . "<br>" . $SQL . "<br>";	
      $this->closeConnection();		
      return $result;
  }
  public function begin(){
      $this->openConnection();
      mysqli_query($this->con, 'BEGIN');
  }
  public function commit(){
      mysqli_query($this->con, 'COMMIT');
      $this->closeConnection();		
  }
  public function rollback(){
      mysqli_query($this->con, 'ROLLBACK');
      $this->closeConnection();		
  }

  function getNumRows($sql) {
      $this->openConnection();
      mysqli_select_db( $this->con, $this->database);
      $result = mysqli_query($this->con, $sql);
      $this->closeConnection();
      return mysqli_num_rows($result);
  }
  
  public function checkRecordAvailability($sql){
      $this->openConnection();
      mysqli_select_db($this->con, $this->database);
      $result = mysqli_query($this->con, $sql);
      $this->closeConnection();
      while($row = mysqli_fetch_array($result))
      {
          return true;
      }
      return false;		
  }

  public function closeConnection(){
      mysqli_close($this->con);		
  }
	
}

function createQueryString($sql,$formName){
	$query = strtoupper("#".$sql);
	$query2 = "#".$sql;
	$intPos = stripos($query,"INSERT INTO");
	if($intPos>0)
	{
		$strTable = trim(substr($query2,$intPos+11,strpos($query,"(")-($intPos+11)));
		saveQueries($strTable,1,$sql,$formName);
	}
	else
	{
		$intPos = stripos($query,"UPDATE");
		if($intPos>0)
		{
				$strTable = trim(substr($query2,$intPos+6,strpos($query,"SET")-($intPos+6)));
				saveQueries($strTable,2,$sql,$formName);
		}
		else
		{
				$intPos = stripos($query,"DELETE FROM");
				if($intPos>0)
				{
					$strTable = trim(substr($query2,$intPos+11,strpos($query,"WHERE")-($intPos+11)));
					saveQueries($strTable,3,$sql,$formName);
				}
		}
	}
}

function failQuery($sql)
{
	$query = strtoupper("#".$sql);
	$query2 = "#".$sql;
	$intPos = stripos($query,"INSERT INTO");
	if($intPos>0)
	{
		$strTable = trim(substr($query2,$intPos+11,strpos($query,"(")-($intPos+11)));
		saveFailQueries($strTable,1,$sql);
	}
	else
	{
		$intPos = stripos($query,"UPDATE");
		if($intPos>0)
		{
				$strTable = trim(substr($query2,$intPos+6,strpos($query,"SET")-($intPos+6)));
				saveFailQueries($strTable,2,$sql);
		}
		else
		{
				$intPos = stripos($query,"DELETE FROM");
				if($intPos>0)
				{
					$strTable = trim(substr($query2,$intPos+11,strpos($query,"WHERE")-($intPos+11)));
					saveFailQueries($strTable,3,$sql);
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

	mysqli_query($this->con, $sql);
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
	mysqli_query($this->con, $sql);
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