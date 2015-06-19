<?php
//WEBSITE

define('WEBSITE_NAME', "AIDA");

define('WEBSITE_DOMAIN', "http://itechytony.com/aida/");

$config['base_url']='http://itechytony.com/aida/';


//DATABASE CONFIGURATION

define('DB_HOST', "localhost"); 

define('DB_TYPE', "mysql"); 

define('DB_USER', "username_goes_here");

define('DB_PASS', "password_goes_here");

define('DB_NAME', "database_name_goes_here");


// FAKE DATABASE TO DISPLAY DATABASE TEST PAGE

$fake_db['hostname'] = 'localhost';
$fake_db['username'] = 'username';
$fake_db['password'] = 'password';
$fake_db['database'] = 'db';
$fake_db['dbdriver'] = 'mysql';

//SESSION CONFIGURATION

define('SESSION_SECURE', false);   

define('SESSION_HTTP_ONLY', true);

define('SESSION_REGENERATE_ID', true);   

define('SESSION_USE_ONLY_COOKIES', 1);


//LOGIN CONFIGURATION

define('LOGIN_MAX_LOGIN_ATTEMPTS', 5); 

define('LOGIN_FINGERPRINT', true); 

define('SUCCESS_LOGIN_REDIRECT', "index.php"); 


//PASSWORD CONFIGURATION

define('PASSWORD_ENCRYPTION', "bcrypt"); //available values: "sha512", "bcrypt"

define('PASSWORD_BCRYPT_COST', "13"); 

define('PASSWORD_SHA512_ITERATIONS', 25000); 

define('PASSWORD_SALT', "Y1ikK38jObs0InjHMZGFxH"); //22 characters to be appended on first 7 characters that will be generated using PASSWORD_ info above

define('PASSWORD_RESET_KEY_LIFE', 10); 


//REGISTRATION CONFIGURATION

define('MAIL_CONFIRMATION_REQUIRED', true); 

define('REGISTER_CONFIRM', "http://itechytony.com/aida/confirm.php");

define('REGISTER_PASSWORD_RESET', "http://itechytony.com/aida/passwordreset.php");


//EMAIL SENDING CONFIGURATION

define('MAILER', "mail"); 

define('SMTP_HOST', ""); 

define('SMTP_PORT', 0); 

define('SMTP_USERNAME', ""); 

define('SMTP_PASSWORD', ""); 

define('SMTP_ENCRYPTION', ""); 


//SOCIAL LOGIN CONFIGURATION

define('SOCIAL_CALLBACK_URI', "http://itechytony.com/aida/vendor/hybridauth/");


// GOOGLE

define('GOOGLE_ENABLED', false); 

define('GOOGLE_ID', "");

define('GOOGLE_SECRET', "");


// FACEBOOK

define('FACEBOOK_ENABLED', false);

define('FACEBOOK_ID', "");

define('FACEBOOK_SECRET', "");


// TWITTER


define('TWITTER_ENABLED', false);

define('TWITTER_KEY', "");

define('TWITTER_SECRET', "");


// TRANSLATION

define('DEFAULT_LANGUAGE', 'en'); 



