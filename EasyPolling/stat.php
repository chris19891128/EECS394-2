<!doctype html>
<head>
<title>Survey Results</title>
</head>
<body>
	<table>
		<tr>
			<td>Answer</td>
			<td>Statistic</td>
		</tr>
<?php
$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT Answer from Answer where Poll_ID='$_POST[id]'";
$result = mysqli_query ( $con, $query );
$stat = array ();

while ( $row = mysqli_fetch_array ( $result ) ) {
	$answer = $row ['Answer'];
	if ($stat [$answer] == NULL) {
		$stat [$answer] = 0;
	}
	$stat [$answer] = $stat [$answer] + 1;
}

foreach ( $stat as $answer => $count ) {
	echo "<tr><td>$answer</td><td>$count</td></tr>";
}
mysqli_close ( $con );
?>

</table>
</body>