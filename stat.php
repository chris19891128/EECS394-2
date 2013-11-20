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
<script type="text/javascript" src="js/external/d3.v3/d3.v3.min.js"></script>
<script type="text/javascript" src="js/external/d3.v3/d3.v3.js"></script>


</head>
<body>
<?php
require_once 'lib/all_error.php';
require_once 'survey_db.php';

$survey_id = $_GET ['id'];
$survey = get_survey_by_id ( $_GET ['id'] );
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

<div class="container">
		<h1><?php echo $survey ['question']; ?></h1>
		<table class="table">
			<tr>
				<th>Answer</th>
				<th>Graphic</th>
				<th>Statistic</th>
				<th>Respondants</th>
			</tr>
		<?php
		
		echo "<script type='text/javascript'>show();</script>";
		
		for($i = 0; $i < count ( $survey ['answer'] ); $i ++) {
			$choice = $survey ['answer'] [$i];
			$count = $stat [$i];
			if ($totalNumber > 0) {
				$percent1 = ($count / $totalNumber * 100) . '%';
				$percent2 = ((1 - $count / $totalNumber) * 100) . '%';
			} else {
				$percent1 = '0%';
				$percent2 = '100%';
			}
			echo <<<END
			<tr>
				<td style="width:100px">$choice</td> 
				<td style="width:">
					<table width="100%">
						<td style="width:"$percent1" bgcolor="DarkCyan" height="20px"/>
						<td style="width:"$percent2" height="20px"/>
					</table>
				</td>
				<td style="width:100px">$count</td> 
				<td style="width:100px">
					<table width="100%">
END;
			
			foreach ( $res [$i] as $single_email ) {
				echo "<tr><td>$single_email</td></tr>";
			}
			echo <<<END
					</table>
				</td>
			</tr>
END;
		}
		
		?>

	</table>
	<?php include ("footer.inc");?>
</div>
</body>
