<!DOCTYPE html>
<html>
<head>
<title>EasyPolling-MakeSurvey</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body>

<?php
    $question=$_POST["Question"];
    $choice1=$_POST["Choice1"];
    $choice2=$_POST["Choice2"];
    $choice3=$_POST["Choice3"];
    $choice4=$_POST["Choice4"];
    $choice5=$_POST["Choice5"];
    echo($question);
?>
    <form action="">
    <input type="radio" name="Choice1" value="Choice1"><?php echo(" ".$choice1); ?><br>
    <input type="radio" name="Choice2" value="Choice2"><?php echo(" ".$choice2); ?><br>
    <input type="radio" name="Choice3" value="Choice3"><?php echo(" ".$choice3); ?><br>
    <input type="radio" name="Choice4" value="Choice4"><?php echo(" ".$choice4); ?><br>
    <input type="radio" name="Choice5" value="Choice5"><?php echo(" ".$choice5); ?><br>
    </form>

<?php
    include("footer.inc");
    ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
             <script src="https://code.jquery.com/jquery.js"></script>
             <!-- Include all compiled plugins (below), or include individual files as needed -->
             <script src="js/bootstrap.min.js"></script>
             </body>
             </html>