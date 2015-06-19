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
$external_database = new AIDADatabase('mysql','FinestWeb.db.9997411.hostedresource.com','FinestWeb','FinestWeb','Dat92083368!');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Bug | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>
<div class="container-fluid">
	<div class="row">
<div class="col-md-12">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Manage Bug</h3>
  </div>
  <div class="panel-body">

<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul id="myTab" class="nav nav-tabs" role="tablist">
      <li role="presentation" ><a href="#add_Bug" id="home-tab" role="tab" data-toggle="tab" aria-controls="add_Bug" aria-expanded="false">Add Bug</a></li>
      <li role="presentation" class="active" ><a href="#edit_Bug" role="tab" id="edit_Bug-tab" data-toggle="tab" aria-controls="edit_Bug" aria-expanded="true">Update Bug</a></l>
      <li role="presentation" ><a href="#remove_Bug" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Remove Bug</a></l>


    </ul>
    <div id="myTabContent" class="tab-content">
      <div role="tabpanel" class="tab-pane fade " id="add_Bug" aria-labelledby="add_Bug-tab">





<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Add New Bug</h3>
  </div>
  <div class="panel-body">
    <?php

    if(isset($_POST['summary'])){


      $summary =$_POST['summary'];
      $description =$_POST['description'];
      $comments =$_POST['comments'];
      $reported_by =$_POST['reported_by'];
      $reported_at =$_POST['reported_at'];
      $assigned_to =$_POST['assigned_to'];
      $priority =$_POST['priority'];
      $status = $_POST['status'];

      $sql = "INSERT INTO Bug VALUES ('','$summary','$description','$reported_by','$reported_at','$assigned_to','$priority','$status','$comments')";


      $result = $external_database->exec($sql);


    }

    ?>
    <form class="form-horizontal" action="manageBug.php" method="POST">
      <fieldset>

        <!-- Form Name -->
        <legend>iTechyBugFix Admin Bug Management - Add a new Bug Post</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="Summary">Summary</label>
          <div class="col-md-8">
            <input id="Summary" name="summary" type="text" placeholder="Summary" class="form-control input-md"  required="">

          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="control-label" for="Description">Description</label>
          <div class="col-md-8">
            <textarea class="form-control" id="Description" name="description" rows="5"></textarea>
          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="control-label" for="comments">Comments</label>
          <div class="col-md-8">
            <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="reported_by">Reported By</label>
          <div class="col-md-2">
            <input id="reported_by" name="reported_by" type="text" placeholder="Reported By" class="form-control input-md" required="" >

          </div>
        </div>

        <input id="reported_at"  name="reported_at" value="<?php echo date('Y-m-d'); ?>" type="hidden" class="form-control input-md" >


        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="assigned_to">Assigned To</label>
          <div class="col-md-2">
            <input id="assigned_to" name="assigned_to" type="text" placeholder="Assigned To" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="priority">Priority</label>
          <div class="col-md-1">
            <input id="priority" name="priority" type="text" placeholder="Priority" class="form-control input-md" >

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="status">Status</label>
          <div class="col-md-1">
            <input id="status" name="status" type="text" placeholder="Status" class="form-control input-md" required="" >

          </div>
        </div>



        <!-- Button -->
        <div class="form-group">
          <label class="control-label" for="submit"></label>
          <div class="col-md-4">
            <input class="btn btn-primary" type="submit" value="Add New Bug">
          </div>
        </div>

      </fieldset>
    </form>



  </div>
</div>


      </div>
      <div role="tabpanel" class="tab-pane fade active in" id="edit_Bug" aria-labelledby="edit_Bug-tab">

      	<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Update Bug</h3>
  </div>
  <div class="panel-body">
<form class="form-horizontal" method="post" action="updateItem.php" >
   <table class="table table-striped">
              <thead>
                <tr>

                  <th>ID</th>
                  <th>SUMMARY</th>
                  <th>DESCRIPTION</th>
                  <th>COMMENTS</th>
                  <th>REPORTED BY</th>
                  <th>ASSIGNED TO</th>
                  <th>REPORTED AT</th>
                  <th>PRIORITY</th>
                  <th>STATUS</th>
                </tr>
              </thead>

      <?php

$result = $external_database->query("SELECT * FROM Bug");

function EditBug($result) {


  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    echo '<tr ><td>'.$row['id'].'</td><td>'.$row['summary'].'</td><td>'.$row['description'].'</td><td>'.$row['comments'].'</td><td>'.$row['reported by'].'</td><td>'.$row['assigned to'].'</td><td>'.$row['reported at'].'</td><td>'.$row['priority'].'</td><td>'.$row['status'].'</td><td><a href="updateBug.php?id='.$row['id'].'">Update</a></td></tr>';

  }

}//end of display function

EditBug($result);
?>
</table>
</form>

  </div>
</div>

      </div>
      <div role="tabpanel" class="tab-pane fade " id="remove_Bug" aria-labelledby="dropdown1-tab">
        <div class="table-responsive">
    <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>SUMMARY</th>
                  <th>DESCRIPTION</th>
                  <th>COMMENTS</th>
                  <th>REPORTED BY</th>
                  <th>ASSIGNED TO</th>
                  <th>REPORTED AT</th>
                  <th>PRIORITY</th>
                  <th>STATUS</th>
                </tr>
              </thead>

      <?php

$result = $external_database->query("SELECT * FROM Bug");
//The function to display the Bug
function displayBug($result) {

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    echo '<tr id="row'.$row['id'].'"><td>'.$row['id'].'</td><td>'.$row['summary'].'</td><td>'.$row['description'].'</td><td>'.$row['comments'].'</td><td>'.$row['reported by'].'</td><td>'.$row['assigned to'].'</td><td>'.$row['reported at'].'</td><td>'.$row['priority'].'</td><td>'.$row['status'].'</td><td><button class="btn btn-danger" type="submit" value="'.$row['id'].'">Delete</button></td></tr>';

  }

}//end of display function

displayBug($result);
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
        url: "deleteBug.php",
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
