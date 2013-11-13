<!DOCTYPE html>
<html>
<head>
<title>EasyPolling</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	<?php
	require_once ('extract.php');
	$survey_id = $_GET ['id'];
	$survey = get_survey_by_id ( $_GET ['id'] );
	?>

	<script type="text/javascript">
	function submitIt(choice){
		var data = {
	        	id: <?php echo "'$survey_id'"; ?>,
	                	choice: choice
	                };
		$.ajax({
        type: "POST",
        url: "response.php",
        data: data,
        success:function(data){
        	location.replace("stat.php?id=" + <?php echo "'$survey_id'"; ?>);
    	}
    });
	}
	</script>
</head>
<body>

	<div class="container">
		<h1> <?php echo($survey['question']); ?> </h1>
	
	<?php
	foreach ( $survey ['answer'] as $choice ) {
		echo "<p><button class='choiceButton btn btn-default' type='button' onClick=\"submitIt('$choice')\"'>$choice</button></p>";
	}
	?>
	<?php include ("footer.inc");?>
	</div>
</body>
</html>