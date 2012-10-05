<?php

require_once('bootstrap.php');

//If this is a post on this page
if ($_POST) {
	$DBHandle->tablePost($_POST);	
        header('location: http://zombieblog.ds152.tss');
}else{
    echo file_get_contents('Login.html');
}
?>
