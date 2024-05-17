<?php 

$servername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "users01";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

//Check connection
if ( $conn->connect_error ) {
    die("Connection Failed: " . $conn->connect_error);
}