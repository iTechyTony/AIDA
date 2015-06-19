<?php require_once 'templates/_header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Internet Development | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>
<div class="container-fluid">
	<div class="row">
<?php require_once 'templates/_leftnav.php';?><div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Function Tests</h3>
				</div>
				<div class="panel-body">
					<h1>Built-in Functions</h1>
<?php
$strvar        = "apples";
$intvar        = 19;
$floatvar      = 27.579;
$product_array = array(
	"id"          => 234,
	"description" => "apples",
	"type"        => "bramley",
	"price"       => 2.45,
);
$url = "www.somesite.com";

print"<br />a) Length of the string $strvar = " .strlen($strvar);

print"<br />b) $strvar to uppercase = " .strtoupper($strvar);

print"<br> c) Substring "."'".substr($url, 4, -8)."'"." in $url at index position = " .strpos($url, 'some');

print"<br />d) $strvar encrypted with md5 = " .md5($strvar);

print"<br>e) Get the variable type of $intvar = " .gettype($intvar);

print"<br>f) Is $floatvar numeric? The answer will be 1(true) or 0(false) = ";
if (is_numeric($floatvar)) {
	echo "1";
} else {
	echo "0";
}

print"<br>g) Format the number $floatvar to 1 decimal place = " .number_format($floatvar, 1);

print"<br>h) Print the product_array = ";
print_r($product_array);

print"<br>i) Number of items in product_array = ".count($product_array);

print"<br>j) Is ".$product_array['description']." in the array? = ";
// check if item is in an array

if (in_array("apples", $product_array)) {

	print"1";
} else {
	print"0";
}
print"<br>k) Add \"price\"=>2.45 onto the product array and display =";

echo '<pre>', print_r($product_array), '</pre>';

echo 'l) Explode '.$url.' into an array (separated by "." ) and display =';

$exploded = explode(".", $url);

foreach ($exploded as $part) {

	print" $part ";
}

echo '<pre>', print_r($exploded), '</pre>';

print"m) Format todays date like this = ".date("D jS F Y");

?>
<h1>User Functions</h1>

<?php

include 'includes/functions/datetime.php';
include 'includes/functions/sanitise.php';

$date     = new DateTime('1991-08-31');
$birthday = date_format($date, '"j","m","Y"');

print"a) Age of someone born ".date_format($date, "jS F Y")." = ".getAge("31", "08", "1991");

$bad_string = "A 'quote' & is bold \"!!";

print"<br>b) Bad string = ".$bad_string;
print"<br> Bad string AFTER sanitisation =".escapeOutput($bad_string);
$name = "";
print"<br>c)".checkString($name);

?>
</div>


			</div>
		</div>
		<!-- end of col-md-9 -->
	</div>
	<!-- end of row -->
</div>
<!-- end of container fluid -->
<?php require_once 'templates/_footer.php';?>

</body>
</html>