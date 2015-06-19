<?php 
require '../../config/init.php';

//build query
$query = 
  "SELECT 
  packageId, 
  packageTitle, 
  packageDescription, 
  packageGraphic 
  FROM packages ORDER BY packageId ASC";

$result = $db->query($query);
// build root XML element
$packages = new SimpleXMLElement ( "<packages></packages>" );

// loop data and build data structure
while($row = $result->fetch(PDO::FETCH_ASSOC)) {    
  $packageId = $row['packageId'];
  $packageTitle = htmlentities($row['packageTitle'],ENT_QUOTES, 'UTF-8');
  $packageDescription= htmlentities($row['packageDescription'],ENT_QUOTES, 'UTF-8');
  $packageGraphic = htmlentities($row['packageGraphic'],ENT_QUOTES, 'UTF-8');
  //Create node and children
  $package = $packages->addChild('package');
  $package->addChild('packageId', $packageId);
  $package->addChild('title', $packageTitle);
  $package->addChild('description', $packageDescription);
  $package->addChild('graphic', $packageGraphic);
}


//format for pretty printing
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($packages->asXML());
 
//Send to browser
header('Content-type: text/xml');
echo $dom->saveXML();
?>