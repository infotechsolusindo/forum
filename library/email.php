<?php
require ROOT . '/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
require ROOT . '/vendor/phpmailer/phpmailer/class.smtp.php';
class Email extends PHPMailer {
    private $_service;
    public $ErrorInfo;
    private $address;
    public $mail;

    function __construct() {
        //$this->_service = new Service;
        // $this->mail             = new PHPMailer();
        $this->mail = $this;

        $this->mail->IsSMTP(); // telling the class to use SMTP
        //$mail->Host       = "mail.yourdomain.com"; // SMTP server

        $this->mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $this->mail->SMTPAuth = true; // enable SMTP authentication
        $this->mail->SMTPSecure = "tls";
        $this->mail->Host = "smtp.gmail.com"; // SMTP server
        $this->mail->Port = 587; // SMTP port
        $this->mail->Username = MAIL_USERNAME; // username
        $this->mail->Password = MAIL_PASSWORD; // password

        $this->mail->SetFrom(MAIL_FROM, MAIL_FROM_DESC);
        // if(!$this->mail->Send()) {
        //     echo "Mailer Error: " . $this->mail->ErrorInfo;
        // } else {
        //     echo "Message sent!";
        // }
        logs(get_class($this));
    }

    public function sendemail() {
        if (MAIL_SERVICE) {
            $sclient = new ServiceClient('email');
            $sclient->addData($this->From, 'from');
            $sclient->addData($this->to, 'to');
            $sclient->addData($this->Subject, 'subject');
            $sclient->addData(base64_encode($this->Body), 'body');
            $service = new Service;
            $service->addClient($sclient);
            return;
        } else {
            logs('Sending direct email...');
            return $this->mail->Send();
        }
    }
    public function execute() {
        return $this->mail->Send();
    }

    public function to($address, $address_name = '') {
        $this->mail->AddAddress($address, $address_name);
    }

    public function subject($subject) {
        $this->mail->Subject = $subject;
    }

    public function body($body) {
        $this->mail->MsgHTML($body);
    }

    private function validate() {

    }
}
