<?php
require_once 'lib/all_error.php';
require_once 'survey_db.php';
    
    session_start ();
    if (! isset ( $_SESSION ['token'] )) {
        header ( 'location: login.php' );
    }
    echo $_SESSION['email'];

$survey_id = $_GET ['id'];
$survey = get_survey_by_id ( $_GET ['id'] );
$survey_res = get_survey_recipient_by_id ( $survey_id );
$resp = "false";
$allow = "false";
if(isset($_GET['responder']))
{
    $respondant = $_GET ['responder'];
    $resp = "true";
}
$number = count ( $survey_res ) -1;
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
</head>

<body onload="init()">
	<div class='container'>
	<?php
    if (!isset($_GET['responder']))
    {
        echo "<ul class=\"pager\">";
        echo "<li class=\"previous\"><a href=\"home.php\">&larr; Home</a></li>";
        echo "</ul>";
    }
	echo "<h1>" . $survey ['question'] . "</h1>"; 
	echo "<p> (Other recipients: ";
    if (isset($_GET['responder']))
    {
        for($i = 0; $i < count ( $survey_res ); $i ++) {
            if ($survey_res [$i] == $respondant)
            {
                $allow = "true";
                break;
            }
        }
    }
	for($i = 0; $i < count ( $survey_res ) - 1; $i ++) {
		echo $survey_res [$i] . ", ";
	}
	echo $survey_res [$i] . " )</p>";
	?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#">Vote</a></li>
        <?php
                if ($resp == "true")
                {
                echo '<li><a href="stat.php?id='.$survey_id.'&responder='.$respondant.'">See Result</a></li>';
                echo '<li><a href="stat2.php?id='.$survey_id.'&responder='.$respondant.'">Track Respondants</a></li>';
                }
                else
                {
                echo '<li><a href="stat.php?id='.$survey_id.'">See Result</a></li>';
                echo '<li><a href="stat2.php?id='.$survey_id.'">Track Respondants</a></li>';
                }
        ?>
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
<script type="text/javascript">
function submitIt(choice){
        //var allow = "false";
    var t2 = "<?php echo $resp; ?>";
    var t = "<?php echo $allow; ?>";
    if (t == "false")
        {
            alert("You cannot vote");
            //continue;
        }
    else
        {
        var sumOfResponder = "<?php echo $number; ?>";
        var responder = "<?php echo $allow; ?>";
        if (responder == "true")
            {
            var data =
                {
                id: <?php echo "'$survey_id'"; ?>,
                choice: choice,
                respondant: <?php echo "'$respondant'"; ?>
                };
            $.ajax(
                   {
                   type: "POST",
                   url: "response.php",
                   data: data,
                   success:function(data)
                   {
                   if(data=='error')
                   {
                        alert('You cannot vote twice');
                   }
                   if (t2 == "false")
                   {
                        location.replace("stat.php?id=" + <?php echo "'$survey_id'"; ?>);
                   }
                   else
                   {
                   location.replace("stat.php?id=" + <?php echo "'$survey_id'"; ?> + "&responder=" + <?php echo "'$respondant'"; ?> );
                   
                   }
                   }
                   });
            }
        else
            {
            alert('you are not allowed to vote');
            }
        }
}

function otherRes(){
    $("#others").show();
    $("#others").dialog();
}

function init(){
    $("#others").hide();
}
</script>
</html>