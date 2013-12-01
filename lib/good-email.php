<?php
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/session.php';
session_start ();

$accessToken = getAccessToken ();
echo 'haha' . $accessToken;
// send_good_email ( 'chris19891128@gmail.com', $accessToken, [
// 'chris1989apply@gmail.com',
// 'chaoshi2012@u.northwestern.edu'
// ], '187e' );

/**
 *
 * @param unknown $me        	
 * @param unknown $token        	
 * @param unknown $emails        	
 * @param unknown $survey_id        	
 */
function send_good_email($me, $token, $emails, $survey_id) {
	foreach ( $emails as $email ) {
		// subject
		$subject = 'You have a new Poll';
		
		// email content
		$cur_url = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['PHP_SELF'];
		$url = dirname ( dirname ( $cur_url ) ) . '/answer.php?id=' . $survey_id . '&responder=' . $email;
		$content = "Please complete the poll through link " . $url;
		
		if (! send_single_email ( $me, $token, $email, $subject, $content )) {
			return false;
		}
	}
	return true;
}
/**
 * This function contains harded coded functions
 *
 * @param unknown $me        	
 * @param unknown $token        	
 * @param unknown $email        	
 * @param unknown $survey_id        	
 */
function send_single_email($me, $token, $email, $subject, $content) {
	$properties = parse_ini_file ( './res/path.properties' );
	if (! $properties) {
		return false;
	}
	
	$java_home = $properties ['java_home'];
	$path = "$JAVA_HOME/bin:/usr/local/bin:/usr/bin:/bin";
	
	putenv ( "JAVA_HOME=$java_home" );
	putenv ( "PATH=$path" );
	
	$exe = 'java -jar ./java/SMTP/out/send_email.jar ' . $me . ' ' . $token . ' ' . $email . ' "' . $subject . '" "' . $content . '" 2>&1';
	exec ( $exe, $out );
	if ($out [count ( $out ) - 1] == 'Successfully sent out') {
		return true;
	} else {
		return false;
	}
}
?>