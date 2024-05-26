<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "users02";

// Create and check connection

try {
    $conn = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch ( PDOException $e ) {
    echo "Connection failed: " . $e->getMessage();
}

// SQL to insert
try {
    $sql = "INSERT INTO users (fname, lname) VALUES (:fname, :lname)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $fname = "First name";
    $lname = "Last name";
    $stmt->execute();
    echo "New record created successfully";
} catch ( PDOException $err ) {
    echo $sql . "<br>" . $err->getMessage();
}