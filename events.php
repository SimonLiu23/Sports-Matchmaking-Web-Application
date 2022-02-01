<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>

<html>
<head>
    <title></title>
</head>
<body>

  <!--Create submit post and form feature-->
  <div class="submit-post">
    <button class="submit-button" onclick="togglePost()">Create Event</button>
  </div>
    <div id="postForm">
      <form name="submitPost" method="POST" enctype="multipart/form-data" action="submitevent.php">
        <label for="location">Choose a Location:</label><br/>
        <select name="location" id="location" required>
          <option disabled selected value> Select an option </option>
          <option value="San Francisco, CA">San Francisco, CA</option>
          <option value="Sunnyvale, CA">Sunnyvale, CA</option>
          <option value="Milpitas, CA">Milpitas, CA</option>
        </select><br/><br/>

        <label for="title">Title:</label><br />
        <input type="text" id="title" name="title" required/><br /><br />

        <label for="content">Event Description:</label><br />
        <input type="text" name="content" id="content" required><br /><br />

        <label for="date">Date:</label><br />
        <input type="date" id="date" name="date" value="Date" required /><br /><br />

        <label for="Upload">Upload:</label><br/>
        <input type="file" name="file" id="upload" required/><br/><br/> 
          
        <button class='submit-button' type="submit" name="submit">Submit</button>
      </form>
    </div>

<!--Creating event posts here-->
  <?php
    $sql = "SELECT id, userid, title, description, date, eventdate, location, image FROM events ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) { //Show data for each row

      while($row = mysqli_fetch_assoc($result)) {
  ?>
        <div class="event-container">
          <div class="event-profile">
            <div onclick="openEvent(
            '<?php echo $row['id'];?>')" style="cursor: pointer;">
              <h4><?php echo $row['title'];?></h4>
              <p> When: <?php echo date("M d, Y",strtotime($row['eventdate']));?></p>
              <p> Where: <?php echo $row['location'];?></p><p>Created by: <?php echo $row['userid'];?></p>
              
            </div>
          <div class="clearfix" onclick="openEvent(
            '<?php echo $row['id'];?>')" style="cursor: pointer;">
              <button type="submit" class = "info-button">More Info ↓</button>
            </div>
          </div>
          <p id="<?php echo $row['id'];?>" class="event-text" style="display:none"> <?php echo $row['description'];?>
          <img src="uploads/<?php echo $row['image'];?>" class="post-img">
          </p>

        <script> //script to allow toggle of every individual event post
        var storage = {};
        function openEvent(id){
          storage[<?php echo $row['id'];?>] = document.getElementById(id);
          if (storage[<?php echo $row['id'];?>].style.display === "none") {
            storage[<?php echo $row['id'];?>].style.display = "block";
          } else {
            storage[<?php echo $row['id'];?>].style.display = "none";
          }
        }
        </script>
      
        </div>
        <?php
      }
    } 
    else {
        echo "No events yet";
    }

    mysqli_close($conn);
    ?>

    <script>
      //Toggle post feature
      const togglePost = () => {
        const x = document.getElementById("postForm");
        x.style.display = x.style.display === "block" ? "none" : "block";
      };
    </script>        

</body>

<?php
    include_once 'footer.php';
?>