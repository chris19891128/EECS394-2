<?php
require_once 'lib/all_error.php';
require_once 'lib/google-api-php-client/src/Google_Client.php';
require_once 'lib/session.php';

set_include_path ( get_include_path () . ":lib" );
require_once 'Zend/Mail/Protocol/Imap.php';
require_once 'Zend/Mail/Protocol/Smtp.php';
require_once 'Zend/Mail/Storage/Imap.php';
require_once 'Zend/Mail/Transport/Smtp.php';
require_once 'Zend/Mail.php';

session_start ();
set_time_limit ( 10 );

?>
<html>
<head>
<title>OAuth2 IMAP example with Gmail</title>
</head>
<body>

<?php

/**
 * Builds an OAuth2 authentication string for the given email address and access
 * token.
 */
function constructAuthString($email, $accessToken) {
	return base64_encode ( "user=$email\1auth=Bearer $accessToken\1\1" );
}

/**
 * Tries to login in SMTP
 */
function sendEmail($email, $accessToken) {
	$smtpInitClientRequestEncoded = constructAuthString ( $email, $accessToken );
	$config = array (
			'ssl' => 'tls',
			'port' => '465',
			'auth' => 'xoauth',
			'xoauth_request' => $smtpInitClientRequestEncoded 
	);
	
	$transport = new Zend_Mail_Transport_Smtp ( 'smtp.gmail.com', $config );
	$mail = new Zend_Mail ();
	$mail->setBodyText ( 'body text' );
	$mail->setFrom ( $email, 'Chao Shi' );
	$mail->addTo ( "chris1989apply@gmail.com", 'Some Recipient' );
	$mail->setSubject ( 'Test sending by smtp' );
	$mail->send ( $transport );
}

$accessToken = getAccessToken ();

$email = 'chris19891128@gmail.com';

if ($email && $accessToken) {
	sendEmail ( $email, $accessToken );
	echo "finish";
}

?>
</body>
</html>
