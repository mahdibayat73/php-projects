<?php 

$host = "localhost";
$dbUsername = "root";
$dbPassword = "root";

// Create and check connection
try {
    $pdo = new PDO("mysql:host = $host", $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch ( PDOException $e ) {
    // Handle database connection or query errors
    $_SESSION["errors"] = ["Database error: " . $e->getMessage()];
    header("Location: ../forms/login-register.php");
    exit();
}