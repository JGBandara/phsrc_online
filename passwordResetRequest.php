<?php
session_start();

$_SESSION['ROOT_PATH']		=  $_SERVER['DOCUMENT_ROOT'].'/core/';
$_SESSION["PROJECT_NAME"] 	=  'core';			

date_default_timezone_set('Asia/Colombo');
	
$_SESSION['MAIN_PATH'] = 'http://'.$_SERVER['SERVER_NAME'].'/'.substr($_SERVER['PHP_SELF'],1,strpos($_SERVER['PHP_SELF'],'/',1)-1).'/';

$message = "";	
if (isset($_POST["txtUserName"]) && $_POST["txtUserName"]!=""){	
  $userName = $_POST["txtUserName"];	
		
  include_once 'classes/loginDB.php';		
		
  $db =  new loginDB();	
  $sql = "select syu_id, syu_user_name, syu_password, syu_status, syu_email, syu_full_name, syu_company_id, syu_employee_id
          from sys_users u
          where syu_user_name =  '$userName'
          limit 1";
  $result = $db->executeQuery($sql);
		
  if($row = mysqli_fetch_array($result)){
      $userId  = $row["syu_id"];
      $userFullName  = $row["syu_full_name"];
      $userCompanyId  = $row["syu_company_id"];
      
      $sql = "update `sys_users`
              set
                syu_reset_request='1'
              where syu_id='$userId'";
      $result = $db->executeNonQuery($sql);

      // Throw new Alert
      $title = $row['syu_full_name']." is requested to reset his password at ".date("Y-m-d H:i:s").".";
      $sql = "insert into `sys_trn_alert`
                (`sal_title`, `sal_type_id`, `sal_category_id`, `sal_reference_id`, 
                  `sal_remarks`, `sal_status`, `sal_is_deleted`, `sal_company_id`, 
                  `sal_created_by`, `sal_created_on`)
              values 
                ('$title', '1', '1', '$userId', 
                  '$title', '1', '0', '$userCompanyId',
                    '$userId', '". time()."')";
      $result = $db->executeNonQuery($sql);
      $alertId = $db->insertId;
      // Get Alert Notify
      $sql = "select group_concat(syp_user_id separator ',') as ids
              from sys_permission p
              where syp_menu_id='6' and syp_edit='1'";
      $result = $db->executeQuery($sql);
      if($row = mysqli_fetch_array($result)){
        $ids = explode(',', $row['ids']);
      }
      foreach ($ids as $notifyId) {
        $sql = "insert into `sys_trn_alert_notify`
                  (`san_alert_id`, `san_user_id`, `san_read_status`, 
                    `san_status`, `san_is_deleted`, `san_company_id`, `san_created_by`, `san_created_on`)
                values
                  ('$alertId', '$notifyId', '2',
                    '1', '0', '$userCompanyId', '$userId', '".time()."')";
        $result = $db->executeNonQuery($sql);
      }
      $db = NULL;
  }
  else{
    $message = "Invalid User Name ...";
  }
}
// -----------------------------------------------------

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Forgot Password</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">
  <!-- Message Modal -->
  <?php include "{$backwardSeparator}messageModal.php";?>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your user name below and we'll send your request!</p>
                  </div>
                  <form class="user"  method="POST" action="<?php echo $_SERVER["REQUEST_URI"];?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="txtUserName" name="txtUserName"  placeholder="Enter User Name ...">
                    </div>
                    <button type="submit" class="btn btn-outline-warning btn-user btn-block">Send Request</button>
                  </form>
                  <hr>
<!--                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>-->
                  <div class="text-center">
                    <a class="small" href="login.php">Back to Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/common.js"></script>

</body>

</html>
<script type="text/javascript">
<?php
  if($message!=""){
    echo 'modalMsgBox("Error", "'.$message.'");';
  }
  elseif(isset($_POST["txtUserName"])){
    echo 'modalMsgBox("Success", "Your request is sent ...");';
  }
?>
</script>
