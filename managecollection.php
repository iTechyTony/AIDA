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
    <h3 class="panel-title">Manage Playlist</h3>
  </div>
  <div class="panel-body">
  
<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs" role="tablist">
      <li role="presentation" ><a href="#add_playlist" id="home-tab" role="tab" data-toggle="tab" aria-controls="add_playlist" aria-expanded="false">Add Playlist</a></li>
      <li role="presentation" class="active" ><a href="#edit_playlist" role="tab" id="edit_playlist-tab" data-toggle="tab" aria-controls="edit_playlist" aria-expanded="true">Update Playlist</a></l>
      <li role="presentation" ><a href="#remove_playlist" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Remove Playlist</a></l>
      

    </ul>
    <div id="myTabContent" class="tab-content">
      <div role="tabpanel" class="tab-pane fade " id="add_playlist" aria-labelledby="add_playlist-tab">





<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Add New Playlist</h3>
  </div>
  <div class="panel-body">
        	<form class="form-horizontal" method="post" action="managecollection.php" enctype="multipart/form-data">
<fieldset>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Name">Name</label>  
  <div class="col-md-4">
  <input id="Name" name="Name" type="text" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">Artist</label>  
  <div class="col-md-4">
  <input id="" name="Artist" type="text"  class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Album">Album</label>  
  <div class="col-md-4">
  <input id="Album" name="Album" type="text"  class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Genre">Genre</label>  
  <div class="col-md-4">
  <input id="Genre" name="Genre" type="text"  class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Rating">Rating</label>  
  <div class="col-md-4">
  <input type="number" name="Rating" class="form-control input-md" min="1" max="10" value="1" >
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Price">Price</label>  
  <div class="col-md-4">
  <input id="Price" name="Price" type="text"  class="form-control input-md">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Description">Description</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="Description" name="Description"></textarea>
  </div>
</div>

 

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="filebutton">Upload Image</label>
  <div class="col-md-4">
   <input type="file" name="files[]" class="input-file"  />
  </div>
</div>


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

if(isset($_FILES['files'])){
$name =$_POST['Name'];
$artist =$_POST['Artist'];
$album =$_POST['Album'];
$genre =$_POST['Genre'];
$rating =$_POST['Rating'];
$price =$_POST['Price'];
$description =$_POST['Description'];

    $errors= array();
  foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
    $file_name = $key.$_FILES['files']['name'][$key];
    $file_size =$_FILES['files']['size'][$key];
    $file_tmp =$_FILES['files']['tmp_name'][$key];
    $file_type=$_FILES['files']['type'][$key];  


      if($file_size > 5097152){
      $errors[]='File size must be less than 5 MB';
        } 

     $query_str = "INSERT INTO `playlist` VALUES ('','$name','$artist','$album','$genre','$rating','','$file_name','$price','$description') ";
 
    
        $desired_dir="assets/img/db";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);    // Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){


                move_uploaded_file($file_tmp,"assets/img/db/".$file_name);
            }else{                  //rename the file if another one exist
                $new_dir="assets/img/db/".$file_name.time();
                 rename($file_tmp,$new_dir) ;       
            }
         //execute the query
         $db -> query($query_str);
        }else{
                print_r($errors);
        }
    }
  if(empty($error)){
    echo '<div class="alert alert-success" role="alert">Well done You\'ve successfully added to the playlist</div>';
  }
}
?>


  </div>
</div>


      </div>
      <div role="tabpanel" class="tab-pane fade active in" id="edit_playlist" aria-labelledby="edit_playlist-tab">

      	<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Update Playlist</h3>
  </div>
  <div class="panel-body">
<form class="form-horizontal" method="post" action="updateItem.php" >
   <table class="table table-striped">
              <thead>
                <tr>

                  <th>ARTIST</th>
                  <th>NAME</th>
                  <th>PRICE</th>
                  <th>EDIT</th>
                </tr>
              </thead>

      <?php 

$result = $db->query("SELECT * FROM playlist order by artist ");
//The function to display the playlist
function EditPlaylist($result) {


  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    echo '<tr ><td>'.$row['artist'].'</td><td>'.$row['name'].'</td><td>£'.$row['price'].'</td><td><a href="updateItem.php?id='.$row['id'].'">Update</a></td></tr>';

  }

}//end of display function

EditPlaylist($result);
?>
</table>
</form>

  </div>
</div>
      	
      </div>
      <div role="tabpanel" class="tab-pane fade " id="remove_playlist" aria-labelledby="dropdown1-tab">
        <div class="table-responsive">
    <table class="table table-striped">
              <thead>
                <tr>

                  <th>ARTIST</th>
                  <th>NAME</th>
                  <th>PRICE</th>
                  <th>DELETE</th>
                </tr>
              </thead>

      <?php 

$result = $db->query("SELECT * FROM playlist order by artist");
//The function to display the playlist
function displayPlaylist($result) {


  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    echo '<tr id="row'.$row['id'].'"><td>'.$row['artist'].'</td><td>'.$row['name'].'</td><td>£'.$row['price'].'</td><td><button class="btn btn-danger" type="submit" value="'.$row['id'].'">Delete</button></td></tr>';

  }

}//end of display function

displayPlaylist($result);
?>
</table>

<div id="msg"></div>
</div>
     </div>
    
    </div>
  </div>


  </div>
</div>

</div>


<?php require_once 'templates/_footer.php'; ?>
<script type="text/javascript">
  $(document).ready(function() {
   $('button').click(function() {
        var rno = $(this).val();
      $.ajax({
        type: "POST",
        url: "deletePlaylist.php",
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