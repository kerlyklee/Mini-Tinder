
<?php
session_start();
if(isset($_SESSION['user']))
    $username = $_SESSION['user'];
else
    echo "uupss"; 

if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit']))
    {
      
    
function upload_my_file($fileid) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $saved_file = $target_dir . $fileid . "." . $imageFileType;
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          echo "<h3>File is not an image.</h3>";
          $uploadOk = 0;
      }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "<h3>Sorry, file already exists.</h3>";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 5000000) {
      echo "<h3>Sorry, your file is too large.</h3>";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "<h3>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h3>";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "<h3>Sorry, your file was not uploaded.</h3>";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file(
           $_FILES["fileToUpload"]["tmp_name"], $saved_file)) {
          echo "<p><h3>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</h3>";
          header("Location: home.php");

      } else {
          echo "<p><h3>Sorry, there was an error uploading your file.</h3>";
      }
  }
}
upload_my_file($username);

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>miniTinder</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="tinder.css">
</head>
<body>

<h2>Upload your best picture</h2>
<div id="logAndReg">
<form action="changeProfilePicture.php" method="post" autocomplete="off" enctype="multipart/form-data">
    <h2>Select photo upload:</h2>
    <input type="file"   name="fileToUpload" id="fileToUpload">
    <input type="submit" class="indexBtn" value="Upload Image" name="submit">

</form>

</div>

</body>
</html> 
