<?php
set_include_path ( '.' );
require_once 'lib/all_error.php';

session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}

?>

<!doctype html>
<head>
<meta charset="utf-8">

<title>Easy Polling</title>
<meta name="description" content="Test Project">
<meta name="viewport" content="width=device-width">
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript"
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
	src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.4.1/less.min.js"></script>
<script type="text/javascript" src="js/site.js"></script>
<body>
	<div class="container">
		<ul class="pager">
			<li class="previous"><a href="home.php">&larr; Home</a></li>
		</ul>

	<?php
	if (isset ( $_GET ['id'] )) {
		echo <<<END
		<h1>Your Poll Has Been Sent!</h1>
		<p>
			See the statistical result, click <a id="seeResult"
				href="stat.php?id=$_GET[id]">here</a>
		</p>
END;
	} else {
		echo "<p> The id of the poll is invalid </p>";
	}
	?>
	</div>
	<footer>- EasyPolling, Powered by the Orange Team, EECS394 2013</footer>
</body>

