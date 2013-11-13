<?php
// $survey_id = $_GET ['id'];
// $survey = get_survey_by_id ( $survey_id );
// echo $survey ['question'];
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
?>
