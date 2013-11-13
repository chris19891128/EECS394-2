<?

/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/


	ob_start();
	session_start();
	error_reporting(0);

	define("AGRIZ_FREE_SCRIPTS", "agrizlive.com");
	
	include_once("inc/loginCheck.php");
	include_once("db_config.php");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard - PHP POLL Script</title>
<link rel="stylesheet" type="text/css" href="css/theme.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var strHref = window.location.href;
	var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
	var strQueryString = strHref.substr(strHref.indexOf("=")).toLowerCase();
	
	var aQueryString = strQueryString.split("&");
	var strClassName = aQueryString[0].substr(1);
	
	
	if(strClassName == "")
	{
		strClassName = "home";
	}
</script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->
</head>
<?
	include_once("inc/content.php");
?>
<body>
	<div id="container">
    	<div id="header">
        	<h2>Agrizlive.com | Free PHP Poll Script</h2>
    <div id="topmenu">
            	<ul class="topMenuUL">
                	<li class="current home"><a href="index.php">Dashboard</a></li>
					<li class="poll"><a href="index.php?content=poll">Poll</a></li>
					<li class="settings"><a href="index.php?content=settings">Settings</a></li>
					<li><a href="logout.php">Logout</a></li>
              </ul>
          </div>
      </div>
        <div id="top-panel">
            <div id="panel">
                <?
					include_once($subMenu);
				?>
            </div>
      </div>
        <div id="wrapper">
            <div id="content">
       			<?
					include_once($loading_page);
				?>
            </div>
            <?
				include_once("right.php");
			?>
      </div>
        <div id="footer">
        <div id="credits">
   		Script by <a href="http://www.agrizlive.com">Agriz PHP Script</a>
        </div>
        <br />

        </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('.topMenuUL li').each(function(el){
		$(this).removeClass('current');
	}); 
	
	$('.'+strClassName).addClass('current');
	
	
	
	$('.topMenuUL li a').each(function(el){
		$(this).mouseover(function(){
			$(this).parent().addClass('current');
		});
		$(this).mouseout(function(){
			if($(this).parent().hasClass(strClassName))
			{
				//do nothing
			}
			else
			{
				$(this).parent().removeClass('current');
			}	
		});
	});
});
</script>
</body>
</html>
