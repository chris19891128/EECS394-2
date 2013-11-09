<!DOCTYPE html>
<html>
<head>
<title>EasyPolling</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->


<script type="text/javascript">
//var str = '{ question: "What is your favorite color?", answer: ["Red", "Orange", "Yellow", "Green", "Blue"] }';

/**
function Parse()
{
    var str1 = "<?php echo $content2; ?>";
    alert(str1);
    var json = eval('(' + str1+ ')');
    alert(json);
    alert(json.question);
    alert(json.answer[0]);
    alert(json.answer[1]);
}
**/
</script>


</head>
<body>
<?php
    require_once('extract.php');
    //echo $content;
    //get the url
    /**
    $url = $_SERVER["REQUEST_URI"];
    //echo $url;
    $url_array = (explode('/', $url));
    //print_r ($url_array);
    //echo count($url_array);
    //$survey_id = (count($url_array) - 1);
    //echo $survey_id;
    
    //the id of survey
    global $survey_id;
    $survey_id = ($url_array[count($url_array) - 1]);
    echo $survey_id;
    //echo $survey_content;
    $survey = (explode('"', $content));
    $split = (explode('answer: ["', $content));
    //echo $split[0];
    $new_answer = substr($split[1],0,strlen($split[1])-5);
    $choice_array = (explode('", "', $new_answer));
    $question = $survey[1];
    
    $choice_count = count($choice_array);
    //echo $choice_count;
     **/
    ?>


<h3><?php echo(" ".$question); ?></h3>
<form action="?survey_id=<?php echo $survey_id; ?>" method="post">

<input type="radio" name="Choice" value="1"><?php echo(" ".$choice_array[0]); ?><br>
<input type="radio" name="Choice" value="2"><?php echo(" ".$choice_array[1]); ?><br>
<input type="radio" name="Choice" value="3"><?php echo(" ".$choice_array[2]); ?><br>
<input type="radio" name="Choice" value="4"><?php echo(" ".$choice_array[3]); ?><br>
<input type="radio" name="Choice" value="5"><?php echo(" ".$choice_array[4]); ?><br><br>
<input type="submit" value="Sent" onClick() = "write()">
<input type="reset" value="Rrset">
</form>


<script type="text/javascript">
funtion write()
{
    alert("response sent");
    
}
</script>



<?php
    //include "Parse.php";
    //error_reporting(0);
    //require_once('extract.php');
    if($_POST)
    {
        $mysql = new mysqli('localhost', 'root', '', 'EasyPolling') or die ('Cannot connect to Database');
        $result = $_POST["Choice"];
        //echo ($result);
        //echo $_GET["survey_id"];
        $query = "INSERT INTO Answer VALUES('','".$survey_id."', '".$result."')";
        if($updateDb = $mysql->query($query) or die ($mysql->error)) {echo "Congrats!";}
    }
    
    ?>

<?php
    
    
    
include("footer.inc");
?>
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
             <script src="https://code.jquery.com/jquery.js"></script>
             <!-- Include all compiled plugins (below), or include individual files as needed -->
             <script src="js/bootstrap.min.js"></script>
             </body>
             </html>