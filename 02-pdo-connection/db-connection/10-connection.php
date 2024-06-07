<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "users01";

// create and check connection
try {
    $conn = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}