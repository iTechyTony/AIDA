<?php require_once 'templates/_header.php'; ?>
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
 <?php require_once 'templates/_leftnav.php'; ?>  
    <div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Classes and Objects</h3>
				</div>
				<div class="panel-body">
					<h1>Use Existing PHP Classes</h1>
<?php

$tableCreate = "CREATE TABLE country_animals (    id int(11) NOT NULL auto_increment,

  country varchar(255) NOT NULL, 

  animals varchar(255) NOT NULL, 

  PRIMARY KEY (id)

  )";

// Drop the table

$query = "DROP TABLE IF EXISTS country_animals CASCADE ";

$db->query ( $query );

// Call the query method

if ($db->query ( $tableCreate ) === TRUE) {
	
	// insert into table
}

$query = "INSERT INTO `country_animals` VALUES (1, 'Australia','kangaroo') ";

$db->query ( $query );

$query = "INSERT INTO `country_animals` VALUES (2, 'China','dragon') ";

$db->query ( $query );

$query = "INSERT INTO `country_animals` VALUES (3, 'England','lion')";

$db->query ( $query );

$query = "INSERT INTO `country_animals` VALUES (4, 'India','tiger')";

$db->query ( $query );

$query = "INSERT INTO `country_animals` VALUES (5, 'America','eagle')";

$db->query ( $query );

$query = "INSERT INTO `country_animals` VALUES (6, 'Cambodia','snake')";

$db->query ( $query );

$query = "INSERT INTO `country_animals` VALUES (7, 'Argentinia','bull')";

$db->query ( $query );

// display data from db
print "<h2>OO PDO and Basic Selection</h2>";
function displayData($result) {
	print '<table class="table table-striped" >';
	
	while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
		
		print "  <tr>";
		
		print "    <td>" . $row ["id"] . "</td>";
		
		print "    <td>" . $row ["country"] . "</td>";
		
		print "    <td>" . $row ["animals"] . "</td>";
		
		print "  </tr>";
	}
	
	print "</table>";
}

// Select Data

$result = $db->query ( "SELECT * FROM country_animals" );

displayData ( $result );

?>
  

  <h2>OO Prepared Statements</h2>
<?php
function readData($db) {
	$sql = 'SELECT * FROM country_animals';
	try {
		$stmt = $db->prepare ( $sql );
		$stmt->execute ();
		
		/* Bind by column number */
		$stmt->bindColumn ( 1, $id );
		$stmt->bindColumn ( 2, $country );
		$stmt->bindColumn ( 3, $animal );
		
		/* Bind by column name */
		// $stmt->bindColumn('calories', $cals);
		print '<table class="table table-striped" >';
		while ( $row = $stmt->fetch ( PDO::FETCH_BOUND ) ) {
			print "  <tr>";
			
			print "    <td>" . $id . "</td>";
			
			print "    <td>" . $country . "</td>";
			
			print "    <td>" . $animal . "</td>";
			
			print "  </tr>";
		}
		print "</table>";
	} catch ( PDOException $e ) {
		print $e->getMessage ();
	}
}
readData ( $db );

?>              
 
<h1>Create Classses/Objects</h1>

					<h2>Item Class Test</h2>

<?php
echo '<pre>';
// instantiating a new Item Object

$artist = new Item ( 1, "Bob Marley", "12.99", "Legendary Music" );

$artist->setGenre ( "Raggae" );

$artist->setImage ( 'bob.jpg' );

$new_artist = new Item ( 2, "Tracy Chapman", "5.99", "Lovely Country Music" );

$new_artist->setPrice ( 10.99 );

print "New item created using constructor for : id = " . $artist->getId () . " price = " . $artist->getPrice ();

print "<br>Set/Get Genre = " . $artist->getGenre ();

print "<br>Set/Get Image = " . $artist->getImage ();

print "<br>" . $artist->__toString ();

print "<br>Set/Get new Price(10.99) =" . $new_artist->getPrice ();

echo '</pre>';
?>

<h2>LineItem Class Test</h2>

<?php
echo '<pre>';
$LineItem = new LineItem ( $artist, 3 );

echo $LineItem->__toString ();
echo '</pre>';
?>

<h2>Collection Class Test</h2>
					<h3>Create 3 line items of Items and add them to the collection</h3>

<?php
$collections = new ObjectCollection ();

$i1 = new Item ( '1', 'Bob Marley', 12.99, 'Robert Nesta "Bob" Marley OM was a Jamaican reggae singer-songwriter, musician, and guitarist who achieved international fame and acclaim' );
$i2 = new Item ( '2', 'The Scripts', 12.99, 'The Script are an Irish pop rock band formed in 2001.');
$i3 = new Item ( '3', 'Taylor Swift', 15.99, 'Taylor Alison Swift is an American singer-songwriter' );
$collections->addItem ( $i1 );
$collections->addItem ( $i2 );
$collections->addItem ( $i3 );

function printDetails($details){
	if (! $details->isEmpty ()) {
	
		foreach ( $details as $detail ) {
	
			$item = $detail ['item'];
	
			printf ( '<pre><p><strong>Description</strong>: %s <br><strong>Name</strong>: %s <br><strong>Quantity</strong>: %d <br><strong>Price</strong>:@ £%0.2f <p></pre>', $item->getDescription (), $item->getName (), $detail ['qty'], $item->getPrice () );
		}
	}	
}


echo "<p>There are " . $collections->count () . " items in the collection</p>";

printDetails($collections);


echo "<h2>Collection after removing 2nd line item</h2>";
$collections->deleteItem ( $i2 );
echo "<p>There are " . $collections->count () . " items in the collection</p>";
printDetails($collections);

echo "<h2>Collection after amending the quantity for 1st line item by adding 5</h2>";
$collections->updateItem ( $i1, 5 );
echo "<p>There are " . $collections->count () . " items in the collection</p>";
printDetails($collections);



?>       

     </div>
			</div>
		</div>
		<!-- end of col-md-9 -->
	</div>
	<!-- end of row -->
</div>
<!-- end of container fluid -->

<?php require_once 'templates/_footer.php'; ?>

</body>
</html>