<?
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/


function addNewPoll($poll_title,$poll_options,$poll_type,$poll_option_type,$end_date)
{
	$query = "INSERT INTO ".TABLE_PREFIX."poll_questions(poll_question,poll_end_date,poll_choice_type,poll_is_multiple) VALUES('".addslashes($poll_title)."','".$end_date."','".$poll_option_type."','".$poll_type."')";
	$result = mysql_query($query);
	
	$poll_last_id = mysql_insert_id();
	
	$poll_options = explode("<br />",nl2br($poll_options));
	foreach($poll_options as $poll_choices)
	{
		if(trim($poll_choices) != ""){
			$query_choices = "INSERT INTO ".TABLE_PREFIX."poll_choices(choice_value) VALUES('".addslashes(trim($poll_choices))."')";
			$result_choices = mysql_query($query_choices);
			$choice_last_id = mysql_insert_id();
		
			$query_q_c = "INSERT INTO ".TABLE_PREFIX."poll_question_choices(question_id,choice_id) VALUES($poll_last_id,$choice_last_id)";
			$result_q_c = mysql_query($query_q_c);
		}	
	}	
	
	return " - Poll Created Successfully";
}

function getPolls($start,$end)
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_questions LIMIT $start,$end";
	$result = mysql_query($query);
	
	return $result;
}


function getTotalPolls()
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_questions";
	$result = mysql_query($query);
	
	return mysql_num_rows($result);
}

function getPollChoices($id)
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_choices INNER JOIN ".TABLE_PREFIX."poll_question_choices ON choices_id = choice_id WHERE question_id = $id";
	$result = mysql_query($query);
	
	return $result;
}

function editPollOptions($option_value,$votes,$options_id)
{
	$count = count($option_value);
	
	for($i=0;$i<$count;$i++)
	{
		$query = "UPDATE ".TABLE_PREFIX."poll_choices SET choice_value = '".addslashes($option_value[$i])."', votes='".$votes[$i]."' WHERE choices_id = '".$options_id[$i]."'";
		$result = mysql_query($query);
	}
}

function getPollByID($id)
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_questions WHERE poll_id = $id";
	$result = mysql_query($query);
	$value = mysql_fetch_array($result);
	
	return $value;
}

function editPoll($poll_title,$poll_type,$poll_option_type,$end_date,$id)
{
	$query = "UPDATE ".TABLE_PREFIX."poll_questions SET poll_question = '".addslashes($poll_title)."', poll_end_date = '".$end_date."',poll_choice_type = '".$poll_option_type."',poll_is_multiple ='".$poll_type."' WHERE poll_id = $id";
	$result = mysql_query($query);
}

function deletePoll($id)
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_question_choices WHERE question_id = $id";
	$result = mysql_query($query);
	while($value = mysql_fetch_array($result))
	{
		$query_c_delete = "DELETE FROM ".TABLE_PREFIX."poll_choices WHERE choices_id = '".$value['choice_id']."'";
		mysql_query($query_c_delete);
	}
	
	$query_q_c = "DELETE FROM ".TABLE_PREFIX."poll_questions WHERE poll_id = $id";
	mysql_query($query_q_c);
	
	$query_q = "DELETE FROM ".TABLE_PREFIX."poll_question_choices WHERE question_id = $id";
	mysql_query($query_q);
	
	return "Delete successfully";
}

function display_poll($id)
{
	$poll =  poll_frontend($id);
	return $poll;
}

function lastest_poll()
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_questions ORDER BY poll_id DESC LIMIT 1";
	$result = mysql_query($query);
	$value = mysql_fetch_array($result);
	
	return poll_frontend($value['poll_id']);
}

function random_poll()
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_questions ORDER BY RAND() LIMIT 1";
	$result = mysql_query($query);
	$value = mysql_fetch_array($result);
	
	return poll_frontend($value['poll_id']);
}

