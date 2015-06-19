<?php require_once 'templates/_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Internet Development | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
<script type="text/javascript">
$(document).ready(function (){
    $("#btn382").click(function(){       
        /* set no cache */
        $.ajaxSetup({ cache: false });
 
        $.getJSON("REST/json/demoAll.json", function(data){
            var html = [];
 			
            html.push("<table class='table table-striped'><thead><tr><th>ID</th><th>Title</th><th>Description</th></tr></thead><tbody>");

            /* loop through array */
            $.each(data, function(index, d){           
                html.push("<tr><th scope='row'> ", d.packageId, "</th> ",
                          "<td>", d.packageTitle, "</td> ",
                          "<td>", d.packageDescription, "</td></tr>");
            });
 			
 			 html.push('</tbody></table>');
 
            $("#div381").html(html.join(''));
        }).error(function(jqXHR, textStatus, errorThrown){ /* assign handler */
            /* alert(jqXHR.responseText) */
            alert("error occurred!");
        });
    });
});
</script>

</head>

<body>
<?php require_once 'templates/_topNav.php';?>

<div class="container-fluid">
		<div class="row">
 <?php require_once 'templates/_leftnav.php'; ?>  
    <div class="col-md-9">

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Data Transfer and Web Services</h3>
					</div>
					<div class="panel-body">

						<h2>XML - Display All Tour Packages</h2>
						<p>
							Package Tour data presented and transfered via XML = <a
								href="REST/xml/demoAll.xml">XML displayXML.php</a> scripts.
						</p>

<?php
// build query
$query = "SELECT 
  packageId, 
  packageTitle, 
  packageDescription, 
  packageGraphic 
  FROM packages ORDER BY packageId ASC";

$result = $db->query ( $query );
// build root XML element
$packages = new SimpleXMLElement ( "<packages></packages>" );

// loop data and build data structure
while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
	$packageId = $row ['packageId'];
	$packageTitle = htmlentities ( $row ['packageTitle'], ENT_QUOTES, 'UTF-8' );
	$packageDescription = htmlentities ( $row ['packageDescription'], ENT_QUOTES, 'UTF-8' );
	$packageGraphic = htmlentities ( $row ['packageGraphic'], ENT_QUOTES, 'UTF-8' );
	// Create node and children
	$package = $packages->addChild ( 'package' );
	$package->addChild ( 'packageId', $packageId );
	$package->addChild ( 'title', $packageTitle );
	$package->addChild ( 'description', $packageDescription );
	$package->addChild ( 'graphic', $packageGraphic );
}

// format for pretty printing
$dom = new DOMDocument ( '1.0', 'UTF-8' );
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML ( $packages->asXML () );

// Send to browser
// header('Content-type: text/xml');
$dom->saveXML ();
$dom->save ( "REST/xml/demoAll.xml" );
?>

<div class="panel-group" id="accordion" role="tablist"
							aria-multiselectable="true">
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion"
											href="#collapseOne" aria-expanded="true"
											aria-controls="collapseOne"> View Source Code </a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse "
									role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<pre>
$query = 
  "SELECT 
  packageId, 
  packageTitle, 
  packageDescription, 
  packageGraphic 
  FROM packages ORDER BY packageId ASC";

$result = $db->query($query);
// build root XML element
$packages = new SimpleXMLElement("&lt;packages&gt;&lt;/packages&gt;");

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
//header('Content-type: text/xml');
$dom->saveXML();
$dom->save("REST/xml/demoAll.xml");
</pre>

									</div>
								</div>
							</div>


							<h2>JSON - Display All Tour Packages</h2>
							<p>
								Package Tour data presented and transfered via JSON = <a
									href="REST/json/displayJSON.php">JSON displayJSON.php</a> scripts.
							</p>
						<h3>JSON Presentation</h3>
					<a name="#ajax-getjson-example"></a>
<div id="example-section38">   
    <p>Tour display using client cient processing</p>
    <div id="div381"></div>
    <button id="btn382" type="button" class="btn btn-danger">Click to load  (json type)</button>   
</div>

<?php
// build query
$query = "SELECT 
  packageId, 
  packageTitle, 
  packageDescription, 
  packageGraphic 
  FROM packages ORDER BY packageId ASC";

$result = $db->query ( $query );

$arRows = array ();
while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
	array_push ( $arRows, $row );
}

json_encode ( $arRows );

$fh = fopen ( "REST/json/demoAll.json", 'w' ) or die ( "Error opening output file" );
fwrite ( $fh, json_encode ( $arRows ) );
fclose ( $fh );

?>

 <div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse"
											data-parent="#accordion" href="#collapseTwo"
											aria-expanded="false" aria-controls="collapseTwo"> View
											Source Code </a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse"
									role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">
										<pre>
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

json_encode($arRows);

