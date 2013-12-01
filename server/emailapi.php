<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/session.php';
require_once 'lib/good-email.php';

session_start ();

$accessToken = getAccessToken ();
if (isset ( $_POST )) {
	send_good_email ( $_POST['me'], $accessToken, array (
			'chris1989apply@gmail.com',
			'chris19891128@gmail.com' 
	), '187e' );
}

?>