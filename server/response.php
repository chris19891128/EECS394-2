<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT * FROM Answer where Poll_ID='" . $_GET ['id'] . "' and Respondant='" . $_GET ['respondant'] . "'";
$result = mysqli_query ( $mysql, $query );
$row = mysqli_num_rows ( $result );

if ($row > 0) {
	echo "error";
} else {
	$query = "INSERT INTO Answer (Poll_ID, Answer, Respondant) values('$_GET[id]', '$_GET[choice]', '$_GET[respondant]')";
	if (mysqli_query ( $mysql, $query )) {
		echo "success";
	} else {
		echo mysqli_error ( $mysql );
	}
	mysqli_close ( $mysql );
}

?>
