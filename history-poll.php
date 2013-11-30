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
		
	});
</script>

</head>
<body>

	<div class="container">
		<ul class="pager">
			<li class="previous"><a href="home.php">&larr; Home</a></li>
		</ul>
		<table class="table" id='mt'>
		</table>
<?php include ("footer.inc");?>
</div>
</body>