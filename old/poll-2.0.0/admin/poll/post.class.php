<?php
	
	
class post
{
	private $Bdd; // object Bdd, connection to the database
	private $category;
	private $settings;
	public function __construct()
	{
		require_once(SERVER_NAME."/admin/class/Bdd.php");
		$this->Bdd = BDD::GetInstance();
		
	}
	
	
	public function get_seo_url($id)
	{   
		$value = $this->getPost($id);
		return $this->CleanFileName(stripslashes($value->post_title));
	}
	
	
	public function addRequest($title,$description,$url,$email)
	{
		$query = "INSERT INTO script_request(title, description, url, email, req_date) VALUES('".$title."','".$description."','".$url."','".$email."',NOW())";
		$result = $this->Bdd->ExecuteQuery($query);
		return $result;
	}
	
	public function getRequests()
	{
		$query = "SELECT * FROM script_request ORDER BY req_date DESC";
		$result = $this->Bdd->ExecuteQuery($query);
		return $result;
	}
	
	public function getPost($id)
	{
		$query = "SELECT * FROM post WHERE post_id = $id AND post_status = 'active'";
		$result = $this->Bdd->ExecuteQuery($query);
		
		$value = $result->fetch_object();
		
		return $value;
	}
	
	public function CleanFileName( $Raw, $name = ''){
		
		$Raw = html_entity_decode(strip_tags(trim(strtolower($Raw))));

		$RemoveChars  = array( "([\40])" , "([^a-zA-Z0-9-])", "(-{2,})" );
		//$RemoveChars  = array( "([\40])" , "([^~`!@#$%^&*()_=+:;,<.>/?'\"])", "(-{2,})" );
		$ReplaceWith = array("-", "", "-");
		if($name == ''){
			return "free-php-scripts/".preg_replace($RemoveChars, $ReplaceWith, $Raw);
		}
		else{
			return "free-php-scripts/$name/".preg_replace($RemoveChars, $ReplaceWith, $Raw);
		}
	}
	
	public function lastID()
	{
		return $this->Bdd->LastInsert();
	}
	
	
	public function getPosts($start,$end,$type = '')
	{
		if($type == '')
		{
			$query = "SELECT * FROM post WHERE post_status = 'active' ORDER BY post_id DESC LIMIT $start, $end";
		}
		else
		{
			$query = "SELECT * FROM post WHERE post_status = 'active' ORDER BY likes DESC LIMIT $start, $end";
		}
		$result = $this->Bdd->ExecuteQuery($query);
		
		return $result;
	}

	
	public function addVote($id,$type)
	{
		if($type == 'like'){
			$query = "UPDATE post SET likes = likes + 1 WHERE post_id = $id";
		}
		else{
			$query = "UPDATE post SET unlike = unlike + 1 WHERE post_id = $id";
		}
		$result = $this->Bdd->ExecuteQuery($query);		
		return $result;
	}
	
	public function getVotes($id,$type){
		if($type == 'like'){
			$query = "SELECT likes FROM post WHERE post_id = $id";
			$result = $this->Bdd->ExecuteQuery($query);		
			$value = $result->fetch_object();
			
			return $value->likes;
		}
		else{
			$query = "SELECT unlike FROM post WHERE post_id = $id";
			$result = $this->Bdd->ExecuteQuery($query);		
			$value = $result->fetch_object();
			
			return $value->unlike;
		}
	}
	
	
	public function getTotalPost()
	{
		$query = "SELECT post_id FROM post WHERE post_status = 'active'";
		$result = $this->Bdd->ExecuteQuery($query);
		
		return $result->num_rows;
	}
	
	public function getSearchPosts($start,$end,$keyword)
	{
		$query = "SELECT * FROM post WHERE post_status = 'active' AND (post_title LIKE '%$keyword%' OR post_content LIKE '%$keyword%') ORDER BY likes DESC LIMIT $start, $end";
		$result = $this->Bdd->ExecuteQuery($query);
		
		return $result;
	}
	
	public function getSearchPostsTotal($keyword)
	{
		$query = "SELECT * FROM post WHERE post_status = 'active' AND (post_title LIKE '%$keyword%' OR post_content LIKE '%$keyword%' OR post_website LIKE '%$keyword%')";
		$result = $this->Bdd->ExecuteQuery($query);
		
		return $result->num_rows;
	}
	
	
	public function getIndexBestPost($limit)
	{
		$query = "SELECT * FROM post INNER JOIN users ON user_id = FK_user_id WHERE post_status = 'active' ORDER BY likes DESC LIMIT $limit";
		$result = $this->Bdd->ExecuteQuery($query);
		
		return $result;
	}
	
	
	public function articleCount($id)
	{
		$query = "UPDATE post SET view_post = view_post + 1 WHERE post_id = $id";
		$result = $this->Bdd->ExecuteQuery($query);
		
		return $result;
	}
	
	public function getBannedStatus($ip){
		$query = "SELECT * FROM ban_ip WHERE ban_ip_address = '$ip'";
		$result = $this->Bdd->ExecuteQuery($query);
		return $result;
	}
}	