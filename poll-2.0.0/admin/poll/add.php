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
	if(isset($_REQUEST['submit']) && !isset($_REQUEST['id']))
	{
		$poll_title = $_REQUEST['title'];
		$poll_options = $_REQUEST['choices'];
		$poll_type = (isset($_REQUEST['type'])) ? 'yes' : 'no';
		$poll_option_type = $_REQUEST['choice_type'];
		$end_date = $_REQUEST['end_date'];
		if($poll_title == "" || $poll_options == ""){
			$status = " - Poll Title and Poll Choices should not be blank";
		}
		else{
			$status = addNewPoll($poll_title,$poll_options,$poll_type,$poll_option_type,$end_date);
		}	
	}
	
	if(isset($_REQUEST['submit']) && isset($_REQUEST['id']))
	{
		$poll_title = $_REQUEST['title'];
		$poll_type = (isset($_REQUEST['type'])) ? 'yes' : 'no';
		$poll_option_type = $_REQUEST['choice_type'];
		$end_date = $_REQUEST['end_date'];
		if($poll_title == ""){
			$status = " - Poll Title should not be blank";
		}
		else{
			$status = editPoll($poll_title,$poll_type,$poll_option_type,$end_date,$_REQUEST['id']);
		}	
	}
	
	
	if(isset($_REQUEST['id']) && $_REQUEST['id'] != ''){
		$value_poll = getPollByID($_REQUEST['id']);
		$poll_title = $value_poll['poll_question'];
		$poll_type = $value_poll['poll_choice_type'];
		$poll_option_type = $value_poll['poll_is_multiple'];
		$end_date =  $value_poll['poll_end_date'];
	}
?>
<div id="box">
	<h3 id="adduser">Add Poll <?=$status?></h3>
	<form id="form" action="" method="post">
		<fieldset id="personal">
			<legend>INFORMATION</legend>
			<p>
				<label for="title">Poll Title</label>
				<input type="text" name="title" value="<?=stripslashes($poll_title)?>" maxlength="255" style="width: 500px"/>
			</p>
			<?
				if(!isset($_REQUEST['id']))
				{
			?>
			<p>
				<span style="color: red">Choices in new line * Maximum 10 choices</span>
				<label for="choices">Poll Choices (One by One)</label>
				<textarea name="choices"></textarea>
			</p>
			<?
				}
			?>
			<p>
				<label for="type">Poll Type</label>
				<input type="checkbox" name="type" value="multiple" <?if(isset($poll_option_type) && $poll_option_type == 'yes'){?>checked="checked"<?}?> /> Allow Multiple Voting
			</p>
			<p>
				<label>Poll Choice Type</label>
				<input type="radio" name="choice_type" value="text" checked="checked" /> Simple Text
				&nbsp;<input type="radio" name="choice_type" value="image" <?if(isset($poll_type) && $poll_type == 'image'){?>checked="checked"<?}?> /> Images
			</p>
			<p>
				<label>Poll End Date</label>
				<input type="text" name="end_date" value="<?if($end_date != "" && $end_date != '0000-00-00 00:00:00'){echo date("Y-m-d",strtotime($end_date));}?>" /> (yyyy-mm-dd) ex : 2010-02-12 - Leave blank if there is no ending date
			</p>
		</fieldset>
		<div align="center">
			<input id="button1" type="submit" value="Send" name="submit" /> 
			<input id="button2" type="reset" />
		</div>
	</form>		
</div>	