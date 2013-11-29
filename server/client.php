<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/google-api-php-client/src/Google_Client.php';

/*
 * Create the client which is to be used globally
 */
$authRedirect = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['PHP_SELF'];
$client = new Google_Client ();
$client->setApplicationName ( 'iMDown' );
$client->setClientId ( '519869230344.apps.googleusercontent.com' );
$client->setClientSecret ( '-wESR-1Mwr7y6h2QOoNcXaRR' );
$client->setRedirectUri ( $authRedirect );
$client->setDeveloperKey ( 'AIzaSyBMs1qCCwvCJyvgxEkJkGxaIVcUOmzU8dI' );
$client->setAccessType ( 'offline' );
$client->setScopes ( array (
		'https://www.google.com/m8/feeds/',
		'https://www.google.com/m8/feeds/user/',
		'https://mail.google.com/',
		'https://www.googleapis.com/auth/userinfo.profile',
		'https://www.googleapis.com/auth/userinfo.email' 
) );

/*
 * Set the client with the access token if it exist already
 */
if (isset ( $_SESSION ['token'] )) {
	$client->setAccessToken ( $_SESSION ['token'] );
}

/*
 * Unset variables
 */
unset ( $authRedirect );
?>