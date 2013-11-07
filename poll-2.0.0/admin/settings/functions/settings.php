<?
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/


function changePassword($password)
{
	$query = "UPDATE ".TABLE_PREFIX."poll_admin SET password = '".md5($password)."' WHERE user_name = '".$_SESSION['admin_account']."'";
	$result = mysql_query($query);
	if($result){
		return " - Password updated successfully";
	}
	else {
		return " - Something went wrong. Try again";
	}
} 
?>