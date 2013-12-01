<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/good-email.php';
require_once 'lib/survey_db.php';
require_once 'lib/session.php';

session_start ();
$accessToken = getAccessToken ();

if ($_POST) {
	
	// Send emails
	// send_email ( $_POST ['me'], $_POST ['pwd'], $_POST ['recipient'], $_POST ['id'] );
	send_good_email ( $_POST ['me'], $accessToken, $_POST ['recipient'], $_POST ['id'] );
	
	if (! isset ( $_GET ['edit'] )) {
		// Store poll in DB
		$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
		$query = "INSERT INTO Poll VALUES('" . $_POST ['id'] . "', '" . json_encode ( $_POST ['data'] ) . "', '" . json_encode ( $_POST ['recipient'] ) . "', '" . $_POST ['me'] . "')";
		if ($updateDb = $mysql->query ( $query ) or die ( $mysql->error )) {
			echo "Email send out success";
		}
		mysqli_close ( $mysql );
	} else {
		$old_recipient = get_survey_recipient_by_id ( $_POST ['id'] );
		$new_recipient = array_merge ( $old_recipient, $_POST ['recipient'] );
		
		// Update poll in DB
		$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
		$query = "UPDATE Poll set recipient='" . json_encode ( $new_recipient ) . "' where ID='" . $_POST ['id'] . "'";
		if ($updateDb = $mysql->query ( $query ) or die ( $mysql->error )) {
			echo "Email send out success";
		}
		mysqli_close ( $mysql );
	}
}
?>
