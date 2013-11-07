<?

/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/


function getRightNow()
{
	$query = "SELECT * FROM ".TABLE_PREFIX."poll_questions WHERE poll_status = 'active'";
	$result = mysql_query($query);
	
	return mysql_num_rows($result);
}
?>
