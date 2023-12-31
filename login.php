<?php
//header navbar section:
include("header.html"); ?>
<!--let's whjrite the php script that will hendle authintication of the user-->
<?php
//here we gonna check if the user did submited the form
if (isset($_POST["login"])) {
    // connect to our database:
    include("connection.php");
    // let's initiate our form data:
    $username_auth = $_POST["username"];
    $password_auth = $_POST["password"];
    // let's retrieve our user hashed-password and check if ot's the same hashed password from the form data:
    $sql_retrieve = "select Password from users where Username = '$username_auth'";
    $result = $conn->query($sql_retrieve);
    if ($result->num_rows > 0) {
        // check the password
        $row = $result->fetch_assoc();
        $hashed_password = $row["Password"];
        if (password_verify($password_auth, $hashed_password)) {
            //create a session to keep tracking our user authontication
            session_start();
            $_SESSION["user_authenticated"] = true;
            header("location: http://localhost/bookini/bookshelf.php");
            exit;
        } else {
            $errorMessage = "Invalid password or username<br>please enter a valid one!";
        }
    }
    $conn->close();
}

?>
<!-- building the login section-->
<div class="welcome-section singup-section">
    <div class="signup-container">
        <div class="form-container">
            <form action="login.php" method="post">
                <h1 class="signup-header login-header" for="signup">Login into your account!</h1>

                <label for="username">Username</label>
                <input type="text" required name="username" id="username">

                <label for="password">password</label>
                <input type="password" required name="password" id="password">

                <!-- display a message 'invalid password or username'-->
                <?php
                if (isset($errorMessage)) {
                    echo "<div style='color: red; font-family : roboto; font-size : 18px'> $errorMessage </div>";
                }
                ?>

                <input class="signup-btn login-btn" type="submit" name="login" value="Login">
            </form>
        </div>
        <div class="login-option signup-option">
            <div class="overlay"></div>
            <h2>Don't Have An Account?</h2>
            <p class="white-p">Crteate your account <br>and discover our new bookshelf!</p>
            <a href="signup.php">Sign Up</a>
        </div>
    </div>
</div>
<?php
//footer section:
include("footer.html");
?>