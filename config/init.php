<?php
ob_start();
ini_set("zlib.output_compression", "On");
function __autoload($classname) {
	$filename = "".$classname.".php";
	include ($filename);
}
include_once 'config.php';

$db = AIDADatabase::getInstance();
session_name('easy-contact');
AIDASession::startSession();

$login    = new AIDALogin();
$register = new AIDARegister();
$mailer   = new AIDAEmail();



if ( isset ( $_GET['lang'] ) )
	AIDALang::setLanguage($_GET['lang']);

//Check if a session collection has been started - if not create one
if (!isset($_SESSION["ObjColl"])) {
	$_SESSION["ObjColl"] = new ObjectCollection();
}
