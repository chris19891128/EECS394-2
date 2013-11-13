<?
/************************************

Script : Free PHP Poll Script
Website : http://www.agrizlive.com

Script is provided Under GPU Non-Commercial License
Agrizlive.com doesn't provide any WARRANTY for this script
**************************************/

	if(defined('AGRIZ_FREE_SCRIPTS') && AGRIZ_FREE_SCRIPTS == 'agrizlive.com'){
	}
	else{
		exit;
	}

	include_once("functions/polls.php");
	
	$total_polls = getTotalPolls();
	$total_pages = ceil($total_polls / 10);
	if(isset($_REQUEST['page'])){
		$page = $_REQUEST['page'];
		$limit = ($page-1) * 10;
	}
	else{
		$page = 1;
		$limit = ($page-1) * 10;
	}
	
	$result = getPolls($limit,10);
	
?>
<div id="box">
	<h3>Poll</h3>
	<table width="100%">
		<thead>
			<tr>
				<th width="40px"><a href="#">ID<img src="img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
				<th><a href="#">Poll Title</a></th>
				<th width="90px"><a href="#">Poll End Date</a></th>
				<th width="90px"><a href="#">Display Code</a></th>
				<th width="60px"><a href="#">Action</a></th>
			</tr>
		</thead>
		<tbody>
		<?
			while($value = mysql_fetch_array($result))
			{
		?>
			<tr>
				<td class="a-center"><?=$value['poll_id']?></td>
				<td><?=stripslashes($value['poll_question'])?></td>
				<td><?if($value['poll_end_date'] == "0000-00-00 00:00:00"){echo "No end date";}else{echo date("Y-m-d",strtotime($value['poll_end_date']));}?></td>
				<td>&lt;? echo display_poll(<?=$value['poll_id']?>); ?&gt;</td>
				<td>
					<a href="?content=poll&value=edit&id=<?=$value['poll_id']?>"><img src="img/icons/user_edit.png" title="Edit Poll Options" width="16" height="16" /></a>
					<a href="?content=poll&value=add&id=<?=$value['poll_id']?>"><img src="img/icons/user_edit.png" title="Edit Poll" width="16" height="16" /></a>
					<a href="?content=poll&value=delete&id=<?=$value['poll_id']?>" onclick="return confirm('Do you want to delete?')"><img src="img/icons/user_delete.png" title="Delete Poll" width="16" height="16" /></a>
				</td>
			</tr>
		<?
			}
		?>	
		</tbody>
	</table>
						
	<div id="pager">
		Page <?if($page > 1){?><a href="index.php?content=poll&page=<?=$page-1?>" alt="Prev"><img src="img/icons/arrow_left.gif" width="16" height="16" /></a><?}?> 
		<input size="1" value="<?=$page?>" type="text" name="page" id="page" /> 
		<?if($total_pages < $page){?>
		<a href="index.php?content=poll&page=<?=$page+1?>" alt="Next"><img src="img/icons/arrow_right.gif" width="16" height="16" /></a><?}?>
		of <?=$total_pages?> pages | Total <strong><?=$total_polls?></strong> records found
	</div>
</div>
