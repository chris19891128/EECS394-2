<?php
// Create connection
$con = mysqli_connect ( "fdb3.biz.nf", "1543790_chao", "nueecs394", "1543790_chao" );

// Check connection
if (mysqli_connect_errno ( $con )) {
	echo json_encode ( array (
			'status' => 'fail',
			'error' => 'connection error' 
	) );
}
$id = uniqid ();
$query = "INSERT INTO user (id, phone_number, name)
VALUES ('$id', '$_GET[num]','$_GET[name]')";

if (mysqli_query ( $con, $query )) {
	echo json_encode ( array (
			'status' => 'success',
			'id' => $id 
	) );
} else {
	$query = "SELECT id FROM user WHERE phone_number='$_GET[num]'";
	$result = mysqli_fetch_array ( mysqli_query ( $con, $query ) );
	$id = $result ['id'];
	echo json_encode ( array (
			'status' => 'fail',
			'error' => 'duplicated phone',
			'id' => $id 
	) );
}

?>