<?
/**
*
* @Script Poll
* @version 1.0.0
* @copyright (c) Agrizlive.com
* @license You are allowed to modify this script. But you must provide a link of agrizlive.com in your footer (bottom of the page)
*
* Tested : PHP 5.2.11
*/

/**
*/

	include_once("db_config.php");
	include_once("poll/functions/polls.php");
	
	$id = $_REQUEST['id'];
	if(isset($_REQUEST['answers'])){
		$vote_id = $_REQUEST['answers'];
		updateVote($id,$vote_id);
		echo poll_frontend_result($id);
	}
	else{
		echo poll_frontend($id);
	}	
?>