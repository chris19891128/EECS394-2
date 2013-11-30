<?php
set_include_path ( '.' );
require_once 'lib/all_error.php';
?>

<!doctype html>
<head>
<meta charset="utf-8">
<title>iMDown</title>
<meta name="description" content="Test Project">
<meta name="viewport" content="width=device-width">
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">
	$(function() {
		$.ajax({
			type : "GET",
			url : 'server/googleapi.php?f=user',
			success : function(data) {
				user = $.parseJSON(data);
				if (user === false) {
					$('#h1').text('Welcome Customer!');
					$('#log').html('Log In').attr('formaction', 'login.php');
					$('#create').html('See demo').attr('formaction',
							'create-poll.php?demo');
					$('#history').hide();
				} else {
					$('#h1').text('Welcome ' + user.name + " !");
					$('#log').html('Log Out')
							.attr('formaction', 'login.php?logout');
				}
				$('#root').show();
			}
		});
	});
</script>
</head>

<body>
	<div class="container" id="root" style="display: none">
		<h1 id="h1">Welcome</h1>
		<form method="GET">
			<button type="submit" class="btn btn-primary" id="create"
				formaction="create-poll.php">New Poll</button>
			<button type="submit" class="btn btn-default" id="history"
				formaction="history-poll.php">History Polls</button>
			<button type="submit" class="btn btn-default" value="logout"
				name="logout" id="log" formaction=""></button>
		</form>
	</div>

</body>
</html>
