<?php
session_start();
if(isset($_SESSION['user']))
    $username = $_SESSION['user'];
else
    header("Location: logIn.php"); 
?>
<!DOCTYPE html>
<html>
 
<head>
 
	<title>Mini-Tinder</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="tinder.css">			
</head>
 
<body>
 
	<div id="container">
		
		
		<div id=logAndReg>
			<div id="title">
			Mini-Tinder
			</div>
			<?php

				echo "<h3> Sorry, no new matches for you at the moment.</h3>";

				?>
			<br>
			<br>
			<button class="indexBtn" onclick="location.href='home.php';"">Home</button>
			<br>
			<button class="indexBtn" onclick="location.href='matches.php';">Look Matches</button>
			<br>
			<button class="indexBtn" onclick="location.href='logOut.php';">Log Out</button>		
		</div>

		
	</div>
 
</body>
 
</html>