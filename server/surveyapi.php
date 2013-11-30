<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/survey_db.php';
require_once 'lib/session.php';

session_start ();

if (isset ( $_GET ['f'] )) {
	if ($_GET ['f'] == 'survey') {
		echo json_encode ( get_survey_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'recipient') {
		echo json_encode ( get_survey_recipient_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'creator') {
		echo get_survey_creator_by_id ( $_GET ['id'] );
	} else if ($_GET ['f'] == 'responders') {
		echo json_encode ( get_survey_responded_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'result') {
		echo json_encode ( get_survey_reply_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'history') {
		$user = getFullUserInfo ();
		$email = $user ['email'];
		echo $email;
		echo json_encode ( get_survey_ids_by_user ( $email ) );
	}
}

?>