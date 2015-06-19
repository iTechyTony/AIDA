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
					<h3 class="panel-title">These details have been drawn from the database using the id passed from the previous list</h3>
				</div>
				<div class="panel-body">
<div class="row">
  <div class="col-xs-12 col-md-4"> 

  <?php 
  function readData($db) {
  	$getid = $_GET['id'];
  	$sql = 'SELECT * FROM playlist WHERE id='.$getid;
  
  		$stmt = $db->prepare ( $sql );
  		$stmt->execute ();

		/* Bind by column number */
  		$stmt->bindColumn ( 1, $id );
  		$stmt->bindColumn ( 2, $name );
  		$stmt->bindColumn ( 3, $artist );
  		$stmt->bindColumn ( 4, $album);
  		$stmt->bindColumn ( 5, $genre );
  		$stmt->bindColumn ( 6, $rating );
  		$stmt->bindColumn ( 7, $song );
  		$stmt->bindColumn ( 8, $image );
  		$stmt->bindColumn ( 9, $price);
  		$stmt->bindColumn ( 10, $description);
  		

  	 	$row = $stmt->fetch ( PDO::FETCH_BOUND ) ;
  			print '<img class="thumbnail img-responsive" src="assets/img/db/'.$image.'" alt="'.$artist.' '. $name.' ">';		
  	
 	?>
  
  </div>
  <div class="col-xs-12 col-md-8">
  <?php

			print '<form id="item_form" action="_addToCollection.php" method="post">';
			print '<div class="table-responsive"><table class="table table-striped" >';
			print "<tr><td>ID</td><td>" . $id . "</td></tr>";
			print "<tr><td>Name</td><td>" . $name . "</td></tr>";
			print "<tr><td>Artist</td><td>" . $artist . "</td></tr>";
			print "<tr><td>Album</td><td>" . $album . "</td></tr>";
			print "<tr> <td>Genre</td><td>" . $genre . "</td></tr>";
			print "<tr><td>Rating</td><td>" . $rating . "</td></tr>";
			print "<tr> <td>Price</td><td>£" . number_format($price,2)  . "</td></tr>";
			print "<tr><td>Listen Music Here<td>";
			print '<audio controls>';
			print '<source src="assets/songs/'.$song.'" type="audio/mpeg">';
			print'</audio>';
			print "</td></tr>";
			print '<tr><td>Quantity</td><td><input type="number" name="quantity" min="1" max="5" value="1"></td></tr>';
			
			
			
			print '<tr><td></td><td><input type="hidden" name="id" value="'. $id .'"><input class="btn btn-primary" type="submit" value="Add to Collection"></td></tr>';
		
		print "</table></form></div></div>";
		
		

?>

<div class="col-xs-12 ">

<?php 

print '<div class="table-responsive"><table class="table table-striped" >';
print "<tr> <td><strong>Description</strong></td><td>" . $description . "</td></tr>";
print "</table></div>";

  }
?>



<?php 
readData ( $db );



?>   


  </div>
</div>
					
					
					
				</div>
</div>
			</div>
		</div><!-- end of col-md-9 -->
	</div><!-- end of row -->
</div><!-- end of container fluid -->

<?php require_once 'templates/_footer.php'; ?>

</body>
</html>