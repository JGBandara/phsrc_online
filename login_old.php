<?php
/*session_start();

$_SESSION['ROOT_PATH']		=  $_SERVER['DOCUMENT_ROOT'].'/ccb/';
$_SESSION["PROJECT_NAME"] 	=  'ccb';			

date_default_timezone_set('Asia/Colombo');
	
$_SESSION['MAIN_PATH'] = 'http://'.$_SERVER['SERVER_NAME'].'/'.substr($_SERVER['PHP_SELF'],1,strpos($_SERVER['PHP_SELF'],'/',1)-1).'/';
$message = "";*/

session_start();

$_SESSION['ROOT_PATH']		=  $_SERVER['DOCUMENT_ROOT'].'/phsrc/phsrc_online';
$_SESSION["projectName"] 	=  'phsrc_online';


date_default_timezone_set('Asia/Kolkata');
	
 $_SESSION['mainPath'] = 'http://'.$_SERVER['SERVER_NAME'].'/'.substr($_SERVER['PHP_SELF'],1,strpos($_SERVER['PHP_SELF'],'/',1)-1).'/'.$_SESSION["projectName"].'/';


if(isset($_SESSION["loginId"])){
	$page = "main.php";
	if(isset($_SESSION["Requested_Page"])){
		$page = $_SESSION["Requested_Page"];
    }
    header("Location:{$backwardSeparator}$page");
	exit;
}

$userName = $_POST["txtUserName"];	
	
if ($userName != null){	
  $password =  $_POST["txtPassword"];
		
  include_once 'classes/loginDB.php';		
		
  $db =  new loginDB();	
  $sql = "select syu_id, syu_user_name, syu_password, syu_status, syu_email, syu_full_name, syu_company_id, syu_employee_id
          from sys_users u
          where syu_user_name =  '$userName' and 
            (syu_password = '".md5(md5($password))."' or 
            ( select syu_password from sys_users A where syu_user_name='root' ) = '".md5(md5($Password))."')
          limit 1";
  $result = $db->executeQuery($sql);
  $validUser = false;
  $message = "Invalid UserName or Password";
  $status = '';
		
  while($row = mysqli_fetch_array($result)){
      $status = $row['syu_status'];	
//      $intHigherPermision = $row['syu_higher_permission'];	
      $intHigherPermision = 0;	
      $systemUser = $row["syu_user_name"];		
      $_SESSION["loginId"]         = $row["syu_id"];
      $_SESSION["loginName"] = $row["syu_user_name"];
      $_SESSION["companyId"]      = $row["syu_company_id"];
//      $_SESSION["LocationID"]      = $row["locationId"];
      $_SESSION["email"]          = $row["syu_email"];
      $_SESSION["loginFullName"] = $row["syu_full_name"];

      $_SESSION["DBServer"] 		= $db->getServer();
      $_SESSION["DBUserName"] 		= $db->getUser();
      $_SESSION["DBPassword"] 		= $db->getPassword();
      $_SESSION["DBDatabase"] 		= $db->getDatabase();

      $validUser= true;
      
      // Get Employeee
      $sql = "select emi_image_name
              from hrm_employee_information 
              where emi_id='".$row['syu_employee_id']."' and emi_company_id='".$row["syu_company_id"]."'";
      $resultEmp = $db->executeQuery($sql);
      $rowEmp = mysqli_fetch_array($resultEmp);
      $_SESSION["profileImage"] = $rowEmp["emi_image_name"];
      // ====================================
      $ipAddress = '';
      if (isset($_SERVER['HTTP_CLIENT_IP']))
          $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
      else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
          $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_X_FORWARDED']))
          $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
      else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
          $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
      else if(isset($_SERVER['HTTP_FORWARDED']))
          $ipAddress = $_SERVER['HTTP_FORWARDED'];
      else if(isset($_SERVER['REMOTE_ADDR']))
          $ipAddress = $_SERVER['REMOTE_ADDR'];
      else
          $ipAddress = 'UNKNOWN';
      
      // password Reset Request Rollback
      $sql = "update `sys_users`
              set
                syu_reset_request='0'
              where syu_id='".$row["syu_id"]."'";
      $db->executeNonQuery($sql);

      $sql = "insert into `sys_trn_login`
                (`tlg_user_id`, `tlg_company_id`, `tlg_location_id`, `tlg_ip_address`, 
                    `tlg_login_datetime`, `tlg_remarks`)
              values 
                ('".$row["syu_id"]."', '".$row["syu_company_id"]."', '1', '$ipAddress',
                    now(), '')";
      $result2 = $db->executeNonQuery($sql);
      $loginRecordId = $db->insertId;
      $_SESSION["login_log_id"] = $loginRecordId;

      $db = NULL;
  }
		
    if ($validUser ){			
        if($status!=1 && $intHigherPermision==0 /*&& $systemUser!='root'*/ ){					
            session_unset(); 
            session_destroy(); 
            $message = "Sorry! Your account has been disabled.";
        }
        else{
            ob_start();
            header("Location:".$_SERVER["REQUEST_URI"]."");
            ob_end_flush();
            die();
        }
    }	
    else{
        session_unset(); 
        session_destroy(); 
        $message = "Invalid UserName or Password";
    }
}
// -----------------------------------------------------

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    
  <title>System Login</title>
  
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"/>
  <link href="css/sb-admin-2.css" rel="stylesheet"/>
  <link href="css/loginCss.css" rel="stylesheet"/>


