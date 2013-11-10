<?php
$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "INSERT INTO Answer (Poll_ID, Answer) values($_POST[id], $_POST[choice])";
if (mysqli_query ( $mysql, $query )) {
	echo "success";
}
mysqli_close ( $con );
?>
