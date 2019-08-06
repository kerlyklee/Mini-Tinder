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
 
	<title>miniTinder</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="tinder.css">
	
		
</head>
 
<body>
 
	<div id="container">
		
		
		
		<div id="logAndReg">
		
				<div id="title">
					Mini-Tinder
				</div>
				<br>
				<h3> Congratulations, It's a Match!!! </h3>
				<button class="indexBtn" onclick="location.href='matches.php';">Look Matches</button>
				<br>
				<button id="logInBtn" class="indexBtn" onclick="location.href='swipe.php';"">Back to swipeing</button>

				<br><br>
			
		
		</div>		
		
	</div>
 
</body>
 
</html>