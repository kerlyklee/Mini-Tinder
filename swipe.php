<?php
session_start(); 
showMatch(); 
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['findMatch']))
    {
    	addToMatch();
        showMatch();
    }
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['findAnotherMatch']))
    {
    	addToNopes();
        showMatch();
    }
function showMatch(){
 	if(isset($_SESSION['user']))
    $username = $_SESSION['user'];
else
    header("Location: logIn.php"); 

    

$host = "localhost";
$user = "st2014";
$pass = "progress";
$database = "st2014";


$conn = new mysqli($host, $user, $pass, $database) or die("Connect failed: %s\n". $conn -> error);
$sql = "SELECT sex FROM t164085profilesData WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);

 if ($row[0] == 'f') {
 	$sex = 'm';
 }
 else $sex = 'f';
 	$sqlMatches = "SELECT age, username, bio FROM t164085profilesData WHERE sex = '$sex'";	
	$result = $conn->query($sqlMatches);
	$count = mysqli_num_rows($result);
	
	if ($result->num_rows > 0) {
   	
    for ($i=0; $i<=$count;) {
    	$row = $result->fetch_assoc();
    	$GLOBALS['userName'] = $row["username"];
    	$matchUserName = $row["username"];
    	$sqlCheckYes = "SELECT yesUserName FROM t164085yesData WHERE username = '$username' AND yesUserName = '$matchUserName'";
    	$results = $conn->query($sqlCheckYes);
    	$sqlCheckNope = "SELECT nopeUserName FROM t164085nopesData WHERE username = '$username' AND nopeUserName = '$matchUserName'";
    	$nopeResults = $conn->query($sqlCheckNope);
    	
    	if( $results->num_rows < 1 && $nopeResults->num_rows < 1 ){

    		$files = glob("uploads/$matchUserName.*");
			$num = $files[0];
			if (empty($row["age"])){
				header("Location: noMatch.php");
				break;
			}
			else{
      		 echo "<br><h3>  ". $row["username"]. " <br> Age: ". $row["age"]. "<br>" . '<img src="' . $num .'" alt="user image">'."&nbsp;&nbsp;". "<br>" . $row["bio"].  "<br></h3>";
      		 break;
      		}
    	}
    	else if ( $results->num_rows <=$i || $nopeResults->num_rows <=$i) {
    		$i++; 
    	}

    }
   }
  
 }
 function addToMatch() {
 	 	if(isset($_SESSION['user']))
   			 $username = $_SESSION['user'];
		else
    		header("Location: logIn.html"); 

    

$host = "localhost";
$user = "st2014";
$pass = "progress";
$database = "st2014";


$conn = new mysqli($host, $user, $pass, $database) or die("Connect failed: %s\n". $conn -> error);
 	$GLOBALS['userName'];
 	$matchUserName = $GLOBALS['userName'];
 	$sqlAddMatch = "INSERT INTO t164085yesData (username, yesUsername) VALUES ('$username', '$matchUserName')";

					if ($conn->query($sqlAddMatch) === TRUE) {
						$sqlCheckIfMatch = "SELECT yesUserName FROM t164085yesData WHERE username ='$matchUserName' AND yesUserName ='$username'";
						$result = mysqli_query($conn, $sqlCheckIfMatch);	
						$count = mysqli_num_rows($result);
						if ($count>0) {
							header("Location: match.php");
							exit;
						}
						else {
    					header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
						exit;
					}
    			}
 }
 function addToNopes() {
 	 	 if(isset($_SESSION['user']))
   			 $username = $_SESSION['user'];
		else
    		header("Location: logIn.html"); 

    

$host = "localhost";
$user = "st2014";
$pass = "progress";
$database = "st2014";


$conn = new mysqli($host, $user, $pass, $database) or die("Connect failed: %s\n". $conn -> error);
 	$GLOBALS['userName'];
 	$matchUserName = $GLOBALS['userName'];
 	$sqlAddNope = "INSERT INTO t164085nopesData (username, nopeUsername) VALUES ('$username', '$matchUserName')";

					if ($conn->query($sqlAddNope) === TRUE) {
						
    					header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
						exit;
					}
    			
 }



/*if (isset($_GET['hello'])) {
    findPontentialMatch();
 }*/
?>
<!DOCTYPE html>
<html>
 
<head>
 
	<title>miniTinder</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="tinder.css">
	
	<!--JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>		
</head>
 
<body>
 
	<div id="container">
		
		
		
		<div id="logAndReg">
		
			
				<form action="swipe.php" method="post">
    					<input type="submit" class="indexBtn" name="findAnotherMatch" value="Nope" />
    					<input type="submit" class="indexBtn" name="findMatch" value="Yes"  />
				</form>
			
		
		</div>		
		
	</div>
 
</body>
 
</html>