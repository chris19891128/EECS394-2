<?
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Install Script</title>
<link rel="stylesheet" type="text/css" href="css/theme.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->
<style>
#loginbox{
	position: relative;
	margin: 0 auto;
	margin-top: 200px;
	width: 400px;
}
fieldset{
	border: 0;
}
</style>
</head>
<?
	if(isset($_REQUEST['submit']))
	{
		$host = $_REQUEST['host'];
		$user = $_REQUEST['user'];
		$password = $_REQUEST['pass'];
		$db = $_REQUEST['db'];
		$prefix = $_REQUEST['pre'];
		if($prefix != ""){$prefix = $prefix."_";}
		$link = mysql_connect($host,$user,$password);
		$db_link = mysql_select_db($db);
		
		if($host == "" || $user == "" || $db == "")
		{
			$status = "Fill all the fileds. Click back button in browser to go back to install page";
		}
		else if(!$link){
			$status = "Can't connect to mysql. Check details. Click back button in browser to go back to install page";
		}
		else if(!$db_link)
		{
			$status = "Can't connect to database. Check database details. Click back button in browser to go back to install page";
		}
		else
		{
			// Create Admin Table
			$query_1 = "CREATE TABLE IF NOT EXISTS ".$prefix."poll_admin (
						  `id` int(3) NOT NULL AUTO_INCREMENT,
						  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
						  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
			$result_1 = mysql_query($query_1);			
			// Create Question Table
			$query_2 = "CREATE TABLE IF NOT EXISTS ".$prefix."poll_choices (
						  `choices_id` int(11) NOT NULL AUTO_INCREMENT,
						  `choice_value` mediumtext COLLATE utf8_unicode_ci NOT NULL,
						  `votes` int(11) NOT NULL,
						  PRIMARY KEY (`choices_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
			$result_2 = mysql_query($query_2);				
			// Create Answer table
			$query_3 = "CREATE TABLE IF NOT EXISTS ".$prefix."poll_questions (
						  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
						  `poll_question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
						  `poll_status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
						  `poll_end_date` datetime NOT NULL,
						  `poll_choice_type` enum('text','image','flash') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'text',
						  `poll_is_multiple` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
						  PRIMARY KEY (`poll_id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
			$result_3 = mysql_query($query_3);			
			// Create question-answer table
			$query_4 = "CREATE TABLE IF NOT EXISTS ".$prefix."poll_question_choices (
						  `question_id` int(11) NOT NULL,
						  `choice_id` int(11) NOT NULL,
						  UNIQUE KEY `question_id` (`question_id`,`choice_id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
			$result_4 = mysql_query($query_4);			
			// Create IP Table
			$query_5 = "CREATE TABLE IF NOT EXISTS ".$prefix."voting_ip (
						  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
						  `id` int(5) NOT NULL,
						  UNIQUE KEY `ip` (`ip`,`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
			$result_5 = mysql_query($query_5);	

			$query_6 = "INSERT INTO ".$prefix."poll_admin (`id`, `user_name`, `password`) VALUES(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');";
			$result_6 = mysql_query($query_6);
			
			$db_file_name = "db_config.php";
			$fp = fopen($db_file_name,"r");
			$content = fread($fp,filesize($db_file_name));
			fclose($fp);
			
			//Create config file
			
			$content = str_replace("{HOST_NAME}","$host",$content);
			$content = str_replace("{DB_USER}","$user",$content);
			$content = str_replace("{DB_PASS}","$password",$content);
			$content = str_replace("{DB_NAME}","$db",$content);
			$content = str_replace("{T_PREFIX}","$prefix",$content);
			
			$fp = fopen($db_file_name,"w");
			fwrite($fp,$content);
			fclose($fp);

			$status = " - Installation is success. admin user: admin / admin password : admin<br /> Delete install.php without fail";
				
		}
	}
?>
<body>
	<div id="container">
    	<div id="header">
        	<h2>agrizlive.com</h2>
			<div id="topmenu">
            </div>
		</div>
        
		<div id="wrapper">   
			<div id="loginbox">
				
				<?
					if(!isset($_REQUEST['submit']))
					{
				?>
					
				<form action="" method="post" id="form">
				<p>
					You must delete your POLL version 1.0.0 files and tables<br />
					If you have trouble, make a comment under poll page
				</p>
					<fieldset>
					<legend>Database Details</legend>
						<p>
							<label>Host : </label>
							<input type="text" name="host" /> (ex: localhsot)
						</p>
						<p>
							<label>DB User : </label>
							<input type="text" name="user" />
						</p>
						<p>
							<label>DB Password : </label>
							<input type="text" name="pass" />
						</p>
						<p>
							<label>DataBase name : </label>
							<input type="text" name="db" />
						</p>
						<p>
							<label>Table Prefix : </label>
							<input type="text" name="pre" />(Leave blank if you are not sure)
						</p>
						<p>
							<input type="submit" name="submit" value="Install" />
						</p>
					</fieldset>
				</form>
				<?
					}
					else
					{
				?>
				<p>
					<?=$status;?>
				</p>
				<?	
					}
				?>
			</div>
		</div>
	</div>
</body>
</html>