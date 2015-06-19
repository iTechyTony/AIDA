<?php require_once 'templates/_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Internet Development | By Tony Ampomah</title>

<?php require_once 'templates/_head.php';?>
<style type="text/css">
/*AM22 - To make google search box appear correct - START*/
input.gsc-input, .gsc-input-box, .gsc-input-box-hover, .gsc-input-box-focus, .gsc-search-button 
{
  box-sizing: content-box;
  line-height: normal;
}
/*AM22 - To make google search box appear correct - END*/

</style>


</head>

<body>
<?php require_once 'templates/_topNav.php';?>

<div class="container-fluid">
	<div class="row">
 <?php require_once 'templates/_leftnav.php'; ?>  
    <div class="col-md-9">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Google Custom Search</h3>
				</div>
				<div class="panel-body">
<script>
  (function() {
    var cx = '011592393768441499249:bazqkf-weew';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
					
			</div>

			</div>
		</div><!-- end of col-md-9 -->
	</div><!-- end of row -->
</div><!-- end of container fluid -->

<?php require_once 'templates/_footer.php'; ?>

</body>
</html>

