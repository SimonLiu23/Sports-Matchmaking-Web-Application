<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
  $result;
  if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
}

function invalidUid($username){
  $result;
  if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
}

function invalidEmail($email){
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $pwdRepeat){
  $result;
  if ($pwd !== $pwdRepeat){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
}

//check if username already exists inside db
function uidExists($conn, $username, $email){
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else{
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

//Sign up user from website if no errors
function createUser($conn, $name, $email, $username, $pwd, $location, $matchtype, $skill, $goal){
  $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd, location, matchtype, skill, goal) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $username, $hashedPwd, $location, $matchtype, $skill, $goal);
  mysqli_stmt_execute($stmt);
  header("location: ../signup.php?error=none");
  exit();
}


function emptyInputLogin($username, $pwd){
  $result;
  if (empty($username) || empty($pwd)){
    $result = true;
  }
  else{
    $result = false;
  }
  return $result;
}

function loginUser($conn, $username, $pwd) {
  $uidExists = uidExists($conn, $username, $username);

  if($uidExists === false){
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $uidExists["usersPwd"]; //column name directly from the database
  $checkPwd = password_verify($pwd, $pwdHashed);

  if($checkPwd === false){
    header("location: ../login.php?error=wronglogin");
    exit();
  }
  else if($checkPwd === true){ //starting session if no errors
    session_start();
    $_SESSION["userid"] = $uidExists["usersId"];
    $_SESSION["useruid"] = $uidExists["usersUid"];
    $_SESSION["username"] = $uidExists["usersName"];

    header("location: ../index.php");
    exit();
  }
}