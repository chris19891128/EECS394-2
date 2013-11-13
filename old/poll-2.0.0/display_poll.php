<?php

$title = "Demo : PHP Poll Script | Free Poll Script using PHP";

$keyword = "";

$description = "see the demo of php poll script and download this script for free";
	include_once("../../header.php");
	include_once("admin/db_config.php");
	include_once("admin/poll/functions/polls.php");
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.form.min.js"></script>
<link href="poll_style.css" type='text/css' rel="stylesheet" />
<div id="wrapper">
	<div class="post">
    	<br />
		<?
			echo random_poll();
		?>
    </div>
</div>

<?php
	include_once("../../right.php");
?>
<?php
	include_once("../../footer.php");
?>       
