<?php
    require_once 'lib/all_error.php';
    require_once 'naive-email.php';
    session_start ();
    
    if (! isset ( $_SESSION ['token'] )) {
        header ( 'location: login.php' );
    }
    ?>
$survey_id = $_GET ['id'];

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
href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript"
src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.4.1/less.min.js"></script>
<script type="text/javascript" src="js/site.js"></script>
</head>
<body onload="init()">
<div class="container">
<ul class="pager">
<li class="previous"><a href="home.php">&larr; Home</a></li>
</ul>
<?php
    if(isset($_POST["Send"]))
    {
        /**
        $mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
        $query = "INSERT INTO Poll VALUES('" . $_POST ['id'] . "', '" . json_encode ( $_POST ['data'] ) . "', '" . json_encode ( $_POST ['recipient'] ) . "', '" . $_POST ['me'] . "')";
        if ($updateDb = $mysql->query ( $query ) or die ( $mysql->error )) {
            send_email ( $_POST ['me'], $_POST ['pwd'], $_POST ['recipient'], $_POST ['id'] );
            
            echo "Email send out success";
        }
        mysqli_close ( $mysql );
         **/
        $addemails = $_POST["respondants"];
        echo($addemails);
        $mysql = new mysqli ( 'localhost', 'root', 'stu.fudan2013', 'EasyPolling' ) or die ( 'Cannot connect to Database' );
        $query = "select recipient from Poll where ID='$survey_id'";
        $result = mysqli_query ( $link, $query );
        $row = mysqli_fetch_array ( $result );
        if ($row) {
            $recipients = $row ['recipient'];
        } else {
            echo mysqli_error ( $link );
            $creator = NULL;
        }
        mysqli_close ( $link );
        return $recipients;
        
    
    } else {
        echo <<<END
        <form action="addrespondants.php" method="post" id="create">
		<input type="hidden" id="emailHidden" value="$_SESSION[email]"/>
		<div id="poll">
        <div class="form-group" id="recipient-group">
        <label for="recipient">To:</label> <input type="text"
            class="form-control" id="recipient" name="respondants"
            placeholder="Email list here separated by comma" />
			</div>
            </div>
            <input type="submit" class="btn btn-primary btn-lg" value="Submit me" name="Send">
            </form>
            <div id="success">
            <h1>Congratulations! Your poll has been sent out!</h1>
            <a id="seeResult" href="" class="btn btn-primary btn-lg">See the Results</a>
            <a id="add more respondants" href="addrepsondants.php" class="btn btn-primary btn-lg">Add Respondants</a>>
            </div>
            <div id="progress">
            <h1>Sending Emails... Please Wait</h1>
            </div>
            END;
}
    
    ?>
<?php include ("footer.inc");?>
</div>
</body>
</html>
