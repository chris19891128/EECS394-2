<?php
// echo $_POST [id];
// echo $_POST [choice];
// echo $_POST [respondant];
$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT COUNT(*) as total FROM Answer where id='" . $_POST [id] . "' and respondant='" . $_POST ['respondant'];
$result = mysqli_query ( $mysql, $query );
$data = mysql_fetch_assoc ( $result );
echo $data;
if ($data ['total'] > 0) {
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
