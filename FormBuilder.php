<?php

 include 'DataHandler.php';
 $base = new BaseData();
 $base->connect();


class HTML{
/*	function PlaceCookie(){
		if (isset($_COOKIE["user"])){
			echo "Welcome " . $_COOKIE["user"] . "!<br />";
		} else { 
			//header('Location:Sign-In.php');
			$user = "";
			setcookie("user", $user, time()+3600);
		}
	}*/

//builds post to display on page
	function buildPage() {

		$base = new BaseData();
		

//build the event HTML
		$HTMLbody ='<h3>Here are what other people have suggested so far:</h3><br>
			<div class="poll">
			';
		foreach ($base->displayDynamic() as $event) {
			
			$HTMLbody .= $this->buildEvent($event);
		}

		$HTMLbody .= '
			We encourage everyone to please provide any ideas you have.  No matter how crazy.
			</div>
			<br><br>';

//build the post HTML
			$HTMLbody.= '<div>Make a blog post or comment on a post.<br>
			';
		foreach ($base->getPosts(10) as $post) {
			$comments = $base->getComments($post['ID']);
			$HTMLbody .= $this->buildPost($post, $comments);
		}
		$HTMLbody .= '
			</div>
		 </div>
		</div>
 		<button id="make_post" class="button" href="#">Create a New Post</button>
		<br><br>';

	return $HTMLbody;

	}

//fill post array with posts and associated comments
	function buildPost(array $post, array $comments) {

		$handle = trim(htmlentities($post['title']));
		$body = trim(htmlentities($post['bodytext']));
		$body = preg_replace("#(https?://\S+)#",'<a href="\\1">\\1</a>',$body);
		//$body = preg_replace("",$body);
		$created = ($post['created']);
		$postID = ($post['ID']);

		$html = "
			<div class='post'>
				<h3 class='name'>{$handle}</h3>			
				<p class='post'>
				$created</br>
				</br>
 				$body
				</p>
					<div class='comment'>
					<input hidden='true' name='postID' class='postID' value='$postID'>
					<a class='comment_post' href='#' onclick='return false;'>Comment</a>
					</br></br>
				</div>";
		foreach ($comments as $comment) {
			$html .= $this->buildComment($comment);
		}
		$html .= '</div><br/>';
		return $html;
	}

//fill comment array
	function buildComment(array $comment) {

		$handle = trim(htmlentities($comment['title']));
		$body = trim(htmlentities($comment['bodytext']));
		$body = preg_replace("#(https?://\S+)#",'<a href="\\1">\\1</a>',$body);
		$created = ($comment['created']);

		return "
			<div class='comments'>
				<h3 class='name'>$handle</h3>
				<p class='post'>
				$created</br>
				</br>
				$body
				</p>
			</div><br>";
	}

//fill event array
	function buildEvent(array $event) {

			$name = trim(htmlentities($event['EventName']));
			$descrip = trim(htmlentities($event['EventDescription']));
			$descrip = preg_replace("#(https?://\S+)#",'<a href="\\1">\\1</a>',$descrip);
	
			return "<div class='event'>$name<br>$descrip<br><br></div><br>";
	}

}

?>
