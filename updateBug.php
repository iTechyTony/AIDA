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
<div class="col-md-12">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title text-center">Update Playlist</h3>
  </div>
  <div class="panel-body">
  <?php 


$id =$_GET['id'];


$sql="SELECT * FROM Bug WHERE id= '$id'";


$external_database = new AIDADatabase('mysql','FinestWeb.db.9997411.hostedresource.com','FinestWeb','FinestWeb','Dat92083368!');
$result = $external_database->query($sql);
$row = $result->fetch(PDO::FETCH_ASSOC);

  ?>


 <form class="form-horizontal" action="updateBug.php" method="POST">
                            <fieldset>

                              <!-- Form Name -->
                              <legend>iTechyBugFix Admin Bug Management - Update a Bug Post</legend>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="control-label" for="Summary">Summary</label>
                                <div class="col-md-8">
                                  <input id="Summary" name="summary" type="text" placeholder="Summary" class="form-control input-md" value="<?php echo $row['summary']; ?>" required="">

                                </div>
                              </div>

                              <!-- Textarea -->
                              <div class="form-group">
                                <label class="control-label" for="Description">Description</label>
                                <div class="col-md-8">
                                  <textarea class="form-control" id="Description" name="description" rows="5"><?php echo $row['description']; ?></textarea>
                                </div>
                              </div>

                              <!-- Textarea -->
                              <div class="form-group">
                                <label class="control-label" for="comments">Comments</label>
                                <div class="col-md-8">
                                  <textarea class="form-control" id="comments" name="comments" rows="3"><?php echo $row['comments']; ?></textarea>
                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="control-label" for="reported_by">Reported By</label>
                                <div class="col-md-2">
                                  <input id="reported_by" name="reported_by" type="text" placeholder="Reported By" class="form-control input-md" required="" value="<?php echo $row['reported by']; ?>">

                                </div>
                              </div>

                              <input id="reported_at"  name="reported_at" value="<?php echo date('Y-m-d'); ?>" type="hidden" class="form-control input-md" >
								<input id="id"  name="id" value="<?php echo $row['id'] ;?>" type="hidden"  class="form-control input-md" >

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="control-label" for="assigned_to">Assigned To</label>
                                <div class="col-md-2">
                                  <input id="assigned_to" name="assigned_to" type="text" placeholder="Assigned To" class="form-control input-md" required="" value="<?php echo $row['assigned to']; ?>">

                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="control-label" for="priority">Priority</label>
                                <div class="col-md-1">
                                  <input id="priority" name="priority" type="text" placeholder="Priority" class="form-control input-md" value="<?php echo $row['priority']; ?>">

                                </div>
                              </div>

                              <!-- Text input-->
                              <div class="form-group">
                                <label class="control-label" for="status">Status</label>
                                <div class="col-md-1">
                                  <input id="status" name="status" type="text" placeholder="Status" class="form-control input-md" required="" value="<?php echo $row['status']; ?>">

                                </div>
                              </div>



                              <!-- Button -->
                              <div class="form-group">
                                <label class="control-label" for="submit"></label>
                                <div class="col-md-4">
                                  <input class="btn btn-primary" type="submit" value="Update Bug">
                                </div>
                              </div>

                            </fieldset>
                          </form>
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
	$id = $_POST['id'];

	$sql = "UPDATE Bug SET summary='$summary',description='$description',`reported by`='$reported_by',`reported at`='$reported_at',`assigned to`='$assigned_to' ,priority='$priority',status='$status',comments='$comments'
	WHERE id=$id";
	
	
	//$result = $external_database->exec($sql);
	$external_database->query($sql);
	header("Location: manageBug.php");

	 
}

?>


  </div>
</div>
</div></div>
</div>

<?php require_once 'templates/_footer.php'; ?>

  </body>
</html>