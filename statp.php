<?php
set_include_path ( '.' );
require_once 'lib/survey_db.php';
require_once 'lib/session.php';
session_start ();

if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
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
	<input id='err' type='hidden' value='0' />
	<input id='sid' type='hidden'
		value='<?php echo isset ( $_GET ['id'] ) ? $_GET ['id']:'' ;?>' />
	<input id='rid' type='hidden'
		value='<?php echo isset ( $_GET ['responder'] ) ? $_GET ['responder']:'' ;?>' />


	<ul class="pager">
		<li class="previous"><a href="home.php"> &larr; Home</a></li>
	</ul>

	<div id='infov' class='container' style='display: none'>
		<h1 id='qt'></h1>
		<p id='ar'></p>
	</div>

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
</body>