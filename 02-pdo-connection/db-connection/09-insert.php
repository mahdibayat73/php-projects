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

// SQL to insert data
try {
    $sql = "INSERT INTO users (fname, lname) VALUES (:fname, :lname)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $fname = "11";
    $lname = "Khordad";
    $stmt->execute();
    echo "New record created successfully";
} catch ( PDOException $e ) {
    echo $sql . "<br>" . $e->getMessage();
}
