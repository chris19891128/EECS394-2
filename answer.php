<?php
set_include_path ( '.' );
require_once 'lib/survey_db.php';

if (! isset ( $_GET ['id'] ) || ! isset ( $_GET ['responder'] )) {
	echo 'Broken URL, Missing survey id or responder!';
	return;
} elseif ($_GET ['responder'] == get_survey_creator_by_id ( $_GET ['id'] )) {
	$err_num = 1;
} elseif (! in_array ( $_GET ['responder'], get_survey_recipient_by_id ( $_GET ['id'] ) )) {
	echo 'You have no authentication to see this poll';
	return;
} elseif (in_array ( $_GET ['responder'], get_survey_responded_by_id ( $_GET ['id'] ) )) {
	$err_num = 2;
} else {
	$err_num = 0;
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
<script src="js/answer.js"></script>
</head>

<<<<<<< HEAD
<body onload="init()">
	<div class='container'>
	<?php
    if (!isset($_GET['responder']))
    {
        echo "<ul class=\"pager\">";
        echo "<li class=\"previous\"><a href=\"home.php\">&larr; Home</a></li>";
        echo "<li class=\"previous\"><a href=\"addrespondants.php?id=".$survey_id."\">&larr; Add Respondants</a></li>";
        echo "</ul>";
    }
	echo "<h1>" . $survey ['question'] . "</h1>"; 
	echo "<p> (Other recipients: ";
            //if (isset($_GET['responder']))
            //{
            //}
            //}
	for($i = 0; $i < count ( $survey_res ) - 1; $i ++) {
		echo $survey_res [$i] . ", ";
	}
	echo $survey_res [$i] . " )</p>";
            //echo 'number:  '.($number).' ';
    $survey_res[$number] = $survey_creator;
    $number = $number + 1;
        for($i = 0; $i < count ( $survey_res ); $i ++) {
                //echo 'voters: '.($survey_res[$i]).'    ';
            if ($survey_res [$i] == $respondant)
            {
                $allow = "true";
                break;
            }
        }
	?>
	<ul class="nav nav-tabs">
		<li class="active"><a href="#">Vote</a></li>
        <?php
                if ($resp == "true")
                {
                echo '<li><a href="stat.php?id='.$survey_id.'&responder='.$respondant.'">Result</a></li>';
                echo '<li><a href="stat2.php?id='.$survey_id.'&responder='.$respondant.'">Respondants</a></li>';
                }
                else
                {
                echo '<li><a href="stat.php?id='.$survey_id.'">Result</a></li>';
                echo '<li><a href="stat2.php?id='.$survey_id.'">Respondants</a></li>';
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
=======
<body>
	<input id='err' type='hidden' value='<?php echo $err_num;?>' />
	<input id='sid' type='hidden'
		value='<?php echo isset ( $_GET ['id'] ) ? $_GET ['id']:'' ;?>' />
	<input id='rid' type='hidden'
		value='<?php echo isset ( $_GET ['responder'] ) ? $_GET ['responder']:'' ;?>' />

	<div class="container" id="root" style="display: none">

		<!-- Panel for question and other recipients display -->
		<div id='infov' class='container' style='display: none'>
			<h1 id='qt'></h1>
			<p id='ar'></p>
		</div>

		<!-- Panel for navigation -->
		<div id='nav' class='container' style='display: none'>
			<ul class="nav nav-tabs">
				<li id='l1' class="active"><a href="#">Vote</a></li>
				<li id='l2'><a id='l2a'>See Result</a></li>
			</ul>
>>>>>>> 00ce24f8835f21cf70532704caad45ead07cb1e4
		</div>

		<!-- Panel for voting -->
		<div id='vv' class='container' style='display: none'>
			</br>
			<form id='vf'></form>
		</div>
		<?php include ("footer.inc");?>
	</div>
</body>

</html>