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

$num_str = $_POST ['nums'];
$num_array = json_decode ( $num_str );
$result = array ();

foreach ( $num_array as $num ) {
	$query = "SELECT id FROM user WHERE phone_number='$num'";
	$qr = mysqli_fetch_array ( mysqli_query ( $con, $query ) );
	if ($qr == NULL) {
		$result [$num] = "";
	} else {
		$result [$num] = $qr ['id'];
	}
}

echo json_encode ( $result );

?>