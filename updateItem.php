<?php
require_once 'templates/_header.php'; 
if ($login->isLoggedIn()) {
  $user     = new AIDAUser(AIDASession::get("user_id"));
  $userInfo = $user->getInfo();

  if (!$user->isAdmin()) {
    header("Location: index.php");
  }

} else {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Collections | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>
<div class="container-fluid">
	<div class="row">
<?php require_once 'templates/_leftnav.php';?><div class="col-md-9">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Update Playlist</h3>
  </div>
  <div class="panel-body">
  <?php 


  $id =$_GET['id'];


$sql="SELECT * FROM playlist WHERE id= '$id'";

$result = $db->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

  ?>
          <form class="form-horizontal" method="post" action="updateItem.php" enctype="multipart/form-data">
<fieldset>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Name">Name</label>  
  <div class="col-md-4">
  <input id="Name" name="Name" type="text" class="form-control input-md" required="" value="<?php echo $row['name']; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">Artist</label>  
  <div class="col-md-4">
  <input id="" name="Artist" type="text"  class="form-control input-md" required="" value="<?php echo $row['artist']; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Album">Album</label>  
  <div class="col-md-4">
  <input id="Album" name="Album" type="text"  class="form-control input-md" required="" value="<?php echo $row['album']; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Genre">Genre</label>  
  <div class="col-md-4">
  <input id="Genre" name="Genre" type="text"  class="form-control input-md" required="" value="<?php echo $row['genre']; ?>">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Rating">Rating</label>  
  <div class="col-md-4">
  <input type="number" name="Rating" class="form-control input-md" min="1" max="10" value="<?php echo $row['rating']; ?>" >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Price">Price</label>  
  <div class="col-md-4">
  <input id="Price" name="Price" type="text"  class="form-control input-md" value="<?php echo $row['price']; ?>">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Description">Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="Description" name="Description" rows="5" ><?php echo $row['description']; ?></textarea>
  </div>
</div>

 

  <input type="hidden"  name="id" value="<?php echo $row['id']; ?>" />
   <input type="hidden"  name="Image" value="<?php echo $row['image']; ?>" />



<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="add"></label>
  <div class="col-md-4">

  
 <input class="btn btn-primary" type="submit" value="Submit">
  
  </div>
</div>

</fieldset>

</form>

<?php

if(isset($_POST['Name'])){
$id=$_POST['id'];
$name =$_POST['Name'];
$artist =$_POST['Artist'];
$album =$_POST['Album'];
$genre =$_POST['Genre'];
$rating =$_POST['Rating'];
$price =$_POST['Price'];
$image =$_POST['Image'];
$description =$_POST['Description'];

$sql = "UPDATE playlist SET name='$name', artist='$artist', album='$album', genre= '$genre', rating='$rating' ,image='$image',price='$price',description='$description'
WHERE id='$id'";

$result = $db->exec($sql);

 header("Location: managecollection.php");

}

?>


  </div>
</div>
</div></div>
</div>

<?php require_once 'templates/_footer.php'; ?>

  </body>
</html>