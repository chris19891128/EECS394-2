<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/naive-email.php';

if ($_POST) {
	
	// Send emails
	send_email ( $_POST ['me'], $_POST ['pwd'], $_POST ['recipient'], $_POST['id'] );
	
	// Store poll in DB
	$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "INSERT INTO Poll VALUES('" . $_POST ['id'] . "', '" . json_encode ( $_POST ['data'] ) . "', '" . json_encode ( $_POST ['recipient'] ) . "', '" . $_POST ['me'] . "')";
	if ($updateDb = $mysql->query ( $query ) or die ( $mysql->error )) {
		echo "Email send out success";
	}
	mysqli_close ( $mysql );
}
?>
