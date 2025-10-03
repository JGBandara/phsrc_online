<?php
require "sendMail.php";

$subject='baw baw baw';
$message='test 1234';
$cusemail='9229neranja@gmail.com';
 
$h = new sendMail( $subject, $message ,$cusemail);
echo "Hello, " . $h->sendEmail(). "! You are ". $h->sendEmail();
?>
<br/>
