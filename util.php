<?php
require_once 'lib/all_error.php';
require_once 'lib/google-api-php-client/src/Google_Client.php';
require_once 'lib/session.php';

session_start ();
$accessToken = getAccessToken ();
echo $accessToken;
?>