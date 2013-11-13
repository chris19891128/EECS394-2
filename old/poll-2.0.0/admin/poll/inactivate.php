<?
session_start();
if(!isset($_SESSION['admin_account']))
{
	exit;
}
include_once("../config.php");
include_once("admin.post.class.php");

$obj_admin_post = new admin_post();

$result = $obj_admin_post->inactivatePost($_POST['id']);

if($result){
	$arr['iserror'] = false;
	$arr['result'] = "Success";
}
else{
	$arr['iserror'] = true;
	$arr['result'] = "It is not inactivated";
}

echo json_encode($arr);
	
?>
