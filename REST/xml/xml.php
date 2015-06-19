<?php 
require '../../config/init.php';

//build query
$query = 
  "SELECT
  tourId, 
  tours.packageId, 
  packageTitle, 
  name, blurb, description, price, difficulty, length, graphic, region
  FROM tours JOIN packages ON tours.packageId = packages.packageId ";

if (isset($_GET['packageid']))
  $packageId = $_GET['packageid'];
else if (isset($_POST['packageid']))
  $packageId = $_POST['packageid'];

if (isset($packageId))
  $query .= " WHERE tours.packageId = " . $packageId;

$query .= " ORDER BY name";

//execute query
$result = $db->query($query);
// build root XML element
$tours = new SimpleXMLElement("<tours></tours>");

// loop data and build data structure
while($row = $result->fetch(PDO::FETCH_ASSOC)) {   
  $tourId = $row['tourId'];
  $tourTitle = htmlentities($row['name'],ENT_QUOTES, 'UTF-8');
  $packageId = $row['packageId'];
  $packageTitle = htmlentities($row['packageTitle'],ENT_QUOTES, 'UTF-8');
  $description = htmlentities($row['description'],ENT_QUOTES, 'UTF-8');
  $price = $row['price'];
  $difficulty = $row['difficulty'];
  $length = $row['length'];
  $image = $row['graphic'];
  
  $tour = $tours->addChild('tour');
  $tour->addChild('tourId', $tourId);
  $tour->addChild('tourTitle', $tourTitle);
  $tour->addChild('packageId', $packageId);
  $tour->addChild('packageTitle', $packageTitle);
  $tour->addChild('description', $description);
  $tour->addChild('price', $price);
  $tour->addChild('difficulty', $difficulty);
  $tour->addChild('length', $length);
  $tour->addChild('image', $image);
  $tour->addChild('link',
   'http://itechytony.com/REST/xml.php?id=' . $tourId);
}

//format for pretty printing
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($tours->asXML());
 
//Send to browser
header('Content-type: text/xml');
echo $dom->saveXML();
?>