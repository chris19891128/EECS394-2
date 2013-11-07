<?php
$con = mysqli_connect ( "fdb3.biz.nf", "1543790_chao", "nueecs394", "1543790_chao" );

// Check connection
if (mysqli_connect_errno ( $con )) {
	echo json_encode ( array (
			'status' => 'fail',
			'error' => 'connection error' 
	) );
}

// Start here
if ($_GET ['action'] == "ask") {
	$uuid = uniqid ();
	$mid = create_message ( $con, $_GET ['content'] );
	$query = "INSERT INTO poll_question (id, from_id, to_id, message_id)
	VALUES ('$uuid', '$_GET[from]','$_GET[to]', '$mid')";
	mysqli_query ( $con, $query );
	echo json_encode ( array (
			'status' => 'success',
			'id' => $uuid 
	) );
} else if ($_GET ['action'] == 'answer') {
	$uuid = uniqid ();
	$mid = create_message ( $con, $_GET ['content'] );
	$query = "INSERT INTO poll_answer (id, from_id, to_id, message_id, poll_question_id)
		VALUES ('$uuid', '$_GET[from]','$_GET[to]', '$mid', '$_GET[qid]')";
	mysqli_query ( $con, $query );
	echo json_encode ( array (
			'status' => 'success',
			'id' => $uuid 
	) );
}
function create_message($con, $content) {
	$uuid = uniqid ();
	$query = "INSERT INTO message (id, content)
	VALUES ('$uuid', '$content')";
	mysqli_query ( $con, $query );
	return $uuid;
}
function exist_question($con, $qid) {
	$query = "SELECT id FROM poll_question WHERE id='$qid'";
	return mysqli_fetch_array ( mysqli_query ( $con, $query ) );
}
?>