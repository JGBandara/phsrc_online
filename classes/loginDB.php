<?php
class loginDB {
  
  private $server = 'localhost';
  private $userName = 'root';
  private $password = '';
  private $database = 'phsrc_reg';
  public $insertId = '';
  
/*    private $server = 'localhost';
  private $userName = 'root';
  private $password = 'C0w&G@teBa6y';
  private $database = 'phsrc_reg';
  public $insertId = ''; */
  
  
  
  /*private $server = 'sql.byethost22.org';
  private $userName = 'sethsiri_slts';
  private $password = 'Npl@itrdA@#$2';
  private $database = 'sethsiri_itrda';*/

  private $con = null;

  public function getServer(){
      return $this->server;
  }

  public function getUser(){
      return $this->userName;
  }
  public function getPassword(){
      return $this->password;
  }
  public function getDatabase(){
      return $this->database;
  }

  public function openConnection(){
      $this->con = mysqli_connect($this->server, $this->userName, $this->password);
      if (!$this->con){
        throw new Exception('DB Connection Failed');
      }
  }
	
  function executeNonQuery($sql){
      $this->openConnection();
      mysqli_select_db( $this->con, $this->database);
      if(mysqli_query($this->con, $sql)){
        $id =  mysqli_insert_id($this->con);
        $this->insertId=$id;
        $this->closeConnection();	
        return true;
      }
      else{
        $error = mysqli_errno($this->con);
        $this->closeConnection();	
        throw new Exception($error);
        return false;
      }
  }
	
  function executeQuery($sql){
      $this->openConnection();
      mysqli_select_db( $this->con, $this->database);
      $result = mysqli_query($this->con, $sql);
      $this->closeConnection();
      return $result;
  }
	
	
  function checkRecordAvailability($sql) {
      $this->openConnection();
      mysqli_select_db( $this->con, $this->database);
      $result = mysqli_query($this->con, $sql);
      $this->closeConnection();
      while($row = mysqli_fetch_array($result)){
          return true;
      }
      return false;		
  }
  
  function getNumRows($sql) {
      $this->openConnection();
      mysqli_select_db( $this->con, $this->database);
      $result = mysqli_query($this->con, $sql);
      $this->closeConnection();
      return mysqli_num_rows($result);
  }
	
  function closeConnection() {
      mysqli_close($this->con);		
  }
}



?>

