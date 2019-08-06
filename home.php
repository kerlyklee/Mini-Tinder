<?php
session_start();
if(isset($_SESSION['user']))
    $username = $_SESSION['user'];
else
    header("Location: logIn.php"); 

$host = "localhost";
$user = "st2014";
$pass = "progress";
$database = "st2014";


$conn = new mysqli($host, $user, $pass, $database) or die("Connect failed: %s\n". $conn -> error);
$userName = $_SESSION["user"];
$sql = "SELECT age FROM t164085profilesData WHERE username = '$userName'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$files = glob("uploads/$userName.*");
$num = $files[0];




 

$conn->close();
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
		
		<div id="title">
			mini Tinder
		</div>
		
		<div id=logAndReg>
			<?php echo "<h3> Welcome " . $_SESSION["user"] . "!</h3>";

			echo "<h2>Age: " . $row[0] . "<br></h2>";
			echo '<img src="'. $num .'" alt="user image">'."&nbsp;&nbsp;";
			?>
			<br>
			<br>
			<button class="indexBtn" onclick="location.href='swipe.php';"">Start looking</button>
			<br>
			<button class="indexBtn" onclick="location.href='matches.php';">Look Matches</button>
			<br>
			<button class="indexBtn" onclick="location.href='changeProfilePicture.php';">Change picture</button>	
			<br>
			<button class="indexBtn" onclick="location.href='logOut.php';">Log Out</button>		
		</div>

		
	</div>
 
</body>
 
</html>