<?php 
/**
 * Class Message
 */
Class AIDAMessage {

    var $name;
    var $email;
    var $subject;
    var $message;

    public function __construct($name, $email, $subject, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function send($emailAddresses) {
        $phpMailer = new PHPMailer();
        $phpMailer->IsMail();

        $phpMailer->AddReplyTo($this->email, $this->name);

        foreach($emailAddresses as $emailAddress)
            $phpMailer->AddAddress($emailAddress);

        $phpMailer->SetFrom($this->email, $this->name);
        $phpMailer->Subject = 'Contact form message: '.$this->subject.' from '.$this->name.'.';

        $msg = 'Name:	    ' . $this->name.'<br />'.
               'Email:	    ' . $this->email.'<br />'.
               'IP Address:	' . $_SERVER['REMOTE_ADDR'] . '<br /><br />'.
               'Message:<br /><br />'.
               nl2br($this->message);

        $phpMailer->MsgHTML($msg);

        $phpMailer->Send();
    }

    public function isEmailValid() {
        if($this->isTextValid($this->email))
            return preg_match('/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/', $this->email);
        return false;
    }

    public function isNameValid() {
        return $this->isTextValid($this->name);
    }

    public function isSubjectValid() {
        return $this->isTextValid($this->subject);
    }

    public function isMessageValid(){
        return $this->isTextValid($this->message);
    }

    public function isTextValid($text) {
        $length = 3;
        return mb_strlen(strip_tags($text), 'utf-8') >= $length;
    }

}