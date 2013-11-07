<?
	if(isset($direct_access) && $direct_access == "agriz_123"){
	}
	else{
		exit;
	}
	
	include_once("post/admin.post.class.php");
	$obj_admin_post = new admin_post();
	
	
	$value = $obj_admin_post->getPostByID($_REQUEST['id']);
	
?>	
<style>th{text-align: left}</style>
<div id="box">
	<h3>Post Details</h3>
	<table width="100%">
		<thead>
			<tr>
				<th width="100"><a href="#">ID</a></th>
				<td><?=$value->post_id?></td>
			</tr>
			<tr>	
				<th><a href="#">Title</a></th>
				<td><?=stripslashes($value->post_title)?></td>
			</tr>	
			<tr>
				<th><a href="#">Content</a></th>
				<td><?=$value->post_content?></td>
			</tr>	
			<tr>
				<th><a href="#">Website</a></th>
				<td><a href="<?=$value->post_website?>"><?=$value->post_website?></a></td>
			</tr>	
			<tr>
				<th><a href="#">Post IP</a></th>
				<td><?=$value->p_ip?></td>
			</tr>
			<tr>	
				<th><a href="#">Post Status</a></th>
				<td><?=$value->post_status?></td>
			</tr>	
			<tr>	
				<th><a href="#">Likes</a></th>
				<td><?=$value->likes?></td>
			</tr>
			<tr>	
				<th><a href="#">Views</a></th>
				<td><?=$value->view_post?></td>
			</tr>
			<tr>
				<th><a href="#">Post Date</a></th>
				<td><?=date("d-M-Y h:i:s",strtotime($value->post_date))?></td>
			</tr>
			<tr>
				<th><a href="#">User ID</a></th>
				<td><?=$value->FK_user_id?></td>
			</tr>
			<tr>	
				<th><a href="#">User Name</a></th>
				<td><a href="?content=account&value=view&id=<?=$value->FK_user_id?>"><?=$value->user_name?></a></td>
			</tr>
			<tr>	
				<th><a href="#">User IP</a></th>
				<td><?=$value->u_ip?></td>
			</tr>
			<tr>	
				<th><a href="#">User Status</a></th>
				<td><?=$value->user_status?></td>
			</tr>
		</thead>
	</table>
</div>