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
					<h3 class="panel-title"><?php echo AIDALang::get('homepage'); ?></h3>
				</div>
				<div class="panel-body">
					<div class="jumbotron">
						<h1>Advance Internet Development A</h1>
					</div>
				</div>

			</div>
		</div><!-- end of col-md-9 -->
	</div><!-- end of row -->
</div><!-- end of container fluid -->

<?php require_once 'templates/_footer.php'; ?>
<?php require_once 'templates/_buttomJsLink.php';?>
</body>
</html>
