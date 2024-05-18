<?php

session_start();

// Function for input validation
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data); // Correct function name
    $data = htmlspecialchars($data);
    return $data;
}

// Check request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = validate_input($_POST["username"]);
    $userEmail = validate_input($_POST["useremail"]);
    $userPass = validate_input($_POST["userpass"]);
    $repPass = validate_input($_POST["reppass"]);

    $errors = [];

    // Checking fields are not empty
    if (empty($userName) || empty($userEmail) || empty($userPass) || empty($repPass)) {
        array_push($errors, "All fields are required!");
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)) {
        array_push($errors, "Only letters and white space allowed in username!");
    }
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format!");
    }
    if (strlen($userPass) < 8) {
        array_push($errors, "Password must be at least 8 characters long!");
    }
    if ($userPass !== $repPass) {
        array_push($errors, "Passwords do not match!");
    }

    // If there are errors, set them in the session and redirect back to login-register.php
    if (!empty($errors)) {
        $_SESSION["errors"] = $errors;
        header("Location: ../login-register.php");
        exit();
    } else {
        try {
            // Connect to MySQL server
            require_once("../../db-connection/db-connection.php");

            // Create database if it does not exist
            $pdo->exec("CREATE DATABASE IF NOT EXISTS users01");

            // Connect to the newly created database
            $pdo->exec("USE users01");

            // Create table if it does not exist
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS users  (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(30) NOT NULL,
                    email VARCHAR(50) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )
            ");

            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->bindParam(':email', $userEmail);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                // Email already exists
                $_SESSION["errors"] = ["User with this email already exists!"];
                header("Location: ../login-register.php");
                exit();
            }

            // Prepare an insert statement
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

            // Bind parameters
            $stmt->bindParam(":username", $userName);
            $stmt->bindParam(":email", $userEmail);
            $stmt->bindParam(":password", password_hash($userPass, PASSWORD_DEFAULT));

            // Execute the statement
            $stmt->execute();

            // Get the user's ID
            $userId = $pdo->lastInsertId();

            // Set session variables for the new user
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $userName;

            // Redirect to success page or login page
            header("Location: ../../index.php");
            exit();
        } catch (PDOException $e) {
            // Handle database connection or query errors
            $_SESSION["errors"] = ["Database error: " . $e->getMessage()];
            header("Location: ../login-register.php");
            exit();
        }
    }
}
