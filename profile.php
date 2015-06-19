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
$userDetails = $user->getDetails ();
?>
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
	    <?php if ( ! $user->isAdmin() ): ?>
                        <div class="alert alert-warning"
				style="margin-top: 30px;">
				<strong><?php echo AIDALang::get('note'); ?>! </strong>
                            <?php echo AIDALang::get('to_change_email_username'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form class="form-horizontal no-submit"
				id="form-changepassword">
				<fieldset>

					<!-- Form Name -->
					<legend><?php echo AIDALang::get('change_password'); ?></legend>

					<!-- Password input-->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="old_password">
                            <?php echo AIDALang::get('old_password'); ?>
                          </label>
						<div class="controls col-lg-8">
							<input id="old_password" name="old_password" type="password"
								placeholder="" class="input-xlarge form-control">

						</div>
					</div>

					<!-- Password input-->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="new_password">
                            <?php echo AIDALang::get('new_password'); ?>
                          </label>
						<div class="controls col-lg-8">
							<input id="new_password" name="new_password" type="password"
								placeholder="" class="input-xlarge form-control">

						</div>
					</div>

					<!-- Password input-->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="new_password_confirm">
                            <?php echo AIDALang::get('confirm_new_password'); ?>
                          </label>
						<div class="controls col-lg-8">
							<input id="new_password_confirm" name="new_password_confirm"
								type="password" placeholder="" class="input-xlarge form-control">

						</div>
					</div>

					<!-- Button -->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="change_password"></label>
						<div class="controls col-lg-8">
							<button id="change_password" name="change_password"
								class="btn btn-primary">
                              <?php echo AIDALang::get('update'); ?>
                            </button>
						</div>
					</div>

				</fieldset>
			</form>


			<form class="form-horizontal no-submit" id="form-details">
				<fieldset>

					<!-- Form Name -->
					<legend><?php echo AIDALang::get('your_details'); ?></legend>

					<!-- Text input-->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="first_name">
                            <?php echo AIDALang::get('first_name'); ?>
                          </label>
						<div class="controls col-lg-8">
							<input id="first_name" name="first_name" type="text"
								value="<?php echo htmlentities($userDetails['first_name']); ?>"
								class="input-xlarge form-control">

						</div>
					</div>

					<!-- Text input-->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="last_name">
                            <?php echo AIDALang::get('last_name'); ?>
                          </label>
						<div class="controls col-lg-8">
							<input id="last_name" name="last_name" type="text"
								value="<?php echo htmlentities($userDetails['last_name']); ?>"
								class="input-xlarge form-control">

						</div>
					</div>

					<!-- Text input-->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="address">
                            <?php echo AIDALang::get('address'); ?>
                          </label>
						<div class="controls col-lg-8">
							<input id="address" name="address" type="text"
								value="<?php echo htmlentities($userDetails['address']); ?>"
								class="input-xlarge form-control">

						</div>
					</div>

					<!-- Text input-->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="phone">
                            <?php echo AIDALang::get('phone'); ?>
                          </label>
						<div class="controls col-lg-8">
							<input id="phone" name="phone" type="text"
								value="<?php echo htmlentities($userDetails['phone']); ?>"
								class="input-xlarge form-control">

						</div>
					</div>

					<!-- Button -->
					<div class="control-group form-group">
						<label class="control-label col-lg-4" for="update_details"></label>
						<div class="controls col-lg-8">
							<button id="update_details" name="update_details"
								class="btn btn-primary">
                              <?php echo AIDALang::get('update'); ?>
                            </button>
						</div>
					</div>

				</fieldset>
			</form>



		</div>
		<!-- end of col-md-9 -->
	</div>
	<!-- end of row -->
</div>
<!-- end of container fluid -->
<?php require_once 'templates/_footer.php'; ?>

<script src="assets/js/sha512.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/js/asengine.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/js/index.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/js/profile.js" type="text/javascript" charset="utf-8"></script>

</body>
</html>
