<?php

include 'DB.php';
include 'DataHandler.php';
include 'FormBuilder.php';

$dbparams = array(
	 'host' => _host,
	 'username' => _username,
	 'password' => _password,
	 'table' => _table,
	 'table2' => _table2,
	 'table3' => _table3,
	 'table4' => _table4,
	 'database' => _database);

//Build DB handle
$DBHandle = new BaseData($dbparams);
$DBHandle->connect();

//Get HTML view and pass in db info
$HTML = new HTML($DBHandle);

?>
