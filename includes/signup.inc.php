<?php

//grab data from user variables and connect necessary files
if (isset($_POST["submit"])){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];
  $pwdRepeat = $_POST["pwdrepeat"];
  $location = $_POST["location"];
  $matchtype = $_POST["match"];
  $skill = $_POST["skill"];
  $goal = $_POST["goal"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  //Error handling functions for sign up form
  if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !==false){
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  
  if (invalidUid($username) !==false){
    header("location: ../signup.php?error=invaliduid");
    exit();
  }

  if (invalidEmail($email) !==false){
    header("location: ../signup.php?error=invalidemail");
    exit();
  }

  if (pwdMatch($pwd, $pwdRepeat) !==false){
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
  }

  if (uidExists($conn, $username, $email) !==false){
    header("location: ../signup.php?error=usernametaken");
    exit();
  }

  //Allow user to sign-up if no errors
  createUser($conn, $name, $email, $username, $pwd, $location, $matchtype, $skill, $goal);

}
else{
  header("location: ../signup.php");
  exit();
}