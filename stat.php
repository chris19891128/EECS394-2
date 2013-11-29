<?php
set_include_path ( '.' );
require_once 'lib/survey_db.php';
require_once 'lib/session.php';
session_start ();

if (! isset ( $_GET ['id'] ) || ! isset ( $_GET ['responder'] )) {
	$err_num = 1;
} elseif ($_GET ['responder'] == get_survey_creator_by_id ( $_GET ['id'] ) || in_array ( $_GET ['responder'], get_survey_recipient_by_id ( $_GET ['id'] ) )) {
	$err_num = 0;
} else {
	$err_num = 2;
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
<script src="js/stat.js"></script>
</head>

<body>
	<input id='err' type='hidden' value='<?php echo $err_num;?>' />
	<input id='sid' type='hidden'
		value='<?php echo isset ( $_GET ['id'] ) ? $_GET ['id']:'' ;?>' />
	<input id='rid' type='hidden'
		value='<?php echo isset ( $_GET ['responder'] ) ? $_GET ['responder']:'' ;?>' />


	<div id='fv' class='container' style='display: none'>
		<p id='errStr'></p>
	</div>

	<div id='infov' class='container' style='display: none'>
		<h1 id='qt'></h1>
		<p id='ar'></p>
	</div>

	<div id='nav' class='container' style='display: none'>
		<ul class="nav nav-tabs">
			<li id='l1'><a href="#">Vote</a></li>
			<li id='l2' class="active"><a id='l2a'>Result</a></li>
		</ul>
	</div>

	<div id='vv' class='container' style='display: none'>
		<p>You can click on the bar chart to see who voted :)</p>
		<table class="table" id="stats_graph">
			<tr id='hidden_line' style='display: hidden'>
				<td></td>
				<td></td>
				<td></td>
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
			</tr>
		</table>
		<?php include ("footer.inc");?>
	</div>
</body>