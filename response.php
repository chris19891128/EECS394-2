<?php
    echo $_POST[id];
    echo $_POST[choice];
    echo $_POST[respondant];
$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
$query = "INSERT INTO Answer (Poll_ID, Answer, Respondant) values('$_POST[id]', '$_POST[choice]', '$_POST[respondant]')";
if (mysqli_query ( $mysql, $query )) {
	echo "success";
} else{
	echo mysqli_error($mysql);
}
mysqli_close ( $mysql );
?>
