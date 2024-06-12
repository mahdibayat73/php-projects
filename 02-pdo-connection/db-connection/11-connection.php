<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "users01";

// Create and check connection
try {
$conn = new PDO("mysql:dbhost=$dbhost; dbname=$dbname", $dbuser, $dbpass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected Successfully!";
} catch ( PDOException $e ) {
    echo "Connection failed: " . $e->getMessage();
}