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
</head>
<body>

<I>You can create a new account in this page.</I>
<?php
$title="Register";
?>
<!-- Redister form -->
<form action="register.php" method="post">
<p>
<label for="username">Username: </label>
<input type="text" name="username" id="txt1" onKeyUp="showHint(this.value)"> <span id="txtHint"></span>
   <br>
<label for="password">Password: </label>
<input type="password" name="password" id="txt2" onKeyUp="showHint2(this.value)"> <span id="txtHint2"></span>
<br>
<label for="checkpassword">Password check:  </label>
<input type="password" name="checkpassword">
<br>
<input type="submit" value="Submit" name="submit">
<input type="reset" value="Reset" name="reset">
</p>
</form>

<?php
$resiter=0;
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

//submit the register informaion
$register=1;
if(isset($_POST["submit"]))
{
	//retrieve the information from the form
	$username=$_POST["username"];
	$password=$_POST["password"];
    $password2=$_POST["checkpassword"];
    
    if ($password!=$password2)
    {
        echo("checking your password!");
        exit;
    }
    
    if ($username == "" || $password == "" || $password2 == "")
    {
        echo("please fill out all content");
    }

	//check wether the username is already exist
	$result = mysql_query("select * from Users");
	while($row = mysql_fetch_array($result))
	{
		if ($username == $row["username"])
		{
			echo("<br>The username is already exist. Please enter another username!!!</br>");
			$register=-1;
			break;
		}
		else
		{
			$register=1;
		}
	}

	if ($register == 1)
	{
		//insert the information into the table
		$sql = "insert into Users(username, password) values ('".$username."','".$password."')";
		if (mysql_query($sql))
		{
			//echo("<br>Register complete!</br>");
            ?>
            <meta http-equiv="Register complete!" content="5; URL='index.php'">
            <?php
		}
		else
		{
			echo("<br>Erroe adding submitted: ".mysql_error(). "</br>");
		}

	}
}

//output the information
//$result = mysql_query("select * from User");
//while($row = mysql_fetch_array($result))
//{
//	echo("<br>".$row["ID"].$row["username"].$row["password"]."</br>");
//}

mysql_close();

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