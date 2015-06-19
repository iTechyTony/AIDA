<?php require_once 'templates/_header.php'; ?>
<?php if(!$login->isLoggedIn())
    header("Location: login.php");
$user = new AIDAUser(AIDASession::get("user_id"));
$userInfo = $user->getInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Internet Development | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
    <script type="text/javascript" charset="utf-8">
        var $_lang = <?php echo AIDALang::all(); ?>;
    </script>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>
<div class="container-fluid">
	<div class="row">
 <?php require_once 'templates/_leftnav.php'; ?>  

              <div class="col-md-9">
              
              	<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Post a Comment</h3>
				</div>
				<div class="panel-body">
              
                
                    <div class="comments">
                            <h3 id="comments-title">
                              <?php echo AIDALang::get('comments_wall'); ?> 
                              <small><?php echo AIDALang::get('last_7_posts'); ?></small>
                            </h3>
                            <div class="comments-comments">
                                <?php $AIDAComment = new AIDAComment(); ?>
                                <?php $comments = $AIDAComment->getComments(); ?>
                                <?php foreach($comments as $comment): ?>
                                 <blockquote>
                                    <p><?php echo htmlentities( stripslashes($comment['comment']) ); ?></p>
                                    <small>
                                        <?php echo htmlentities($comment['posted_by_name']);  ?> 
                                        <em> <?php echo AIDALang::get('at'); ?> <?php echo $comment['post_time']; ?></em></small>
                                </blockquote>
                                <?php endforeach; ?>
                            </div>
                    </div>
                
                    <?php if($user->getRole() != 'user'): ?>
                    <div class="leave-comment">
                        <div class="control-group form-group">
                            <h5><?php echo AIDALang::get('leave_comment'); ?></h5>
                            <div class="controls">
                                <textarea class="form-control" id="comment-text"></textarea>
                            </div>
                        </div>
                        <div class="control-group form-group">
                             <div class="controls">
                                <button class="btn btn-success" id="comment">
                                  <?php echo AIDALang::get('comment'); ?>
                                </button>
                            </div>
                        </div>
                    </div></div>   </div>  </div></div>
                    <?php else: ?>
                        <p><?php echo AIDALang::get('you_cant_post'); ?></p>
                    <?php endif; ?>
                    
        
         
            </div>  
          
        
<?php require_once 'templates/_footer.php'; ?>
<script type="text/javascript" src="assets/js/sha512.js"></script>
<script src="lib/js/asengine.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="lib/js/index.js" charset="utf-8"></script>
</body>
</html>
