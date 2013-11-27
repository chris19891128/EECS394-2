<?php
require_once 'lib/all_error.php';
session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}
if(isset($_POST["logout"]))
{
    echo ("you click logout");
    unset($_SESSION['token']);
    unset($_SESSION ['email']);
	unset($_SESSION ['image']);
    session_destroy();
}
?>
<!doctype html>
<head>
<meta charset="utf-8">

<title>iMDown</title>
<meta name="description" content="Test Project">
<meta name="viewport" content="width=device-width">
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

		<h1>Welcome 
		<?php
		echo $_SESSION ['email'];
		//echo "<div><img src='" . $_SESSION ['image'] . "?sz=50'></div>";
		?></h1>

		<form method="GET">
			<button type="submit" class="btn btn-primary btn-lg"
				formaction="create-poll.php">New Poll</button>
			<button type="submit" class="btn btn-default btn-lg"
				formaction="history-poll.php">History Polls</button>
            <button class="btn btn-default btn-lg" value="logout"
                formaction="home.php" method="post">LogOut</button>
		</form>
	</div>
	<script type="text/javascript"
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript"
		src="http://www.parsecdn.com/js/parse-1.2.12.min.js"></script>
	<script type="text/javascript"
		src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript"
		src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.4.1/less.min.js"></script>
	<script type="text/javascript" src="js/site.js"></script>
</body>
</html>
