<?php
    include_once 'header.php';
?>

    <section class="signup-form"
        
        <div class="signup-form-form">
            <h2>Login</h2>
            <form action="includes/login.inc.php" method="post">
                <input type="text" name="uid" placeholder="Username/Email..." required>
                <input type="password" name="pwd" placeholder="Password..." required>
                <button type="submit" name="submit">Log In</button>
            <ul>
            <li><a href="signup.php">Don't have an account? Sign Up Now</a></li>
            </ul>
            </form>

        </div>
        <?php
            if (isset($_GET["error"])){
                if($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields!</p>";
                }
                else if($_GET["error"] == "wronglogin"){
                    echo "<p>Incorrect login information</p>";
                }
            }
        ?>

    </section>

<?php
    include_once 'footer.php';
?>