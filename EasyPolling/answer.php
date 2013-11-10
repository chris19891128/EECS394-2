<!DOCTYPE html>
<html>
<head>
<title>EasyPolling</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
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
        	location.replace("success.html");
    	}
    });
	}
	</script>
</head>
<body>

	<div id="main_div">
		<h3> <?php echo($survey['question']); ?> </h3>
	
	<?php
	foreach ( $survey ['answer'] as $choice ) {
		echo "<button class='choiceButton' type='button' onClick=\"submitIt('$choice')\"'>$choice</button></br>";
	}
	?>
	</div>
	
	<?php include ("footer.inc");?>
</body>
</html>