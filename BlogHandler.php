<?php

require_once('bootstrap.php');

//If this is a post on this page
if ($_POST) {
	$DBHandle->tablePost($_POST);
        header('location: http://zombieblog.ds152.tss');
}else{
    $DBBInfo = $HTML->buildBlogPosts();
    $BlogBody = file_get_contents('Blog.html');
    $BlogHTML = str_replace("%%%DBB_Info%%%",$DBBInfo,$BlogBody);
    echo $BlogHTML;
}
?>
