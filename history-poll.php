<?php
require_once 'lib/all_error.php';
require_once 'lib/survey_db.php';

session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}

?>
<!doctype html>
<head>
<title>iMDown</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
	$(function(){
		$.ajax({
			type : "GET",
			url : 'server/surveyapi.php',
			data : {f : 'history'},
			success : function(data) {
				var polls = $.parseJSON(data);
				for (var i=0; i < polls.length; i++) {
					$td1 = $('<td>' + polls[i]['survey']['question'] + '</td>');
					$td2 = $('<td><a href="statp.php?id=' + polls[i]['id'] + '">See statistic result</a></td>');
					$td3 = $('<td><a href="edit-poll.php?id=' + polls[i]['id'] + '">Add more recipients</a></td>');
					$row = $('<tr></tr>').append($td1).append($td2).append($td3);
					$('#mt').append($row);
				}
				$('#root').show();
			}
		});
	});
</script>

</head>
<body>
	<div class="container" id="root" style="display: none">
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
		<table class="table" id='mt'>
		</table>
	<?php include ("footer.inc");?>
	</div>
</body>