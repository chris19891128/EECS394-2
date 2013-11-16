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
    function get_survey_by_id($survey_id) {
        $link = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
        $query = "select * from Poll where ID='$survey_id'";
        $result = mysqli_query ( $link, $query );
        $row = mysqli_fetch_array ( $result );
        
        if ($row) {
            $content = $row ['Content'];
                // echo $content;
            $json = json_decode ( $content, true );
        } else {
            echo mysqli_error ( $link );
            $json = NULL;
        }
        mysqli_close ( $link );
        return $json;
    }
?>
<?php
    $survey_id = $_GET ['id'];
    $survey = get_survey_by_id ( $_GET ['id'] );
    ?>
<div class="container">
<h1><?php echo $survey ['question']; ?></h1>
<table class="table">
<tr>
<th>Answer</th>
<th>Graphic</th>
<th>Statistic</th>
</tr>



			<?php
			$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
			$query = "SELECT Answer from Answer where Poll_ID='$_GET[id]'";
			$result = mysqli_query ( $mysql, $query );
			$stat = array ();
			$totalNumber = 0;
			while ( $row = mysqli_fetch_array ( $result ) ) {
				$answer = $row ['Answer'];
				if (! array_key_exists ( $answer, $stat )) {
					$stat [$answer] = 0;
				}
				$stat [$answer] = $stat [$answer] + 1;
			}
			echo "<script type='text/javascript'>show();</script>";
			
			foreach ( $stat as $answer => $count ) {
				$totalNumber = $totalNumber + $count;
			}
			
			// echo($totalNumber);
			foreach ( $stat as $answer => $count ) {
				$percent1 = $count / $totalNumber * 100;
				$percent1 = $percent1 . '%';
				$percent2 = 1 - $count / $totalNumber * 100;
				$percent2 = $percent2 . '%';
				echo "<tr><td style=\"width:100px\">$answer</td> <td style=\"width:\"><table width=\"100%\"><td style=\"width:" . "$percent1" . "\" bgcolor=\"red\" height=\"20px\"></td><td style=\"width:" . "$percent2" . "\" height=\"20px\"></td></table></td><td style=\"width:100px\">$count</td></tr>";
			}
			mysqli_close ( $mysql );
			?>

		</table>
		<?php include ("footer.inc");?>
	</div>
</body>
