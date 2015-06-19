<li class="dropdown"><a href="#" class="dropdown-toggle"
	data-toggle="dropdown">
                                    <?php echo AIDALang::get('hi'); ?>, <?php echo htmlentities($userInfo['username']);  ?>
                                    <b class="caret"></b>
</a>
	<ul class="dropdown-menu">
		<li><a href="profile.php"> <i
				class="icon-user glyphicon glyphicon-user"></i>
                                            <?php echo AIDALang::get('my_profile'); ?>
                                        </a></li>
                                    <?php if($user->isAdmin()): ?>
                  <li><a href="users.php"> <i
				class="icon-fire glyphicon glyphicon-fire"></i>
                          <?php echo AIDALang::get('users'); ?>

                      </a></li>
		<li><a href="user_roles.php"> <i
				class="icon-fire glyphicon glyphicon-fire"></i>
                          <?php echo AIDALang::get('user_roles'); ?>
                      </a></li>
                        <li><a href="managecollection.php"> <i
        class="icon-fire glyphicon glyphicon-fire"></i>
                          Manage Playlist
                      </a></li>

<li><a href="manageBug.php"> <i
										class="icon-fire glyphicon glyphicon-fire"></i>
										Manage Bug
									</a></li>
								<?php endif; ?>
                                    <li class="divider"></li>
		<li><a href="logout.php" id="logout"> <i
				class="icon-off glyphicon glyphicon-off"></i>
                                            <?php echo AIDALang::get('logout'); ?>
                                        </a></li>
	</ul></li>
