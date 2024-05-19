<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "myDBPDO";

// Create and check connection by PDO
try {
    $pdo =new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to insert data
    $sql = "INSERT INTO MyGuests (firstname, lastname, email)
    VALUES ('Mahdi', 'Bayat', 'mahdibayat@gmail.com')";
    // use exec() because no results are returned
    var_dump($pdo->exec($sql));
    echo "<br>";
    echo "New record created successfully";
} catch ( PDOException $e ) {
    echo $sql . "<br>" . $e->getMessage();
}

$pdo = null;