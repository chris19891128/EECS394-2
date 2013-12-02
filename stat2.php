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

<?php
    require_once 'lib/all_error.php';
    require_once 'lib/survey_db.php';
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
<?php
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
<?php
    if (!isset($_GET['responder']))
    {
    echo "<ul class=\"pager\">";
    echo "<li class=\"previous\"><a href=\"home.php\">&larr; Home</a></li>";
    echo "</ul>";
    }
    $survey = get_survey_by_id ( $_GET ['id'] );
    $survey_res = get_survey_recipient_by_id ( $survey_id );
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
    echo '<li><a href="stat.php?id='.$survey_id.'&responder='.$respondant.'">Result</a></li>';
    }
    else
    {
    echo '<li><a href="answer.php?id='.$survey_id.'">Vote</a></li>';
    echo '<li><a href="stat.php?id='.$survey_id.'">Result</a></li>';
    }
    ?>
<li class="active"><a href="#">Respondants</a></li>
</ul>
<br />
        <!-- frame = "void" -- not show the edge of the table -->
		<table class="table" border="0" frame="void">
				<th>Recipient</th>
				<th>Answer</th>
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
