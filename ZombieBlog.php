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

//If this is a post on this page
if ($_POST) {
	$DBHandle->tablePost($_POST);				
}

?>


<html>
 <head>
	<title> Zombie Blog!</title>
	<link href="Styles.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="Zombie.js"></script>
 </head>

<body id="ZombieBlog">

	<div class="header">
		<h1>BRAAAAAAIIIINNNS!</h1>
		<img src="images/zombies.gif"/>
	</div>
	


		<div class="left">
		
			<img class="banner" height="289" width="200" src="images/zombie1.jpg"/>
			<p class="banner">
			We want YOU....</br>
			to join the zombie apocolypse.</p>
			<br>
			<img class="banner" height="122" width="200" src="images/eatFlesh.jpg"/>
		</div>

		<div class="right">
										
			<img class="banner" height="150" width="200" src="images/ILoveZomies.png"/><br><br>
			<img class="banner" height="200" width="200" src="images/Smiley.png"/>

		</div>

	<div class="wrapper">

		<div class="middle">

		<h2 class="warning">WARINING!</br>This site may contain graphic images.</h2>	
		Welcome to my Zombie Blog! <br>
		 If you have an un-natural obsession with zombies and can't wait for the zombie apocolypse to happen then you are in the right place. 

		  <p class="center">

			<form id="poll" name="eventPoll" action="" method="post">
				</br></br>
				<h3>The Zombie Olympics Are Coming!</h3>
				Place your vote!<br>
				What events would you most like to see at the Zombie Olympics?<br>
				<input type="text" name="game" id="game" class="textinput" value="Event Name"/><br>
				<textarea class="textinput" name="description" id="description">Describe The Event</textarea><br>
				<input class="button" type="submit" value="Submit Event Idea"/>
				<input type="hidden" id="dynamic" name="dynamic" value="true"/>
			</form>

	<?php
		echo $HTML->buildPage();
	?>

			</p>
			<img src="images/gif-zombies.gif"/>
		</div>

	</div>


		<div  class="inputCont" id="inputCont">

 			<div class="input">	
				<div class="close">
					<button class="button" id="close">[X]</button>
				</div>
				<form id="container" name="zombieBlog" action="DataHandler.php" method="post">
					<input type="hidden" id="PostNum" name="PostNum" value="0"/>
					User Handle:</br>
					<input class="textinput" type="text" name="handle" id="handle" value=""/>
					</br></br>
					Post: </br>
					<textarea class="textinput" name="body" id="body" value=""></textarea>
					</br></br>
					<input class="button" type="submit" value="Create Entry"/>
				</form>
			</div>

		</div>

		


 </body>

</html>
