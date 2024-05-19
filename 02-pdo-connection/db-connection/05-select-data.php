<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "myDBPDO";

// Create and check connection
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to select data
    $sql = "SELECT id, firstname, lastname FROM MyGuests";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // set the resulting array to associative
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    foreach ( $results as $result ) {
        foreach ( $result as $key => $val ) {
            echo $key . ": " . $val . "<br>";
        }
    }
} catch ( PDOException $e ) {
    echo $sql . "<br>" . $e->getMessage();
}