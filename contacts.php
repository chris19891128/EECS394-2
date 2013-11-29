<?php
require_once 'lib/all_error.php';
session_start ();
if (! isset ( $_SESSION ['token'] )) {
	header ( 'location: login.php' );
}
?>
<!doctype html>
<head>
<title>All Contacts</title>
<link
	href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css"
	rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<link href="lib/select2-3.4.5/select2.css" rel="stylesheet" />

<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="lib/select2-3.4.5/select2.js"></script>

<script>
	$(document).ready(function() { $("#e1").select2();});

	function loadSelectIntoInput() {
		$('li.select2-search-choice div').each(function(index) {
			var str = $(this).text();
		});
	}
	
</script>

</head>

<body>
	<select multiple name="e1" id="e1" style="width: 300px"
		class="populate">
		<?php
		foreach ( $_SESSION ['contact'] as $pair ) {
			$name = $pair [0];
			$email = $pair [1];
			$json_string = json_encode ( $pair );
			echo "<option value='$json_string'> $name &#60;$email&#62; </option>";
		}
		?>
	</select>

	<button type="button" onClick="loadSelectIntoInput()">Click me</button>
</body>

</html>