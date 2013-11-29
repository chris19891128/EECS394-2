<?php
set_include_path ( '..' );
require_once 'server/myapi.php';

session_start ();

if ($_GET ['f'] == 'user') {
	echo var_dump ( getFullUserInfo () );
} else if ($_GET ['f'] == 'contact') {
	echo var_dump ( getAllContacts () );
}
?>