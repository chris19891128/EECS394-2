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

<!-- Survey form -->
<form action="Deal.php" method="post">
<p>
<label for="Question">Question: </label>
<input type="text" name="Question"><br>
<label for="Choice1">Choice1: </label>
<input type="text" name="Choice1"><br>
<label for="Choice2">Choice2: </label>
<input type="text" name="Choice2"><br>
<label for="Choice3">Choice3: </label>
<input type="text" name="Choice3"><br>
<label for="Choice4">Choice4: </label>
<input type="text" name="Choice4"><br>
<label for="Choice5">Choice5: </label>
<input type="text" name="Choice5"><br>
<input type="submit" value="Sent" name="Sent">
<input type="reset" value ="Reset" name="Reset">
</p>
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