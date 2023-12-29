<?php
//initiate database connection:
$host = "localhost";
$usernamedb = "root";
$passworddb = "";
$namedb = "bookini";

//create a new mysqli object that will allow us to access the database:
$conn = new mysqli($host, $usernamedb, $passworddb, $namedb);

//check if the conn was successfull :
if ($conn->connect_error) {
    // so if the didnt connect then print out the conn error
    die("connection field!" . $conn->connect_error);
}
