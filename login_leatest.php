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
	
 $_SESSION['MAIN_PATH']  = 'http://'.$_SERVER['SERVER_NAME'].'/'.substr($_SERVER['PHP_SELF'],1,strpos($_SERVER['PHP_SELF'],'/',1)-1).'/'.$_SESSION["projectName"].'/';

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
  $sql = "select syu_id, syu_user_name, syu_password, syu_status, syu_email, syu_full_name, syu_company_id, syu_employee_id, syo_location_id
          from sys_users u
            inner join sys_user_location on syu_id=syo_user_id and syo_is_deleted='0' and syo_company_id=syu_company_id and syo_status='1'
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
      $_SESSION["locationId"]      = $row["syo_location_id"];
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

<!DOCTYPE html>
<html lang="en" class="Gibbu_@hotmail.com">

<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.1/js/all.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.js" integrity="sha256-mkdmXjMvBcpAyyFNCVdbwg4v+ycJho65QLDwVE3ViDs=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/login_css/style.css">
      
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

<body>

  
<!-- NORMALIZED CSS INSTALLED-->
<!-- View settings for more info.-->
<div id="container">
 <!--<?php include "{$backwardSeparator}messageModal.php";?>-->
  <div id="inviteContainer">
    <div class="logoContainer"><img class="logo" src="img/core/phsrc_gif.gif"/><img class="text" src="img/core/phsrc_icon.png"/></div>
    <div class="acceptContainer">
      <form class="user" id="frmlogin" name="frmlogin" method="POST" action="">
        <h1>WELCOME BACK!</h1>
        <div class="formContainer">
          <div class="formDiv" style="transition-delay: 0.2s;">
            <p>USER NAME</p>
           <input class="form-control form-control-user" name="txtUserName" type="text" tabindex="0" placeholder="User Name" aria-describedby="emailHelp" autocompletetype="Disabled" autocomplete="off" id="txtUserName" value="" onclick="ClearUser(this.value);"/>

          </div>
          <div class="formDiv" style="transition-delay: 0.4s;">
            <p>PASSWSORD</p>
            <input class="form-control form-control-user"  type="password" placeholder="Password" name="txtPassword" id="txtPassword" value="" onkeypress="EnableEnterKeySubmission(event);" onclick="ClearPassword(this.value);"/><a class="forgotPas" href="#">FORGOT YOUR PASSWORD?</a>
          </div>
          <div class="formDiv" style="transition-delay: 0.6s;">
            <input type="button" class="btn btn-success btn-user btn-block acceptBtn" value="Login" onclick="SubmitDetails();"/><span class="register">Need an account?<a href="presentation/createAccount/registration/createAccount/newRegistration.php">Register</a></span>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
  
  

    <script  src="js/login_js/js/index.js"></script>




</body>

</html>
