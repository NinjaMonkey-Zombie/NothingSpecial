<?php

class BaseData {


	 private $db_info = array();

	/**
	* @param array $db_params This will hold db connection info from DB.php
	*/
	public function __construct(array $db_params)
	{
		foreach($db_params as $key => $value)
		{
			$this->db_info[$key] = $value;
		}
	}

//connect to DB
	public function connect() {
	
	mysql_connect($this->db_info['host'], $this->db_info['username'], $this->db_info['password']) or die ("Could not connect. " .mysql_error());
	mysql_select_db($this->db_info['database']) or die ("Could not find database. " .mysql_error());
	
	}

//create an array for Event table
	public function displayDynamic($limit = 20) {
		$qry = mysql_query("SELECT * FROM {$this->db_info['table3']} ORDER BY ID DESC LIMIT {$limit}");
		if (!$qry)
			return array();

		$eventOut = array();
		while($e = mysql_fetch_assoc($qry)) {
			$eventOut[] = $e;
		}
		return $eventOut;

	}

//create an array for Posts table
	public function getPosts($limit = 10) {
		$r = mysql_query("SELECT * FROM {$this->db_info['table']} ORDER BY created DESC LIMIT {$limit}");
		if (!$r)
			return array();

		$posts = array();		
		while ($post = mysql_fetch_assoc($r)) {
			$posts[] = $post;
		}
		return $posts;
	}
	
//create an array for Comments table
	public function getComments($postId) {
		$r = mysql_query("SELECT * FROM {$this->db_info['table2']} WHERE postId={$postId} ORDER BY created DESC LIMIT 5");
		if (!$r)
			return array();
		
		$comments = array();
		while ($c = mysql_fetch_assoc($r)) {
			$comments[] = $c;
		}
		return $comments;
	}
	
//post data into DB
	public function tablePost($p) {

	//blog post DB posting
		if (isset($p['handle'])) {
			$blogHandle = mysql_real_escape_string($p['handle']);
		}

		if (isset($p['body'])) {
			$blogPost = mysql_real_escape_string($p['body']);
		}	
	
		if (!empty($blogHandle) && !empty($blogPost)) {
			$created = date("m-d-Y, H:i:s");
			if ($p['PostNum'] == '0') {
					
				$sql = "INSERT INTO {$this->db_info['table']} VALUES(DEFAULT,'$blogHandle','$blogPost','$created','$IPaddress')";	
				return mysql_query($sql);	
			} else {
				$postId = ($p['PostNum']);
				$sql = "INSERT INTO {$this->db_info['table2']} VALUES(DEFAULT,'$blogHandle','$blogPost','$created','$postId','$IPaddress')";	
				return mysql_query($sql);		
			}


		}

//event DB posting
		if (isset($p['game'])) {
			$game = mysql_real_escape_string($p['game']);
		}

		if (isset($p['description'])) {
			$description = mysql_real_escape_string($p['description']);
		}	
	
		if (!empty($game) && !empty($description) && $game !== 'Event Name' && $description !== 'Describe The Event') {
			$sql = "INSERT INTO {$this->db_info['table3']} VALUES(DEFAULT,'$game','$description','$IPaddress')";
			return mysql_query($sql);
		}
                
//login creation posting
		if (isset($p['create']) == 1) {
			if ($p['name']) {
				$name = mysql_real_escape_string($p['name']);
			}

			if ($p['email']) {
				$email = mysql_real_escape_string($p['email']);
			}

			if ($p['Pswd']) {
				$pswd = mysql_real_escape_string($p['Pswd']);
			}

			if (!empty($name) && !empty($email) && !empty($pswd)) {
				$verify = mysql_query("SELECT * FROM {$this->db_info['table4']}");				
		
				while ($v = mysql_fetch_assoc($verify)) {
					if ($v['Name'] == $name || $v['Email'] == $email)
						return false;
				}	
			}
			$sql = "INSERT INTO {$this->db_info['table4']} VALUES(DEFAULT,'$name','$email','$pswd',DEFAULT)";
			return mysql_query($sql);
		} else {
			return	false;	
		}
	}
}
?>
