<?php
ini_set ( 'include_path', './lib' );
require_once 'all_error.php';
require_once 'google-api-php-client/src/Google_Client.php';
require_once 'Zend/Mail/Protocol/Imap.php';
require_once 'Zend/Mail/Storage/Imap.php';
session_start ();

if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}

?>

<?php

/**
 * Builds an OAuth2 authentication string for the given email address and access
 * token.
 */
function constructAuthString($email, $accessToken) {
	return base64_encode ( "user=$email\1auth=Bearer $accessToken\1\1" );
}

/**
 * Given an open IMAP connection, attempts to authenticate with OAuth2.
 *
 * $imap is an open IMAP connection.
 * $email is a Gmail address.
 * $accessToken is a valid OAuth 2.0 access token for the given email address.
 *
 * Returns true on successful authentication, false otherwise.
 */
function oauth2Authenticate($imap, $email, $accessToken) {
	$authenticateParams = array (
			'XOAUTH2',
			constructAuthString ( $email, $accessToken ) 
	);
	$imap->sendRequest ( 'AUTHENTICATE', $authenticateParams );
	while ( true ) {
		$response = "";
		$is_plus = $imap->readLine ( $response, '+', true );
		if ($is_plus) {
			error_log ( "got an extra server challenge: $response" );
			// Send empty client response.
			$imap->sendRequest ( '' );
		} else {
			if (preg_match ( '/^NO /i', $response ) || preg_match ( '/^BAD /i', $response )) {
				error_log ( "got failure response: $response" );
				return false;
			} else if (preg_match ( "/^OK /i", $response )) {
				return true;
			} else {
				// Some untagged response, such as CAPABILITY
			}
		}
	}
}

/**
 * Given an open and authenticated IMAP connection, displays some basic info
 * about the INBOX folder.
 */
function showInbox($imap) {
	/**
	 * Print the INBOX message count and the subject of all messages
	 * in the INBOX
	 */
	$storage = new Zend_Mail_Storage_Imap ( $imap );
	
	include 'header.php';
	echo '<h1>Total messages: ' . $storage->countMessages () . "</h1>\n";
	
	/**
	 * Retrieve first 5 messages.
	 * If retrieving more, you'll want
	 * to directly use Zend_Mail_Protocol_Imap and do a batch retrieval,
	 * plus retrieve only the headers
	 */
	echo 'First five messages: <ul>';
	for($i = 1; $i <= $storage->countMessages () && $i <= 5; $i ++) {
		echo '<li>' . htmlentities ( $storage->getMessage ( $i )->subject ) . "</li>\n";
	}
	echo '</ul>';
}

/**
 * Tries to login to IMAP and show inbox stats.
 */
function tryImapLogin($email, $accessToken) {
	/**
	 * Make the IMAP connection and send the auth request
	 */
	$imap = new Zend_Mail_Protocol_Imap ( 'imap.gmail.com', '993', true );
	if (oauth2Authenticate ( $imap, $email, $accessToken )) {
		echo '<h1>Successfully authenticated!</h1>';
		showInbox ( $imap );
	} else {
		echo '<h1>Failed to login</h1>';
	}
}

?>
<html>
<head>
<title>Send out emails</title>
</head>
<body>
<?php
if ($_SESSION['token']) {
	tryImapLogin ( 'chris19891128@gmail.com', $_SESSION['token'] );
}
?>
</body>
</html>
