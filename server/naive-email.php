<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/swift/lib/swift_required.php';

function send_email($me, $pwd, $emails, $survey_id) {
	$transport = Swift_SmtpTransport::newInstance ( 'smtp.gmail.com', 465, "ssl" )->setUsername ( $me )->setPassword ( $pwd );
	
	$mailer = Swift_Mailer::newInstance ( $transport );
	
	if (gettype ( $emails ) == 'string') {
		$emails = json_decode ( $emails, true );
	}
	
	foreach ( $emails as $email ) {
		$url = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['PHP_SELF'] . '/../answer.php?id=' . $survey_id . '&responder=' . $email;
		
		$message = Swift_Message::newInstance ( 'You have a new poll' )->setFrom ( array (
				$_POST ['me'] 
		) )->setTo ( array (
				$email 
		) )->setBody ( $url );
		
		$result = $mailer->send ( $message );
	}
}

?>