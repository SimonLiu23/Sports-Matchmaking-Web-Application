<?php

include_once 'includes/dbh.inc.php';

session_start();

if(!isset($_SESSION['useruid'])){ //if login in session is not set
        header("Location: signup.php");
      }
else {

//Saving post text here
  $location = $_POST['location'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $eventdate = $_POST['date'];

//Handling image uploads here
$file = $_FILES['file'];
$fileName = $file['name'];
$fileTmpName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];
$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));
$allowed = array('jpg', 'jpeg', 'png', 'jfif', '');

if(in_array($fileActualExt, $allowed)) {
  if($fileError===0){
    if($fileSize <2000000){
      $fileNameNew = uniqid('', true).".".$fileActualExt;
      $fileDestination = 'uploads/'.$fileNameNew; //the directory uploaded images are saved to
      move_uploaded_file($fileTmpName, $fileDestination);
      header("Location: events.php?submitevent=success");
    }else{
      echo "Your file is too big! Max 2 mb";
    }
  }else{
    echo "There was an error uploading your file!";
  }
}else{
  echo "You cannot upload files of this type!";
}


//Trying to save date/time when post was created
date_default_timezone_set('America/Los_Angeles');
$sDate = date("Y-m-d H:i:s");
$eventdate = date("Y-m-d",strtotime($eventdate));

//Trying to insert information into database here
include_once 'events.php';
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO events (userid, title, description, date, eventdate, location, image) 
VALUES ('{$_SESSION['username']}', '$title', '$content', '$sDate', '$eventdate', '$location' , '$fileNameNew' );";
mysqli_query($conn, $sql);

header("Location: events.php?testing=success");

}

