<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "users-data";

// Create and check connection by PDO
try {
    $pdo = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch ( PDOException $err ) {
    echo "Connection failed: " . $err->getMessage();
}