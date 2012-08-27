<?php

class BaseData {

	var $host = 'localhost';
	var $username = 'shanem';
	var $password = 'pa55w0rd';
	var $table = 'Posts';
	var $table2 = 'Comments';
	var $table3 = 'Event';
	var $table4 = 'Users';
	var $database = 'BlogDB';

//connect to DB
	public function connect() {
	
	mysql_connect($this->host, $this->username, $this->password) or die ("Could not connect. " .mysql_error());
	mysql_select_db($this->database) or die ("Could not find database. " .mysql_error());
	
	}

//create an array for Event table
	public function displayDynamic() {
		$qry = mysql_query("SELECT * FROM {$this->table3} ORDER BY ID DESC");
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
		$r = mysql_query("SELECT * FROM {$this->table} ORDER BY created DESC LIMIT {$limit}");
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
		$r = mysql_query("SELECT * FROM {$this->table2} WHERE postId={$postId} ORDER BY created");
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

	$IPaddress = "";  //IP of the poster

	//blog post DB posting
		if ($p['handle']) {
			$blogHandle = mysql_real_escape_string($p['handle']);
		}

		if ($p['body']) {
			$blogPost = mysql_real_escape_string($p['body']);
		}	
	
		if (!empty($blogHandle) && !empty($blogPost)) {
			$created = date("m-d-Y, H:i:s");
			$IPaddress = ipcheck();
			if ($p['PostNum'] == '0') {
					
				$sql = "INSERT INTO {$this->table} VALUES(DEFAULT,'$blogHandle','$blogPost','$created','$IPaddress')";	
				return mysql_query($sql);	
			} else {
				$postId = ($p['PostNum']);
				$sql = "INSERT INTO {$this->table2} VALUES(DEFAULT,'$blogHandle','$blogPost','$created','$postId','$IPaddress')";	
				return mysql_query($sql);		
			}


		}

//event DB posting
		if ($p['game']) {
			$game = mysql_real_escape_string($p['game']);
		}

		if ($p['description']) {
			$description = mysql_real_escape_string($p['description']);
		}	
	
		if (!empty($game) && !empty($description) && $game !== 'Event Name' && $description !== 'Describe The Event') {
			$IPaddress = ipcheck();
			$sql = "INSERT INTO {$this->table3} VALUES(DEFAULT,'$game','$description','$IPaddress')";
			return mysql_query($sql);
		}

//login creation posting
		if ($p['create'] == 1) {

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
				$verify = mysql_query("SELECT * FROM {$this->$table4}");				
			
				while ($v = mysql_fetch_assoc($verify)) {
					if ($v['Name'] == $name || $v['Email'] == $email)
						return false;
				}	
			}
			$sql = "INSERT INTO {$this->table4} VALUES(DEFAULT,'$name','$email','$pswd',DEFAULT)";
			return mysql_query($sql);
		} else {
			return	false;	
		}


	}



}

$DBHandle = new BaseData();

if ($_POST) {
	
	$DBHandle->connect();
	$DBHandle->tablePost($_POST);				

	header('Location:ZombieBlog.php');

}


function ipcheck() {

	$ip = $_SERVER['REMOTE_ADDR'];
	return $ip;

}



?>
