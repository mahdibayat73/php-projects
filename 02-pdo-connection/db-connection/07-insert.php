<?php

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "users02";

// create and check connection by PDO

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validate user data

    function validate_input($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = validate_input($_POST["fname"]);
        $lname = validate_input($_POST["lname"]);

        // sql to insert data
        $sql = "INSERT INTO users (fname, lname) VALUES (:fname, :lname)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->execute();

        $_SESSION["secc_insert"] = "New record created successfully";

        header("Location: 07-insert-html.php");
        exit();
    } else {
        header("Location: 07-insert-html.php");
        exit();
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
