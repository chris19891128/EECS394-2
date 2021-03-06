<?php
    set_include_path ( '.' );
    require_once 'lib/all_error.php';
    ?>

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
href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"
rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript"
src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript"
src="//cdnjs.cloudflare.com/ajax/libs/less.js/1.4.1/less.min.js"></script>

<!-- my script -->
<script type="text/javascript" src="js/site.js"></script>

<!-- Select 2 Library -->
<link href="lib/select2-3.4.5/select2.css" rel="stylesheet" />
<script src="lib/select2-3.4.5/select2.js"></script>
<script>

</script>

</head>

<body>
<a href="home.php" id="home_link">Home</a>

<div class="container">
<form action="post-create-poll.php" method="" id="create">
<div id="poll">
<div class="form-group" id="recipient-group">
<label for="recipient">To:</label> <input type="hidden"
class="form-control" id="recipient" />
<p>
<select multiple name="e1" id="e1" style="width: 500px"
class="populate">
</select>
</p>
</div>
<div class="form-group" id="question-group">
<label for="question">Question:</label> <input type="text"
class="form-control" id="question"
placeholder="Enter your question here" />
</div>
<div class="form-group" id="option-group">
<div class="form-group">
<label for="option_1_input">Option 1:</label> <input type="text"
class="form-control" id="option_1_input" placeholder="" />
</div>
<div class="form-group">
<label for="option_2_input">Option 2:</label> <input type="text"
class="form-control" id="option_2_input" placeholder="" />
</div>
</div>
</div>
<button type="button" class="btn btn-default" onclick="addOption()">Add
Option</button>
<button type="submit" class="btn btn-default">Make a Poll</button>

</form>
</div>
<footer>- EasyPolling, Powered by the Orange Team, EECS394 2013</footer>
</body>
</html>
s