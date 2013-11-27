<!doctype html>
<head>
<title>Survey Results</title>
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

<?php
    require_once 'lib/all_error.php';
    require_once 'survey_db.php';
    $resp = "false";
    if(isset($_GET['responder']))
    {
        $respondant = $_GET ['responder'];
        $resp = "true";
    }
    $survey_id = $_GET ['id'];
?>

</head>
<body>
<div class="container">
<?php
    if (!isset($_GET['responder']))
    {
    echo "<ul class=\"pager\">";
    echo "<li class=\"previous\"><a href=\"home.php\">&larr; Home</a></li>";
    echo "</ul>";
    }
$survey = get_survey_by_id ( $_GET ['id'] );
$survey_res = get_survey_recipient_by_id ( $survey_id );
$stat = array ();
$res = array ();
for($i = 0; $i < count ( $survey ['answer'] ); $i ++) {
	$stat [$i] = 0;
	$res [$i] = array ();
}

$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT * from Answer where Poll_ID='$_GET[id]'";
$result = mysqli_query ( $mysql, $query );

while ( $row = mysqli_fetch_array ( $result ) ) {
	$index = intval ( $row ['Answer'] );
	$stat [$index] ++;
	$res [$index] [count ( $res [$index] )] = $row ['Respondant'];
}

$totalNumber = 0;
for($i = 0; $i < count ( $survey ['answer'] ); $i ++) {
	$totalNumber = $totalNumber + $stat [$i];
}

mysqli_close ( $mysql );
?>
	<h1><?php echo $survey ['question']; ?></h1>
    <?php
        echo "<p> (Other recipients: ";
        for($i = 0; $i < count ( $survey_res ) - 1; $i ++) {
            echo $survey_res [$i] . ", ";
        }
        echo $survey_res [$i] . " )</p>";
    ?>

	<ul class="nav nav-tabs">
<?php
        if ($resp == "true")
        {
        echo '<li><a href="answer.php?id='.$survey_id.'&responder='.$respondant.'">Vote</a></li>';
        echo '<li><a href="stat2.php?id='.$survey_id.'&responder='.$respondant.'">Tack Respondants</a></li>';
        }
        else
        {
        echo '<li><a href="answer.php?id='.$survey_id.'">Vote</a></li>';
        echo '<li><a href="stat2.php?id='.$survey_id.'">Track Respondants</a></li>';
        }
    ?>
    <li class="active"><a href="#">See Result</a></li>
	</ul>
	<br />
	<p>You can click on the bar chart to see who voted :)</p>
	<table class="table" id="stats_graph">
		<!-- <tr>
			<th>Answer</th>
			<th>Graphic</th>
			<th>Statistic</th>
			<th>Respondants</th>
		</tr> -->
	<?php
	
	// echo "<script type='text/javascript'>show();</script>";
    $max = 0;
    for($i = 0; $i < count ( $survey ['answer'] ); $i ++)
    {
        $count = $stat [$i];
        if ($count >= $max)
        {
            $max = $count;
        }
    }
	for($i = 0; $i < count ( $survey ['answer'] ); $i ++) {
		$choice = $survey ['answer'] [$i];
		$count = $stat [$i];
		if ($totalNumber > 0) {
			$percent = ($count / $max * 100) . '%';
		} else {
			$percent = '0%';
		}
		echo <<<END
		<tr>
			<td>$choice</td> 
			<td style="width:100%;">
				<a style="display: block; width:$percent; height: 20px; background-color: #428bca;" data-toggle="modal" data-target="#voters$i"> </a>
			</td>
			<td>$count</td> 
			<td>
			<div class="modal fade" id="voters$i" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Voters for $choice</h4>
			      </div>
			      <div class="modal-body">
END;
		
		foreach ( $res [$i] as $single_email ) {
			echo "$single_email<br />";
		}
		echo <<<END
				  <div class="modal-footer">
			        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <button type="button" class="btn btn-primary">Save changes</button>-->
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</tr>
END;
	}
	
	?>

	</table>
	<?php include ("footer.inc");?>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
</body>
