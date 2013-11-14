<?php
require_once 'lib/all_error.php';
session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}
?>
<html>
<head>
<title>Home Page for Users</title>
</head>
<body>

<?php
echo var_dump ( $_SESSION ['token'] );
echo "<h1> Welcome " . $_SESSION ['google_user'] ['name'] . "</h1>";
?>
	<button type="submit" class="btn btn-default"
		formaction="/create-poll.php">New Poll</button>
	<button type="submit" class="btn btn-default"
		formaction="/history-poll.php">History Polls</button>
</body>
</html>