$fh = fopen("REST/json/demoAll.json", 'w')
or die("Error opening output file");
fwrite($fh, json_encode($arRows));
fclose($fh);
</pre>
									</div>
								</div>
							</div>



							<h2>Web Service REST/XML-Tours for an Individual Package (pass
								package id)</h2>
							<p>
								Individual Tour data for a particular package is presented and
								transfered via XML. The <strong>packageid (from 1 - 9)</strong>
								needs to be appended to the URL = <a href="REST/xml/xml.php?packageid=9">xml.php</a>
								file.
							</p>

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingThree">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse"
											data-parent="#accordion" href="#collapseThree"
											aria-expanded="false" aria-controls="collapseThree"> View
											Source Code </a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse"
									role="tabpanel" aria-labelledby="headingThree">
									<div class="panel-body">
										<pre>
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
$tours = new SimpleXMLElement("&lt;tours&gt;&lt;/tours&gt;");

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
</pre>

									</div>
								</div>
							</div>

							<h2>Web Service REST/JSON-Tours for an Individual Package (pass
								package id)</h2>
							<p>
								Individual Tour data for a particular package is presented and
								transfered via JSON. The <strong>packageid (from 1 - 9)</strong>
								needs to be appended to the URL = <a
									href="REST/json/json.php?packageid=9">json.php</a> file.
							</p>

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingFour">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse"
											data-parent="#accordion" href="#collapseFour"
											aria-expanded="false" aria-controls="collapseFour"> View
											Source Code </a>
									</h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse"
									role="tabpanel" aria-labelledby="headingFour">
									<div class="panel-body">
										<pre>
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
</pre>
									</div>
								</div>
							</div>

							<h2>XML/RSS - Display All Tour Packages</h2>
							<p>
								Package Tour data presented and transfered as an XML RSS feed =
								<a href="REST/rss/rssDemoAll.xml">rssDemoAll.xml</a> file.
							</p>
<?php

$query = "SELECT 
  packageId, 
  packageTitle, 
  packageDescription, 
  packageGraphic 
  FROM packages ORDER BY packageId ASC";
$result = $db->query ( $query );

// $row_rsPackages = mysql_fetch_assoc($rsPackages);
// $totalRows = mysql_num_rows($rsPackages);

// build parent element
$rss = new SimpleXMLElement ( "<rss version='2.0'></rss>" );
$channel = $rss->addChild ( 'channel' );
$channel->addChild ( 'title', 'Explore California Tour Packages' );
$channel->addChild ( 'description', 'Explore Our World Your Way' );
$channel->addChild ( 'link', 'http://www.explorecalifornia.org' );

while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
	
	$title = $row ['packageTitle'];
	$esc_title = htmlentities ( $title, ENT_QUOTES, 'UTF-8' );
	$description = $row ['packageDescription'];
	$esc_description = htmlentities ( $description, ENT_QUOTES, 'UTF-8' );
	$id = $row ['packageId'];
	
	$item = $channel->addChild ( 'item' );
	$item->addChild ( 'title', $esc_title );
	$item->addChild ( 'link', 'http://www.explorecalifornia.org/package.php?id=' . $id );
	$item->addChild ( 'description', $esc_description );
}

// format for pretty printing
$dom = new DOMDocument ( '1.0', 'UTF-8' );
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML ( $rss->asXML () );

// Send header to buffer

$dom->saveXML ();
$dom->save ( "REST/rss/rssDemoAll.xml" );
?>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingFive">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse"
											data-parent="#accordion" href="#collapseFive"
											aria-expanded="false" aria-controls="collapseFive"> View
											Source Code </a>
									</h4>
								</div>
								<div id="collapseFive" class="panel-collapse collapse"
									role="tabpanel" aria-labelledby="headingFive">
									<div class="panel-body">
										<pre>
$query = "SELECT 
  packageId, 
  packageTitle, 
  packageDescription, 
  packageGraphic 
  FROM packages ORDER BY packageId ASC";
$result = $db->query ( $query );

// $row_rsPackages = mysql_fetch_assoc($rsPackages);
// $totalRows = mysql_num_rows($rsPackages);

// build parent element
$rss = new SimpleXMLElement ( "&lt;rss version='2.0'&gt;&lt;/rss&gt;" );
$channel = $rss->addChild ( 'channel' );
$channel->addChild ( 'title', 'Explore California Tour Packages' );
$channel->addChild ( 'description', 'Explore Our World Your Way' );
$channel->addChild ( 'link', 'http://www.explorecalifornia.org' );

while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
	
	$title = $row ['packageTitle'];
	$esc_title = htmlentities ( $title, ENT_QUOTES, 'UTF-8' );
	$description = $row ['packageDescription'];
	$esc_description = htmlentities ( $description, ENT_QUOTES, 'UTF-8' );
	$id = $row ['packageId'];
	
	$item = $channel->addChild ( 'item' );
	$item->addChild ( 'title', $esc_title );
	$item->addChild ( 'link', 'http://www.explorecalifornia.org/package.php?id=' . $id );
	$item->addChild ( 'description', $esc_description );
}

// format for pretty printing
$dom = new DOMDocument ( '1.0', 'UTF-8' );
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML ( $rss->asXML () );

// Send header to buffer

$dom->saveXML ();
$dom->save ( "REST/rss/rssDemoAll.xml" );
										</pre>
									</div>
								</div>
							</div>

							<h2>XML/RSS - Tour Packages as RSS - Tours for an Individual
								Package (pass package id)</h2>
							<p>
								Individual Tour data for a particular package is presented as an
								XML RSS feed. The <strong>packageid (from 1 - 9)</strong> needs
								to be appended to the URL = <a href="REST/rss/rss.php?packageid=9">rss.php</a>
								file.
							</p>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingSix">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse"
											data-parent="#accordion" href="#collapseSix"
											aria-expanded="false" aria-controls="collapseSix"> View
											Source Code </a>
									</h4>
								</div>
								<div id="collapseSix" class="panel-collapse collapse"
									role="tabpanel" aria-labelledby="headingSix">
									<div class="panel-body">
										<pre>
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
$rss = new SimpleXMLElement("&lt; version='2.0'&gt;&lt;/rss&gt;");
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
</pre>



									</div>
								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
			<!-- end of col-md-9 -->
		</div>
		<!-- end of row -->
	</div>
	<!-- end of container fluid -->
  

<?php require_once 'templates/_footer.php'; ?>