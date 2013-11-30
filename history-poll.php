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
			url : 'server/surveyapi.php?f=history&id=' + $('#sid').val(),
			success : function(data) {
				$('#ar').html('(Other Recipients: ');
				var emails = $.parseJSON(data);
				var i = 0;
				for (; i < emails.length - 1; i++) {
					$('#ar').append(emails[i] + ', ');
				}
				$('#ar').append(emails[i] + ')');
				$('#infov').show();
			}
		});
	});
</script>

</head>
<body>

	<div class="container">
		<ul class="pager">
			<li class="previous"><a href="home.php">&larr; Home</a></li>
		</ul>
		<table class="table">
// <?php

// $user = getFullUserInfo ();
// $me = $user ['email'];

// while ( $row = mysqli_fetch_array ( $result ) ) {
// $id = $row ['ID'];
// $survey = get_survey_by_id ( $id );

// echo "<tr>";
// echo "<td>" . $survey ['question'] . "</td>";
// echo "<td><a href='statp.php?id=$id'>See statistic result</a></td>";
// // echo "<td><a href='stat2.php?id=$id'>See individual result</a></td>";
// echo "</tr>";
// }
?>

</table>
<?php include ("footer.inc");?>
</div>
</body>