function poll_frontend_result($id)
{
	$value_question = getPollByID($id);
	$result_answer = getPollChoices($id);
	$total = 0;
	$max = 0;
	while($value_poll_answer = mysql_fetch_array($result_answer))
	{
		$total += $value_poll_answer['votes'];
		if($value_poll_answer['votes'] > $max)
		{
			$max = $value_poll_answer['votes'];
		}
		$poll_answers[] = stripslashes($value_poll_answer['choice_value']);
		$votes[] = $value_poll_answer['votes'];
	}
	$count = count($poll_answers);
	$html = '';
	$html .= '<div class="agriz_poll_ans agriz_poll">';
		$html .= '<p class="agriz_poll_heading">'.stripslashes($value_question['poll_question']).'</p>';
		$html .= "<ul class='agriz_poll_container'>";
			for($i = 0;$i < $count;$i++)
			{
				if($value_question['poll_choice_type'] == 'text'){
					$poll_choice[$i] = stripslashes($poll_answers[$i]);
				}
				else if($value_question['poll_choice_type'] == 'image'){
					$poll_choice[$i] = "<img align='top' src=".stripslashes($poll_answers[$i])." />";
				}
				else{
					
				}
				if($votes[$i] == 0) { $percentage = 0; } else { $percentage = round(($votes[$i] / $total) * 100);}
				if($votes[$i] == $max){$style = 'font-weight: bold'; $additional_class = 'agriz_deep_result'; $max = -1;}else{$style = ''; $additional_class = 'agriz_normal_result';}
				$html .= "<li class='agriz_poll_answer'>";
					$html .= "<div class='agriz_option' style='$style'>".$poll_choice[$i]."</div>";
					$html .= "<div class='agriz_poll_result $additional_class' style='width: ".$percentage."px;'>&nbsp;</div>";
					$html .= "<div class='agriz_poll_votes'>".$percentage."% (".$votes[$i].")</div>";
					$html .= '<div style="clear: both;" class="clear"></div>';
				$html .= "</li>";
			}
		$html .= "</ul>";
		$html .= "<p class='poweredby' style='clear:both;font-size: 11px;padding: 3px;'><i>Powered by <a href='http://www.agrizlive.com' style='text-decoration: none;font-size: 11px'><b>Agriz Poll</b></a></i></p>";
	$html .= '</div>';
	return $html;
}

function poll_frontend($id)
{
	$value_question = getPollByID($id);
	$result_answer = getPollChoices($id);
	
	if($value_question['poll_id'] == "") {return;}
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$find = voting_ip($ip,$id);
	
	if($value_question['poll_is_multiple'] == "yes")
	{
		$type = "checkbox";
	}
	else
	{
		$type = "radio";
	}
	if($value_question['poll_end_date'] != '0000-00-00 00:00:00' && $value_question['poll_end_date'] != ''){
		$end_date = strtotime($value_question['poll_end_date']);
		$today = strtotime(date("Y-h-d h:i:s"));
		
		if($today > $end_date){
			return poll_frontend_result($id);
		}
	}
	if($find){return poll_frontend_result($id);}
	else{	
	$html = '';
	$html .= '<div class="agriz_poll agriz_poll_question_'.$id.'">';
		$html .= '<form action="admin/showresults.php?id='.$id.'" id="agriz_poll_form_'.$id.'">';
		$html .= '<p class="agriz_poll_heading">'.stripslashes($value_question['poll_question']).'</p>';
		$html .= "<ul class='agriz_poll_container'>";
			while($value_poll_answer = mysql_fetch_array($result_answer))
			{
				if($value_question['poll_choice_type'] == 'text'){
					$poll_choice = stripslashes($value_poll_answer['choice_value']);
				}
				else if($value_question['poll_choice_type'] == 'image'){
					$poll_choice = "<img align='top' src=".stripslashes($value_poll_answer['choice_value'])." />";
				}
				else{
					
				}
				$html .= "<li class='agriz_poll_answer'>";
					$html .= "<div class='agriz_option'><input type='$type' name='answers[]' value='".$value_poll_answer['choices_id']."' class='voting' />".$poll_choice."</div>";
					$html .= '<div style="clear: both;" class="clear"></div>';
				$html .= "</li>";
			}
		$html .= "</ul>";
		$html .= "<input type='submit' value='Vote!' />";
		$html .= "</form>";
		$html .= "<p class='poweredby' style='clear:both;font-size: 11px;padding: 3px;'><i>Powered by <a href='http://www.agrizlive.com' style='text-decoration: none;font-size: 11px'><b>Agriz Poll</b></a></i></p>";
	$html .= '</div>';
	$html .= "<script type='text/javascript'>
	$(document).ready(function() {
		$('#agriz_poll_form_$id').submit(function() {
			$(this).ajaxSubmit({
				beforeSubmit: function(before) {},
				success: function(d) {
					$('.result').html(d);
					$('.agriz_poll_question_$id').html(d);
				}
			}); 
			return false;
		});			
	});
</script>";
	return $html;
	}
}



function voting_ip($ip,$id)
{
	$query = "SELECT * FROM ".TABLE_PREFIX."voting_ip WHERE ip = '".$ip."' AND id = '$id'";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) >= 1){
		return true;
	}
	else {
		return false;
	}
}
function updateVote($id,$ans)
{
	foreach($ans as $c_id){
		$query = "UPDATE ".TABLE_PREFIX."poll_choices SET votes = votes +1 WHERE choices_id = $c_id";
		$result = mysql_query($query);
	}	
	
	//Update ip
	$ip = $_SERVER['REMOTE_ADDR'];
	$query = "INSERT INTO ".TABLE_PREFIX."voting_ip(ip,id) VALUES('$ip',$id)";
	$result = mysql_query($query);
	
}
?>