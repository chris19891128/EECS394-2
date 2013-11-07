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
	
	include_once("functions/functions_dashboard.php");
?>
<div id="rightnow">
	<h3 class="reallynow">
		<span>Right Now</span>
		<a href="http://www.agrizlive.com" class="app_add">Agriz Php Scripts</a>
		<a href="index.php?content=poll&value=add" class="add">Create Poll</a>
		<br />
	</h3>
	<p class="youhave">You have <b><?=getRightNow()?></b> Active polls</p>
</div>
<div id="infowrap">
</div>