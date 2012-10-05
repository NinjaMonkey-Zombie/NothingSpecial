<?php

 
class HTML {


	protected $basedata = NULL;

	public function __construct(BaseData $object) {
		$this->basedata = $object;
	}

//builds post to display on page
	function buildBlogPosts() {

//build the post HTML
			$HTMLbody = '';
		foreach ($this->basedata->getPosts(10) as $post) {
			$comments = $this->basedata->getComments($post['ID']);
			$HTMLbody .= $this->buildPost($post, $comments);
		}
	return $HTMLbody;
	}

//build event to display on page
	function buildBlogEvents() {
//build the event HTML
		$HTMLbody = "<div class='events'>";
		foreach ($this->basedata->displayDynamic() as $event) {
			
			$HTMLbody .= $this->buildEvent($event);
			
		}
		$HTMLbody .= "</div>";

//return HTML
	return $HTMLbody;

	}

//fill post array with posts and associated comments
	function buildPost(array $post, array $comments) {

		$handle = trim(htmlentities($post['title']));
		$body = preg_replace("#(https?://\S+)#",'<a href="\\1">\\1</a>',trim(htmlentities($post['bodytext'])));
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
					<input class='hidden' hidden='true' name='postID' class='postID' value='$postID'>
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
		$body = preg_replace("#(https?://\S+)#",'<a href="\\1">\\1</a>',trim(htmlentities($comment['bodytext'])));
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
			$descrip = preg_replace("#(https?://\S+)#",'<a href="\\1">\\1</a>',trim(htmlentities($event['EventDescription'])));
	
			return "<div class='event'>$name<br>$descrip<br><br></div><br>";
	}

}

?>
