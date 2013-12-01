
    <?php
        set_include_path ( '.' );
        require_once 'lib/survey_db.php';
        require_once 'lib/session.php';
        session_start ();
        if (! isset ( $_SESSION ['token'] ))
        {
        header ( 'location: login.php' );
        }
        $respondantError = "false";
        $existRespondant = "false";
            //no survey_id
        if (! isset ( $_GET ['id'] )) {
            echo 'Broken URL, Missing survey id or responder!';
            return;
                //no responder then judge as the initiator
        } elseif (! isset ($_GET ['responder'])){
            $userInfo = getFullUserInfo();
            $respondant = $userInfo['email'];
            echo($respondant);
            $err_num = 0;
                //the home did not create that survey
            if($respondant != get_survey_creator_by_id ( $_GET ['id']))
                {
                $respondantError = "true";
                    //echo($respondantError);
                $err_num = 1;
                }
            echo 'repondantError: '.($respondantError);
                //not the recipient of the survey
        } elseif (! in_array ( $_GET ['responder'], get_survey_recipient_by_id ( $_GET ['id'] ) )) {
            $existRespondant = "true";
            echo 'You have no authentication to see this poll';
            return;
        } elseif (in_array ( $_GET ['responder'], get_survey_responded_by_id ( $_GET ['id'] ) )) {
            $existRespondant = "true";
            echo ('You have already voted');
            $err_num = 2;
        } else {
            $existRespondant = "true";
            $err_num = 0;
            echo ($existRespondant);
        }
    /**
set_include_path ( '.' );
require_once 'lib/survey_db.php';

if (! isset ( $_GET ['id'] ) || ! isset ( $_GET ['responder'] )) {
	echo 'Broken URL, Missing survey id or responder!';
	return;
} elseif ($_GET ['responder'] == get_survey_creator_by_id ( $_GET ['id'] )) {
	$err_num = 1;
} elseif (! in_array ( $_GET ['responder'], get_survey_recipient_by_id ( $_GET ['id'] ) )) {
	echo 'You have no authentication to see this poll';
	return;
} elseif (in_array ( $_GET ['responder'], get_survey_responded_by_id ( $_GET ['id'] ) )) {
	$err_num = 2;
} else {
	$err_num = 0;
}
**/
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
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
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
		value='<?php echo isset ( $_GET ['responder'] ) ? $_GET ['responder']:'' ;?>' />

	<div class="container" id="root" style="display: none">

		<!-- Panel for question and other recipients display -->
		<div id='infov' class='container' style='display: none'>
			<h1 id='qt'></h1>
			<p id='ar'></p>
		</div>

		<!-- Panel for navigation -->
		<div id='nav' class='container' style='display: none'>
			<ul class="nav nav-tabs">
				<li id='l1' class="active"><a href="#">Vote</a></li>
				<li id='l2'><a id='l2a'>See Result</a></li>
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