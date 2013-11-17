<?php
require_once 'lib/google-api-php-client/src/Google_Client.php';
require_once 'lib/google-api-php-client/src/contrib/Google_Oauth2Service.php';
require_once 'lib/all_error.php';

// Set your cached access token. Remember to replace $_SESSION with a
// real database or memcached.
session_start ();

$client = new Google_Client ();
$client->setApplicationName ( 'EasyPolling' );
// Visit https://code.google.com/apis/console?api=plus to generate your
// client id, client secret, and to register your redirect uri.
$client->setClientId ( '519869230344.apps.googleusercontent.com' );
$client->setClientSecret ( '-wESR-1Mwr7y6h2QOoNcXaRR' );
$client->setRedirectUri ( 'http://orange394.cloudapp.net/EasyPolling/login.php' );
$client->setDeveloperKey ( 'AIzaSyBMs1qCCwvCJyvgxEkJkGxaIVcUOmzU8dI' );
// $scopes = $client->getScopes ();
// array_push ( $scopes, 'https://mail.google.com/' );
// $client->setScopes ( $scopes );
$oauth = new Google_Oauth2Service ( $client );

if (isset ( $_GET ['logout'] )) {
	unset ( $_SESSION ['token'] );
	unset ( $_SESSION ['user'] );
}

if (isset ( $_GET ['code'] )) {
	$client->authenticate ();
	$_SESSION ['token'] = $client->getAccessToken ();
	$redirect = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['PHP_SELF'];
	header ( 'Location: ' . filter_var ( $redirect, FILTER_SANITIZE_URL ) );
}

if (isset ( $_SESSION ['token'] )) {
	$client->setAccessToken ( $_SESSION ['token'] );
}

if ($client->getAccessToken ()) {
	$_SESSION ['token'] = $client->getAccessToken ();
	$_SESSION ['google_user'] = $oauth->userinfo->get ();
	header ( 'location: home.php' );
} else {
	$authUrl = $client->createAuthUrl ();
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
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
	<h1>Welcome to EasyPolling, please connect your Gmail account first.</h1>
	<?php print "<a class='login btn btn-primary btn-lg' href='$authUrl'>Connect Me!</a>"; ?>
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