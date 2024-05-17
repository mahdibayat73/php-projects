<?php 

session_start();

// Function form validation
function validate_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check request method
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $userName = validate_input($_POST["username"]);
    $userEmail = validate_input($_POST["useremail"]);
    $userPass = validate_input($_POST["userpass"]);
    $repPass = validate_input($_POST["reppass"]
);
    $errors = [];

    // Checking fields are not empty
    if ( empty($userName) or empty($userEmail) or empty($userPass) or empty($repPass) ) {
        array_push($errors, "All fields are required!");
    }
    if ( !preg_match("/^[a-zA-Z-' ]*$/",$userName) ) {
        array_push($errors, "Only letters and white space allowed!");
    }
    if ( !filter_var($userEmail, FILTER_VALIDATE_EMAIL) ) {
        array_push($errors, "Invalid email format!");
    }
    if ( strlen($userPass < 8) ) {
        array_push($errors, "Password must be at least 8 characters long!");
    }
    if ( $userPass !== $repPass ) {
        array_push($errors, "Password does not match!");
    }

    // If there are errors, set them in the session and redirect back to login-register.php
    if ( !empty($errors) ) {
        $_SESSION["errors"] = $errors;
        header("Location: ../login-register.php");
    }
}