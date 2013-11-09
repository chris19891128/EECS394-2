
<?php
    //error_reporting(0);
//link to the database
$link=@mysql_connect('localhost','root','');
if(!$link) 
{
	echo( "<br> Unable to connect to the database server at this time.</br>");
	exit();
}


//choose the database
if(!@mysql_select_db('EasyPolling'))
{
	echo( "<br> Unable to locate the database server at this time.</br>");
	exit();
}
    
    
    
    
    
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
    //echo $survey_id;
    $survey_id = substr($survey_id, 0, 4);
   // echo $survey_id;
    //echo $survey_id;

    $result = mysql_query("select * from Poll where ID = '".$survey_id."'");
    //$result = mysql_query("select * from Poll where ID = u6al");
$row = mysql_fetch_array($result);
    global $content;
    $content = $row["Content"];
        //echo $content;
    //echo $content;
    
    
    
    
    
    
    
    
    //echo $survey_id;
    //echo $survey_content;
    $survey = (explode('"', $content));
    $split = (explode('answer:["', $content));
    //echo $split[0];
    $new_answer = substr($split[1],0,strlen($split[1])-5);
    $choice_array = (explode('", "', $new_answer));
    $question = $survey[1];
    
    $choice_count = count($choice_array);
    //echo $choice_count;

    
    
    
    
    
    

mysql_close();

?>
