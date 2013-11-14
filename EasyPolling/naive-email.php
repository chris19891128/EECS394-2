<?php
require_once 'lib/all_error.php';
require_once 'lib/swift/lib/swift_required.php';
if ($_POST) {
	$transport = Swift_SmtpTransport::newInstance ( 'smtp.gmail.com', 465, "ssl" )->setUsername ( $_POST ['me'] )->setPassword ( $_POST ['pwd'] );
	
	$mailer = Swift_Mailer::newInstance ( $transport );
	
	//$emails = json_decode ( $_POST ['recepient'], true );
	$emails = $_POST['recepient'];
	
	foreach ( $emails as $email ) {
		$message = Swift_Message::newInstance ( 'You have a new poll' )->setFrom ( array (
				$_POST ['me'] 
		) )->setTo ( array (
				$email 
		) )->setBody ( 'http://orange394.cloudapp.net/EasyPolling/answer.php?id=' . $_POST ['id'] . '&responder=' . $email );
		
		$result = $mailer->send ( $message );
	}
}

?>