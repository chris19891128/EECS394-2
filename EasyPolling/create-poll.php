<?php
require_once 'lib/all_error.php';
session_start ();

if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}

if ($_POST) {
	$mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
	$query = "INSERT INTO Poll VALUES('" . $_POST ['id'] . "', '" . json_encode ( $_POST ['data'] ) . "')";
	if ($updateDb = $mysql->query ( $query ) or die ( $mysql->error )) {
		echo 'success';
	}
} else {
	echo '
<!doctype html>
<head>
<meta charset="utf-8">

<title>Easy Polling</title>
<meta name="description" content="Test Project">
<meta name="viewport" content="width=device-width">
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<input id="meEmail" type="hidden" value="' . $_SESSION ['google_user'] ['email'] . '"></input>
	<input id="meName" type="hidden" value="' . $_SESSION ['google_user'] ['name'] . '"></input>
	
	<div class="container">		
		<form action="" method="" id="create">
			<div id="options">
				<div class="form-group" id="recipient-group">
					<label for="recepients">To:</label> <input type="text"
						class="form-control" id="recepient"
						placeholder="Email list here separated by comma" />
				</div>
				<div class="form-group" id="question-group">
					<label for="question">Question:</label> <input type="text"
						class="form-control" id="question"
						placeholder="Enter your question here" />
				</div>
				<div class="form-group" id="option-group">
					<div class="form-group">
						<label for="option_1_input">Option 1:</label> 
						<input type="text" class="form-control" id="option_1_input" placeholder="" />
					</div>
					<div class="form-group">
						<label for="option_2_input">Option 2:</label> 
						<input type="text" class="form-control" id="option_2_input" placeholder="" />
					</div>
				</div>
			</div>
			<button type="button" class="btn btn-default" onclick="addOption()">Add
				Option</button>
			<button type="button" class="btn btn-default" onclick="newPoll()">Make
				a Poll</button>
		</form>
		
		<form class="form-inline" role="form" id="success">
			<p>And you can see the result of your poll here:</p>
			<div class="form-group">
				<input type="text" class="form-control" id="statUrl" />
			</div>
		</form>

		<footer>- EasyPolling, Powered by the Orange Team, EECS394 2013</footer>
	</div>
				
	<script type="text/javascript"
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript"
		src="http://www.parsecdn.com/js/parse-1.2.12.min.js"></script>
	<script type="text/javascript"
		src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript"
		src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.4.1/less.min.js"></script>
	<script type="text/javascript" src="js/site.js"></script>
</body>
</html>';
}
// <p>Congrats! Your poll has been created. Copy this url to share with
// your friends!</p>
// <div class="form-group">
// <input type="text" class="form-control" id="answerUrl" />
// </div>
?>

