<?php
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
    
function get_survey_creator_by_id($survey_id)
{
    $link = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "select Creator from Poll where ID='$survey_id'";
    $result = mysqli_query ( $link, $query );
    $row = mysqli_fetch_array ( $result );
    if ($row) {
		$creator = $row ['recipient'];
	} else {
		echo mysqli_error ( $link );
		$creator = NULL;
	}
	mysqli_close ( $link );
	return $creator;
}
    
}

?>