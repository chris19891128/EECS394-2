<?php
set_include_path ( '.' );
require_once 'lib/survey_db.php';
require_once 'lib/session.php';
session_start ();

$userInfo = null;

if (! isset ( $_GET ['id'] )) {
	// no survey_id
	echo 'Broken URL, Missing survey id or responder!';
	return;
} elseif (! isset ( $_GET ['responder'] ) && ($userInfo = getFullUserInfo ()) == false) {
	// no responder and not logged in
	header ( 'location: login.php' );
} elseif (! isset ( $_GET ['responder'] ) && $userInfo ['email'] == get_survey_creator_by_id ( $_GET ['id'] )) {
	$respondant = $userInfo ['email'];
	if (in_array ( $userInfo ['email'], get_survey_responded_by_id ( $_GET ['id'] ) )) {
		// Logged in user is the creator and responded before
		$err_num = 1;
	} else {
		// Logged in user is the creator and did not respond before
		$err_num = 2;
	}
} elseif (! isset ( $_GET ['responder'] )) {
	echo 'You are not the owner of this poll';
	return;
} elseif (! in_array ( $_GET ['responder'], get_survey_recipient_by_id ( $_GET ['id'] ) )) {
	// Custom user and not authorized
	echo 'You have no authentication to see this poll';
	return;
} elseif (in_array ( $_GET ['responder'], get_survey_responded_by_id ( $_GET ['id'] ) )) {
	// Custom user authorized but replied
	$existRespondant = "true";
	$err_num = 3;
} else {
	$existRespondant = "true";
	$err_num = 0;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>iMDown</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="js/answer.js"></script>
</head>

<body>
	<input id='err' type='hidden' value='<?php echo $err_num;?>' />
	<input id='sid' type='hidden'
		value='<?php echo isset ( $_GET ['id'] ) ? $_GET ['id']:'' ;?>' />
	<input id='rid' type='hidden'
		value='<?php echo isset ( $_GET ['responder'] ) ? $_GET ['responder'] : $respondant ;?>' />

	<div class="container" id="root" style="display: none">

		<!-- Panel for home button -->
		<div id='home' class='container' style='display: none'>
			<ul class="pager">
				<li class="previous"><a href="home.php">&larr; Home</a></li>
			</ul>
		</div>

		<!-- Panel for question and other recipients display -->
		<div id='infov' class='container' style='display: none'>
			<h1 id='qt'></h1>
			<p id='ar'></p>
		</div>

		<!-- Panel for navigation -->
		<div id='nav' class='container'>
			<ul class="nav nav-tabs">
				<li id='l1' class="active"><a href="#">Vote</a></li>
				<li id='l2'><a id='l2a' href="">See Result</a></li>
				<li id='l3'><a id='l3a' href="">Track Respondants</a></li>
			</ul>
		</div>

		<!-- Panel for voting -->
		<div id='vv' class='container' style='display: none'>
			</br>
			<form id='vf'></form>
		</div>
		<?php include ("footer.inc");?>
	</div>
</body>

</html>