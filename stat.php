<?php
set_include_path ( '.' );
require_once 'lib/survey_db.php';
require_once 'lib/session.php';
session_start ();
$existRespondant = "false";
$respondantError = "false";
/**
if (! isset ( $_GET ['id'] )) {
    echo 'Broken URL, Missing survey id or responder!';
    return;
} elseif ($_GET ['responder'] == get_survey_creator_by_id ( $_GET ['id'] ) || in_array ( $_GET ['responder'], get_survey_recipient_by_id ( $_GET ['id'] ) )) {
	$err_num = 0;
} else {
	$err_num = 2;
}
**/
    if (! isset ( $_GET ['id'] )) {
        echo 'Broken URL, Missing survey id or responder!';
        return;
            //no responder then judge as the initiator
    } elseif (! isset ($_GET ['responder'])){
        $userInfo = getFullUserInfo();
        $respondant = $userInfo['email'];
        $err_num = 3;
        //the home did not create that survey
        if($respondant != get_survey_creator_by_id ( $_GET ['id']))
            {
            $respondantError = "true";
            $err_num = 1;
            }
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
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript"
	src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script src="js/stat.js"></script>
</head>

<body>
	<input id='err' type='hidden' value='<?php echo $err_num;?>' />
<input id='exist' type='hidden' value='<?php echo $existRespondant;?>' />
	<input id='sid' type='hidden'
		value='<?php echo isset ( $_GET ['id'] ) ? $_GET ['id']:'' ;?>' />
	<input id='rid' type='hidden'
		value='<?php echo isset ( $_GET ['responder'] ) ? $_GET ['responder']:'' ;?>' />

	<div class="container" id="root" style="display: none">
        <!-- Panel for home button -->
        <div id='home' class='container' style='display: none'>
        <ul class="pager">
        <li class="previous"><a href="home.php">&larr; Home</a></li>
        </ul>
        </div>

		<!-- Panel for errors -->
		<div id='fv' class='container' style='display: none'>
			<p id='errStr'></p>
		</div>

		<!-- Panel for question and other recipients -->
		<div id='infov' class='container' style='display: none'>
			<h1 id='qt'></h1>
			<p id='ar'></p>
		</div>

		<!-- Panel for navigation -->
		<div id='nav' class='container' style='display: none'>
			<ul class="nav nav-tabs">
				<li id='l1'><a id='l1a' href="#">Vote</a></li>
				<li id='l2' class="active"><a id='l2a'>See Result</a></li>
                <li id='l3'><a id='l3a'>Track Respondants</a></li>
			</ul>
		</div>

		<!-- Stat data area -->
		<div id='vv' class='container' style='display: none'>
			<p>You can click on the bar chart to see who voted :)</p>
			<table class="table" id="stats_graph">
				<tr id='hidden_line' style='display: none'>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<div class="modal fade" id="voters_sample" tabindex="-1"
							role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"
											aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel"></h4>
									</div>
									<div class="modal-body">
										<div class="modal-footer"></div>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		<?php include ("footer.inc");?>
		</div>
	</div>
</body>