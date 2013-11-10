<!DOCTYPE html>
<html>
<head>
<title>EasyPolling</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script src="jquery-1.10.2.min.js"></script>
</head>
<body>

<?php
require_once ('extract.php');
?>

<script type="text/javascript">
	function submitIt(choice){
		$.ajax({
        type: "POST",
        url: "response.php",
        data: {
        	id: <?php echo $survey_id; ?>,
        	choice: choice
        },
        success:function(data){
        	
    	}
    });
	}
</script>

	<h3><?php echo(" ".$question); ?></h3>
	
	<?php
	foreach ( $choice_array as $choice ) {
		echo "<button type='button' value='$choice' onClick='submitIt($choice)'/></br>";
	}
	include ("footer.inc");
	?>
</body>
</html>