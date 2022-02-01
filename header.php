<?php
    session_start();
?>

<html lang="en" dir="ltr"
    <head>
        <meta charset="utf-8">
        <title> PHP Project 01</title>
        <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <nav>
            <div class="wrapper" id = "nav">
                <ul>
                <li style="float:left"><a href="index.php"><img src="img/logo.png" alt="icon" class="logo" /></a></li>
                <br/>
                    <li><a href="findplayers.php">Find Players</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="index.php">Home</a></li>
                    <?php //checking if user is logged in 
                        if(isset($_SESSION["useruid"])){
                            echo "<li><a href='includes/logout.inc.php'>Log out</a></li>";
                            echo "<li><a id='greeting'> Hi " . $_SESSION["username"] . "!</a></li>";
                        }
                        else{
                            echo "<li><a href='login.php'>Log in</a></li>";
                            echo "<li><a href='signup.php'>Sign up</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </nav>

<div class="wrapper">