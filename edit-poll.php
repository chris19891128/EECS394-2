<?php
require_once 'lib/all_error.php';
require_once 'lib/session.php';

session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
} elseif (! isset ( $_GET ['id'] )) {
	echo 'Invalid url, missing survey id';
	return;
}
?>

<!doctype html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>iMDown</title>
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<!-- my script -->
<script type="text/javascript" src="js/edit.js"></script>

<!-- Select 2 Library -->
<link href="lib/select2-3.4.5/select2.css" rel="stylesheet" />
<script src="lib/select2-3.4.5/select2.js"></script>
</head>

<body>
	<input id='sid' type='hidden' value='<?php echo $_GET ['id'];?>' />

	<div class="container" id="root" style="display: none">
		<!-- Home -->
		<ul class="pager">
			<li class="previous"><a href="home.php"> &larr; Home</a></li>
		</ul>

		<!-- Main form for creating poll -->
		<form action="post-create-poll.php" method="" id="create">
			<div id="poll">

				<!-- Existing Recipients -->

				<!-- Recipients -->
				<div class="form-group" id="recipient-group">
					<label for="recipient">To:</label> <input type="hidden"
						class="form-control" id="recipient" />
					<p>
						<select multiple name="e1" id="e1" style="width: 500px"
							class="populate">
						</select>
					</p>
				</div>

				<!-- Question -->
				<div class="form-group" id="question-group">
					<label for="question">Question:</label> <input type="text"
						class="form-control" id="question" readonly />
				</div>

				<!-- Options -->
				<div class="form-group" id="option-group"></div>
			</div>

			<!-- Control buttons -->
			<div class="form-group">
				<button type="submit" class="btn btn-default">Send to More People</button>
				<div class="formgroup" id="spinDiv" style="display: inline-block"></div>
			</div>
		</form>
		<?php include ("footer.inc");?>
	</div>
</body>
</html>
