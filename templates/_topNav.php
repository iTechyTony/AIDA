<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><?php echo WEBSITE_NAME;?></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<form class="navbar-form navbar-left" role="search" action="formDBTest.php" method="get">
					<div class="form-group">
						<input type="text" name="searchq" class="form-control" placeholder="Search for an item">
					</div>
				</form>
				<ul class="nav navbar-nav">
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
<?php
if (!$login->isLoggedIn()) {
	require_once 'templates/_not_signed_in.php';
} elseif ($login->isLoggedIn()) {
		$user = new AIDAUser ( AIDASession::get ( "user_id" ) );
		$userInfo = $user->getInfo ();
		require_once 'templates/_signed_in.php';
}

?>
      </ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>