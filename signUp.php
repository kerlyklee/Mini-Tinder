 <?php
session_start();
$host = "localhost";
$user = "st2014";
$pass = "progress";
$database = "st2014";

 
$conn = new mysqli($host, $user, $pass, $database) or die("Connect failed: %s\n". $conn -> error);
$error_message = "";
$username = "";
$sex = "";
$age ="";
$fullname= "";
$password = "";
$passwordCheck ="";
$bio ="";
$email = "";

if (isset($_POST["gender"]) && isset($_POST["age"]) && isset($_POST["userName"]) && isset($_POST["fullName"]) && isset($_POST["password"]) && isset($_POST["bio"]) && isset($_POST["passwordCheck"]) && isset($_POST["email"])) {
	
	$sex = mysqli_real_escape_string($conn, $_POST["gender"]);
	$age = mysqli_real_escape_string($conn, $_POST["age"]);
	$username = mysqli_real_escape_string($conn, $_POST["userName"]);
	$fullname = mysqli_real_escape_string($conn, $_POST["fullName"]);
	$password =  mysqli_real_escape_string($conn, $_POST["password"]);
	$passwordCheck = mysqli_real_escape_string($conn, $_POST["passwordCheck"]);
	$bio = mysqli_real_escape_string($conn, $_POST["bio"]);
	$email = mysqli_real_escape_string($conn, $_POST["email"]);
	$_SESSION["favcolor"] = $username;

	if (strlen ($username) <= 20 && strlen($fullname) <= 40 && strlen($password) <= 20 &&  strlen($bio) <=200 && strlen($passwordCheck) <= 20 && strlen($email) <= 100) {
		$sex = htmlentities($sex);
		$age = htmlentities($age);
		$username = htmlentities($username);
		$fullname = htmlentities($fullname);
		$password = htmlentities($password);
		$passwordCheck = htmlentities($passwordCheck);
		$bio = htmlentities($bio);
		$email = htmlentities($email);
		
		if (!empty($sex) && !empty($age) && !empty($username) && !empty($fullname) && !empty($password) && !empty($passwordCheck)) {
			if ($password != $passwordCheck) {
				$error_message = "Passwords do not match.";
			}
			else{
				$sql = "SELECT username FROM t164085profilesData WHERE username = '$username'";
				$result = mysqli_query($conn, $sql);	
				$count = mysqli_num_rows($result);
				if ($count>0) {
					$error_message = "Username is taken.";
				} 
				else {
					$sql = "INSERT INTO t164085profilesData (sex, age, username, fullname, password, bio, email) VALUES ('$sex', '$age', '$username', '$fullname', '$password', '$bio', '$email')";

					if ($conn->query($sql) === TRUE) {
						$_SESSION["favcolor"];
						header("location: upload.php");
    				
    				}		
				
				}

			}	
		}

		 else {
			$error_message = "All fields are required.";
		}
	}
}

?>
 
<!DOCTYPE html>
<html>
 
<head>
 
	<title>miniTinder</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="tinder.css">
	<script src="signUp.js"></script>
		
</head>
 
<body>
 
	<div id="container">
		
		
		
		<div id="logAndReg">
			
			<div id="reg">
				<div id="title">
			Mini-Tinder
		</div><br>
		
				<div id="errorMsg"><?php echo "$error_message"; ?></div>
				<form style="display: inline; " action="signUp.php" method="POST" autocomplete="off">
					<select class="indexInput" id="sex" name="gender">
  						<option value="m">Male</option>
 						<option value="f">Female</option>
					</select><br>
					<input class="indexInput" id="age" name="age" type="number" min="18" max="99" placeholder="Age"><br>
					<input class="indexInput" type="text" id="username" name="userName" placeholder="Username" maxlength="20" title="Pikkus 20 tähte."><br>
					<input class="indexInput" type="text" id="fullname" name="fullName" placeholder="Full Name" maxlength="40" title="Pikkus 40 tähte."><br>
					<input class="indexInput" type="text" id="email" name="email" placeholder="Email" maxlength="100" title="Pikkus 100 tähte"><br>
					<input class="indexInput" type="password" id="password" name="password" placeholder="Password" maxlength="20" title="Pikkus 20 tähte."><br>
					<input class="indexInput" type="password" id="password" name="passwordCheck" placeholder="Password Again" maxlength="20" title="Pikkus 20 tähte"><br>
					<input class="indexBio" type="text" id="bio" name="bio" placeholder="Why should anyone want to date you?" maxlength="200" title="Pikkus 200 tähte."> <br>
					<button type=submit class="indexBtn">Submit</button><br>
				</form>
				

				<button id="backToIndex" class="indexBtn" onclick="location.href='index.html';">Back</button>
				
				<br><br>
		
				
			</div>
		
		</div>		
		
	</div>
 
</body>
</html>





  