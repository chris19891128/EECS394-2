<?php
require_once 'lib/all_error.php';
require_once 'lib/client.php';

session_start ();

if (isset ( $_GET ['logout'] )) {
	unset ( $_SESSION ['token'] );
}

if (isset ( $_GET ['code'] )) {
	$client->authenticate ();
	$_SESSION ['token'] = $client->getAccessToken ();
	$redirect = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['PHP_SELF'];
	header ( 'Location: ' . filter_var ( $redirect, FILTER_SANITIZE_URL ) );
}

if (isset ( $_SESSION ['token'] )) {
	header ( 'location: home.php' );
} else {
	$authUrl = $client->createAuthUrl ();
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
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript"
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
	src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.4.1/less.min.js"></script>
<script type="text/javascript" src="js/site.js"></script>

</head>

<body>
	<div class="container">
		<h1>Welcome to iMDown, please connect your Gmail account first.</h1>
		<a class="login btn btn-primary btn-lg" href="<?php echo $authUrl; ?>">Connect
			Me!</a>
	</div>
</body>
</html>