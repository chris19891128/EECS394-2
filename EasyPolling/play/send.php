<?php
require_once 'lib/google/appengine/api/mail/Message.php';
require_once 'lib/all_error.php';
use google\appengine\api\mail\Message; 
$message_body = "Testing Email 1";

$mail_options = [ 
		"sender" => "chris19891128@gmail.com",
		"to" => "chaoshi2012@u.northwestern.edu",
		"subject" => "Your example.com account has been
activated.",
		"textBody" => $message_body 
];
try {
	$message = new Message ( $mail_options );
	$message->send ();
} catch ( InvalidArgumentException $e ) {
	echo "".$e;
}
?>