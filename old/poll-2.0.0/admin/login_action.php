<?
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/

ob_start();
session_start();
include_once("db_config.php");

$username = addslashes($_REQUEST['username']);
$password = $_REQUEST['password'];

$query = "SELECT * FROM ".TABLE_PREFIX."poll_admin WHERE user_name = '".$username."' AND password = '".md5($password)."'";
$result = mysql_query($query);

if(mysql_num_rows($result) > 0)
{
	$_SESSION['admin_account'] = $username;
	header("location: index.php");
}
else
{
	header("location: login.php");
}
?>