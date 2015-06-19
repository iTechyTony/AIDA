<?php
//Function to escape output
function escapeOutput($string){
	//String, double and single quotes,character encoding
	return htmlentities($string,ENT_QUOTES,'UTF-8');
}

function checkString($string) {
	
	$msg = "";
	if (empty($string)){
		$msg .="- Error:String must not be empty";
	}
	
      //Other tests here
	
	if (empty($msg)){
		$msg = "Valid string";
	}
	return $msg;
}