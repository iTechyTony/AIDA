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

$arRows = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	array_push($arRows, $row);
}

header('Content-type: application/json');
echo json_encode($arRows);