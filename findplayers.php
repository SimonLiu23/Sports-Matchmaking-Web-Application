<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>

<html>
  <head>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>

  
    <!--Find player form-->
    <h1 class = "header">Find a Player</h1>

    <div class=findplayer>
      <p> Select an option for each category below </p>
      <form method="GET">
      <label for="location">Preferred Location:</label>
                <select name="location" id="location" required>
                <option disabled selected value> Select an option </option>
                <option value="San Francisco, CA">San Francisco, CA</option>
                <option value="Sunnyvale, CA">Sunnyvale, CA</option>
                <option value="Milpitas, CA">Milpitas, CA</option>
                </select><br><br>

                <label for="match">Match Preference:</label>
                <select name="match" id="match" required>
                    <option disabled selected value> Select an option </option>
                    <option value="Singles">Singles (1v1)</option>
                    <option value="Doubles">Doubles (2v2)</option>
                </select><br><br>

                <label for="skill">Skill level:</label>
                <select name="skill" id="skill" required>
                  <option disabled selected value> Select an option </option>
                  <option value="Beginner">Beginner</option>
                  <option value="Intermediate">Intermediate</option>
                  <option value="Advanced">Advanced</option>
                </select><br><br>

                <label for="goal">Goals:</label>
                <select name="goal" id="goal" required>
                  <option disabled selected value> Select an option </option>
                  <option value="Casual">Casual, Looking to meet new friends</option>
                  <option value="Competitive">Competitive, Looking for a training partner</option>
                </select><br /><br />

          <button class="submit-button" type="submit" name="submit" onclick="openEvent()">Search</button>
          </form>
  </div>
  <hr class="search-line">
  <?php

  if (isset($_GET['skill'])) {
  $nr = $_GET['skill'];
  $sql = "SELECT * FROM users WHERE location='{$_GET['location']}' AND matchtype='{$_GET['match']}' AND skill='{$_GET['skill']}' AND goal='{$_GET['goal']}' ORDER BY usersId DESC;";
  $result = mysqli_query($conn,$sql);
  $resultCheck = mysqli_num_rows($result);

  if ($resultCheck >= 0){
      if(!isset($_SESSION['useruid'])){ //if login in session is not set
        header("Location: signup.php");
      }
      elseif ($resultCheck > 0) {
        while($row = mysqli_fetch_assoc($result)){
        ?>
  <div id="searchResults">
    <div class="search-container">
      <div class="search-profile" onclick="#" style="cursor: pointer;">
        <div>
          <p><b><u><?php echo $row['usersName'];?></b></u></p>
          <p><b>Match Type: </b><?php echo $row['matchtype'];?> Player</p>
          <p><b>Skill level: </b><?php echo $row['skill'];?></p>
          <p><b>Goals: </b>          
          <?php 
          if ($row['goal']='Casual'){
            echo "Casual, Looking to meet new friends";
          }
          else{
            echo "Competitive, Looking for a training partner";
          }
          ?></p></p>
          <p><b>Location: </b><?php echo $row['location'];?></p>
          
        </div>
      </div>
      <button class = "invite-button" onclick="document.getElementById('id01').style.display='block'">Invite</button>
      <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="modal-content" action='mailto:<?php echo $row['usersEmail'];?>' method='POST' enctype='multipart/form-data' name='EmailForm'>
          <div class="container">
            <h1>Invite</h1>
            <hr>
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Your Name" name="name" required>
            <label for="message"><b>Message</b></label>
            <textarea name='message' rows='6' cols='20'></textarea>
            <div class="clearfix">
              <br/>
              <button type="submit" class="signupbtn">Invite</button>
            </div>
          </div>
        </form>
    </div>
  </div>
  <?php
      }

    }
    elseif ($resultCheck < 1){
      echo "No results found";
    
    }
  }
}
  
  mysqli_close($conn);
  ?>
  <!--      echo $row['usersName'] . "<br>";
      echo $row['location'] . "<br>";
      echo $row['matchtype'] . "<br>";
      echo $row['skill'] . "<br>";
      echo $row['goal'] . "<br>";
    }
  }
}-->


  <script>
    //Toggle search feature
    function openEvent(){
     
      window.location.reload();
    }

    function sendEmail() 
    {
        window.location = "mailto:simon_liu2005@yahoo.com;"
    }
  </script>


  </body>
</html>