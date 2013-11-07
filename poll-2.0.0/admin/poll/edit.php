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
	$status = "";
	if(isset($_REQUEST['submit']))
	{
		$option_value = $_REQUEST['option_value'];
		$votes = $_REQUEST['votes'];
		$options_id = $_REQUEST['options_id'];

		$status = editPollOptions($option_value,$votes,$options_id);
	}
	
	$result_poll_choices = getPollChoices($_REQUEST['id']);
?>
<div id="box">
	<h3 id="adduser">Edit Poll Chocies <?=$status?></h3>
	<form id="form" action="" method="post">
		<?
		$i = 0;
		while($value = mysql_fetch_array($result_poll_choices))
		{
			$i++;
		?>
		<fieldset>
			<legend>Choice <?=$i?></legend>
			<p>
				<label for="type">Option Value</label>
				<input type="text" name="option_value[]" value="<?=stripslashes($value['choice_value'])?>" />
			</p>
			<p>
				<label for="type">Vote (Fake it :))</label>
				<input type="text" name="votes[]" value="<?=stripslashes($value['votes'])?>" />
				<input type="hidden" name="options_id[]" value="<?=$value['choices_id']?>" />
			</p>			
		</fieldset>
		<?
		}
		?>	
		<div align="center">
			<input id="button1" type="submit" value="Send" name="submit" /> 
			<input id="button2" type="reset" />
		</div>
	</form>		
</div>	