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
	include_once("functions/settings.php");
	$status = "";
	if(isset($_REQUEST['submit']))
	{
		$password = $_REQUEST['password'];
		$password_1 = $_REQUEST['re-password'];
		if($password == "" || $password_1 == ""){
			$status = " - Passowrds should not be empty";
		}
		else if($password != $password_1){
			$status = " - Passowrds dont match";
		}
		else{
			$status = changePassword($password);
		}	
	}
?>	

<div id="box">
	<h3 id="adduser">Change Password <?=$status?></h3>
	<form id="form" action="" method="post">
		<fieldset id="personal">
			<legend>Password Change</legend>
			<p>
				<label for="title">Password</label>
				<input type="password" name="password" value="" />
			</p>
			<p>
				<label for="title">Re-Password</label>
				<input type="password" name="re-password" value="" />
			</p>
		</fieldset>
		<div align="center">
			<input id="button1" type="submit" value="Send" name="submit" /> 
			<input id="button2" type="reset" />
		</div>
	</form>		
</div>	