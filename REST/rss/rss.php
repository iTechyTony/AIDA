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

// build parent element
$rss = new SimpleXMLElement("<rss version='2.0'></rss>");
$channel = $rss->addChild('channel');
$channel->addChild('title', 'Explore California Tours');
$channel->addChild('description', 'Explore Our World Your Way');
$channel->addChild('link', 'http://www.explorecalifornia.org');
$channel->addChild('copyright', 'Copyright (c) 2011 lynda.com');

// loop data and build data structure
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
  	
  $title = $row['name'];
  $esc_title = htmlentities($title, ENT_QUOTES, 'UTF-8');
  $description = $row['description'];
  $esc_description = htmlentities($description, ENT_QUOTES, 'UTF-8');
  $id = $row['tourId'];
  $category = $row['packageTitle'];
  
  $item = $channel->addChild('item');
  $item->addChild('title', $esc_title);
  $item->addChild('link','http://www.explorecalifornia.org/tour.php?id=' . $id);
  $item->addChild('description', $esc_description);
  $item->addChild('category', $category);
  
}

//format for pretty printing
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($rss->asXML());
 
//Send to buffer
header('Content-type: text/xml');
echo $dom->saveXML();
