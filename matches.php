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
$sql = "SELECT yesUserName FROM t164085yesData WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $matchUserName = $row["yesUserName"];
        $sqlFindIfLikesBack = "SELECT username FROM t164085yesData WHERE username='$matchUserName' AND yesUserName='$username'";
        $results = $conn->query($sqlFindIfLikesBack);
        if($results ->num_rows > 0){
        	$files = glob("uploads/$matchUserName.*");
			$num = $files[0];
        	echo "<br><h3>" . $matchUserName . "<br>". '<img src="' . $num .'" alt="user image">'."&nbsp;&nbsp;" . "<br></h3>";
        }
    }
} else {
    echo "<h3> No matches yet </h3>";
}




    	
    	

    
   

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
		
			
			<br>
			<br>
			<button class="indexBtn" onclick="location.href='home.php';"">Home</button>
			<br>
			<button class="indexBtn" onclick="location.href='swipe.php';">Start looking</button>
			<br>
			<button class="indexBtn" onclick="location.href='logOut.php';">Log Out</button>		
		</div>

		
	</div>
 
</body>
 
</html>