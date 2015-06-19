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
<title>Advanced Internet Development | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>
<div class="container-fluid">
	<div class="row">
 <?php require_once 'templates/_leftnav.php'; ?>  
    <div class="col-md-9">
			<div class="control-group roles-input">
				<div class="controls col-lg-3">
					<input type="text" class="form-control col-lg-3" id='role-name'
						placeholder="<?php echo AIDALang::get('role_name'); ?>">
				</div>
				<button type="submit" class="btn btn-success"
					onclick="roles.addRole();">
                      <?php echo AIDALang::get('add'); ?>
                    </button>
			</div>
				<?php $roles = $db->select("SELECT * FROM `as_user_roles` WHERE `role_id` NOT IN (1,2,3)"); ?>
              <table class="table table-striped roles-table">
				<thead>
				<tr>
					<th><?php echo AIDALang::get('role_name'); ?></th>
					<th><?php echo AIDALang::get('users_with_role'); ?></th>
					<th><?php echo AIDALang::get('action'); ?></th>
					</tr>
				</thead>
              <?php foreach ($roles as $role): ?>
                  <?php $result = $db->select("SELECT COUNT(*) AS num FROM `as_users` WHERE `user_role` = :r", array( "r" => $role['role_id'])); ?>
                  <?php $usersWithThisRole = $result[0]['num']; ?>
                  <tr class="role-row">
					<td><?php echo htmlentities($role['role']); ?></td>
					<td><?php echo htmlentities($usersWithThisRole); ?></td>
					<td>
						<button type="button" class="btn btn-danger btn-sm"
							onclick="roles.deleteRole(this,<?php echo $role['role_id']; ?>);">
							<i class="icon-trash glyphicon glyphicon-trash"></i>
                            <?php echo AIDALang::get('delete'); ?>
                  		</button>
					</td>

				</tr>
              <?php endforeach; ?>
              </table>
		</div>
		<!-- end of col-md-9 -->
	</div>
	<!-- end of row -->
</div>
<!-- end of container fluid -->
<?php require_once 'templates/_footer.php'; ?>
<script type="text/javascript" src="lib/js/asengine.js"></script>
<script type="text/javascript" src="lib/js/roles.js"></script>
<script type="text/javascript" src="lib/js/index.js"></script>
</body>
</html>