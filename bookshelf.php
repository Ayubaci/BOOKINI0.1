<!-- check if the user is correctly authenticated-->
<?php
session_start();
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}
?>
<!-- the navbar-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--external links-->
    <link rel="stylesheet" href="./resources/css/main.css">
    <link rel="stylesheet" href="./resources/css/all.min.css">
    <link rel="stylesheet" href="./resources/css/fontawesome.min.css">
    <link rel="stylesheet" href="./resources/css/welcome.css">
    <link rel="stylesheet" href="./resources/css/login.css">
    <link rel="stylesheet" href="./resources/css/signup.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Rubik+Maps&family=Rubik+Mono+One&family=Salsa&display=swap" rel="stylesheet">
    <!--external links-->
    <title>WELCOME TO BOOKINI!</title>
</head>

<body>
    <header>
        <div class="logo-holder">
            <i class="fa-solid fa-book-open-reader logo logo-footer"></i>
            <h1>bookini</h1>
        </div>
        <nav>
            <a href="index.php">home</a>
            <a href="about.php">about us</a>
            <a href="#">Contact Us</a>
        </nav>
    </header>
    <!-- start building our bookshelf-->
    <div class="welcome-section bookshelf">
    </div>

    <?php
    //footer section:
    include("footer.html");
    ?>