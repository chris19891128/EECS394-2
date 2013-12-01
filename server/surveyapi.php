<?php
/**
 * This is the API for all google related service.
 * This script encapsulate all the google api details.
 * There are two approaches to call this api.
 *
 * All api calls will return the json encoded string ! Decode it first before usage
 *
 * (1) BaseUrl/server/surveyapi.php?f=survey&id=xxx
 * 	   return survey in 
 * 		{'question' => 'xxxx',
 * 		'answer' => ['opt1', 'opt2'... ]
 * 		}
 * 
 * (2) BaseUrl/server/surveyapi.php?f=recipient&id=xxx
 * 	   Return array of email addresses which are recipients by now
 * 		['a@gmail.com', 'b@gmail.com'];
 * 
 * (3) BaseUrl/server/surveyapi.php?f=creator&id=xxx
 * 		Return single string of the survey creator email address
 * 
 * (4) BaseUrl/server/surveyapi.php?f=responder&id=xxx
 * 	   Return array of email addresses which are recipients who has responded
 * 		['a@gmail.com', 'b@gmail.com'];
 * 
 * (5) BaseUrl/server/surveyapi.php?f=result&id=xxx
 * 	   Return array containing answers in sequence and corresponding responders
 * 		{'answer' => ['opt1','opt2'...]
 * 		 'reply => [ ['a@gmail.com', 'b@gmail.com'],
 * 					 ['e@gmail.com', 'd@gmail.com'],
 * 					 []
 * 					]
 * 		}
 * 
 * (6) BaseUrl/server/surveyapi.php?f=history
 * 	   Return the list of surveys created by the current logged in user. No id needed
 * 		['aaaa', 'bbbb' ...]
 * 
 */
set_include_path ( '..' );
require_once 'lib/all_error.php';
require_once 'lib/survey_db.php';
require_once 'lib/session.php';

session_start ();

if (isset ( $_GET ['f'] )) {
	if ($_GET ['f'] == 'survey') {
		echo json_encode ( get_survey_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'recipient') {
		echo json_encode ( get_survey_recipient_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'creator') {
		echo get_survey_creator_by_id ( $_GET ['id'] );
	} else if ($_GET ['f'] == 'responders') {
		echo json_encode ( get_survey_responded_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'result') {
		echo json_encode ( get_survey_reply_by_id ( $_GET ['id'] ) );
	} else if ($_GET ['f'] == 'history') {
		$user = getFullUserInfo ();
		$email = $user ['email'];
		echo json_encode ( get_survey_ids_by_user ( $email ) );
	}
}

?>