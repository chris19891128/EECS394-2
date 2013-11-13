<?php
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/

if(!isset($_SESSION['admin_account']))
{
	header("Location:login.php"); exit;
}
?>