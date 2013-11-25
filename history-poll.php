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
<div class="container">
	<ul class="pager">
	  <li class="previous"><a href="home.php">&larr; Home</a></li>
	</ul>
	<table class="table">
<?php
require_once 'lib/all_error.php';
require_once 'survey_db.php';
session_start ();

$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT * from Poll where Creator='" . $_SESSION ['email'] . "'";
$result = mysqli_query ( $mysql, $query );

while ( $row = mysqli_fetch_array ( $result ) ) {
	$id = $row ['ID'];
    $survey = get_survey_by_id ( $id );
	
	echo "<tr>";
	echo "<td>". $survey ['question'] ."</td>";
	echo "<td><a href='stat.php?id=$id'>See statistic result</a></td>";
	// echo "<td><a href='stat2.php?id=$id'>See individual result</a></td>";
	echo "</tr>";
}
?>

</table>
<?php include ("footer.inc");?>
</div>
</body>