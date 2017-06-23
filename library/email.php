<?php
require 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
class Email extends PHPMailer
{
	public $ErrorInfo;
	private $address;
	public $mail;

	function __construct(){
		// $this->mail             = new PHPMailer();
		$this->mail = $this;


		$this->mail->IsSMTP(); // telling the class to use SMTP
		//$mail->Host       = "mail.yourdomain.com"; // SMTP server

		$this->mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		                                           // 1 = errors and messages
		                                           // 2 = messages only
		$this->mail->SMTPAuth   = true;                  // enable SMTP authentication
		$this->mail->SMTPSecure = "tls";                 
		$this->mail->Host       = "smtp.gmail.com";      // SMTP server
		$this->mail->Port       = 587;                   // SMTP port
		$this->mail->Username   = MAIL_USERNAME;  // username
		$this->mail->Password   = MAIL_PASSWORD;            // password

		$this->mail->SetFrom(MAIL_FROM, MAIL_FROM_DESC);
		// if(!$this->mail->Send()) {
		// 	echo "Mailer Error: " . $this->mail->ErrorInfo;
		// } else {
		// 	echo "Message sent!";
		// }
		logs(get_class($this));
	}

	public function sendemail(){
		$this->mail->Send();
	}

	public function to($address,$address_name=''){
		$this->mail->AddAddress($address,$address_name);
	}

	public function subject($subject){
		$this->mail->Subject = $subject;
	}

	public function body($body){
		$this->mail->MsgHTML($body);
	}

	private function validate(){
		 
	}
}
