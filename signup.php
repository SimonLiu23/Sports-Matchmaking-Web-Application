<?php
    include_once 'header.php';
?>

    <section class="signup-form"

        <div class="signup-form-form">
            <h1>Sign Up</h1>
            <form action="includes/signup.inc.php" method="post">
                <input type="text" name="name" placeholder="Full name...">
                <input type="text" name="email" placeholder="Email...">
                <input type="text" name="uid" placeholder="Username...">
                <input type="password" name="pwd" placeholder="Password...">
                <input type="password" name="pwdrepeat" placeholder="Password...">

                <label for="location">Preferred Location:</label>
                <select name="location" id="location">
                <option disabled selected value> Select an option </option>
                <option value="San Francisco, CA">San Francisco, CA</option>
                <option value="Sunnyvale, CA">Sunnyvale, CA</option>
                <option value="Milpitas, CA">Milpitas, CA</option>
                </select><br><br>

                <label for="match">Match Preference:</label>
                <select name="match" id="match">
                    <option disabled selected value> Select an option </option>
                    <option value="Singles">Singles (1v1)</option>
                    <option value="Doubles">Doubles (2v2)</option>
                </select><br><br>

                <label for="skill">Skill level:</label>
                <select name="skill" id="skill">
                <option disabled selected value> Select an option </option>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
                </select><br><br>

            <label for="goal">Goals:</label>
            <select name="goal" id="goal">
                <option disabled selected value> Select an option </option>
                <option value="Casual">Casual, Looking to meet new friends</option>
                <option value="Competitive">Competitive, Looking for a training partner</option>
            </select><br /><br />
                <button type="submit" name="submit">Sign Up</button>
            <ul>
            <li><a href="login.php">Already have an account? Login Now</a></li>
            </ul>
            </form>
            
        </div>
        
        <?php
            if (isset($_GET["error"])){
                if($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                }
                else if($_GET["error"] == "invaliduid"){
                    echo "<p>Choose a proper username!</p>";
                }
                else if($_GET["error"] == "invalidemail"){
                    echo "<p>Choose a proper email!</p>";
                }
                else if($_GET["error"] == "passwordsdontmatch"){
                    echo "<p>Passwords don't match!</p>";
                }
                else if($_GET["error"] == "stmtfailed"){
                    echo "<p>Something went wrong, try again!</p>";
                }
                else if($_GET["error"] == "usernametaken"){
                    echo "<p>Username already taken!</p>";
                }
                else if($_GET["error"] == "none"){
                    echo "<p>You have signed up!</p>";
                }
            }
        ?>
    </section>


<?php
    include_once 'footer.php';
?>