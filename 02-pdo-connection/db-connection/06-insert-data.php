<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "myDBPDO";

// create and check connection
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // prepare sql and bind parameters
    $sql = "INSERT INTO MyGuests (firstname, lastname, email) VALUES (:firstname, :lastname, :email)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    
    // insert a row
    $firstname = "Test01";
    $lastname = "Testy01";
    $email = "Testy01@gmial.com";
    $stmt->execute();

    echo "New record created successfully";


} catch ( PDOException $e ) {
    echo "SQL: " . $sql . "<br>" . "ERROR: " . $e->getMessage();
}

$conn = null;