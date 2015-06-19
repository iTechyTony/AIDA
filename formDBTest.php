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
					<h3 class="panel-title">Form to Database Interaction Test</h3>
				</div>
				<div class="panel-body">

  <div class="row">
				
 
 <?php
 

		function readData($db) {
			

			$sql = 'SELECT * FROM items WHERE name LIKE ?';
			
			try {
				$stmt = $db->prepare ( $sql );
				
				if(isset($_GET['searchq'])){
				$searchq =$_GET['searchq'];
				$stmt->bindValue(1, "%$searchq%", PDO::PARAM_STR);
				}else{
					$searchq="";
					$stmt->bindValue(1, "%$searchq%", PDO::PARAM_STR);
				}
				$stmt->execute ();
				
				/* Bind by column number */
				$stmt->bindColumn ( 1, $id );
				$stmt->bindColumn ( 2, $name );
				$stmt->bindColumn ( 7, $img );
				$stmt->bindColumn ( 3, $price );
				
				if ($stmt->rowCount()==1){
					echo '<div class="col-md-12"><div class="alert alert-success" role="alert">';
					echo '<h2 class="text-center">Searching for "'.$searchq .'"</h2> <br><h3 class="text-center">'.$stmt->rowCount().' item found</h3>';
					echo '</div></div>';
				}
				
				if ($stmt->rowCount()>1 && !empty($searchq)){
					echo '<div class="col-md-12"><div class="alert alert-success" role="alert">';
					echo '<h2 class="text-center">Searching for "'.$searchq .'"</h2> <br><h3 class="text-center">'.$stmt->rowCount().' items found</h3>';
					echo '</div></div>';
				}
				
				while ( $row = $stmt->fetch ( PDO::FETCH_BOUND ) ) {
					echo '<div class="col-sm-6 col-md-4">';
					echo '<div class="thumbnail">';
					echo '<img src="assets/img/db/' . $img . '" alt="' . $img . '">';
					echo '<div class="caption">';
					echo '<h5>' . $name . '</h5>';
					echo '<h6>' . ' £' . number_format ( $price, 2 ) . '</h6>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
				
				if ($stmt->rowCount()==0){
					echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">';
					echo '<h1 class="text-center">Searching for "'.$searchq.'"</h1><br>';
					echo '<h2 class="text-center">No results found</h2><br>';
 					echo '<h3 class="text-center">Remember to check your spelling, and try using just a few key words.</h3>';
 					echo '</div></div>';
					}
				
					
			
			} catch ( PDOException $e ) {
				print $e->getMessage ();
			}
			
		}
		
		
		readData ( $db );
		
		?>
  
  
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

</body>
</html>