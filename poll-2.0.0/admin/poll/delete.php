<?
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/

	if(defined('AGRIZ_FREE_SCRIPTS') && AGRIZ_FREE_SCRIPTS == 'agrizlive.com'){
	}
	else{
		exit;
	}
	include_once("functions/polls.php");
	$status = deletePoll($_REQUEST['id']);
?>
<div id="box">
	<h3><?=$status?></h3>
	<p>
		<a href="javascript: history.go(-1)">Go Back</a>
	</p>
</div>	