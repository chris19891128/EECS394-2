<?php
require_once 'lib/all_error.php';
require_once 'survey_db.php';

$survey_id = $_GET ['id'];
$survey = get_survey_by_id ( $_GET ['id'] );
$survey_res = get_survey_recipient_by_id ( $survey_id );
$respondant = $_GET ['responder'];
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
<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="/resources/demos/style.css" />
<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


<script type="text/javascript">
	function submitIt(choice){
		var data = {
	        	id: <?php echo "'$survey_id'"; ?>,
	            choice: choice,
        		respondant: <?php echo "'$respondant'"; ?>
	    };
		$.ajax({
        	type: "POST",
        	url: "response.php",
        	data: data,
        	success:function(data){
            	if(data=='error'){
                	alert('You cannot vote twice');
            	}
        		location.replace("stat.php?id=" + <?php echo "'$survey_id'"; ?>);
    		}
   	 	});
	}

	function otherRes(){
		$("#others").show();
		$("#others").dialog();
	}

	function init(){
		$("#others").hide();
	}
</script>
</head>

<body onload="init()">
	<div class='container'>
	<?php
	echo "<h1>" . $survey ['question'] . "</h1>"; 
	echo "<p> (Other recipients: ";
	for($i = 0; $i < count ( $survey_res ) - 1; $i ++) {
		echo $survey_res [$i] . ", ";
	}
	echo $survey_res [$i] . " )</p>";
	?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#">Vote</a></li>
		<li><a href="stat.php?id=<?php echo $survey_id; ?>">See Result</a></li>
	</ul>
	<br />
	<?php
	$count = 0;
	foreach ( $survey ['answer'] as $choice ) {
		echo '<p><button class="choiceButton btn btn-default" type="button"' . 'onClick="submitIt(\'' . $count ++ . '\')">' . $choice . '</button></p>';
	}
	?>
	
	<div id="dialog" title="Basic dialog">
			<p></p>
		</div>
	
	<?php
	include ("footer.inc");
	?>
	</div>
</body>
</html>