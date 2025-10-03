<?php class sendMail {
 
	private $name;
	private $age;
	private $subject;
	private $message;
	private $cusemail;
 
	function __construct($subject, $message,$cusemail) {
		$this->subject = $subject;
		$this->massage = $massage;
		$this->cusemail= $cusemail;
	}
 
	function sendEmail() {
		
		$email_from = "phsrc2015@gmail.com";
$email_subject = "Private Health Services Regulatory Council -".$this->subject;
$email_message = "Dear Sir/Madem,<br>".$this->massage."<br><br>Thank You<br>Best Regards<br>PHSRC";
$email_to = "9229neranja@gmail.com";
/*$email_to = "info@mfe.gov.lk"; neranjagunarathne.92229@yahoo.com*/
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
			$msgs="Your Message Sent";	
			} 
			else 
			{
			$msge="Your email could not be sent.... Please try again!";
			}
		return $msge;
	}
 
	function isAdult() {
		//return $this->age >= 18?"an Adult":"Not an Adult";
	}
 
}
?>