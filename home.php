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
	href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
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
		<h2 style="float:left;"><i class="fa fa-thumbs-up"></i> iMDown</h2>
		<div style="float:right;margin-top:20px;margin-bottom:10px;"><button type="submit" class="btn btn-default btn-sm" value="logout"
				name="logout" id="log" formaction=""></button></div>
		<div class="clear"></div>
		<h1 id="h1">Welcome</h1>
		<form method="GET" style="margin-bottom: 8px;">
			<button type="submit" class="btn btn-primary" id="create"
			formaction="create-poll.php" style="width:100%;">What’s up <i class="fa fa-question"></i></button>
		</form><form method="GET">
			<button type="submit" class="btn btn-default" id="history"
			formaction="history-poll.php" style="width:100%;">Who’s down <i class="fa fa-thumbs-o-up"></i></button>
		</form>
		<?php include ("footer.inc");?>
	</div>

</body>
</html>
