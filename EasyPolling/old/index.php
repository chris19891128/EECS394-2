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

<!-- Login form -->
<form action="new.html" method="post">
<p>
<label for="username">Username: </label>
<input type="text" name="username"><br>
<label for="password">Password: </label>
<input type="text" name="password"><br>
<input type="submit" value="Login" name="Login">
<input type="reset" value ="Reset" name="Reset">
</p>
</form>

<a href = "register.php"> Do not have an account, click here to register</a>

<?php
    session_start();
    $login=0;
    
    
    //link to the database
    $link=@mysql_connect('localhost','root','');
    if(!$link)
    {
        echo( "<br> Unable to connect to the "."database server at this time.</br>");
        exit();
    }
    else
    {
        echo("<br> Conncect to the database successfully</br>");
    }
    
    //choose the database
    if(!@mysql_select_db('EasyPolling'))
    {
        echo( "Unable to link to the database");
        exit();
    }
    else
    {
        echo( "link to the EasyPolling database");
    }
    
    //submit the login informaion
    if(isset($_POST["submit"]))
    {
        //retrieve the information from the form
        $username=$_POST["username"];
        $password=$_POST["password"];
        
        //check wether the username is already exist
        $result = mysql_query("select * from Users");
        while($row = mysql_fetch_array($result))
        {
            if (($username == $row["username"]) &&($password == $row["password"]))
            {
                $login=1;
                $_SESSION["authority"]=$_POST['username'];
                echo $_SESSION["authority"];
                echo 'Login In Successfully.<br><a //href="index.php" target="_blank">Click here to go back to the home page.</a>  <br>';
                break;
            }
            else
            {
                $login=-1;
            }
        }
		if ( $login==-1 )
			echo "Login Error!<br> Please create a new account first!<br>";
    }
    
    
    mysql_close();
    
    
    ?>
<?php
    include("footer.inc");
    ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
             <script src="https://code.jquery.com/jquery.js"></script>
             <!-- Include all compiled plugins (below), or include individual files as needed -->
             <script src="js/bootstrap.min.js"></script>
             </body>
             </html>