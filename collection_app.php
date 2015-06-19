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
<?php include 'templates/_leftnav.php';?><div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Collection Application</h3>
				</div>


				<div class="panel-body">


<?php

$result = $db->query("SELECT * FROM playlist order by artist");
//The function to display the playlist
function displayPlaylist($result) {

	print'<div class="row">';
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		print' <div class="col-md-4">';
		print'<div class="thumbnail">';
		print'<a href="displayItem.php?id='.$row["id"].'">';
		print'<img src="assets/img/db/'.$row["image"].'" alt="shoes.jpg">';
		print'</a>';
		print'<div class="caption">';
		print'<h4 class="text-center">'.$row["artist"]." - ".$row["name"].' </h4>';
		print'</a>';
		print'<p class="text-center"><a href="displayItem.php?id='.$row["id"].'" class="btn btn-primary" role="button">View Details</a></p>';
		print"  </div>";
		print"  </div>";
		print"  </div>";

	}
	print"</div>";
}//end of display function

displayPlaylist($result);

$in_memory_data = $_SESSION["ObjColl"];
?>


<?php

if (!$in_memory_data->isEmpty()) {

	?>
	<div class="table-responsive">
		<table class="table table-striped">
				      <thead>
				        <tr>

				          <th>ARTIST</th>
				          <th>NAME</th>
				          <th>QUANTITY</th>
				          <th>PRICE</th>
				          <th>DESCRIPTION</th>
				          <th>DELETE</th>
				        </tr>
				      </thead>

	<?php

	foreach ($in_memory_data as $c) {

		$item = $c['item'];

		printf('<tr id="row%s"><td>%s</td><td>%s</td><td>%d</td><td>£%0.2f</td><td>%s</td><td><button class="btn btn-danger" type="submit" value="%s">Delete</button></td></tr>', $item->getID(), $item->getArtist(), $item->getName(), $c['qty'], $item->getPrice(), $item->getDescription(), $item->getID());
	}
}

?>
</table>
</div>
<div id="msg"></div>
</div>
			</div>
		</div>
		<!-- end of col-md-9 -->
	</div>
	<!-- end of row -->
</div>
<!-- end of container fluid -->


<?php require_once 'templates/_footer.php';?>
<script type="text/javascript">
	$(document).ready(function() {
	 $('button').click(function() {
		    var rno = $(this).val();
 			$.ajax({
 				type: "POST",
 				url: "deleteFromCollection.php",
 				data: {id:rno},
 		        success: function(response) {
                       $('#row' + rno).fadeOut('slow');
            	}
 				}).done(function( result ) {
 				$("#msg").html( "<div class='alert alert-info' role='alert'><h3 class='text-center'>Item at line number " +rno +" deleted </h3></div>");
 			});
	});
});
</script>

</body>
</html>