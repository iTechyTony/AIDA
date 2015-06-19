<?php require_once   'config/init.php';
$emailAddresses = array(
    'itechytony@gmail.com',
    'antonydat@live.co.uk'
);

error_reporting(0);
date_default_timezone_set('America/Los_Angeles');
require "vendor/phpmailer/class.phpmailer.php";

session_name("easy-contact");
session_start();


foreach ($_POST as $key => $val) {
    $_POST[$key] = stripslashes($_POST[$key]);
    $_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}

// Create new message object
$message = new AIDAMessage($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);

try {
    // Check validities
    if(!$message->isNameValid())
        throw new Exception('Name field is too short.');
    if(!$message->isEmailValid())
        throw new Exception('Email is not valid.');
    if(!$message->isSubjectValid())
        throw new Exception('Subject field is too short.');
    if(!$message->isMessageValid())
        throw new Exception('Message field is too short.');

    if ((int)$_POST['captcha'] != $_SESSION['expected'])
        throw new Exception('Captcha field is not valid.');

    $message->send($emailAddresses);
    echo json_encode(array('status' => 'ok','log' => 'Mail sent.'));
}
catch (Exception $ex){
    $error = $ex->getMessage();
    echo json_encode(array('status' => 'fail','log' => $error));
}


