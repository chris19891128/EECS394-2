<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/survey_db.php';

if (isset ( $_GET ['f'] ) && isset ( $_GET ['id'] )) {
	if ($_GET ['f'] == 'survey') {
		echo json_encode ( get_survey_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'recipient') {
		echo json_encode ( get_survey_recipient_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'creator') {
		echo get_survey_creator_by_id ( $_GET ['id'] );
	} else if ($_GET ['f'] == 'result') {
		echo json_encode ( get_survey_reply_by_id ( $_GET ['id'] ) );
	}
}

?>