<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "myDBPDO";

// create and check connection
try {
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to create table
    $sql = "CREATE TABLE MyGuests (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    // use exec() because no results are returned
    var_dump($pdo->exec($sql));
    echo "Table MyGuests created successfully";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
