<?

/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/

$db_host='{HOST_NAME}'; 		// DB Host

$db_user='{DB_USER}';		// DB Username

$db_pass='{DB_PASS}';		// DB Password

$db_name='{DB_NAME}';		// DB Name

define('TABLE_PREFIX','{T_PREFIX}');

$link = mysql_connect($db_host,$db_user,$db_pass);
$db = mysql_select_db($db_name,$link);
?>