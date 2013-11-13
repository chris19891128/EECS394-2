<?php
require_once 'lib/all_error.php';
//session_start ();

if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: black.php' );
} else{
	header ( 'location: white.php' );
}
?>
<html>
<head>
<title>Home Page for Users</title>
</head>
<body>

<?php
//echo var_dump ( $_SESSION ['google_user'] );
echo "<h1> Welcome $_SESSION['google_user']['name'] ($_SESSION['google_user']['email'])"
?>
</body>
</html>
