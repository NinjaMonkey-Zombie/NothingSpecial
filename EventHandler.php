<?php

require_once('bootstrap.php');

//If this is a post on this page
if ($_POST) {
	$DBHandle->tablePost($_POST);
        header('location: http://zombieblog.ds152.tss');				
}else{
    $DBEInfo = $HTML->buildBlogEvents();
    $EventBody = file_get_contents('Event.html');
    $EventHTML = str_replace("%%%DBE_Fill%%%",$DBEInfo,$EventBody);
    echo $EventHTML;
}
?>
