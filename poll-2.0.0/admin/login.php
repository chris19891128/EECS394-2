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
<title>Login</title>
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

<body>
	<div id="container">
    	<div id="header">
        	<h2>agrizlive.com</h2>
			<div id="topmenu">
            </div>
		</div>
        
		<div id="wrapper">      
			<div id="loginbox">
				<form action="login_action.php" action="post" id="form">
					<fieldset>
					<legend>Login</legend>
						<p>
							<label>Username : </label>
							<input type="text" name="username" />
						</p>
						<p>
							<label>Password : </label>
							<input type="password" name="password" />
						</p>
						<p>
							<input type="submit" name="submit" value="login" />
						</p>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
