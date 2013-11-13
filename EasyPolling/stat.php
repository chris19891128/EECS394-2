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
<script type="text/javascript" src="d3.v3/d3.v3.js"></script>
<script type="text/javascript" src="d3.v3/d3.v3.min.js"></script>
<script type="text/javascript" src="d3.v3/d3.v3.js"></script>
<style>

.bar.positive {
fill: steelblue;
}


.bar.negative {
fill: brown;
}

.axis text {
font: 10px sans-serif;
}

.axis path,
.axis line {
fill: none;
stroke: #000;
    shape-rendering: crispEdges;
}

</style>


</head>
<body>
	<div class="container">
		<h1>Here's the Result of the Poll</h1>
		<table class="table">
			<tr>
				<th>Answer</th>
                <th>Graphic</th>
				<th>Statistic</th>
			</tr>
			<?php
			$mysql = new mysqli ( 'localhost', 'root', '', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
			$query = "SELECT Answer from Answer where Poll_ID='$_GET[id]'";
			$result = mysqli_query ( $mysql, $query );
			$stat = array ();
                $totalNumber = 0;
                

			while ( $row = mysqli_fetch_array ( $result ) ) {
				$answer = $row ['Answer'];
				if (!array_key_exists($answer, $stat)) {
					$stat [$answer] = 0;
				}
				$stat [$answer] = $stat [$answer] + 1;
			}
            echo "<script type='text/javascript'>show();</script>";
            
            foreach ( $stat as $answer => $count )
            {
                $totalNumber = $totalNumber + $count;
            }
                
                //echo($totalNumber);
			foreach ( $stat as $answer => $count ) {
                $percent1 = $count/$totalNumber*100;
                $percent1 = $percent1.'%';
                $percent2 = 1 - $count/$totalNumber*100;
                $percent2 = $percent2.'%';
				echo "<tr><td style=\"width:100px\">$answer</td> <td style=\"width:\"><table width=\"100%\"><td style=\"width:"."$percent1"."\" bgcolor=\"red\" height=\"20px\"></td><td style=\"width:"."$percent2"."\" height=\"20px\"></td></table></td><td style=\"width:100px\">$count</td></tr>";
			}
			mysqli_close ( $mysql );
			?>

		</table>
		<?php include ("footer.inc");?>
	</div>
</body>
