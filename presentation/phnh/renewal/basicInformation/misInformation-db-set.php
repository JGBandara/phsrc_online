<?php 
	
	$backwardseperator = "../../../../";
	/*$mainPath 	= $_SESSION['mainPath'];
	$userId 	= $_SESSION['userId'];*/
	$requestType 	= $_REQUEST['requestType'];
	$requstTypeSub = $_REQUEST['requstTypeSub'];
	include "{$backwardseperator}dataAccess/misconnector.php";
	$response = array('type'=>'', 'msg'=>'');
	
	/////////// parameters /////////////////////////////
	$requestType 	= $_REQUEST['requestType'];
        $type	=($_REQUEST['optConfirmStatus']==''?'NULL':"'".$_REQUEST['optConfirmStatus']."'");
	//$id 			= $_REQUEST['cboSearch'];

	$insId			= trim($_REQUEST['insId']);
	$mobNo	= $_REQUEST['mobNo'];
	
	/////////// location insert part /////////////////////

	/////////// location update part /////////////////////
	if($requestType=='edit')
	{
           $type=$_REQUEST['type'];
            //$mobNo='0711899110';
            $alphabet = "0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
  //$acTime =  DATE_ADD(date('Y-m-d H:i:s'), INTERVAL 30 MINUTE);
   date_default_timezone_set("Asia/Colombo");
		$start = date('Y-m-d H:i:s');
               $acTime =  date('Y-m-d H:i:s',strtotime(' +5 minutes',strtotime($start)));
   
		 $sql = "UPDATE `reg_ins_comm` SET code='".implode($pass)."',active_time='$acTime' WHERE (`institute_id`='$insId')";
		$result =mysqli_query($conn,$sql);
		if(($result)){
                  
                    if($type==1){
                    $msg="Your one-time confirmation code for PHSRC system authorization is: ".implode($pass)."";

	 
	 require_once "{$backwardseperator}classes/ESMSWS.php";
$session=createSession('','esmsusr_1f7m','3esotc9','');
sendMessages($session,'PHSRC',$msg,array($mobNo),1); 
closeSession($session);
                    }else{
 //===================================================================================================                     
$msgs="";
$msge="";
$name="";
$cusemail="";
$subject="";
$message="";
$msg="<img src='http://phsrc.lk/phsrc_online/img/core/Capture.JPG' height='90%' width='95%'/><br/>Dear Sir/Madem,<br/>Your one-time confirmation code for PHSRC system authorization is: ".implode($pass)."<br/> <br /><h6 style='color:red'><b>This e-mail and any attachments may contain confidential and
privileged information. If you are not the intended recipient,
please notify the sender immediately by return e-mail, delete this
e-mail and destroy any copies. Any dissemination or use of this
information by a person other than the intended recipient is
unauthorized and may be illegal.</b></h6><br/>";
/*if(isset($_POST['name']) && ($_POST['email'])){*/
	/*$name=$_POST['name'];
 	$cusemail=$_POST['email'];
 	$subject=$_POST['subject'];
 	$message=$_POST['message'];*/
	$name='Baw';
 	$cusemail='Baw';
 	$subject='Online Registration User Credencial';
 	$message=$msg;
	/*if(empty($name)) { $msge="Please enter your name";}
	if(empty($cusemail)) { $msge="Please enter your email address";}
	if(empty($subject)) { $msge="Please enter subject of message";}
	if(empty($message)) { $msge="Please enter your message";}*/
if(empty($msge))
{
/*$email_from = "info@mfe.gov.lk";*/
    $reply="phsrc2015@gmail.com";
$email_from = "info@phsrc.lk";
$email_subject = "Private Health Services Regulatory Council -".$subject;
$email_message = "".$message."<br><br>Thank You<br>Best Regards<br>PHSRC";
//$email_to = "9229neranja@gmail.com";
$email_to = "neranja@slts.lk";
		$headers = "From:" .($email_from) . "\r\n";
     	$headers .= "Reply-To: ".($reply) . "\r\n";
        $headers .= "Return-Path: ".($email_from) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";
		$ok = @mail($email_to, $email_subject, $email_message, $headers);
			if($ok) 
			{
				echo 'ok';
				$msgs="Your Message Sent";
				$name="";
				$cusemail="";
				$subject="";
				$message="";
			} 
			else 
			{
			$msge="Your email could not be sent.... Please try again!";
			
			echo $msge;
			}
	}
//==================================================================================
                        
                    }
                    
			$response['type'] 		= 'pass';
                        $response['acTime']             = $acTime;
			$response['msg'] 		= 'Updated successfully.';
		}
		else{
			$response['type'] 		= 'fail';
			$response['msg'] 		= $db->errormsg;
			$response['q'] 			=$sql;
		}
	}
	/////////// location delete part /////////////////////
	else if($requestType=='delete')
	{
		$sql = "DELETE FROM `mst_locations` WHERE (`intId`='$id')  ";
		$result = $db->RunQuery($sql);
		if(($result)){
			$response['type'] 		= 'pass';
			$response['msg'] 		= 'Deleted successfully.';
		}
		else{
			$response['type'] 		= 'fail';
			$response['msg'] 		= $db->errormsg;
			$response['q'] 			=$sql;
		}
	}
	echo json_encode($response);
?>