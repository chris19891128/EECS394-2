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
<a href="home.php" id="home_link">Home</a>

<?php
require_once 'lib/all_error.php';
require_once 'survey_db.php';

$survey_id = $_GET ['id'];
$survey = get_survey_by_id ( $_GET ['id'] );
$survey_res = get_survey_recipient_by_id ( $_GET ['id'] );

$stat = array ();

$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT * from Answer where Poll_ID='$_GET[id]'";
$result = mysqli_query ( $mysql, $query );

while ( $row = mysqli_fetch_array ( $result ) ) {
	$stat [$row ['Respondant']] = $row ['Answer'];
}

mysqli_close ( $mysql );
?>

<div class="container">
		<h1><?php echo $survey ['question']; ?></h1>
		<table class="table">
			<tr>
				<th>Recipient</th>
				<th>Answer</th>
			</tr>
		<?php
		foreach ( $survey_res as $res ) {
			echo "<tr><td>$res</td>";
			if (! array_key_exists ( $res, $stat )) {
				echo "<td>Not Responded</td>";
			} else {
				echo "<td>" . $survey ['answer'] [$stat [$res]] . "</td>";
			}
			echo "</tr>";
		}
		?>

	</table>
	<?php include ("footer.inc");?>
</div>
</body>
