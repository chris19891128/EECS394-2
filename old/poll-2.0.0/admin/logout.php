<?PHP
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/

		ob_start();
		session_start();
		
		unset($_SESSION['admin_account']);
		header("location: login.php");
?>