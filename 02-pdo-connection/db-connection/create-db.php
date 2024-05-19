<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";

// Create and check connection by PDO
try {
    $pdo = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE myDBPDO";
    // use exec() because no results are returned
    var_dump($pdo->exec($sql));
    echo "<br>";
    echo "Database created successfully <br>";
} catch ( PDOException $e ) {
    echo $sql . "<br>" . $e->getMessage();
}

$pdo = null;
