<?php
set_include_path ( '..' );
require_once 'lib/client.php';
require_once 'lib/session.php';

session_start ();

if (isset ( $_GET )) {
	if ($_GET ['f'] == 'user') {
		echo json_encode ( getFullUserInfo () );
	} else if ($_GET ['f'] == 'contact') {
		echo json_encode ( getAllContacts () );
	}
}

?>
