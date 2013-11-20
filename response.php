<?php
// echo $_POST [id];
// echo $_POST [choice];
// echo $_POST [respondant];
$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "SELECT COUNT(*) as total FROM Answer where Poll_ID='" . $_POST [id] . "' and Respondant='" . $_POST ['respondant'];
$result = mysqli_query ( $mysql, $query );
echo 'result is '.$result.'  ';
$data = mysql_fetch_assoc ( $result );
echo $data ['total'] . ' hello\n';
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
