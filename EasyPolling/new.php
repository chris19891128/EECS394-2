<?php 

if($_POST)
{
	$mysql = new mysqli('localhost', 'root', '', 'EasyPolling') or die ('Cannot connect to Database');
	#$data = $_POST['data'];
	$query = "INSERT INTO Poll VALUES('".$_POST['id']."', '".$_POST['data']."')";
	if($updateDb = $mysql->query($query) or die ($mysql->error)) {echo "Congrats!";}
}

?>