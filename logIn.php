<?php

session_start();
$host = "localhost";
$user = "st2014";
$pass = "progress";
$database = "st2014";
$errorMessage= "";


$conn = new mysqli($host, $user, $pass, $database) or die("Connect failed: %s\n". $conn -> error);




if (isset($_POST["username"]) && isset($_POST["password"])) {
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password =  mysqli_real_escape_string($conn, $_POST["password"]);
	
	$username = htmlentities($username);
	$password = htmlentities($password);

	
	if (!empty($username) && !empty($password)) {
		$sql = "SELECT username FROM t164085profilesData WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
	
		
		if ($count == 0) {
			$errorMessage = "Invalid username / password.";
		} else if ($count == 1) {
			$_SESSION["user"] = $username;
			header("Location: home.php");
		}		
		
	} else {
		$errorMessage="You must enter username and password";
	}
}
?>
<!DOCTYPE html>
<html>
 
<head>
 
	<title>mini Tinder</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="tinder.css">	
	<!--JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		
</head>
 
<body>
 
	<div id="container">
		
	<div id="errorMsg"><?php echo "$errorMessage"; ?></div>
		
		<div id="logAndReg">
			
			<div id="reg">
				<div id="title">
				Mini-Tinder
			</div> <br>
				<form style="display: inline;" action="logIn.php" method="POST" autocomplete="off">
					<input class="indexInput" type="text" name="username" placeholder="Username" maxlength="20" title="Pikkus 20 tähte."><br>
					<input class="indexInput" type="password" name="password" placeholder="Password" maxlength="20" title="Pikkus 20 tähte."><br>
					<button type="submit" id="signUpBtn" class="indexBtn">Log In</button>
				</form>
				<br>
				<button id="backToIndex" class="indexBtn" onclick="location.href='index.html';">Back</button>
				
				<br>
				
			</div>
		
		</div>

		
	</div>
 
</body>
 
</html>