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
					<h3 class="panel-title">Test Initialisation and Configuration</h3>
				</div>
				<div class="panel-body">
				 <?php
					print "Base URL =" . $config ['base_url'];
					print "<br />";
					print "Database Details";
					print "<pre>";
					print_r ( $fake_db );
					print "</pre>";
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