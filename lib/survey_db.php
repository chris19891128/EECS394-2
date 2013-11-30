<?php

/**
 *
 * @param unknown $survey_id        	
 * @return multitype:string multitype:string
 */
function get_survey_by_id($survey_id) {
	$link = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "select * from Poll where ID='$survey_id'";
	$result = mysqli_query ( $link, $query );
	$row = mysqli_fetch_array ( $result );
	
	if ($row) {
		$content = $row ['Content'];
		// echo $content;
		$json = json_decode ( $content, true );
	} else {
		echo mysqli_error ( $link );
		$json = NULL;
	}
	mysqli_close ( $link );
	
	return $json;
}

/**
 *
 * @param unknown $survey_id        	
 * @return multitype:string
 */
function get_survey_recipient_by_id($survey_id) {
	$link = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "select * from Poll where ID='$survey_id'";
	$result = mysqli_query ( $link, $query );
	$row = mysqli_fetch_array ( $result );
	
	if ($row) {
		$emails = $row ['recipient'];
		$json = json_decode ( $emails, true );
	} else {
		echo mysqli_error ( $link );
		$json = NULL;
	}
	mysqli_close ( $link );
	
	return $json;
}

/**
 *
 * @param unknown $survey_id        	
 */
function get_survey_responded_by_id($survey_id) {
	$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "SELECT * from Answer where Poll_ID='$_GET[id]'";
	$result = mysqli_query ( $mysql, $query );
	$responders = array ();
	while ( $row = mysqli_fetch_array ( $result ) ) {
		array_push ( $responders, $row ['Respondant'] );
	}
	return $responders;
}

/**
 *
 * @param unknown $survey_id        	
 * @return string
 */
function get_survey_creator_by_id($survey_id) {
	$link = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "select Creator from Poll where ID='$survey_id'";
	$result = mysqli_query ( $link, $query );
	$row = mysqli_fetch_array ( $result );
	if ($row) {
		$creator = $row ['Creator'];
	} else {
		echo mysqli_error ( $link );
		$creator = NULL;
	}
	mysqli_close ( $link );
	return $creator;
}

/**
 */
function get_survey_reply_by_id($survey_id) {
	$survey = get_survey_by_id ( $_GET ['id'] );
	$res = array ();
	for($i = 0; $i < count ( $survey ['answer'] ); $i ++) {
		$res [$i] = array ();
	}
	$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "SELECT * from Answer where Poll_ID='$_GET[id]'";
	$result = mysqli_query ( $mysql, $query );
	
	while ( $row = mysqli_fetch_array ( $result ) ) {
		$index = intval ( $row ['Answer'] );
		$res [$index] [count ( $res [$index] )] = $row ['Respondant'];
	}
	
	mysqli_close ( $mysql );
	$res = array (
			'answer' => $survey ['answer'],
			'reply' => $res 
	);
	return $res;
}

/**
 * Return all the survey under one's email
 *
 * @param unknown $email        	
 * @return multitype:
 */
function get_survey_ids_by_user($email) {
	$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "SELECT * from Poll where Creator='" . $email . "'";
	$result = mysqli_query ( $mysql, $query );
	
	$returned = array ();
	while ( $row = mysqli_fetch_array ( $result ) ) {
		$id = $row ['ID'];
		$survey = get_survey_by_id ( $id );
		array_push ( $returned, array (
				'id' => $id,
				'survey' => $survey 
		) );
	}
	mysqli_close ( $mysql );
	
	return $returned;
}

?>