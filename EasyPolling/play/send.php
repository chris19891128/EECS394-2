<?php
require_once 'lib/google/appengine/api/mail/Message.php';
use google\appengine\api\mail\Message; // ... $message_body = "...";

$mail_options = [ 
		"sender" => "admin@example.com",
		"to" => "user@example.com",
		"subject" => "Your example.com account has been
activated.",
		"textBody" => $message_body 
];
try {
	$message = new Message ( $mail_options );
	$message->send ();
} catch ( InvalidArgumentException $e ) { // ...
}
?>