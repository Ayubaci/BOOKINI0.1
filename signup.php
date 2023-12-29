<?php
//header navbar section:
include("header.html"); ?>

<!--sign up php code goes here:-->
<?php
include("connection.php");
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["signup"])) {
    //initiate the from data:
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $major = $_POST["major"];
    // before inserting the password directly into our database we need to hash it //
    //using bcrypt algorithm usin password_hash funtion in php
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    //create the query :
    $sql = "insert into users (FullName, Username, Password, Major)
            values ('$fullname', '$username', '$hashed_password', '$major');";
    // and now we gonna excute our pre written query with database:
    // so with that we have to check if the query was successfully excuted:
    if ($conn->query($sql) === true) {
        header("location: login.php");
        exit();
    } else {
        echo "could not excute the query";
        exit();
    }
}
$conn->close();
?>

<!-- building the login section-->
<div class="welcome-section singup-section">
    <div class="signup-container">
        <div class="form-container">
            <form action="signup.php" method="post">
                <label class="signup-header" for="signup">Create your account!</label>

                <label for="username">Username</label>
                <input type="text" required name="username">

                <label for="fullname">Fullname</label>
                <input type="text" required name="fullname">

                <label for="password">password</label>
                <input type="password" required name="password">

                <label for="major" style="margin-top: 10px;">Your Major</label>
                <div class="radio-input-container">
                    <label>
                        <input type="radio" name="major" value="computer science" required class="radio-input">
                        Computer Science
                    </label>

                    <label>
                        <input type="radio" name="major" value="biology" required class="radio-input">
                        Biology
                    </label>
                </div>

                <input class="signup-btn" type="submit" name="signup" value="Sign Up">
            </form>
        </div>
        <div class="login-option">
            <div class="overlay"></div>
            <h2>Have An Account?</h2>
            <p class="white-p">Login into your account <br>and discover our new bookshelf!</p>
            <a href="login.php">Login</a>
        </div>
    </div>
</div>
<?php
//footer section:
include("footer.html");
?>