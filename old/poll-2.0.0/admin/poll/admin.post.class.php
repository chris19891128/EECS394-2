<?php
	
	
class admin_post
{
	private $Bdd; // object Bdd, connection to the database

	public function __construct()
	{
		require_once(SERVER_NAME."/admin/class/Bdd.php");
		$this->Bdd = BDD::GetInstance();
		
	}
	
	
	public function insertPost($title,$description,$dl,$demo,$ins,$price)
	{
		
			$query = "INSERT INTO post(post_title,post_content,post_download,post_demo,post_instruction,post_date,post_price) VALUES('$title','$description','$dl','$demo','$ins',NOW(),'$price')";
			$result = $this->Bdd->ExecuteQuery($query);
			
			return $result;
	}
	
	public function lastID()
	{
		return $this->Bdd->LastInsert();
	}
	
	
	
	public function getPost($limit,$type)
	{
		if($type != ""){
			$cond = " AND post_status = '$type'";
		}
		else{$cond = "";}
		$query = "SELECT * FROM post WHERE 1 $cond ORDER BY post_id DESC LIMIT $limit, 10";
		$result = $this->Bdd->ExecuteQuery($query);
		return $result;
	}
	
	public function inactivatePost($id)
	{
		$query = "UPDATE post SET post_status = 'inactive' WHERE post_id = $id";
		$result = $this->Bdd->ExecuteQuery($query);
		return $result;
	}
	
	public function getPostByID($id)
	{
		$query = "SELECT * FROM post WHERE post_id = $id";
		$result = $this->Bdd->ExecuteQuery($query);
		$value = $result->fetch_object();
		
		return $value;
	}
	
	
}	