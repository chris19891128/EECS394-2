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
</head>
<body>
	<div class="container">
		<h1>Here's the Result of the Poll</h1>
		<table class="table">
			<tr>
				<th>Answer</th>
				<th>Statistic</th>
			</tr>
			<?php
			$mysql = new mysqli ( 'localhost', 'root', '', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
			$query = "SELECT Answer from Answer where Poll_ID='$_GET[id]'";
			$result = mysqli_query ( $mysql, $query );
			$stat = array ();

			while ( $row = mysqli_fetch_array ( $result ) ) {
				$answer = $row ['Answer'];
				if (!array_key_exists($answer, $stat)) {
					$stat [$answer] = 0;
				}
				$stat [$answer] = $stat [$answer] + 1;
			}

			foreach ( $stat as $answer => $count ) {
				echo "<tr><td>$answer</td><td>$count</td></tr>";
			}
			mysqli_close ( $mysql );
			?>

		</table>
		<?php include ("footer.inc");?>
	</div>
</body>
