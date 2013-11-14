<?php
require_once 'lib/swift/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance ( 'smtp.gmail.com', 465, "ssl" )->setUsername ( 'chris19891128@gmail.com' )->setPassword ( 'chris1989d' );

$mailer = Swift_Mailer::newInstance ( $transport );

$message = Swift_Message::newInstance ( 'Test Subject' )->setFrom ( array (
		'chris19891128@gmail.com' => 'ABC' 
) )->setTo ( array (
		'chris1989apply@gmail.com' 
) )->setBody ( 'This is a test mail.' );

$result = $mailer->send ( $message );
?>