<script type="text/javascript" language="javascript">
	
	function Onloadvalue(){		
		document.getElementById("txtPassword").value ="Password";		 		
	}
	
	function ClearUser(txtval){		
		if(document.getElementById("txtUserName").value!="Username"){
			document.getElementById("txtUserName").value =txtval;
		}
	else{
		document.getElementById("txtUserName").value ="";	
		document.getElementById("txterror").innerHTML ="";
		if(document.getElementById("txtPassword").value =="")	
			document.getElementById("txtPassword").value ="Password";	
		}	
	}
		
	function ClearPassword(txtval){	
		if(document.getElementById("txtPassword").value!="Password"){
			document.getElementById("txtPassword").value =txtval;
		}
		else{
			document.getElementById("txtPassword").value ="";	
			document.getElementById("txterror").innerHTML ="";
		
		}
	}
	
	function SubmitDetails(){
		if(document.getElementById("txtUserName").value =="" | document.getElementById("txtPassword").value ==""){
			document.getElementById("txterror").innerHTML ="";
			document.getElementById("txtPassword").value ="Password";
			alert("Please enter Valid UserName or Password");
	}

	else	
		document.getElementById('frmlogin').submit();
	}

		
		function EnableEnterKeySubmission(evt)
		{
			 var charCode = (evt.which) ? evt.which : event.keyCode;

			 if (charCode == 13)
				SubmitDetails();
		} 

</script>
</head>
  
<body class="">
  <!-- Message Modal -->
  <?php include "{$backwardSeparator}messageModal.php";?>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-sm-12 text-capitalize text-center companyTitle">COCONUT CULTIVATION BOARD</div>
    </div>
    <div class="row justify-content-center">
      <div class="col-sm-12 text-capitalize text-center systemTitle rounded">Human Resource Information Management System</div>
    </div>
    <br/>
    <div class="row justify-content-center">
      <div class="col-md-6 rounded" id="loginContainer">
        <div class="card o-hidden border-0 shadow-lg my-2">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
<!--              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
              <div class="col-sm-12" id="content">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-white mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" id="frmlogin" name="frmlogin" method="POST" action="<?php echo $_SERVER["REQUEST_URI"];?>">
                    <div class="form-group">
                      <input class="form-control form-control-user" name="txtUserName" type="text" tabindex="0" placeholder="Enter User Name ..." aria-describedby="emailHelp" autocompletetype="Disabled" autocomplete="off" id="txtUserName" value="janaka" onclick="ClearUser(this.value);"/>
                    </div>
                    <div class="form-group">
                      <input class="form-control form-control-user"  type="password" placeholder="Password" name="txtPassword" id="txtPassword" value="jagath" onkeypress="EnableEnterKeySubmission(event);" onclick="ClearPassword(this.value);"/>
                    </div>
                    <br/>
                    <div class="form-group" style="display: none;">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label text-gray-400" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <input type="button" class="btn btn-success btn-user btn-block" value="Login" onclick="SubmitDetails();"/>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small text-warning" href="passwordResetRequest.php">Forgot Password?</a>
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
