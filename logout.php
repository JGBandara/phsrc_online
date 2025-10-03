<?php

session_start();
$mainPath = $_SESSION['MAIN_PATH'];
$backwardSeparator = "";
$error = "";

if(isset($_SESSION["login_log_id"])){
  try {
    include "{$backwardSeparator}dataAccess/connector.php";
    // update Logout Details
    $logId = $_SESSION["login_log_id"];
    $sql = "update `sys_trn_login`
            set 
              `tlg_login_out_datetime` = now()
            where `tlg_id` = '$logId'";
    $result = $db->singleQuery($sql);
    session_unset(); 
    session_destroy(); 
    
    header ("Location:{$backwardSeparator}index.php");
    
  } catch (Exception $exc) {
    $error = "<li>".$exc->getMessage()."<br/>".$exc->getTraceAsString()."</li>";
  }

}
else{
  session_unset(); 
  session_destroy(); 
  header ("Location:{$backwardSeparator}index.php");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log out</title>

<link href="css/sb-admin-2.css" rel="stylesheet">
<style type="text/css">
  body {
   min-height:100vh;
}

.flex-fill {
   flex:1 1 auto;
}
</style>
</head>

<body id="page-top" class="d-flex flex-column">  
  <header>
  </header>
  <main class="container-fluid flex-fill">
      <!-- Main Content -->
      <div id="content">
        <!-- Error -->
        <?php if($error!=""){?>
        <div class="row align-middle py-5">
          <div class="col-1"></div>
          <div class="card col-10 text-danger shadow py-2">
            <div class="text-left">
              <h1 class="h4 text-danger mb-4">Error Occurred ...</h1>
            </div>
            <ul>
              <?php echo $error;?>
            </ul>
          </div>
          <div class="col-1"></div>
        </div>
        <?php }?>
      </div>
  </main>
  <footer>
  </footer>
</body>
</html>
