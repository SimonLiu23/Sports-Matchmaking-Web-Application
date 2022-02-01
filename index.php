<?php
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
?>

<html>
<head>
    <title></title>
</head>
<body>

  <!--Create and submit post form here-->
  <div class="submit-post">
    <button class="submit-button" onclick="togglePost()">Submit Post</button>
  </div>
    <div id="postForm">
      <form name="submitPost" method="POST" enctype="multipart/form-data" action="submitpost.php">

        <label for="posttext">Text:</label><br/>
        <input type="text" name="posttext" id="posttext" required><br/><br/><br/>

        <label for="Upload">Upload:</label><br/>
        <input type="file" name="file" id="upload" /><br/><br/> 
          
        <button class = 'submit-button' type="submit" name="Submit">Submit</button>
      </form>
    </div>

    <!--Post feature starts here-->
      <?php
      
        $sql = "SELECT userid, text, image, date FROM posts ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) { //Show data for each row
          while($row = mysqli_fetch_assoc($result)) {
      ?>

            <div class="post-container">
              <div class="post-profile">
                  <div>
                  <p><?php echo $row['userid'];?></p>
                  <span><?php echo date('M d, Y, h:i A', strtotime($row['date']));?></span>
                  </div>
              </div>
              <p class="post-text"><?php echo $row['text'];?></p>
             <!--  <img src="uploads/<?php echo $row['image'];?>" width = "970" onerror="this.onerror=null; this.src=''; this.width ='0'"> -->
            </div>

      <?php
    
          }
        } 
        else {
          echo "No posts yet";
        }
      

      mysqli_close($conn);
        ?>

    <!--Javascript start-->
    <script>
      window.onload = function () {
        const data = [
          {
            postId: 1,
            firstName: "Jane",
            middleName: null,
            lastName: "Doe",
            image: "https://image_host.com/image/1",
            createdTimestamp: "2021-10-20T22:12:30Z"
          },
        ];

        const post = document.getElementById("posts");
        //create children divs here for displaying posts: https://www.w3schools.com/jsref/met_node_appendchild.asp
      };

      //Toggle post feature
      const togglePost = () => {
        const x = document.getElementById("postForm");
        x.style.display = x.style.display === "block" ? "none" : "block";
      };

      // Get the modal
      var modal = document.getElementById('id01');
      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }

    </script>


</body>
<?php
    include_once 'footer.php';
?>