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

$arRows = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  array_push($arRows, $row);
}

header('Content-type: application/json');
echo json_encode($arRows);