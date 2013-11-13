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
	
	$path = "";
	if(isset($_REQUEST['content']) && $_REQUEST['content'] != "")
	{
		if(isset($_REQUEST['value']) && $_REQUEST['value'] != "")
		{
			$loading_page = $path.$_REQUEST['content']."/".$_REQUEST['value'].".php";
		}
		else
		{
			$loading_page = $path.$_REQUEST['content']."/index.php";
		}	
		$subMenu = $_REQUEST['content']."/submenu.php";
	}
	else
	{
		$loading_page = "default.php";
		$subMenu = "submenu.php";
	}
?>