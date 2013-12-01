<?php
require_once 'lib/all_error.php';
session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}

?>
<!doctype html>
<head>
<title>iMDown</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="/resources/demos/style.css" />
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


</head>
<body>

	<div class="container">
		<ul class="pager">
			<li class="previous"><a href="home.php">&larr; Home</a></li>
		</ul>
		<table class="table">
<?php
require_once 'survey_db.php';


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