<?php
require_once 'lib/all_error.php';
$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT * FROM Answer where Poll_ID='" . $_POST ['id'] . "' and Respondant='" . $_POST ['respondant'] . "'";
$result = mysqli_query ( $mysql, $query );
$row = mysqli_num_rows ( $result );

if ($row > 0) {
	echo "error";
} else {
	$query = "INSERT INTO Answer (Poll_ID, Answer, Respondant) values('$_POST[id]', '$_POST[choice]', '$_POST[respondant]')";
	if (mysqli_query ( $mysql, $query )) {
		echo "success";
	} else {
		echo mysqli_error ( $mysql );
	}
	mysqli_close ( $mysql );
}

?>
