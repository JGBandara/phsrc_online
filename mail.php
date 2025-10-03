<?php
//require_once("classes/Dbconn.php");
//require_once("classes/configaration.php");
//$dbconn			=new DBconnection();
//$config			=new Configuration();



	$readfilepath="contacts/contacts_English.xls";
	$cph_name = "Name...";
	$cph_email = "Email...";
	$cph_subject = "Subject...";
	$cph_message = "Message...";



?>
<?php
$msgs="";
$msge="";
$name="";
$cusemail="";
$subject="";
$message="";
/*if(isset($_POST['name']) && ($_POST['email'])){*/
	/*$name=$_POST['name'];
 	$cusemail=$_POST['email'];
 	$subject=$_POST['subject'];
 	$message=$_POST['message'];*/
	$name='Baw';
 	$cusemail='Baw';
 	$subject='Online Registration User Credencial';
 	$message='<br>User name:ADMIN<br>Password:ADMIN';
	/*if(empty($name)) { $msge="Please enter your name";}
	if(empty($cusemail)) { $msge="Please enter your email address";}
	if(empty($subject)) { $msge="Please enter subject of message";}
	if(empty($message)) { $msge="Please enter your message";}*/
if(empty($msge))
{
/*$email_from = "info@mfe.gov.lk";*/
$email_from = "neranja@slts.lk";
$email_subject = "Private Health Services Regulatory Council -".$subject;
$email_message = "Dear Sir/Madem,<br>".$message."<br><br>Thank You<br>Best Regards<br>PHSRC";
$email_to = "9229neranja@gmail.com";
/*$email_to = "info@mfe.gov.lk";*/
		$headers = "From:" .($email_from) . "\r\n";
     	$headers .= "Reply-To: ".($email_from) . "\r\n";
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
/*}*/
?>