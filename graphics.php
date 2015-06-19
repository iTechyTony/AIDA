<?php require_once 'templates/_header.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Internet Development | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
<?php

require_once 'HighchartsPHP-master/Highchart.php';
require_once 'HighchartsPHP-master/HighchartOption.php';
require_once 'HighchartsPHP-master/HighchartJsExpr.php';
require_once 'HighchartsPHP-master/HighchartOptionRenderer.php';


$query = "SELECT artist FROM playlist LIMIT 9 ";

$result = $db->query ( $query );

$db_artist = array ();
while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
    array_push ( $db_artist, $row['artist'] );
}


$query = "SELECT rating FROM playlist LIMIT 9 ";

$result = $db->query ( $query );

$db_ratings = array ();
while ( $row2 = $result->fetch ( PDO::FETCH_ASSOC ) ) {
    array_push ( $db_ratings , $row2['rating'] );
}

function castnumbers($number){
    $num = $number;
    $int = (int)$num;
    $float = (float)$num;

    return $float;
}


$r0=castnumbers($db_ratings[0]);
$r1=castnumbers($db_ratings[1]);
$r2=castnumbers($db_ratings[2]);
$r3=castnumbers($db_ratings[3]);
$r4=castnumbers($db_ratings[4]);
$r5=castnumbers($db_ratings[5]);
$r6=castnumbers($db_ratings[6]);
$r7=castnumbers($db_ratings[7]);
$r8=castnumbers($db_ratings[8]);


$ratings = array(
        $r0,
        $r1,
        $r2,
        $r3,
        $r4,
        $r5,
        $r6,
        $r7,
        $r8,
       
    );


$data = array(
    'data' => $ratings
);

//echo '<pre>',print_r($data),'</pre>';

$chart = new Highchart();

$chart->chart->renderTo = "container";
$chart->chart->type = "column";
$chart->title->text = "Top rated Artist";

$chart->xAxis->categories = $db_artist;
$chart->yAxis->min = 0;
$chart->yAxis->title->text = "Ratings";
$chart->yAxis->stackLabels->enabled = 1;
$chart->yAxis->stackLabels->style->fontWeight = "bold";


$chart->series[] = $data;


?>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php $chart->printScripts(); ?>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>
<div class="container-fluid">
	<div class="row">
<?php require_once 'templates/_leftnav.php';?><div class="col-md-9">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Graphics</h3>
				</div>
				<div class="panel-body">

<div id="container"></div>
<script type="text/javascript"><?php echo $chart->render("chart1"); ?></script>

			</div>

			</div>
		</div><!-- end of col-md-9 -->
	</div><!-- end of row -->
</div><!-- end of container fluid -->

<?php require_once 'templates/_footer.php';?>
</body>
</html>

