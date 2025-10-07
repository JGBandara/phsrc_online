<?php

session_start();

$_SESSION['ROOT_PATH']		=  $_SERVER['DOCUMENT_ROOT'].'/phsrc_online';
$_SESSION["projectName"] 	=  'phsrcoffline';


date_default_timezone_set('Asia/Kolkata');
	
$_SESSION['MAIN_PATH'] = 'http://'.$_SERVER['SERVER_NAME'].'/'.substr($_SERVER['PHP_SELF'],1,strpos($_SERVER['PHP_SELF'],'/',1)-1).'/';

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

// -----------------------------------------------------
$newName= $_POST['txtSName'];
$newNic  = $_POST['txtSNic'];
$newEmail	= $_POST['txtSEmail'];
$newMobile = $_POST['txtSMobile'];
$newUserName = $_POST['txtSUserName'];
$newUserPword = $_POST['txtSPassword'];
$newComPword  = $_POST['textSConPassword'];

if($newName!=null){
	    include_once 'classes/loginDB.php';		
		$db =  new loginDB();
		
		 $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
     
		
		  $sql="insert into sys_users (syu_user_name,syu_password,syu_full_name,syu_division_id,syu_contact_no,syu_designation_id,syu_email,syu_remarks,syu_status) values ('$newUserName','".md5(md5(implode($pass)))."','$newName','0','$newMobile','0','$newEmail','$newNic','1')";
		
 $resultNW=$db->executeQuery($sql);
 if($resultNW){
	 
	 $msg="Thank you for registrating with the PHSRC ONLINE REGISTRATION SYSTEM.
             
Your loging password is - ".implode($pass)."
               
PHSRC";
	 
	 require_once 'classes/ESMSWS.php';
$session=createSession('','esmsusr_1f7m','3esotc9','');
sendMessages($session,'PHSRC',$msg,array($newMobile),1); // 1 for promotional messages, 0 for normal message 
closeSession($session);
	 
	 
	$sql="select syu_id from sys_users order by syu_id DESC limit 1";
	 $result=$db->executeQuery($sql);
	 while($row=mysqli_fetch_array($result)){
		 $entryId=$row['syu_id'];
		 $sql="insert into `sys_user_location`
                (syo_location_id, syo_user_id, syo_remarks, syo_status, syo_company_id, syo_created_by, syo_created_on)
              values 
                ('1', '$entryId', '', '1', '1', '$entryId', '". time()."')";
	
	$resultLoc=$db->executeQuery($sql); 

  //$sql="select syu_id from sys_users where  order by syu_id";
 // $result=$db->executeQuery($sql);
 // while($row=mysqli_fetch_array($result)){

    $sys_id=$entryId;

    $sqlCat="SELECT
    dms_file_category.dfc_id
    FROM
    dms_file_category";

    $resultCat=$db->executeQuery($sqlCat);
    while($rowCat=mysqli_fetch_array($resultCat)){

      $fCat=$rowCat['dfc_id'];

      $sqlIn="INSERT INTO `dms_file_permission` (`dfp_file_category_id`,`dfp_user_id`,`dfp_remarks`,`dfp_status`,`dfp_is_deleted`,`dfp_location_id`,`dfp_company_id`,`dfp_created_by`,`dfp_created_on`,`dfp_last_modified_by`,`dfp_last_modified_on`,`dfp_deleted_by`,`dfp_deleted_on`) VALUES ($fCat,$sys_id,'',1,0,1,1,1,1560507766,1,1635772893,NULL,NULL)";
      $resulIn=$db->executeQuery($sqlIn);
    
    }



    
 // } 

	
	
//	  $sqlCopyUser="insert into sys_permission SELECT
//					syp_menu_id,
//					'".$entryId."',
//					syp_view,
//					syp_list,
//					syp_add,
//					syp_edit,
//					syp_delete,
//					syp_approval_1,
//					syp_approval_2,
//					syp_approval_3,
//					syp_approval_4,
//					syp_approval_5,
//					syp_send_to_approval,
//					syp_print,
//					syp_reject,
//					syp_revise,
//					syp_admin_right,
//					syp_copy_to_clipboard,
//					syp_export_to_excel,
//					syp_export_to_pdf,
//					syp_location_id,
//					syp_company_id
//					FROM sys_permission
//					WHERE
//					syp_user_id =1
//					";
//		$result = $db->executeQuery($sqlCopyUser);

		 }
	 }
	 }
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login & Sign Up Form Concept</title>
  
  
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>

      <link rel="stylesheet" href="css/animate_css/css/style.css">
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
	
	function createUser(){
		
		var userName= document.getElementById("txtSName").value;
		var NicNum  = document.getElementById("txtSNic").value;
		var email	= document.getElementById("txtSEmail").value;
		var mobileNum = document.getElementById("txtSMobile").value;
		/*var userNameS = document.getElementById("txtSUserName").value;
		var userPword = document.getElementById("txtSPassword").value;*/
		var comPword  = document.getElementById("textSConPassword").value;
		
		
		if(userName ==""||NicNum=="" || email==""|| mobileNum=="" || userNameS==""){
			alert("Please enter Valid Details");
		
		}else{
				
				document.getElementById('frmCreate').submit();
			}
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

  <div class="cotn_principal">
  <div class="headerText"><img src="img/core/heder_text.png"></div>
<div class="cont_centrar">

  <div class="cont_login">
<div class="cont_info_log_sign_up">
      <div class="col_md_login">
<div class="cont_ba_opcitiy">
        
        <h2>LOGIN</h2>  
  <p>User Loging Portal</p> 
  <button class="btn_login" onclick="cambiar_login()">LOGIN</button>
  </div>
  </div>
<div class="col_md_sign_up">
<div class="cont_ba_opcitiy">
  <h2>SIGN UP</h2>

  
  <p>New User Portal</p>

  <button class="btn_sign_up" onclick="cambiar_sign_up()">SIGN UP</button>
</div>
  </div>
       </div>

    
    <div class="cont_back_info">
       <div class="cont_img_back_grey">
       <img src="" alt="" />
       </div>
       
    </div>
<div class="cont_forms" >
    <div class="cont_img_back_">
       <img src="" alt="" />
       </div>
       <form class="user" id="frmlogin" name="frmlogin" method="POST" action="">
 <div class="cont_form_login">
 
<a href="#" onclick="ocultar_login_sign_up()" ><i class="material-icons">&#xE5C4;</i></a>
   <h2>LOGIN</h2>
   
 <input name="txtUserName" type="text" tabindex="0" placeholder="User Name" aria-describedby="emailHelp" autocompletetype="Disabled" autocomplete="off" id="txtUserName" value="" onclick="ClearUser(this.value);" required/>
 <input type="password" placeholder="Password" name="txtPassword" id="txtPassword" value="" onkeypress="EnableEnterKeySubmission(event);" onclick="ClearPassword(this.value);"  required/>

<button class="btn_login" onclick="SubmitDetails();">LOGIN</button>

  </div>
  </form>
  <form class="user" id="frmCreate" name="frmCreate" method="POST" action="">  
   <div class="cont_form_sign_up">
<a href="#" onclick="ocultar_login_sign_up()"><i class="material-icons">&#xE5C4;</i></a>
     <h2>SIGN UP</h2>
     <input type="text" name="txtSName" id="txtSName" placeholder="Name" required/>
<input type="text" name="txtSNic" id="txtSNic" placeholder="Nic" required />
<input type="email" name="txtSEmail" id="txtSEmail" placeholder="Email" required/>
<input type="text" name="txtSMobile" id="txtSMobile" placeholder="Mobile" required/>
<input type="text" name="txtSUserName" id="txtSUserName" placeholder="User Name" required/>
<!--<input type="password" name="txtSPassword" id="txtSPassword" placeholder="Password" />
<input type="password" name="textSConPassword" id="textSConPassword" placeholder="Confirm Password" />-->
<button class="btn_sign_up" onclick="cambiar_sign_up();createUser();">SIGN UP</button>

  </div>
</form>
    </div>
    
  </div>
 </div>
 <div style="height:480px"></div>
   <div class="headerText" ><img src="img/core/footer_text.png"></div>
</div>
    <script  src="js/animate_js/js/index.js"></script>
</body>

</html>
