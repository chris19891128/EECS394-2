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

	<div class="container">
		<table class="table">
<?php
require_once 'lib/all_error.php';
session_start ();

$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT * from Poll where Creator='" . $_SESSION ['email'] . "'";
$result = mysqli_query ( $mysql, $query );

while ( $row = mysqli_fetch_array ( $result ) ) {
	$id = $row ['ID'];
	
	echo "<tr>";
	echo "<td>Poll_$id</td>";
	echo "<td><a href='stat.php?id=$id'>See statistic result</a></td>";
	echo "<td><a href='stat2.php?id=$id'>See individual result</a></td>";
	echo "</tr>";
}
?>

</table>
<?php include ("footer.inc");?>
</div>
</body>