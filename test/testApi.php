<?php
set_include_path ( '..' );
require_once 'lib/survey_db.php';

echo json_encode ( get_survey_reply_by_id ( $_GET ['id'] ) );
?>