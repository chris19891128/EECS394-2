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
set_time_limit ( 0 );

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
	$config = array (
			'ssl' => 'tls',
			'port' => 587, // or 465
			'auth' => 'login',
			'username' => 'chris19891128@gmail.com',
			'password' => 'chris1989d' 
	);
	
	// $smtpInitClientRequestEncoded = constructAuthString ( $email, $accessToken );
	// $authenticateParams = array (
	// 'XOAUTH',
	// $smtpInitClientRequestEncoded
	// );
	// $config = array (
	// 'AUTHENTICATE' => $authenticateParams,
	// 'port' => '465',
	// 'ssl' => 'tls'
	// )
	
	$smtp = new Zend_Mail_Transport_Smtp ( 'smtp.gmail.com', $config );
	
	try {
		// Create a new mail object
		$mail = new Zend_Mail ();
		$mail->setDefaultTransport ( $smtp );
		$mail->setFrom ( "chris19891128@gmail.com" );
		$mail->addTo ( "chris1989apply@gmail.com" );
		$mail->setSubject ( "Your account has been created" );
		$mail->setBodyText ( "Thank you for registering!" );
		$mail->send ( $smtp );
	} catch ( Exception $e ) {
		echo "error sending email . <BR>" . $e;
	}
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
