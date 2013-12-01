<?php
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
		
		send_single_email ( $me, $token, $email, $subject, $content );
	}
}
/**
 *
 * @param unknown $me        	
 * @param unknown $token        	
 * @param unknown $email        	
 * @param unknown $survey_id        	
 */
function send_single_email($me, $token, $email, $subject, $content) {
	
}